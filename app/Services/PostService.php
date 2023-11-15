<?php

namespace App\Services;

use App\Models\Post;
use Exception;
use Illuminate\Support\Facades\DB;

class PostService extends MySqlService
{


    /**
     * @throws Exception
     */
    public function create(array $data): Post
    {
        DB::beginTransaction();
        try {

            $post = Post::create($data);

            DB::commit();

            return $post;
        } catch (Exception $exception) {
            $this->handleException($exception, 'create new post is fail');
            throw $exception;
        }
    }

    /**
     * @param Post $post
     * @param array $data
     * @return void
     * @throws Exception
     */
    public function update(Post $post, array $data): void
    {
        DB::beginTransaction();
        try {
            $post->update($data);
            DB::commit();

        } catch (Exception $exception) {
            $this->handleException($exception);
        }

    }

}
