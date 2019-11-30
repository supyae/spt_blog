<?php
namespace App\Repositories;

use App\Blog;
use Illuminate\Http\Request;

class BlogRepository extends GeneralRepository
{
    public function __construct()
    {
        parent::__construct(new Blog());
    }

    /**
     * Homepage with comment count
     *
     * @param $relation
     * @param int $page
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getByPaginateWithCount($relation, $page = 10)
    {
        $data = $this->model
            ->with($relation)
            ->withCount(['comment'])
            ->orderBy('id', "DESC")
            ->paginate($page);
        return $data;
    }

    /**
     * Search By Blog Title
     * @param $relation
     * @param int $page
     * @param $key
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getSearchByPaginateWithCount($relation, $page = 10, $key)
    {
        $data = $this->model
            ->with($relation)
            ->withCount(['comment'])
            ->where(function ($q) use($key) {
                if ($key != '') {
                    $q->where('title', "LIKE", "%".$key."%");
                }
            })
            ->orderBy('id', "DESC")
            ->paginate($page);
        return $data;
    }

}