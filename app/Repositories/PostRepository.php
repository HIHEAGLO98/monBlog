<?php

namespace App\Repositories;
use App\Models\Post;

class PostRepository
{
    /**
     * Create a query for Post.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function queryActive()
    {
        return Post::select(
                      'id',
                      'slug',
                      'image',
                      'title',
                      'excerpt',
                      'user_id')
                    ->with('user:id,name')
                    ->whereActive(true);
    }

    /**
     * Create a query for Post.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function queryActiveOrderByDate()
    {
        return $this->queryActive()->latest();
    }

    /**
     * Get active posts collection paginated.
     *
     * @param  int  $nbrPages
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getActiveOrderByDate($nbrPages)
    {
        return $this->queryActiveOrderByDate()->paginate($nbrPages);
    }

    /**
     * Get heros.
     *
     * @param  int  $nbrPages
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getHeros()
    {
        return $this->queryActive()->with('categories')->latest('updated_at')->take(5)->get();
    }
}
