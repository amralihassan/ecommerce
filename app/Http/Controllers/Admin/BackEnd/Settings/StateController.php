<?php

namespace App\Http\Controllers\Admin\BackEnd\Settings;
use App\Http\Controllers\Controller;
use App\Http\Requests\StateRequest;
use App\Models\BackEnd\Settings\State;
use Illuminate\Http\Request;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $data = State::with('country','city')->get();
            return datatables($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($data){
                           $btn = '<a class="btn btn-warning btn-sm" href="'.route('states.edit',$data->id).'">
                           <i class=" la la-edit"></i>
                       </a>';
                            return $btn;
                    })
                    ->addColumn('country_id',function($data){
                        return session('lang') == 'ar' || session('lang') == trans('admin.ar') ?
                        $data->country->ar_country_name :$data->country->en_country_name;
                    })
                    ->addColumn('city_id',function($data){
                        return session('lang') == 'ar' || session('lang') == trans('admin.ar') ?
                        $data->city->ar_city_name :$data->city->en_city_name;
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
        return view('layouts.backEnd.settings.states.index',['title'=>trans('admin.states')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.backEnd.settings.states.create',['title'=>trans('admin.new_state')]);
    }
    private function attributes()
    {
        return [
            'ar_state_name',
            'en_state_name',
            'country_id',
            'city_id',
            'admin_id'
        ];
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StateRequest $request)
    {
        $request->user()->states()->create($request->only($this->attributes()));
        alert()->success(trans('msg.stored_successfully'), trans('admin.new_state'));
        return redirect()->route('states.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\State  $state
     * @return \Illuminate\Http\Response
     */
    public function edit(State $state)
    {
        return view('layouts.backEnd.settings.states.edit',['title'=>trans('admin.edit_state'),'state'=>$state]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\State  $state
     * @return \Illuminate\Http\Response
     */
    public function update(StateRequest $request, State $state)
    {
        $state->update($request->only($this->attributes()));
        alert()->success(trans('msg.updated_successfully'), trans('admin.edit_state'));
        return redirect()->route('states.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\State  $state
     * @return \Illuminate\Http\Response
     */
    public function destroy(State $state)
    {
        if (request()->ajax()) {
            if (request()->has('id'))
            {
                foreach (request('id') as $id) {
                    State::destroy($id);
                }
            }
        }
        return response(['status'=>true]);
    }
}
