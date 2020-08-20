<?php

namespace App\Http\Controllers\FrontEnd;
use App\Http\Controllers\Controller;
use App\Models\BackEnd\Offer;
use App\Models\BackEnd\Product;
use App\Models\BackEnd\Settings\Category;
use App\Models\BackEnd\Settings\Definition;
use App\Models\BackEnd\Settings\Specification;
use Config;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        Config::set('auth.defaults.guard','web');
    }
    public $departmentId ;
    public $categories ;
    public $specifications ;
    public $definitions ;

    public $filter = [];

    public function index()
    {
        $offers = Offer::all();
        $categories = $this->categories();
        $products = Product::with('department')->get();
        return view('layouts.frontEnd.pages.dashboard',compact('offers','categories','products'));
    }
    public function product($id)
    {
        $categories = $this->categories();
        $product = Product::with('category','department','productSpecifications')->where('id',$id)->first();
        
        $products = $this->products($product->department_id);
        return view('layouts.frontEnd.pages.product',compact('categories','product','products'));
    }
    public function allProducts($department_id)
    {
        session()->forget('filter');
        $this->departmentId = $department_id;
        $this->prepareMainData($department_id);
        $products = $this->products($department_id);

        return view('layouts.frontEnd.pages.allProducts',[
            'categories'     => $this->categories,
            'products'       => $products,
            'specifications' => $this->specifications,
            'definitions'    => $this->definitions]);
    }
    public function filter($department_id)
    {
        $this->departmentId = $department_id;
        $this->prepareMainData($department_id);
        session()->put('filter',request()->all());
        foreach (session('filter') as $key => $value) {
            $this->filter[] = $key;
        }

        if (count($this->filter) > 0) {
            $products = Product::with('productSpecifications')->whereHas('productSpecifications',function($q){
                $q->whereIn('definition_id',$this->filter);
            })->where('department_id',$department_id)->paginate(15);
        }else{
            $products = $this->products($department_id);
        }

        return view('layouts.frontEnd.pages.allProducts',[
            'categories'     => $this->categories,
            'products'       => $products,
            'specifications' => $this->specifications,
            'definitions'    => $this->definitions]);
    }
    private function categories()
    {
        return Category::with('departments')->sort()->get();
    }
    private function products($department_id)
    {
        return Product::where('department_id',$department_id)->paginate(15);
    }
    private function definitions($department_id)
    {
        return Definition::with('department')
        ->whereHas('department',function($q){
            $q->where('department_id',$this->departmentId);
        })->get();
    }
    private function specifications($department_id)
    {
        return Specification::with('definitions','productSpecifications')
        ->whereHas('definitions',function($q){
            $q->where('department_id',$this->departmentId);
        })
        ->orderBy('sort','asc')
        ->get();
    }
    private function prepareMainData($department_id)
    {
        $this->categories = $this->categories();
        $this->definitions = $this->definitions($department_id);
        $this->specifications =  $this->specifications($department_id);
    }
    public function fetch(Request $request)
    {
        if($request->get('query'))
        {
            $query = $request->get('query');
            $data = Product::where('en_product_name', 'LIKE', "%{$query}%")
            ->orWhere('ar_product_name', 'LIKE', "%{$query}%")
            ->get();

            $output = '<ul class="dropdown-menu" style="display:block;margin-top: -3px;width: 100%;padding: 5px;">';
            foreach($data as $row)
            {
                $search = session('lang') == 'ar' ? $row->ar_product_name : $row->en_product_name ;
                $department_id = $row->department_id;
            $output .= '
                <li><a href="#">'.$search.'</a></li>
                 ';
            }
            $output .= '</ul>';
            echo $output;
        }
    }
    public function productSearch($department_id)
    {
        $query = request('searchBox');

        $products = Product::where('en_product_name', 'LIKE', "%{$query}%")
        ->orWhere('ar_product_name', 'LIKE', "%{$query}%")
        ->paginate(15);


        $this->categories = $this->categories();

        $this->definitions = Definition::with('department')
        ->whereHas('department',function($q){
            $q->whereIn('department_id',$this->departmentRelatedSearch());
        })->get();

        $this->specifications = Specification::with('definitions','productSpecifications')
        ->whereHas('definitions',function($q){
            $q->whereIn('department_id',$this->departmentRelatedSearch());
        })
        ->sort()->get();

        return view('layouts.frontEnd.pages.allProducts',[
            'categories'     => $this->categories,
            'products'       => $products,
            'specifications' => $this->specifications,
            'definitions'    => $this->definitions]);
    }
    private function departmentRelatedSearch()
    {
        $query = request('searchBox');
        return Product::where('en_product_name', 'LIKE', "%{$query}%")
        ->orWhere('ar_product_name', 'LIKE', "%{$query}%")
        ->select('department_id')->get();
    }

}
