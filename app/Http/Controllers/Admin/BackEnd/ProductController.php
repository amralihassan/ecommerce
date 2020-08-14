<?php

namespace App\Http\Controllers\Admin\BackEnd;
use App\Http\Controllers\Controller;
use File;
use App\Models\BackEnd\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $data = Product::with('category','department')->get();
            return datatables($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($data){
                           $btn = '<a class="btn btn-warning btn-sm" href="'.route('products.edit',$data->id).'">
                           <i class=" la la-edit"></i>
                       </a>';
                            return $btn;
                    })
                    ->addColumn('add_specifications', function($data){
                        $btn = '<a class="btn btn-success btn-sm" href="'.route('productSpecifications.index',$data->id).'">
                            <i class=" la la-plus"></i>
                        </a>';
                            return $btn;
                    })
                    ->addColumn('department_id',function($data){
                        return session('lang') == 'ar' || session('lang') == trans('admin.ar') ?
                        $data->department->ar_department_name :$data->department->en_department_name;
                    })
                    ->addColumn('category_id',function($data){
                        return session('lang') == 'ar' || session('lang') == trans('admin.ar') ?
                        $data->category->ar_category_name :$data->category->en_category_name;
                    })
                    ->addColumn('check', function($data){
                           $btnCheck = '<label class="pos-rel">
                                        <input type="checkbox" class="ace" name="id[]" value="'.$data->id.'" />
                                        <span class="lbl"></span>
                                    </label>';
                            return $btnCheck;
                    })
                    ->rawColumns(['action','check','category_id','department_id','add_specifications'])
                    ->make(true);
        }
        return view('layouts.backEnd.products.index',['title'=>trans('admin.products')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.backEnd.products.create',['title'=>trans('admin.new_product')]);
    }
    private function attributes()
    {
        return [
            'en_product_name',
            'ar_product_name',
            'ar_description',
            'en_description',
            'country_id',
            'department_id',
            'seller_id',
            'category_id',
            'price',
            'brand',
            'discount_price',
            'item_condition',
            'note',
            'admin_id'
        ];
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->user()->products()->create($request->only($this->attributes())
        + ['product_image'=>$this->uploadProductImage()]);
        alert()->success(trans('msg.stored_successfully'), trans('admin.new_product'));
        return redirect()->route('products.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('layouts.backEnd.products.edit',['title'=>trans('admin.edit_product'),'product'=>$product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $product->update($request->only($this->attributes())
        + ['product_image'=>$this->uploadProductImage($product)]);
        alert()->success(trans('msg.updated_successfully'), trans('admin.edit_product'));
        return redirect()->route('products.index');
    }
    private function uploadProductImage(Product $product = null)
    {
        $fileName = '';

        $productImageName = !empty($product) ? $product : '';


        if (request()->hasFile('product_image'))
        {
            if (!empty($productImageName)) {
                            // remove old image
                $image_path = public_path("/images/product_images/".$productImageName->product_image);
                // return dd($image_path);
                if(File::exists($image_path)) {
                    File::delete($image_path);
                }
            }

            $product_image = request('product_image');
            $fileName = time().'-'.$product_image->getClientOriginalName();

            $location = public_path('images/product_images');

            $product_image->move($location,$fileName);
            $data['product_image'] = $fileName;
        }
        return empty($fileName) ? $productImageName->product_image : $fileName ;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if (request()->ajax()) {
            if (request()->has('id'))
            {
                foreach (request('id') as $id) {
                    Product::destroy($id);
                }
            }
        }
        return response(['status'=>true]);
    }
}
