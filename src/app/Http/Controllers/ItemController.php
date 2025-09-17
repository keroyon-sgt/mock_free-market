<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Session;

// use Illuminate\Http\UploadedFile;

use App\Http\Requests\ItemRequest;
use App\Http\Requests\PurchaseRequest;
use App\Http\Requests\AddressRequest;

use App\Models\Item;
use App\Models\ItemCategory;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Purchase;




class ItemController extends Controller
{
    //
    public function index()
    {
        $items = Item::all();

        return view('index', compact('items') );//['items'=>$items]
    }
// ----------------------------------------------------------------
    public function item($item_id)
    {
        $item = Item::find($item_id);

        $item->price = number_format($item->price);

        $item_categories = ItemCategory::where('item_id', $item_id)->get();

        $property=array();
        foreach($item_categories as $item_category){
            $property[$item_category->category]=TRUE;
        }

        $categories = Category::all();
        $category_list=array();
        foreach($categories as $category){
            if( isset($property[ $category['id'] ]) ){
                $category_list[] = $category['content'];
            }
        }

        $comments = Comment::with('User')->where('item_id', $item_id)->where('is_deleted', NULL)->get();
        $comments_count = $comments->count();

        foreach($comments as $comment){

            if(!$comment->user->portrait_path){ $comment->user->portrait_path = 'unknown.jpg'; }

        }

        $likes_count = Like::where('item_id', $item_id)->count();

        $duplication=FALSE;
        if (Auth::check()) {
            $user = Auth::user();

            $user_like = Like::where('user_id', $user->id)->where('item_id', $item_id)->count();
            if( $user_like ){
                $duplication=TRUE;
            }
        }

        return view('item', compact('item', 'category_list', 'comments', 'comments_count', 'likes_count', 'duplication') );
    }

// --------------------------------------------------------------------
    public function comment(Request $request, $item_id)
    {
        if (Auth::check()) {
            $user = Auth::user(); // ログインユーザーのモデルを取得
        } else {
            return redirect('/login'); // 未ログインの場合はログインページへリダイレクト
        }

        $comment = Comment::create([
            'user_id' => $user->id,
            'item_id' => $request->item_id,
            'comment' => $request->comment,
        ]);
        return redirect('/item/'.$item_id);
    }
// --------------------------------------------------------------------
    public function like($item_id)  //Request $request, 
    {
        if (Auth::check()) {
            $user = Auth::user();
        } else {
            return redirect('/login');
        }

        if( !$duplication=Like::where('user_id', $user->id)->where('item_id', $item_id)->count() )
        {
            $like = Like::create([
                'user_id' => $user->id,
                'item_id' => $item_id,
            ]);
        }

        return redirect('/item/'.$item_id);
    }

// --------------------------------------------------------------------
    public function sellForm()
    {
        $categories = Category::all();

        return view('sell', compact('categories'));
    }

    public function sellStore(Request $request) //ItemRequest //file必須を追加のこと
    {
        if (Auth::check()) {
            $user = Auth::user(); // ログインユーザーのモデルを取得
        } else {
            return redirect('/login'); // 未ログインの場合はログインページへリダイレクト
        }

        $image_path='';

        if($request->file('image')){
            $image_path = $request->file('image')->store('public');
        }

        $item = Item::create([
            'user_id' => $user->id,
            'condition' => $request->condition,
            'title' => $request->title,
            'brand' => $request->brand,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => 1,
            'image_path' => basename($image_path),
        ]);

        if(isset($request->category) && is_array($request->category)){
            foreach($request->category as $category){
                $item_category = ItemCategory::create([
                    'item_id' => $item->id,
                    'category' => $category,
                ]);
            }
        }

        return redirect('/');
    }
 //----------------------------------------------------------------------

    public function purchaseForm($item_id)  //Request $request
    {
        if( NULL == session('item_id') ){
            session()->put('item_id', $item_id);
        }elseif($item_id !== session('item_id') ){
            session()->put('item_id', $item_id);
            session()->remove('delivery');
            session()->remove('price');
        }

        $item = Item::find($item_id);

        $price_formed = number_format($item->price);

        if (Auth::check()) {
            $user = Auth::user();
        } else {
            return redirect('/login');
        }

        $delivery=array();
        if(null !== session('delivery')){
            $delivery = session('delivery');
        }else{
            $delivery['postal_code'] = $user->postal_code;
            $delivery['address'] = $user->address;
            $delivery['building'] = $user->building;
            // session()->put('delivery', $delivery);
        }

        // session()->put('price', $item->price);

        return view('purchase', compact('item', 'price_formed', 'user', 'delivery') );
    }

    
//-------------------------------------------------------------------------

    public function purchase(Request $request)  //PurchaseRequest
    {

        $purchase = $request->only([
            'item_id',
            'price',
            'method',
            'postal_code',
            'address',
            'building',
        ]);

        if (Auth::check()) {
            $purchase['user_id'] = Auth::id();
        } else {
            return redirect('/login');
        }

        $result = Purchase::create($purchase);

        $item = Item::find($purchase['item_id']);

        $item->stock--;
        $item->save();


        // return view('thanks/'.$result->id);
        // return redirect('purchase/'.$request['item_id'] );
        return redirect('/');
    }

//-------------------------------------------------------------------------

    public function addressForm()
    {


        $item_id=session('item_id');

        if (Auth::check()) {
            $user = Auth::user();
        } else {
            return redirect('/login');
        }

        $delivery=array();
        if(null !==session('delivery')){
            $delivery = session('delivery');
        }else{
            $delivery['postal_code'] = $user->postal_code;
            $delivery['address'] = $user->address;
            $delivery['building'] = $user->building;
        }

        return view('address', compact('delivery'));    //, 'item_id'
    }
// --------------------------------------------------------------------
    public function addressSet(AddressRequest $request)
    {
        $delivery = $request->only([
            'postal_code',
            'address',
            'building',
        ]);

        session()->put('delivery', $delivery);

// exit;
        // Item::create($Item);
        // return view('thanks');
        return redirect('purchase/'.session('item_id') );
    }

    // --------------------------------------------------------------------

    public function search(Request $request)
    {

        $items = Item::with('category')
            ->KeywordSearch($request->keyword)
            ->get();

        $query = Item::query();
        if ($value = $request->keyword) {
            $query->where('title', 'LIKE', "%{$value}%")
                ->orWhere('brand', 'LIKE', "%{$value}%")
                ->orWhere('description', 'LIKE', "%{$value}%")
                ->orWhere('price', 'LIKE', "%{$value}%");
        }

        $items = $query->paginate(7)->withQueryString();

        return view('index', compact('items'));
    }

    // --------------------------------------------------------------------


}
