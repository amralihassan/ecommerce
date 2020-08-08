<?php


namespace App\Http\Controllers\Admin\BackEnd\Settings;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\BackEnd\Settings\Category;
use File;
use Illuminate\Cache\RetrievesMultipleKeys;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $data = Category::latest();
            return datatables($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($data){
                           $btn = '<a class="btn btn-warning btn-sm" href="'.route('categories.edit',$data->id).'">
                           <i class=" la la-edit"></i>
                       </a>';
                            return $btn;
                    })
                    ->addColumn('icon',function($data){
                        return '<img width="40" height="40" src="'.asset("/images/icon\/").$data->icon.'">';
                    })
                    ->addColumn('check', function($data){
                           $btnCheck = '<label class="pos-rel">
                                        <input type="checkbox" class="ace" name="id[]" value="'.$data->id.'" />
                                        <span class="lbl"></span>
                                    </label>';
                            return $btnCheck;
                    })
                    ->rawColumns(['action','check','icon'])
                    ->make(true);
        }
        return view('layouts.backEnd.settings.categories.index',['title'=>trans('admin.categories')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('layouts.backEnd.settings.categories.create',['title'=>trans('admin.new_category')]);
    }
    private function attributes()
    {
        return [
            'ar_category_name',
            'en_category_name',
            'description',
            'keywords',
            'admin_id'
        ];
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $request->user()->categories()->create($request->only($this->attributes()) + ['icon'=>$this->uploadIcon()]);
        alert()->success(trans('msg.stored_successfully'), trans('admin.new_category'));
        return redirect()->route('categories.index');
    }

    private function uploadIcon(Category $category = null)
    {
        $fileName = '';
        if (!empty($category)) {
            $iconName = Category::find($category->id);
        }

        if (request()->hasFile('icon'))
        {
            if (!empty($iconName)) {
                            // remove old image
                $image_path = public_path("/images/icon/".$iconName->icon);
                // return dd($image_path);
                if(File::exists($image_path)) {
                    File::delete($image_path);
                }
            }

            $icon = request('icon');
            $fileName = time().'-'.$icon->getClientOriginalName();

            $location = public_path('images/icon');

            $icon->move($location,$fileName);
            $data['icon'] = $fileName;
        }
        return empty($fileName) ? $iconName->icon : $fileName ;
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('layouts.backEnd.settings.categories.edit',['title'=>trans('admin.edit_category'),'category'=>$category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->only($this->attributes()) + ['icon'=>$this->uploadIcon($category)]);
        alert()->success(trans('msg.updated_successfully'), trans('admin.edit_category'));
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if (request()->ajax()) {
            if (request()->has('id'))
            {
                foreach (request('id') as $id) {
                    $iconName = Category::find($id);
                    $image_path = public_path("/images/icon/".$iconName->icon);
                    // return dd($image_path);
                    if(File::exists($image_path)) {
                        File::delete($image_path);
                    }
                    Category::destroy($id);
                }
            }
        }
        return response(['status'=>true]);
    }
    private function categories()
    {
        $categories = Category::all();
        foreach ($categories as $category) {
            $category->setAttribute('categoryName',session('lang')=='en'?$category->en_category_name:$category->ar_category_name);
        }
        return $categories;
    }
    public function getCategories()
    {
        $output = "";
        $output .='<option value="">'.trans('admin.select').'</option>';
        foreach ($this->categories() as $category) {
            $output .= ' <option value="'.$category->id.'">'.$category->categoryName.'</option>';
        };
        return json_encode($output);
    }
    public function getCategorySelected()
    {
        $id = request()->get('category_id');
        $output = "";
        $output .='<option value="">'.trans('admin.select').'</option>';
        foreach ($this->categories() as $category) {
            $selected = $category->id == $id?"selected":"";
            $output .= ' <option '.$selected.' value="'.$category->id.'">'.$category->categoryName.'</option>';
        };
        return json_encode($output);
    }
}
