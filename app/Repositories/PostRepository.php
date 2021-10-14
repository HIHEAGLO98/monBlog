<?php

namespace App\Repositories;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Str;

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
    // Post for slug with user, tags and categories
    public function getPostBySlug($slug)
    {
        // Post for slug with user, tags and categories
        $post = Post::with(
            'user:id,name,email',
            'tags:id,tag,slug',
            'categories:title,slug'
        )
            ->withCount('validComments')
            ->whereSlug($slug)
            ->firstOrFail();
        // Previous post
        $post->previous = $this->getPreviousPost($post->id);
        // Next post
        $post->next = $this->getNextPost($post->id);
        return $post;
    }
    //get previous post
    protected function getPreviousPost($id)
    {
        return Post::select('title', 'slug')
            ->whereActive(true)
            ->latest('id')
            ->firstWhere('id', '<', $id);
    }
    //get next post
    protected function getNextPost($id)
    {
        return Post::select('title', 'slug')
            ->whereActive(true)
            ->oldest('id')
            ->firstWhere('id', '>', $id);
    }
    //vue show
    /*
    public function show(Request $request, $slug)
    {
        $post = $this->postRepository->getPostBySlug($slug);
        return view('front.post', compact('post'));
    } */

    //articles par categories
    public function getActiveOrderByDateForCategory($nbrPages, $category_slug)
    {
        return $this->queryActiveOrderByDate()
            ->whereHas('categories', function ($q) use ($category_slug) {
                $q->where('categories.slug', $category_slug);
            })->paginate($nbrPages);
    }

    //article par author
    public function getActiveOrderByDateForUser($nbrPages, $user_id)
    {
        return $this->queryActiveOrderByDate()
            ->whereHas('user', function ($q) use ($user_id) {
                $q->where('users.id', $user_id);
            })->paginate($nbrPages);
    }
    //obtenir un post pour une étiquette

    public function getActiveOrderByDateForTag($nbrPages, $tag_slug)
    {
        return $this->queryActiveOrderByDate()
            ->whereHas('tags', function ($q) use ($tag_slug) {
                $q->where('tags.slug', $tag_slug);
            })->paginate($nbrPages);
    }

    //search a post
    public function search($n, $search)
    {
        return $this->queryActiveOrderByDate()
            ->where(function ($q) use ($search) {
                $q->where('excerpt', 'like', "%$search%")
                    ->orWhere('body', 'like', "%$search%")
                    ->orWhere('title', 'like', "%$search%");
            })->paginate($n);
    }

    //create a post
    public function store($request)
    {
        $request->merge([
            'active' => $request->has('active'),
            'image' => basename($request->image),
        ]);
        $post = $request->user()->posts()->create($request->all());
        $this->saveCategoriesAndTags($post, $request);
    }

    protected function saveCategoriesAndTags($post, $request)
    {
        // Categorie
        $post->categories()->sync($request->categories);
        // Tags
        $tags_id = [];
        if($request->tags) {
            $tags = explode(',', $request->tags);
            foreach ($tags as $tag) {
                $tag_ref = Tag::firstOrCreate([
                    'tag' => ucfirst($tag),
                    'slug' => Str::slug($tag),
                ]);
                $tags_id[] = $tag_ref->id;
            }
        }
        $post->tags()->sync($tags_id);
    }
}
