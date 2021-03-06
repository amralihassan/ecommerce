<?php

namespace App\Http\Controllers\Admin\BackEnd\Settings;
use App\Http\Controllers\Controller;
use App\Http\Requests\CountryRequest;
use App\Models\BackEnd\Settings\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $data = Country::latest();
            return datatables($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($data){
                           $btn = '<a class="btn btn-warning btn-sm" href="'.route('countries.edit',$data->id).'">
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
        return view('layouts.backEnd.settings.countries.index',['title'=>trans('admin.countries')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.backEnd.settings.countries.create',['title'=>trans('admin.new_country')]);
    }
    private function attributes()
    {
        return [
            'ar_country_name',
            'en_country_name',
            'global_key',
            'currency',
            'code',
            'admin_id'
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CountryRequest $request)
    {
        $request->user()->countries()->create($request->only($this->attributes()));
        alert()->success(trans('msg.stored_successfully'), trans('admin.new_country'));
        return redirect()->route('countries.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function edit(Country $country)
    {
        return view('layouts.backEnd.settings.countries.edit',['title'=>trans('admin.edit_country'),'country'=>$country]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(CountryRequest $request, Country $country)
    {
        $country->update($request->only($this->attributes()));
        alert()->success(trans('msg.updated_successfully'), trans('admin.edit_country'));
        return redirect()->route('countries.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country)
    {
        if (request()->ajax()) {
            if (request()->has('id'))
            {
                foreach (request('id') as $id) {
                    Country::destroy($id);
                }
            }
        }
        return response(['status'=>true]);
    }
    private function countries()
    {
        $countries = Country::all();
        foreach ($countries as $country) {
            $country->setAttribute('countryName',session('lang')=='en'?$country->en_country_name:$country->ar_country_name);
        }
        return $countries;
    }
    public function getCountries()
    {
        $output = "";
        $output .='<option value="">'.trans('admin.select').'</option>';
        foreach ($this->countries() as $country) {
            $output .= ' <option value="'.$country->id.'">'.$country->countryName.'</option>';
        };
        return json_encode($output);
    }
    public function getCountrySelected()
    {
        $id = request()->get('country_id');
        $output = "";
        $output .='<option value="">'.trans('admin.select').'</option>';
        foreach ($this->countries() as $country) {
            $selected = $country->id == $id?"selected":"";
            $output .= ' <option '.$selected.' value="'.$country->id.'">'.$country->countryName.'</option>';
        };
        return json_encode($output);
    }
}
