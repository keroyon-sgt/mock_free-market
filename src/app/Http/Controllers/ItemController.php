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

// echo '<br /><br />item_id = ';
// var_dump($item_id);

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


//コメント読み込み
        $comments = Comment::with('User')->where('item_id', $item_id)->where('is_deleted', NULL)->get();
        $comments_count = $comments->count();

        foreach($comments as $comment){

// echo '<br /><br />comment->user->portrait_path = ';
// var_dump($comment->user->portrait_path);

            if(!$comment->user->portrait_path){ $comment->user->portrait_path = 'unknown.jpg'; }

// echo '<br /><br />comment->user->portrait_path after= ';
// var_dump($comment->user->portrait_path);

        }


        $likes_count = Like::where('item_id', $item_id)->count();

        $duplication=FALSE;
        if (Auth::check()) {
            $user = Auth::user();

            $user_like = Like::where('user_id', $user->id)->where('item_id', $item_id)->count();
            if( $user_like ){
                $duplication=TRUE;
            }

// echo '<br /><br />Like::';
// var_dump(Like::where('user_id', $user->id)->where('item_id', $item_id)->count());


        }

// echo '<br /><br />categories';
// var_dump($categories);
// echo '<br /><br />category_list';
// var_dump($category_list);
// echo '<br /><br />request = ';
// var_dump($request);

// echo '<br /><br />item = ';
// var_dump($item);

// foreach($item_categories as $item_category){

// echo '<br /><br />item_category->category = ';
// var_dump($item_category->category);
// }

// echo '<br /><br />getRequestUri() = ';
// var_dump( $request->getRequestUri() );
// echo '<br /><br />current() = ';
// var_dump( url()->current() );
// echo '<br /><br />full() = ';
// var_dump( url()->full() );

// exit;

        return view('item', compact('item', 'category_list', 'comments', 'comments_count', 'likes_count', 'duplication') );
    }

// --------------------------------------------------------------------
    public function comment(Request $request, $item_id)
    {
        
// echo '<br />comment() ';
// echo '<br />get = ';
// var_dump($_GET);
// echo '<br />post = ';
// var_dump($_POST);
// echo '<br />session(id) = ';
// var_dump(session('item_id'));
// echo '<br />file(image) = ';
// var_dump( $request->file('image') );

        
        if (Auth::check()) {
            $user = Auth::user(); // ログインユーザーのモデルを取得
        } else {
            return redirect('/login'); // 未ログインの場合はログインページへリダイレクト
        }
        

// echo '<br /><br />item->image_path = ';
// var_dump($item->image_path);
// echo '<br /><br />item = ';
// // var_dump($item);
// echo '<br />image_path = ';
// // var_dump(basename($image_path));


        $comment = Comment::create([
            'user_id' => $user->id,
            'item_id' => $request->item_id,
            'comment' => $request->comment,
        ]);


// echo '<br /><br />user->id = ';
// var_dump($user->id);
// echo '<br /><br />item_id = ';
// var_dump($item_id);


// exit;

        return redirect('/item/'.$item_id);
    }
// --------------------------------------------------------------------
    public function like($item_id)  //Request $request, 
    {
        
// echo '<br />like() ';
// echo __FUNCTION__;
// echo '<br />get = ';
// var_dump($_GET);
// echo '<br />post = ';
// var_dump($_POST);
// echo '<br />session(id) = ';
// var_dump(session('item_id'));
// echo '<br />file(image) = ';
// var_dump( $request->file('image') );

        
        if (Auth::check()) {
            $user = Auth::user(); // ログインユーザーのモデルを取得
        } else {
            return redirect('/login'); // 未ログインの場合はログインページへリダイレクト
        }
        

// echo '<br /><br />item->image_path = ';
// var_dump($item->image_path);
// echo '<br /><br />item = ';
// // var_dump($item);
// echo '<br />image_path = ';
// // var_dump(basename($image_path));

        if( !$duplication=Like::where('user_id', $user->id)->where('item_id', $item_id)->count() )
        {
            $like = Like::create([
                'user_id' => $user->id,
                'item_id' => $item_id,
            ]);
        }
        

// echo '<br /><br />user->id = ';
// var_dump($user->id);
// echo '<br /><br />item_id = ';
// var_dump($item_id);
// echo '<br /><br />duplication = ';
// var_dump($duplication);


// exit;

        return redirect('/item/'.$item_id);
    }

