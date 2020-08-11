<?php

namespace App\Http\Controllers\Admin\BackEnd\Settings;
use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentRequest;
use App\Models\BackEnd\Settings\Department;
use Illuminate\Http\Request;
use File;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $data = Department::with('category')->orderBy('sort','asc')->get();
            return datatables($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($data){
                           $btn = '<a class="btn btn-warning btn-sm" href="'.route('departments.edit',$data->id).'">
                           <i class=" la la-edit"></i>
                       </a>';
                            return $btn;
                    })
                    ->addColumn('department_image',function($data){
                        return '<img width="75" height="75" src="'.asset("/images/department_images\/").$data->department_image.'">';
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
                    ->rawColumns(['action','check','department_image'])
                    ->make(true);
        }
        return view('layouts.backEnd.settings.departments.index',['title'=>trans('admin.departments')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.backEnd.settings.departments.create',['title'=>trans('admin.new_department')]);
    }

    private function attributes()
    {
        return [
            'ar_department_name',
            'en_department_name',
            'category_id',
            'description',
            'show',
            'keywords',
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
    public function store(DepartmentRequest $request)
    {
        $request->user()->departments()->create($request->only($this->attributes())
        + ['department_image'=>$this->uploadDepartmentImage()]);
        alert()->success(trans('msg.stored_successfully'), trans('admin.new_department'));
        return redirect()->route('departments.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        return view('layouts.backEnd.settings.departments.edit',['title'=>trans('admin.edit_department'),'department'=>$department]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        // dd($this->uploadDepartmentImage($department));
        $department->update($request->only($this->attributes()) + ['department_image' => $this->uploadDepartmentImage($department)]);
        alert()->success(trans('msg.updated_successfully'), trans('admin.edit_department'));
        return redirect()->route('departments.index');
    }
    private function uploadDepartmentImage(Department $department = null)
    {
        $fileName = '';

        $departmentImageName = !empty($department) ? $department : '';


        if (request()->hasFile('department_image'))
        {
            if (!empty($departmentImageName)) {
                            // remove old image
                $image_path = public_path("/images/department_images/".$departmentImageName->department_image);
                // return dd($image_path);
                if(File::exists($image_path)) {
                    File::delete($image_path);
                }
            }

            $department_image = request('department_image');
            $fileName = time().'-'.$department_image->getClientOriginalName();

            $location = public_path('images/department_images');

            $department_image->move($location,$fileName);
            $data['department_image'] = $fileName;
        }
        return empty($fileName) ? $departmentImageName->department_image : $fileName ;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        if (request()->ajax()) {
            if (request()->has('id'))
            {
                foreach (request('id') as $id) {
                    $departmentImageName = Department::find($id);
                    $image_path = public_path("/images/department_images/".$departmentImageName->department_image);

                    if(File::exists($image_path)) {
                        File::delete($image_path);
                    }
                    Department::destroy($id);
                }
            }
        }
        return response(['status'=>true]);
    }
    private function departments()
    {
        $departments = request()->has('category_id')? Department::where('category_id',request()->get('category_id'))->get() :Department::all();
        foreach ($departments as $department) {
            $department->setAttribute('departmentName',session('lang')=='en'?$department->en_department_name:$department->ar_department_name);
        }
        return $departments;
    }
    public function getDepartments()
    {
        $output = "";
        $output .='<option value="">'.trans('admin.select').'</option>';
        foreach ($this->departments() as $department) {
            $output .= ' <option value="'.$department->id.'">'.$department->departmentName.'</option>';
        };
        return json_encode($output);
    }
    public function getDepartmentsById()
    {
        $output =count($this->departments()) > 0?'<option value="">'.trans('admin.select').'</option>':'';
        foreach ($this->departments() as $department) {
            $output .= ' <option value="'.$department->id.'">'.$department->departmentName.'</option>';
        };
        return json_encode($output);
    }
    public function getDepartmentSelected()
    {
        $id = request()->get('department_id');
        $output = "";
        $output =count($this->departments()) > 0?'<option value="">'.trans('admin.select').'</option>':'';
        foreach ($this->departments() as $department) {
            $selected = $department->id == $id?"selected":"";
            $output .= ' <option '.$selected.' value="'.$department->id.'">'.$department->departmentName.'</option>';
        };
        return json_encode($output);
    }
}
