<?php

namespace App\Http\Controllers;

use App\Repositories\BlogRepository;
use Illuminate\Support\Facades\View;

class WelcomeController extends Controller
{
    private $repo;

    public function __construct(BlogRepository $blogRepository)
    {
        $this->repo = $blogRepository;
    }

    /**
     * Home Page
     *
     * @return View
     */
    public function index()
    {
        $page = 10;
        $relation = ['comment'];
        $blogs = $this->repo->getByPaginateWithCount($relation, $page);

        return view('welcome')->with([
            'blogs' => $blogs
        ]);
    }

    /**
     * Search blog
     * 
     * @return mixed
     */
    public function search() {
        $page = 10;
        $key = $_GET["q"];
        $relation = ['comment'];
        $blogs = $this->repo->getSearchByPaginateWithCount($relation, $page, $key);

        return view('welcome')->with([
            'blogs' => $blogs
        ]);
    }

}
