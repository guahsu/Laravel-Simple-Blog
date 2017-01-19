<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Post_tag;
use App\Models\Category;
use Auth;

class PostController extends Controller
{
    //posts-list
    public function list()
    {
    	$posts = Post::orderby('id', 'desc')->paginate(10);
    	return view('admin/posts/list', compact('posts'));
    }

    //posts-create
    public function create()
    {
        $post = new Post();
        $tags = Tag::pluck('name', 'id');
        $post_tag = [];
        $categories = Category::pluck('name', 'id');
    	return view('admin/posts/edit', compact('post', 'tags', 'post_tag', 'categories'));
    }

    //posts-edit
    public function edit($id)
    {
    	$post = Post::find($id);
        $tags = Tag::pluck('name', 'id');
        $post_tag = Post_tag::where('post_id', '=', $id)->pluck('tag_id')->toArray();
        $categories = Category::pluck('name', 'id');
    	return view('admin/posts/edit', compact('post', 'tags', 'post_tag', 'categories'));
    }

    //posts-store
    public function store(Request $request)
    {
        //dd($request);
        //unique: tableName, columnName
        //validate alert message set in /resources/lang/en/validation.php
        $this->validate($request, [
            'postTitle' => 'required|unique:posts,title,' . $request['id'],
            'postSlug' => 'unique:posts,slug,' . $request['id'],
            'postContent' => 'required',
            'postExcerpt' => 'required',
        ]);

        //storeType: set create or edit for this post.
        if($request['storeType'] === 'create'){
            $post = new Post;
        }else if($request['storeType'] === 'edit') {
            $post = Post::find($request['id']);
        }

        //base post value (required values)
        $post->title   = $request['postTitle'];
        $post->content = $request['postContent'];
        $post->status  = $request['postStatus'];
        $post->excerpt = $request['postExcerpt'];

        //postSlug: if postSlug is empty, use postTitle
        if(empty($request['postSlug']))  {
            $post->slug = str_slug($request['postTitle']);
        }else {
            $post->slug = str_slug($request['postSlug']);
        }

        //postCategory: if postCategory is not empty, save it.
        if(!empty($request['postCategory'])) {
            $post->category = $request['postCategory'];
        }

        //postImage: if has image file, save and move to /public/img
        if ($request->hasFile('postImage')) {
            $image = $request->file('postImage');
            $filename = 'image_' . time() . '_' . $image->hashName();
            $image = $image->move(public_path('img'), $filename);
            $post->image = $filename;
        }

        //seoTitle: if seoTitle is empty, use postTitle
        if(empty($request['seoTitle'])) {
            $post->seo_title = $request['postTitle'];
        }else {
            $post->seo_title = $request['seoTitle'];
        }

        //seoDesc: if seoDesc is empty, use postExcerpt
        if(empty($request['seoDesc'])) {
            $post->seo_description = $request['postExcerpt'];
        }else {
            $post->seo_description = $request['seoDesc'];
        }

        //seoKeywords: if seoKeywords is empty and has postTag, use postTag
        if(empty($request['seoKeywords']) && !empty($request['postTag'])) {
            $seoKeywords = '';
            foreach ($request['postTag'] as $tag) {
                $seoKeywords .= $tag . ', ';
            }
            $post->seo_keywords = substr($seoKeywords, 0, -2);
        }else {
            $post->seo_keywords = $request['seoKeywords'];
        }

        //save post
        $post->save();

        //save post and tag relationship(table:post_tag)
        if(empty($request['postTag'])) {
            $post->tags()->sync([]);
        }else{
            //if request tag not in table:tag, insert it.
            $postTags = [];
            foreach ($request['postTag'] as $tag) {
                $result = Tag::where('id', '=', $tag)->count();
                if ($result == 0) {
                    $postId = Tag::insertGetId(['name' => $tag]);
                }else{
                    $postId = $tag;
                }
                array_push($postTags, $postId);
            }
            $post->tags()->sync($postTags);
        }

        //delect surplus tags
        Tag::whereNotIn('id', function($query){$query->select('tag_id')->from(with(new Post_tag)->getTable());})->delete();

        return redirect('/admin/posts');
    }

    //posts-delete
    public function delete($id)
    {
        $post = Post::find($id);
        $post->delete();
        return redirect('/admin/posts');
    }

    //test
    public function test()
    {
        $test = Tag::whereNotIn('id', function($query){
        $query->select('tag_id')
        ->from(with(new Post_tag)->getTable());
        })->pluck('id');

        dd($test);
    }
}
