<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Post;
use App\Models\Setting;
use App\Models\Tag;
use App\Models\Post_tag;
use App\Models\Category;

/**
 * testing git flow wiht folk
**/
class BlogController extends Controller
{
    //
    public function lists()
    {
    	$posts = Post::where('status', '=', 'PUBLISHED')->orderby('id', 'desc')->paginate(5);
    	return view('blog/lists', compact('posts'));
    }

    public function post($slug)
    {
        $post = Post::where('slug', $slug)->where('status', '=', 'PUBLISHED')->first();
        $prevPostId = Post::where('id', '<', $post->id)->max('id');
        $nextPostId = Post::where('id', '>', $post->id)->min('id');

        if(empty($prevPostId)){
            $prevPost = 'empty';
        }else{
            $prevPost = Post::findOrFail($prevPostId);
        }

        if(empty($nextPostId)){
            $nextPost = 'empty';
        }else{
            $nextPost = Post::findOrFail($nextPostId);
        }

        $tags = Tag::pluck('name', 'id');
        $post_tag = Post_tag::where('post_id', '=', $post->id)->pluck('tag_id')->toArray();
        $category = Category::where('id', '=', $post->category)->value('name');

        return view('blog/post', compact('post', 'tags', 'post_tag', 'category', 'prevPost', 'nextPost'));
    }

    public function searchCategory($category)
    {
        $searchTitle = 'Search Result:';
        $id= Category::where('name', '=', $category)->pluck('id');
        $posts = Post::whereIn('category', $id)->orderby('id', 'desc')->paginate(5);

        return view('blog/lists', compact('posts', 'searchTitle'));
    }

    public function searchTag($tag)
    {
        $searchTitle = 'Search Result:';
        $id = Tag::where('name', '=', $tag)->value('id');
        $post_tag = Post_tag::where('tag_id', '=', $id)->pluck('post_id')->toArray();
        $posts = Post::whereIn('id', $post_tag)->orderby('id', 'desc')->paginate(5);

        return view('blog/lists', compact('posts', 'searchTitle'));
    }

    public function timeline()
    {
        $posts = Post::latest()->get()
                ->groupBy(function($item){
                  return $item->created_at->format('Y-m');
                });
        return dd($posts);
    }

}
