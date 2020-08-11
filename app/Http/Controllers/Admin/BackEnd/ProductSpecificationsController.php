<?php

namespace App\Http\Controllers\Admin\BackEnd;
use App\Http\Controllers\Controller;
use App\Models\BackEnd\Product;
use App\Models\BackEnd\ProductSpecifications;
use Illuminate\Http\Request;

class ProductSpecificationsController extends Controller
{
    public $productName;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $productName = session('lang') == 'ar' || session('lang') == trans('admin.ar') ?
            $this->getProductName($id)->ar_product_name :$this->getProductName($id)->en_product_name;

        if (request()->ajax()) {
            $data = ProductSpecifications::with('product','definition','specification')
            ->where('product_id',$id)->get();

            return datatables($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($data){
                           $btn = '<a class="btn btn-warning btn-sm" href="'.route('productSpecifications.edit',$data->id).'">
                                        <i class=" la la-edit"></i>
                                    </a>';
                            return $btn;
                    })
                    ->addColumn('definition_id',function($data){
                        return session('lang') == 'ar' || session('lang') == trans('admin.ar') ?
                        $data->definition->ar_value :$data->definition->en_value;
                    })
                    ->addColumn('specification_id',function($data){
                        return session('lang') == 'ar' || session('lang') == trans('admin.ar') ?
                        $data->specification->ar_specification_name :$data->specification->en_specification_name;
                    })
                    ->addColumn('check', function($data){
                           $btnCheck = '<label class="pos-rel">
                                        <input type="checkbox" class="ace" name="id[]" value="'.$data->id.'" />
                                        <span class="lbl"></span>
                                    </label>';
                            return $btnCheck;
                    })
                    ->rawColumns(['action','check','definition_id','specification_id'])
                    ->make(true);
        }
        return view('layouts.backEnd.productSpecifications.index',
        [
            'title'         => trans('admin.productSpecifications'),
            'id'            => $id,
            'productName'   => $productName]);
    }
    private function getProductName($product_id)
    {
        return Product::findOrFail($product_id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $productName = session('lang') == 'ar' || session('lang') == trans('admin.ar') ?
        $this->getProductName($id)->ar_product_name :$this->getProductName($id)->en_product_name;

        return view('layouts.backEnd.productSpecifications.create',
        ['title'=>trans('admin.new_productSpecifications'),'id'=>$id,'productName'=>$productName]);
    }
    private function attributes()
    {
        return [
            'product_id',
            'specification_id',
            'definition_id',
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
        $request->user()->productSpecifications()->create($request->only($this->attributes()));
        alert()->success(trans('msg.stored_successfully'), trans('admin.new_productSpecifications'));
        return redirect()->route('productSpecifications.index',request('product_id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductSpecifications  $productSpecifications
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductSpecifications $productSpecifications)
    {
        $productName = session('lang') == 'ar' || session('lang') == trans('admin.ar') ?
        $this->getProductName($productSpecifications->product_id)->ar_product_name :
            $this->getProductName($productSpecifications->product_id)->en_product_name;

        return view('layouts.backEnd.productSpecifications.edit',['title'=>trans('admin.edit_productSpecifications'),
        'productSpecifications'=>$productSpecifications,'productName'=>$productName]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductSpecifications  $productSpecifications
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductSpecifications $productSpecifications)
    {
        $productSpecifications->update($request->only($this->attributes()));
        alert()->success(trans('msg.updated_successfully'), trans('admin.edit_productSpecifications'));
        return redirect()->route('productSpecifications.index',request('product_id'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductSpecifications  $productSpecifications
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductSpecifications $productSpecifications)
    {
        if (request()->ajax()) {
            if (request()->has('id'))
            {
                foreach (request('id') as $id) {
                    ProductSpecifications::destroy($id);
                }
            }
        }
        return response(['status'=>true]);
    }
}
