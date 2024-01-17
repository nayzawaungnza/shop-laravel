<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function categorylist(){
        $categories = Category::when(request('key'),function($query){
                        $query->where('name','like','%'. request('key').'%');
                        })
                        ->orderBy('created_at','desc')
                        ->paginate(5);
       $categories->appends(request()->all());

        return view('admin.category.list',compact('categories'));
    }

    public function categorycreate(){
        return view('admin.category.create');
    }


    public function categorystore(Request $request){
        $this->categoryValidationCheck($request);

        //change data to array format
        $data = $this->requestCategoryData($request);

        Category::create($data);
        return redirect()->route('admin#categorylist')->with(['create'=>'Category Created Success']);
    }

    //delete category
    public function categorydelete($id){
        Category::where('id',$id)->delete();
        return back()->with(['delete'=>'Category deleted...']);
    }

    //edit category
    public function categoryedit($id){
        $category = Category::where('id',$id)->first();
        return view('admin.category.edit',compact('category'));
    }

    //update category
    public function categoryupdate($id, Request $request){
        $request['id'] =$id;
        //dd($request->all());
        $this->categoryValidationCheck($request);

        //change data to array format
        $data = $this->requestCategoryData($request);
        Category::where('id',$id)->update($data);
        return redirect()->route('admin#categorylist')->with(['update'=>'Category Updated Success']);
    }

    //validation check
    private function categoryValidationCheck($request){
        Validator::make($request->all(),[
            'categoryName' => 'required|min:4|unique:categories,name,'.$request->id,
        ],
        [
            'categoryName.required' => 'Enter Category Name',
        ])->validate();
    }

    //category data
    private function requestCategoryData($request){
        return [
            'name' => $request->categoryName,
            'slug' => Str::slug($request->categoryName),
            'updated_at' => Carbon::now(),
        ];
    }

}
