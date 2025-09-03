<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Session;

use App\Http\Requests\ItemRequest;
use App\Http\Requests\PurchaseRequest;
use App\Models\Item;
use App\Models\Category;



class ItemController extends Controller
{
    //
    public function index()
    {
        $items = Item::all();

        return view('index', compact('items') );//['items'=>$items]
    }

    public function item($item_id)
    {

// echo '<br /><br />item_id = ';
// var_dump($item_id);

        $item = Item::find($item_id);

        $categories = Category::all();
        $category_list=array();
        foreach($categories as $category){
            $category_list += array($category['id']=>$category['content']);
        }

// echo '<br /><br />categories';
// var_dump($categories);
// echo '<br /><br />category_list';
// var_dump($category_list);
// echo '<br /><br />request = ';
// var_dump($request);

// echo '<br /><br />item = ';
// var_dump($item);
// exit;

        return view('item', compact('item', 'category_list') );
    }

    public function sellForm()
    {
        // $items = Item::all();
        $categories = Category::all();
        
        return view('sell', compact('categories'));//['items'=>$items]
    }

    public function purchaseForm($item_id)
    {

// echo '<br /><br />item_id = ';
// var_dump($item_id);


        //user_idとaddressをsessionにset

        session()->put('item_id', $item_id);

        $item = Item::find($item_id);

echo '<br />get = ';
var_dump($_GET);
echo '<br />post = ';
var_dump($_POST);
echo '<br />session(id) = ';
var_dump(session('item_id'));
echo '<br />session(id) = ';
var_dump( session()->get('item_id') );
// echo '<br />session = ';
// var_dump(Session::getId());

        // return $Item;
        // return view('confirm');
        // return view('confirm', ['Item' => $Item]);
        return view('purchase', compact('item') );
    }

    public function purchase(PurchaseRequest $request)
    {

// echo '<br /><br />item_id = ';
// var_dump($item_id);

        $purchase = $request->only([
            'method',
            // 'postal_code',
            // 'address',
            // 'building',
        ]);

echo '<br />get = ';
var_dump($_GET);
echo '<br />post = ';
var_dump($_POST);
echo '<br />session(id) = ';
var_dump(session('item_id'));
echo '<br />session(id) = ';
var_dump( session()->get('item_id') );
// echo '<br />session = ';
// var_dump(Session::getId());


            //if(session address)sessionからaddressを抜き出す
exit;
        // Item::create($Item);
        // return view('thanks');
        return redirect('purchase/'.$request['item_id'] );
    }

 public function addressForm()
    {

// echo '<br /><br />item_id = ';
// var_dump($item_id);

        // session()->put('item_id', $item_id);
        // $item = Item::find($item_id);

echo '<br />get = ';
var_dump($_GET);
echo '<br />post = ';
var_dump($_POST);
echo '<br />session(id) = ';
var_dump(session('item_id'));
echo '<br />session(id) = ';
var_dump( session()->get('item_id') );
// echo '<br />session = ';
// var_dump(Session::getId());

        return view('address');
    }

    public function addressSet(PurchaseRequest $request)
    {

// echo '<br /><br />item_id = ';
// var_dump($item_id);

        $purchase = $request->only([
            'method',
            // 'postal_code',
            // 'address',
            // 'building',
        ]);

echo '<br />get = ';
var_dump($_GET);
echo '<br />post = ';
var_dump($_POST);
echo '<br />session(id) = ';
var_dump(session('item_id'));
echo '<br />session(id) = ';
var_dump( session()->get('item_id') );
// echo '<br />session = ';
// var_dump(Session::getId());


            //if(session address)sessionからaddressを抜き出す
exit;
        // Item::create($Item);
        // return view('thanks');
        return redirect('purchase/'.$request['item_id'] );
    }



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

    public function destroy(Request $request)
    {
        Item::find($request->id)->delete();

        return redirect('/admin');//->with('message', 'お問い合わせを削除しました');
    }

    public function admin(Request $request)
    {

        $Items = Item::paginate(7);


        $categories = Category::all();

        $category_list=array();
        foreach($categories as $category){
            $category_list += array($category['id']=>$category['content']);
        }

        $form_action = '/export';

        return view('admin', compact('Items', 'category_list', 'categories', 'request', 'form_action'));
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

    public function search(Request $request)
    {
        
        $Items = Item::with('category')
        // $Items = Item::query()
            ->CategorySearch($request->category_id)
            ->DateSearch($request->created_at)
            ->GenderSearch($request->gender)
            ->KeywordSearch($request->keyword)
            ->get();
        
        // $Items = $Items->paginate(7)->withQueryString();
// echo '<br />Items = ';
// var_dump($Items);

        $query = Item::query();
        if ($value = $request->category_id) {
            $query->where('category_id', $value);

// echo '<br /><br />value(category_id) = ';
// var_dump($value);
// echo '<br /><br />query = ';
// var_dump($query);

        }
        if ($value = $request->gender) {
            $query->where('gender', $value);

// echo '<br /><br />value(g) = ';
// var_dump($value);
// echo '<br /><br />query = ';
// var_dump($query);

        }
        if ($value = $request->created_at) {
            $query->where('created_at', $value.'%');

// echo '<br /><br />value(c) = ';
// var_dump($value);
// echo '<br /><br />query = ';
// var_dump($query);

        }
        if ($value = $request->keyword) {
            $query->where('email', 'LIKE', "%{$value}%")
                ->orWhere('detail', 'LIKE', "%{$value}%")
                ->orWhere('email', 'LIKE', "%{$value}%")
                ->orWhere('last_name', 'LIKE', "%{$value}%")
                ->orWhere('first_name', 'LIKE', "%{$value}%");

// echo '<br /><br />value(k) = ';
// var_dump($value);
// echo '<br /><br />query = ';
// var_dump($query);


        }
        $Items = $query->paginate(7)->withQueryString();

// echo '<br /><br />category_id = ';
// var_dump($request->category_id);
// echo '<br /><br />gender = ';
// var_dump($request->gender);
// echo '<br /><br />created_at = ';
// var_dump($request->created_at);
// echo '<br /><br />keyword = ';
// var_dump($request->keyword);

// echo '<br /><br />Items = ';
// var_dump($Items);
// exit;

        $categories = Category::all();

        $category_list=array();
        foreach($categories as $category){
            $category_list += array($category['id']=>$category['content']);
        }

        $form_action = '/export/search';

// echo '<br />categories';
// var_dump($categories);
// echo '<br />category_list';
// var_dump($category_list);
// exit;

        return view('admin', compact('Items', 'category_list', 'request', 'form_action'));
    }

    public function test(){ return view('test'); }
    public function test_js01(){ return view('test_js01'); }
    public function test_js02(){ return view('test_js02'); }

    public function thanks(){ return view('thanks'); }


}
