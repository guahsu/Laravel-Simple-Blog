<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Category;

class CategoryController extends Controller
{
    public function list()
    {
    	$categories = Category::orderby('name')->get();
    	return view('admin/categories/list', compact('categories'));
    }

    public function create()
    {
    	$request = Input::all();

    	$parent_id = 0;
    	$order = 1;
    	$name = $request['name'];
    	$slug = str_slug($request['name']);

		// $check = Category::where('name', '=', $name)->orWhere('slug', '=', $slug)->count();

		// if($check > 0){
		// 	$returnData['tpye'] = 'error';
		// 	$returnData['message'] = 'cant to use' . $name ;
		// 	return $returnData;
		// }

		$returnData['id'] = Category::insertGetId(['parent_id' => $parent_id, 'order' => $order, 'name' => $name, 'slug' => $slug]);
		$returnData['parent_id'] = $parent_id ;
		$returnData['order'] = $order ;
		$returnData['name'] = $name ;
		$returnData['slug'] = $slug ;
		$returnData['type'] = 'create';

		return $returnData;
    }

    public function edit($id)
    {
    	$inputName = Input::get('name');
    	$category = Category::find($id);
    	$category->name = $inputName;
    	$category->slug = str_slug($inputName);
    	$category->save();

    	$returnData['id'] = $id;
		$returnData['name'] = $inputName ;
		$returnData['slug'] = str_slug($inputName) ;
    	$returnData['type'] = 'edit';

    	return $returnData;
    }

    public function delete($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect('/admin/categories');
    }

}
