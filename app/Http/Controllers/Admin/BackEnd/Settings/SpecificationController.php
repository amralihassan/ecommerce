<?php

namespace App\Http\Controllers\Admin\BackEnd\Settings;
use App\Http\Controllers\Controller;
use App\Http\Requests\SpecificationRequest;
use App\Models\BackEnd\Settings\Specification;
use Illuminate\Http\Request;

class SpecificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $data = Specification::orderBy('sort','asc')->get();
            return datatables($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($data){
                           $btn = '<a class="btn btn-warning btn-sm" href="'.route('specifications.edit',$data->id).'">
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
        return view('layouts.backEnd.settings.specifications.index',['title'=>trans('admin.specifications')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.backEnd.settings.specifications.create',['title'=>trans('admin.new_country')]);
    }
    private function attributes()
    {
        return [
            'ar_specification_name',
            'en_specification_name',
            'sort',
            'admin_id'
        ];
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SpecificationRequest $request)
    {
        $request->user()->specifications()->create($request->only($this->attributes()));
        alert()->success(trans('msg.stored_successfully'), trans('admin.new_specification'));
        return redirect()->route('specifications.index');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Specification  $specification
     * @return \Illuminate\Http\Response
     */
    public function edit(Specification $specification)
    {
        return view('layouts.backEnd.settings.specifications.edit',['title'=>trans('admin.edit_country'),'specification'=>$specification]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Specification  $specification
     * @return \Illuminate\Http\Response
     */
    public function update(SpecificationRequest $request, Specification $specification)
    {
        $specification->update($request->only($this->attributes()));
        alert()->success(trans('msg.updated_successfully'), trans('admin.edit_specification'));
        return redirect()->route('specifications.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Specification  $specification
     * @return \Illuminate\Http\Response
     */
    public function destroy(Specification $specification)
    {
        if (request()->ajax()) {
            if (request()->has('id'))
            {
                foreach (request('id') as $id) {
                    Specification::destroy($id);
                }
            }
        }
        return response(['status'=>true]);
    }
    private function specifications()
    {
        $specifications = Specification::all();
        foreach ($specifications as $specification) {
            $specification->setAttribute('specificationName',session('lang')=='en'?$specification->en_specification_name:$specification->ar_specification_name);
        }
        return $specifications;
    }
    public function getSpecifications()
    {
        $output = "";
        $output .='<option value="">'.trans('admin.select').'</option>';
        foreach ($this->specifications() as $specification) {
            $output .= ' <option value="'.$specification->id.'">'.$specification->specificationName.'</option>';
        };
        return json_encode($output);
    }
    public function getSpecificationselected()
    {
        $id = request()->get('specification_id');
        $output = "";
        $output .='<option value="">'.trans('admin.select').'</option>';
        foreach ($this->specifications() as $specification) {
            $selected = $specification->id == $id?"selected":"";
            $output .= ' <option '.$selected.' value="'.$specification->id.'">'.$specification->specificationName.'</option>';
        };
        return json_encode($output);
    }
}
