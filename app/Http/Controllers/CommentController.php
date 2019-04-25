<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Comment;
use App\Repositories\CommentRepository;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;

class CommentController extends Controller
{
    private $repo;
    private $route;

    public function __construct(CommentRepository $repository)
    {
        $this->repo = $repository;
        $this->route = "blog";

    }

    /**
     * Both for Create and Reply Comment
     *
     * @param Request $request
     * @return mixed
     */
    public function create(Request $request)
    {

        $input = $request->all();
        $blog_id = $input['blog_id'];

        $filter_input_data = $this->repo->getFillables();//[blog_id, message]
        $post_data = [];
        foreach ($input as $key => $value) {
            if (in_array($key, $filter_input_data)) {
                $post_data[$key] = $value;
            }
        }
        // get random user_id
//        $users = (new User())->pluck('id')->toArray();
//        $post_data["user_id"] = $users[array_rand($users)];
        $post_data['user_id'] = Auth::user()->id;


        $comment = new Comment($post_data);
        $blog = Blog::find($input['blog_id']);
        $blog->comment()->save($comment);

        return redirect(route($this->route) . '/' . $blog_id)
            ->with(session()->flash('msg', Lang::get('custom.add-success')));
    }
}
