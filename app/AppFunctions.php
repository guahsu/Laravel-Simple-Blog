<?php
namespace App;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
			$tags = DB::table('tags')
					->join('post_tag', 'tags.id', '=', 'post_tag.tag_id')
					->selectRaw('tags.id, tags.name, count(post_tag.tag_id) tag_cnt')
					->groupBy('tags.id')
					->get();
			return $tags;
		}

		if($table === 'Category'){
			$categories = DB::table('categories')
						->join('posts', 'categories.id', '=', 'posts.category')
						->selectRaw('categories.id, categories.name, count(posts.category) cate_cnt')
						->groupBy('categories.id')
						->get();
			return $categories;
		}

	}
}
