<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posts = Post::orderBy('updated_at', 'DESC')->paginate(8);

        return view('admin.posts.index', ['data' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $input = $request->validated();

        $data = [
            'title' => $input['title'],
            'content' => str_replace("\r\n", "<br>", $input['content']), // rollback after...
            'short_content' => $input['short_content'],
            'slug' => Str::random(24),
            'link_to_details' => strtolower(str_replace(" ", "-", $input['link_to_details'])),
            'user_id' => $request->user_id ?? Auth::id(),
            'trending' => isset($request->trending) ? '1' : '0'
        ];

        if ($request->hasFile('image') && $request->file('image')->isValid()) {

            $file = $request->file('image');
            $fileName = 'inery-' . pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . '-' . time() . "." . $file->getClientOriginalExtension();
            $fileName = str_replace(" ", "", $fileName);

            if (Storage::disk('local')->putFileAs('public/uploads/posts', $file, $fileName)) {

                $data['image'] =  $fileName;
            }
        }

        if (Post::create($data)) {

            return redirect()->route('posts.index')->with('message',  'Post created successfuly');
        } else {

            return redirect()->back()->with('message', 'Something went wrong');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::with('user')->where('slug', $slug)->first();
        $post->postedBy = User::where('id', $post->user_id)->first()->name;

        return view('admin.posts.show', ['data' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $post = Post::where('slug', $slug)->first();
        $users = User::all();
        // dd($post);
        return view('admin.posts.edit', ['data' => $post, 'users' => $users]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $post = Post::where('slug', $slug)->first();

        $request->validate([
            'title' => 'required|min:3',
            'content' => 'required|min:10',
            'short_content' => 'required|min:3',
            'link_to_details' => [
                'required', 'min:3', 'regex:/^[a-zA-Z0-9\-\_ ]+$/', Rule::unique('posts')->ignore($post->id)
            ],
            'user_id' => 'integer',
        ], [
            'link_to_details.regex' => 'You can only use letters, numbers, hyphens, and dashes.',
            'link_to_details.min' => 'The post url slug field must have at least 3 characters',
            'link_to_details.unique' => 'This post url slug is already taken.',
            'link_to_details.required' => 'The post url slug field is reqiured.',
        ]);

        $data = [
            'title' => $request->title,
            'content' => $request->content,
            'short_content' => $request->short_content,
            'user_id' => $request->user_id ?? Auth::id(),
            'link_to_details' => strtolower(str_replace(" ", "-", $request->link_to_details)),
            'image' => $request->image, //? $request->image : ($post->image && $post->image),
            'trending' => isset($request->trending) ? '1' : '0'
        ];

        $old_image_path = storage_path('app/public/uploads/posts/');

        if ($request->image != null) {

            if ($post->image && file_exists($old_image_path . $post->image)) {
                unlink($old_image_path . $post->image);
            }

            $file = $request->file('image');
            $fileName = 'inery-' . pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . '-' . time() . "." . $file->getClientOriginalExtension();
            $fileName = str_replace(" ", "", $fileName);

            if (Storage::disk('local')->putFileAs('public/uploads/posts', $file, $fileName)) {
                $data['image'] =  $fileName;
            }
        } else {
            if ($request->remove_image == 0) {
                $data['image'] = $post->image;
            } else {
                $data['image'] = null;
            }
        }

        if ($post->update($data)) {

            return redirect()->route('posts.index')->with('message', 'Post updated successfuly');
        } else {

            return redirect()->back()->with('message', 'Something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $post = Post::where('slug', $slug)->first();
        if ($post->delete()) {

            $old_image_path = storage_path('app/public/uploads/posts/');

            if ($post->image && file_exists($old_image_path . $post->image)) {
                unlink($old_image_path . $post->image);
            }

            return redirect()->back()->with('message', 'Post deleted successfuly.');
        } else {

            return redirect()->route('posts.index')->with('message', 'Something went wrong.');
        }
    }

    private function _makeUrlSlugFromTitle($title)
    {
        $slug = '';

        if (!empty($title) && $title != '') {
            $slug = strtolower(str_replace(" ", "-", $title));
        }

        return $slug;
    }
}
