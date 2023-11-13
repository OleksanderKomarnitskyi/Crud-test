<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class PostController extends Controller
{

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

    public function show(Request $request): Response
    {
        dd("index");
    }

    public function create(Request $request): Response
    {
        dd("index");
    }

    public function store(Request $request): Response
    {
        dd("index");
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
