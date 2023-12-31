<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\SavePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Services\PostService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PostController extends Controller
{
    private PostService $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        $posts = Post::where('user_id', $request->user()->id)
            ->orderByDesc('created_at')
            ->paginate(5)
            ->withQueryString();

        $posts = PostResource::collection($posts);
        return Inertia::render('Post/Index', compact('posts'));
    }

    /**
     * @param Post $post
     * @return Response
     */
    public function show(Post $post): Response
    {
        $post = PostResource::make($post)->resolve();
        return Inertia::render('Post/Show', compact('post'));
    }

    /**
     * @return Response
     */
    public function create(): Response
    {
        return Inertia::render('Post/Create');
    }


    /**
     * @param SavePostRequest $request
     * @return RedirectResponse
     */
    public function store(SavePostRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['user_id'] = $request->user()->id;

        try {
            $this->postService->create($data);
            return redirect()->route('posts.index');
        } catch (Exception $exception) {
            return redirect()->back(500)->withException($exception);
        }

    }

    /**
     * @param Post $post
     * @return Response
     */
    public function edit(Post $post): Response
    {
        return Inertia::render("Post/Edit", compact('post'));
    }

    /**
     * @param Post $post
     * @param SavePostRequest $request
     * @return RedirectResponse
     */
    public function update(Post $post, SavePostRequest $request): RedirectResponse
    {
        if (!$post->user_id || ($post->user_id != $request->user()->id) ) {
            return back()->withErrors('Permission to execute is denied')->setStatusCode(403);
        }
        $data = $request->validated();
        try {
            $this->postService->update($post, $data);
            return redirect()->route('posts.index');
        } catch (Exception $exception) {
            return redirect()->back(500)->withException($exception);
        }
    }

    /**
     * @param Post $post
     * @param Request $request
     * @return RedirectResponse
     */
    public function destroy(Post $post, Request $request): RedirectResponse
    {
        if (!$post->user_id || ($post->user_id != $request->user()->id) ) {
            return back()->withErrors('Permission to execute is denied')->setStatusCode(403);
        }
        try {
            $post->delete();
            return redirect()->route('posts.index');
        } catch (Exception $exception) {
            return redirect()->back(500)->withException($exception);
        }

    }
}
