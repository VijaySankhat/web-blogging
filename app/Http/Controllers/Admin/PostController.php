<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ImportRequest;
use App\Http\Requests\PostsRequest;
use App\Http\Response;
use App\Jobs\ProcessImportPostRequest;
use App\Models\Post;
use App\Models\UserImport;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class PostController extends AdminBaseController
{
    use Response;

    /**
     * PostController constructor.
     */
    public function __construct()
    {
        //Authorized all admin resource request
        $this->authorizeResource(Post::class);
    }


    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return View
     */
    public function index(Request $request) : View
    {
        return view('admin.posts.index', [
            'posts' => Post::mine($this->getAuthUserId(), $this->getAuthUser()->isAdmin())
                ->sorting($request->sort)
                ->search($request->q)
                ->paginate(config('app.default_item_per_page'))
        ]);
    }


    /**
     * Show the form for creating a new resource.
     * @return View
     */
    public function create() : View
    {
        return view('admin.posts.create', [
            'author_id' => $this->getAuthUserId(),
        ]);
    }


    /**
     * Store a newly created resource in storage.
     * @param PostsRequest $request
     * @return RedirectResponse
     */
    public function store(PostsRequest $request) : RedirectResponse
    {
        $post = Post::create($request->only(['title', 'description', 'slug', 'author_id']));
        return redirect()->route('admin.posts.index', $post)
            ->withSuccess(__('post.created'));
    }


    /**
     * Display the specified resource.
     * @param Post $post
     * @return View
     */
    public function show(Post $post) : View
    {
        return view('admin.posts.show', [
            'post' => $post
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     * @param Post $post
     * @return View
     */
    public function edit(Post $post) : View
    {
        return view('admin.posts.edit', [
            'post' => $post
        ]);
    }


    /**
     * Update the specified resource in storage.
     * @param PostsRequest $request
     * @param Post $post
     * @return RedirectResponse
     */
    public function update(PostsRequest $request, Post $post) : RedirectResponse
    {
        $post->update($request->only(['title', 'description', 'slug']));
        return redirect()->route('admin.posts.edit', $post)
            ->withSuccess(__('post.updated'));
    }


    /**
     * Remove the specified resource from storage.
     * @param Post $post
     * @return RedirectResponse
     */
    public function destroy(Post $post) : RedirectResponse
    {
        $post->delete();
        return redirect()->route('admin.posts.index')
            ->withSuccess(__('post.deleted'));
    }


    /**
     * @param ImportRequest $request
     * @param UserImport $userImport
     * @return View
     */
    public function importPosts(ImportRequest $request, UserImport $userImport) : View
    {

        Log::info("Add import request to the job", ["url" => $request->url]);
        $jobId = $this->dispatch(new ProcessImportPostRequest($this->getAuthUserId(), $request->url));
        $userImport->add($this->getAuthUserId(), $jobId);
        return view('admin.posts.import_progress', [
            'jobId' => $userImport->id
        ]);

    }


    /**
     * @param UserImport $user_imports
     * @return JsonResponse
     */
    public function importStatus(UserImport $user_imports) : JsonResponse
    {
        if($user_imports) {
            if($user_imports->status) {
                return $this->success(true, trans("post.import_success"));
            } else {
                return $this->success(false, trans("post.in_progress"));
            }
        } else {
            return $this->failedWith404(trans("psot.job_not_found"));
        }
    }


}
