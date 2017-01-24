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
    	$inputValue = Input::get('value');
    	$settings = Setting::find($id);
    	$settings->value = $inputValue;
    	$settings->save();


    	$returnData['id'] = $id;
		$returnData['value'] = $inputValue;

    	return $returnData;
    }


}
