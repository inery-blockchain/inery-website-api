<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->page ? $request->page : 1;
        $data = [];
        $per_page = 4;

        if ($page == 0 || !is_numeric($page)) {

            return response()->json(['success' => false, 'data' => [], 'msg' => 'Bad request'], 400);
        }

        $page = ($request->page) - 1;
        $data['no_of_pages'] = ceil(Post::count() / 4);
        $data['posts'] = Post::select('id', 'slug', 'title', 'image', 'short_content', 'link_to_details', 'updated_at')->orderBy('id', 'DESC')->skip($page * $per_page)->take($per_page)->get();

        $data = collect($data);

        return $this->sendResponse($data);
    }

    public function topPosts(Request $request)
    {
        $page = $request->page ? $request->page : 1;
        $data = [];
        $per_page = 4;

        $page = ($request->page) - 1;
        $data['no_of_pages'] = ceil(Post::count() / 4);

        $data['posts'] = Post::select('id', 'slug', 'title', 'image', 'short_content', 'link_to_details', 'no_of_clicks', 'created_at', 'updated_at')->orderBy('no_of_clicks', 'DESC')->skip($page * $per_page)->take($per_page)->get();

        $data = collect($data);

        return $this->sendResponse($data);
    }

    public function randomPosts(Request $request)
    {
        $page = $request->page ? $request->page : 1;
        $data = [];
        $per_page = 4;

        $page = ($request->page) - 1;
        $data['no_of_pages'] = ceil(Post::count() / 4);

        $data['posts'] = Post::select('id', 'slug', 'title', 'image', 'short_content', 'link_to_details', 'no_of_clicks', 'created_at', 'updated_at')->orderBy('updated_at', 'DESC')->skip($page * $per_page)->take($per_page)->get()->shuffle();

        $data = collect($data);

        return $this->sendResponse($data);
    }

    public function popularPostsToday()
    {
        $data = Post::select('id', 'slug', 'title', 'image', 'link_to_details', 'short_content', 'no_of_clicks', 'created_at', 'updated_at')
            ->where('created_at', '>=', Carbon::now()->subHours(120)->toDateTimeString())
            ->orderBy('no_of_clicks', 'DESC')
            ->get();

        return $this->sendResponse($data);
    }

    public function show($link_to_details)
    {
        $data['current_post'] = Post::where('link_to_details', $link_to_details)->first();
        $data['current_post']->timestamps = false;
        $data['current_post']->update(['no_of_clicks' => $data['current_post']->no_of_clicks + 1]);
        $data['trending_posts'] = Post::where('trending', 1)->where('slug', '!=', $data['current_post']->slug)->take(2)->get();
        $data['other_posts'] = Post::where('slug', '!=', $link_to_details)->select('id', 'slug', 'title', 'image', 'link_to_details', 'short_content', 'user_id')->get()->shuffle()->take(4);
        $data['current_post']->timestamps = true;

        if ($data) {

            return response()->json(['success' => true, 'data' => $data], 200);
        } else {

            return response()->json(['success' => false, 'data' => '', 'msg' => 'Post not found'], 404);
        }
    }

    public function latestPosts(Request $request)
    {
        $data = Post::select('id', 'slug', 'title', 'image', 'short_content', 'link_to_details', 'no_of_clicks', 'created_at', 'updated_at')->orderBy('created_at', 'DESC')->take(3)->get();

        return $this->sendResponse($data);
    }

    public function ajaxSearch(Request $request)
    {
        $request->validate([
            'phrase' => 'required|min:3|max:50'
        ]);

        if ($request->phrase == '') {
            $data = Post::all();
        } else {
            $data = Post::where('title', 'like', '%' . $request->phrase . '%')->orderBy('updated_at', 'DESC')->get();
        }

        return $this->sendResponse($data);
    }

    public function search(Request $request)
    {
        $request->validate([
            'phrase' => 'required|min:3|max:50'
        ]);

        if ($request->phrase == '') {
            $data = Post::all();
        } else {
            $data = Post::where('title', 'like', '%' . $request->phrase . '%')->orWhere('content', 'like', '%' . $request->phrase . '%')->orderBy('updated_at', 'DESC')->get();
        }

        return $this->sendResponse($data);
    }

    public function sendResponse($data, $msg = '')
    {
        if ($data->isEmpty()) {

            return response()->json(['success' => false, 'msg' => 'Not found', 'data' => []]);
        } else {

            return response()->json(['success' => true, 'msg' => '', 'data' => $data], 200);
        }
    }
}