// --------------------------------------------------------------------
    public function sellForm()
    {
        // $items = Item::all();
        $categories = Category::all();
        
        return view('sell', compact('categories'));//['items'=>$items]
    }

    public function sellStore(Request $request) //ItemRequest //file必須を追加のこと
    {
        
// echo '<br />get = ';
// var_dump($_GET);
// echo '<br />post = ';
// var_dump($_POST);
// echo '<br />session(id) = ';
// var_dump(session('item_id'));
// echo '<br />file(image) = ';
// var_dump( $request->file('image') );

        
        if (Auth::check()) {
            $user = Auth::user(); // ログインユーザーのモデルを取得
        } else {
            return redirect('/login'); // 未ログインの場合はログインページへリダイレクト
        }
        

        // $Item = $request->only([
        //     'title',
        //     'brand',
        //     'description',
        //     'price',
        // ]);

        $image_path='';

        if($request->file('image')){
            $image_path = $request->file('image')->store('public');

// echo '<br />image_path = ';
// var_dump( $image_path );
// echo '<br />basename(image_path) = ';
// var_dump(basename($image_path));

            // $item->image_path = basename($image_path);
        }

// echo '<br /><br />item->image_path = ';
// var_dump($item->image_path);
// echo '<br /><br />item = ';
// // var_dump($item);
// echo '<br />image_path = ';
// var_dump(basename($image_path));

        // $post=new Item();
        //     $post->product=$request->product;
        //     $post->category_id=$request->brand_id;
        //     $post->price=$request->price;
        //     $post->stock=$request->stock;
        //     if(isset($request->image_path)){
        //         $file_name=$request->image_path->getClientOriginalName();
        //         $post->image_path=$request->file('image_path')->storeAs('storage/images',$file_name);



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


// echo '<br /><br />item->id = ';
// var_dump($item->id);



        if(isset($request->category) && is_array($request->category)){
            foreach($request->category as $category){
                $item_category = ItemCategory::create([
                    'item_id' => $item->id,
                    'category' => $category,
                ]);
            }
        }




// exit;





        //foreach categories -> item-ctg.db

        // Item::create($Item);

//-----------------------------------------------------

        // $Item = $request->only([
        //     'first_name',
        //     'last_name',
        //     'gender',
        //     'email',
        //     // 'tel-1',
        //     // 'tel-2',
        //     // 'tel-3',
        //     'address',
        //     'building',
        //     'category_id',
        //     'detail',
        // ]);


        // if($request->input('correct') == 'correct'){
        //     return redirect('sell')->withInput();
        // }

        // Item::create($Item);



        return redirect('/');
    }
 //----------------------------------------------------------------------

    public function purchaseForm($item_id)  //Request $request
    {

// echo '<br /><br />item_id = ';
// var_dump($item_id);


        //user_idとaddressをsessionにset

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
            $user = Auth::user(); // ログインユーザーのモデルを取得
        } else {
            return redirect('/login'); // 未ログインの場合はログインページへリダイレクト
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

        session()->put('price', $item->price);

// echo '<br />get = ';
// var_dump($_GET);
// echo '<br />post = ';
// var_dump($_POST);
// echo '<br />postal_code = ';
// var_dump(session('postal_code'));
// echo '<br />delivery = ';
// var_dump(session('delivery'));
// echo '<br />price = ';
// var_dump(session('price'));
// echo '<br />user->id = ';
// var_dump($user);
// echo '<br />session(id) = ';
// var_dump( session()->get('item_id') );
// echo '<br />session = ';
// var_dump(Session::getId());

        // return $Item;
        // return view('confirm');
        // return view('confirm', ['Item' => $Item]);
        return view('purchase', compact('item', 'price_formed', 'user', 'delivery') );
    }

    
//-------------------------------------------------------------------------

    public function purchase(Request $request)  //PurchaseRequest
    {

// echo __FUNCTION__;
// echo '<br /><br />item_id = ';
// var_dump($item_id);
// echo '<br />get = ';
// var_dump($_GET);
// echo '<br />post = ';
// var_dump($_POST);
// echo '<br />item(id) = ';
// var_dump(session('item_id'));
// echo '<br />session(id) = ';
// var_dump( session()->get('item_id') );
// echo '<br />session = ';
// var_dump(Session::getId());


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
            return redirect('/login'); // 未ログインの場合はログインページへリダイレクト
        }

        // $delivery = session('delivery');

        // $purchase['item_id'] = session('item_id');
        // $purchase['postal_code'] = $delivery['postal_code'];
        // $purchase['address'] = $delivery['address'];
        // $purchase['building'] = $delivery['building'];
        // $purchase['price'] = $delivery['price'];

// echo '<br />purchase = ';
// var_dump($purchase);

// exit;
            //if(session address)sessionからaddressを抜き出す
        $result = Purchase::create($purchase);
// exit;



        $item = Item::find($purchase['item_id']); // ログインユーザーのモデルを取得


        $item->stock--;
        $item->save();


        // return view('thanks/'.$result->id);
        // return redirect('purchase/'.$request['item_id'] );
        return redirect('/');
    }

