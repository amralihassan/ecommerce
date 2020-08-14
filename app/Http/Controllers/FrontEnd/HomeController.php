<?php

namespace App\Http\Controllers\FrontEnd;
use App\Http\Controllers\Controller;
use App\Models\BackEnd\Offer;
use App\Models\BackEnd\Product;
use App\Models\BackEnd\ProductSpecifications;
use App\Models\BackEnd\Settings\Category;
use App\Models\BackEnd\Settings\Definition;
use App\Models\BackEnd\Settings\Specification;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public $departmentId ;

    public function index()
    {
        $offers = Offer::all();
        $categories = Category::with('departments')->orderBy('sort','asc')->get();
        return view('layouts.frontEnd.pages.dashboard',compact('offers','categories'));
    }
    public function product($id)
    {
        $categories = Category::with('departments')->orderBy('sort','asc')->get();
        $product = Product::with('category','department','productSpecifications')->where('id',$id)->first();
        return view('layouts.frontEnd.pages.product',compact('categories','product'));
    }
    public function allProducts($department_id)
    {
        $this->departmentId = $department_id;
        $categories = Category::with('departments')->orderBy('sort','asc')->get();
        $products = Product::where('department_id',$department_id)->paginate(15);

        /**
         * products - specifications - definitions
         */
        $definitions = Definition::with('department')
        ->whereHas('department',function($q){
            $q->where('department_id',$this->departmentId);
        })->get();

        $specifications = Specification::with('definitions','productSpecifications')
        ->whereHas('definitions',function($q){
            $q->where('department_id',$this->departmentId);
        })

        ->orderBy('sort','asc')
        ->get();

        return view('layouts.frontEnd.pages.allProducts',compact('categories','products','specifications','definitions'));
    }
}

/**
 *   $specifications = Specification::with('definitions')
        // ->whereHas('definitions',function($q){
        //     $q->where('department_id',$this->departmentId);
        // })
        ->orderBy('sort','asc')->get();
 */

 /**
  *
        $data = ProductSpecifications::with('definition','product','specification')
        ->whereHas('product',function($q){
            $q->where('products.department_id',$this->departmentId);
        })
        ->whereHas('definition',function($q){
            $q->where('definitions.department_id',$this->departmentId);
        })
        ->distinct('specification_id')
        ->get();

  */
