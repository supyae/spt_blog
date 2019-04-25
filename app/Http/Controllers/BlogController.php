<?php

namespace App\Http\Controllers;

use App\Repositories\BlogRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class BlogController extends Controller
{
    private $repo;

    public function __construct(BlogRepository $repository)
    {
        $this->repo = $repository;
    }

    /**
     * @param Request $request
     */
    public function create(Request $request)
    {

        $post_data = $this->getData($request);

        $respond_data = $this->repo->create($post_data);
        $respond_data->id;


    }

    /**
     * @param $id
     * @return mixed
     */
    public function get($id)
    {
        //try {
            $relation = ['comment.user'];
            $data = $this->repo->getByRelationsId($relation, $id);

            return view('blog.detail')->with(['blog' => $data, 'comments' => $data->comment]);
//        } catch (\Exception $e) {
//            return Redirect::route("/error")->withErrors($e->getMessage());
//        }
    }

    public function update(Request $request)
    {

        $post_data = $this->getData($request);
        $id = $request->get('blog_id');
        $this->repo->update($post_data, $id);

    }


    public function getData(Request $request)
    {
        $input = $request->all();
        $filter_input_data = $this->repo->getFillables();
        $post_data = [];
        foreach ($input as $key => $value) {
            if (in_array($key, $filter_input_data)) {
                $post_data[$key] = $value;
            }
        }
        $post_data["user_id"] = Auth::user()->id;

        return $post_data;
    }
}
