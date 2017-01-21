<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Setting;

class SettingController extends Controller
{
    public function lists()
    {
    	$settings = Setting::orderby('id')->get();
    	return view('admin/settings/lists', compact('settings'));
    }


    public function edit($id)
    {
    	$inputKey = Input::get('key');
    	$inputValue = Input::get('value');
    	$category = Setting::find($id);
    	$category->key = $inputKey;
    	$category->Value = $inputValue;
    	$category->save();

    	$returnData['id'] = $id;
		$returnData['value'] = $inputValue ;

    	return $returnData;
    }


}
