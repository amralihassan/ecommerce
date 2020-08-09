<?php

namespace App\Http\Controllers\Admin\BackEnd;
use App\Http\Controllers\Controller;
use App\Http\Requests\SellerRequest;
use App\Models\BackEnd\Seller;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $data = Seller::latest();
            return datatables($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($data){
                           $btn = '<a class="btn btn-warning btn-sm" href="'.route('sellers.edit',$data->id).'">
                           <i class=" la la-edit"></i>
                       </a>';
                            return $btn;
                    })
                    ->addColumn('check', function($data){
                           $btnCheck = '<label class="pos-rel">
                                        <input type="checkbox" class="ace" name="id[]" value="'.$data->id.'" />
                                        <span class="lbl"></span>
                                    </label>';
                            return $btnCheck;
                    })
                    ->rawColumns(['action','check'])
                    ->make(true);
        }
        return view('layouts.backEnd.sellers.index',['title'=>trans('admin.sellers')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.backEnd.sellers.create',['title'=>trans('admin.new_seller')]);
    }
    private function attributes()
    {
        return [
            'seller_name',
            'mobile',
            'email',
            'activition',
            'address',
            'admin_id'
        ];
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SellerRequest $request)
    {
        $request->user()->sellers()->create($request->only($this->attributes()));
        alert()->success(trans('msg.stored_successfully'), trans('admin.new_seller'));
        return redirect()->route('sellers.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function edit(Seller $seller)
    {
        return view('layouts.backEnd.sellers.edit',['title'=>trans('admin.edit_seller'),'seller'=>$seller]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Seller $seller)
    {
        $seller->update($request->only($this->attributes()));
        alert()->success(trans('msg.updated_successfully'), trans('admin.edit_seller'));
        return redirect()->route('sellers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seller $seller)
    {
        if (request()->ajax()) {
            if (request()->has('id'))
            {
                foreach (request('id') as $id) {
                    Seller::destroy($id);
                }
            }
        }
        return response(['status'=>true]);
    }
    public function getSellers()
    {
        $output = "";
        $sellers = Seller::where('activition','yes')->get();
        $output .='<option value="">'.trans('admin.select').'</option>';
        foreach ($sellers as $seller) {
            $output .= ' <option value="'.$seller->id.'">'.$seller->sellerName.'</option>';
        };
        return json_encode($output);
    }
    public function getSellerSelected()
    {
        $id = request()->get('country_id');
        $output = "";
        $sellers = Seller::where('activition','yes')->get();
        $output .='<option value="">'.trans('admin.select').'</option>';
        foreach ($sellers as $seller) {
            $selected = $seller->id == $id?"selected":"";
            $output .= ' <option '.$selected.' value="'.$seller->id.'">'.$seller->sellerName.'</option>';
        };
        return json_encode($output);
    }
}
