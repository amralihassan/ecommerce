<?php

namespace App\Http\Controllers\Admin\BackEnd\Settings;
use App\Http\Controllers\Controller;
use App\Http\Requests\DefinitionRequest;
use App\Models\BackEnd\Settings\Definition;
use Illuminate\Http\Request;

class DefinitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $data = Definition::with('department','specification')->orderBy('id','desc')->get();
            return datatables($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($data){
                           $btn = '<a class="btn btn-warning btn-sm" href="'.route('definitions.edit',$data->id).'">
                           <i class=" la la-edit"></i>
                       </a>';
                            return $btn;
                    })
                    ->addColumn('department_id',function($data){
                        return session('lang') == 'ar' || session('lang') == trans('admin.ar') ?
                        $data->department->ar_department_name :$data->department->en_department_name;
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
                    ->rawColumns(['action','check','department_id','specification_id'])
                    ->make(true);
        }
        return view('layouts.backEnd.settings.definitions.index',['title'=>trans('admin.definitions')]);
    }
    private function attributes()
    {
        return [
            'ar_value',
            'en_value',
            'specification_id',
            'department_id',
            'sort',
            'admin_id'
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.backEnd.settings.definitions.create',['title'=>trans('admin.new_definition')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DefinitionRequest $request)
    {
        $request->user()->definitions()->create($request->only($this->attributes()));
        alert()->success(trans('msg.stored_successfully'), trans('admin.new_definition'));
        return redirect()->route('definitions.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Definition  $definition
     * @return \Illuminate\Http\Response
     */
    public function edit(Definition $definition)
    {
        return view('layouts.backEnd.settings.definitions.edit',['title'=>trans('admin.edit_definition'),'definition'=>$definition]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Definition  $definition
     * @return \Illuminate\Http\Response
     */
    public function update(DefinitionRequest $request, Definition $definition)
    {
        $definition->update($request->only($this->attributes()));
        alert()->success(trans('msg.updated_successfully'), trans('admin.edit_definition'));
        return redirect()->route('definitions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Definition  $definition
     * @return \Illuminate\Http\Response
     */
    public function destroy(Definition $definition)
    {
        if (request()->ajax()) {
            if (request()->has('id'))
            {
                foreach (request('id') as $id) {
                    Definition::destroy($id);
                }
            }
        }
        return response(['status'=>true]);
    }
    private function definitions()
    {
        $definitions = request()->has('specification_id')? Definition::where('specification_id',request()->get('specification_id'))->get() :Definition::all();
        foreach ($definitions as $definition) {
            $definition->setAttribute('definitionName',session('lang')=='en'?$definition->en_value:$definition->ar_value);
        }
        return $definitions;
    }
    public function getDefinitions()
    {
        $output = "";
        $output .='<option value="">'.trans('admin.select').'</option>';
        foreach ($this->definitions() as $definition) {
            $output .= ' <option value="'.$definition->id.'">'.$definition->definitionName.'</option>';
        };
        return json_encode($output);
    }
    public function getDefinitionsById()
    {
        $output =count($this->definitions()) > 0?'<option value="">'.trans('admin.select').'</option>':'';
        foreach ($this->definitions() as $definition) {
            $output .= ' <option value="'.$definition->id.'">'.$definition->definitionName.'</option>';
        };
        return json_encode($output);
    }
    public function getDefinitionSelected()
    {
        $id = request()->get('definition_id');
        $output = "";
        $output =count($this->definitions()) > 0?'<option value="">'.trans('admin.select').'</option>':'';
        foreach ($this->definitions() as $definition) {
            $selected = $definition->id == $id?"selected":"";
            $output .= ' <option '.$selected.' value="'.$definition->id.'">'.$definition->definitionName.'</option>';
        };
        return json_encode($output);
    }
}