//-------------------------------------------------------------------------

    public function addressForm()
    {

// echo '<br /><br />item_id = ';
// var_dump($item_id);

        $item_id=session('item_id');
        // session()->put('item_id', $item_id);
        // $item = Item::find($item_id);

        if (Auth::check()) {
            $user = Auth::user(); // ログインユーザーのモデルを取得
        } else {
            return redirect('/login'); // 未ログインの場合はログインページへリダイレクト
        }

        $delivery=array();
        if(null !==session('delivery')){
            $delivery = session('delivery');
        }else{
            $delivery['postal_code'] = $user->postal_code;
            $delivery['address'] = $user->address;
            $delivery['building'] = $user->building;
        }



// echo '<br />get = ';
// var_dump($_GET);
// echo '<br />post = ';
// var_dump($_POST);
// echo '<br />session(id) = ';
// var_dump(session('item_id'));
// echo '<br />session(id) = ';
// var_dump( session()->get('item_id') );
// echo '<br />session = ';
// var_dump(Session::getId());

        return view('address', compact('delivery'));    //, 'item_id'
    }
// --------------------------------------------------------------------
    public function addressSet(AddressRequest $request)
    {

// echo '<br /><br />item_id = ';
// var_dump($item_id);

        $delivery = $request->only([
            'postal_code',
            'address',
            'building',
        ]);

        session()->put('delivery', $delivery);

// echo '<br />get = ';
// var_dump($_GET);
// echo '<br />post = ';
// var_dump($_POST);
// echo '<br />session(item_id) = ';
// var_dump(session('item_id'));
// echo '<br />session(id) = ';
// var_dump( session()->get('item_id') );
// echo '<br />session(delivery) = ';
// var_dump(session('delivery'));
// echo '<br />session(delivery) = ';
// var_dump(session('delivery')['postal_code']);
// echo '<br />session = ';
// var_dump(Session::getId());


            //if(session address)sessionからaddressを抜き出す
// exit;
        // Item::create($Item);
        // return view('thanks');
        return redirect('purchase/'.session('item_id') );
    }

// --------------------------------------------------------------------

    // public function store(Request $request)
    public function store(ItemRequest $request)
    {
        $Item = $request->only([
            'first_name',
            'last_name',
            'gender',
            'email',
            // 'tel-1',
            // 'tel-2',
            // 'tel-3',
            'address',
            'building',
            'category_id',
            'detail',
        ]);

        $Item['tel']=$request['tel-1'].$request['tel-2'].$request['tel-3'];

        if($request->input('correct') == 'correct'){
            return redirect('/')->withInput();
        }

        Item::create($Item);
        return view('thanks');
    }

    // --------------------------------------------------------------------

    public function destroy(Request $request)
    {
        Item::find($request->id)->delete();

        return redirect('/admin');//->with('message', 'お問い合わせを削除しました');
    }

    // --------------------------------------------------------------------

    public function admin(Request $request)
    {

        $items = Item::paginate(7);


        $categories = Category::all();

        $category_list=array();
        foreach($categories as $category){
            $category_list += array($category['id']=>$category['content']);
        }

        $form_action = '/export';

        return view('admin', compact('items', 'category_list', 'categories', 'request', 'form_action'));
    }

    // public function category()
    // {
    //     return $this->belongsTo(Category::class);
    // }

    // public function scopeCategorySearch($query, $category_id)
    // {
    //     if (!empty($category_id)) {
    //         $query->where('category_id', $category_id);
    //     }
    // }

    // public function scopeKeywordSearch($query, $keyword)
    // {
    //     if (!empty($keyword)) {
    //         $query->where('detail', 'like', '%' . $keyword . '%');
    //     }
    // }

    // --------------------------------------------------------------------

    public function search(Request $request)
    {

// echo __FUNCTION__;
// echo '<br />get = ';
// var_dump($_GET);
// echo '<br />request = ';
// var_dump($request);

        $items = Item::with('category')
            ->KeywordSearch($request->keyword)
            ->get();
        
// $items = $items->paginate(7)->withQueryString();
// echo '<br />items = ';
// var_dump($items);

        $query = Item::query();
        if ($value = $request->keyword) {
            $query->where('title', 'LIKE', "%{$value}%")
                ->orWhere('brand', 'LIKE', "%{$value}%")
                ->orWhere('description', 'LIKE', "%{$value}%")
                ->orWhere('price', 'LIKE', "%{$value}%");

// echo '<br /><br />value(k) = ';
// var_dump($value);
// echo '<br /><br />query = ';
// var_dump($query);

        }


        $items = $query->paginate(7)->withQueryString();

// echo '<br /><br />keyword = ';
// var_dump($request->keyword);

// echo '<br /><br />items = ';
// var_dump($items);
// exit;

// exit;

        return view('index', compact('items'));
    }

    // --------------------------------------------------------------------


}
