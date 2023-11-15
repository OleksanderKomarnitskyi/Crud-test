<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\StorePostRequest;
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
     * @throws Exception
     */
    public function store(StorePostRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = $request->user()->id;

        try {
            $this->postService->create($data);
            return redirect()->route('posts.index');
        } catch (Exception $exception) {
            return response()->withException($exception)->setStatusCode(500);
        }

    }

    public function edit(Request $request): Response
    {
        dd("edit");
    }

    public function update(Request $request): RedirectResponse
    {
       dd("update");
    }

    public function destroy(Request $request): RedirectResponse
    {
        dd('destroy');

    }
}
