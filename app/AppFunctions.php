<?php
namespace App;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Post;
use App\Models\Setting;
use App\Models\Tag;
use App\Models\Post_tag;
use App\Models\Category;

class AppFunctions
{
	public static function data($table, $key, $default = NULL)
	{
		if($table === 'Setting'){
			$setting = Setting::where('key', '=', $key)->first();
			if(isset($setting->id)){
				return $setting->value;
			}
			return $default;
		}

		if($table === 'Tag'){
			$tags = Tag::pluck('name', 'id');
			return $tags;
		}

		if($table === 'Category'){
			$categories = Category::pluck('name', 'id');
			return $categories;
		}



	}
}
