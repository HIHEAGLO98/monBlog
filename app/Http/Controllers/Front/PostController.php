<?php

namespace App\Http\Controllers\Front;
use App\Http\Requests\Front\SearchRequest;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use App\Repositories\PostRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $postRepository;
    protected $nbrPages;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
        $this->nbrPages = config('app.nbrPages.posts');
    }

    //vue index
    public function index()
    {
        $posts = $this->postRepository->getActiveOrderByDate($this->nbrPages);
        $heros = $this->postRepository->getHeros();
        return view('front.index', compact('posts', 'heros'));
    }

    //vue show
    public function show(Request $request, $slug)
    {
        $post = $this->postRepository->getPostBySlug($slug);
        return view('front.post', compact('post'));
    }

    //post par categories
    public function category(Category $category)
    {
        $posts = $this->postRepository->getActiveOrderByDateForCategory($this->nbrPages, $category->slug);
        $title = __('Posts for category ') . '<strong>' . $category->title . '</strong>';
        return view('front.index', compact('posts', 'title'));
    }

    //les posts pour un author x
    public function user(User $user)
    {
        $posts = $this->postRepository->getActiveOrderByDateForUser($this->nbrPages, $user->id);
        $title = __('Posts for author ') . '<strong>' . $user->name . '</strong>';
        return view('front.index', compact('posts', 'title'));
    }

    //vue tag
    public function tag(Tag $tag)
    {
        $posts = $this->postRepository->getActiveOrderByDateForTag($this->nbrPages, $tag->slug);
        $title = __('Posts for tag ') . '<strong>' . $tag->tag . '</strong>';
        return view('front.index', compact('posts', 'title'));
    }

    //do research for a post
    public function search(SearchRequest $request)
    {
        $search = $request->search;
        $posts = $this->postRepository->search($this->nbrPages, $search);
        $title = __('Posts found with search: ') . '<strong>' . $search . '</strong>';
        return view('front.index', compact('posts', 'title'));
    }
}
