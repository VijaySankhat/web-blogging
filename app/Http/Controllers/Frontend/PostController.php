<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Repository\Post\PostRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostController extends Controller
{
    private $postRepository;

    /**
     * PostController constructor.
     * @param PostRepositoryInterface $postRepository
     * PostController constructor.
     * Just to demonstrate, here I used repository pattern
     */
    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }


    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return View
     */
    public function index(Request $request) : View
    {
        return view('posts.index', [
            'posts' => $this->postRepository->all($request->sort, $request->q)
        ]);
    }


    /**
     * Display the specified resource.
     * @param Post $post
     * @return View
     */
    public function show(Post $post) : View
    {
        return view('posts.show', [
            'post' => $post
        ]);
    }

}
