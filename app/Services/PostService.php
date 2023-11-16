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
     * @return bool
     * @throws Exception
     */
    public function update(Post $post, array $data): bool
    {
        DB::beginTransaction();
        try {
            $result = $post->update($data);
            DB::commit();

            return $result;
        } catch (Exception $exception) {
            $this->handleException($exception, 'update post is fail');
            throw $exception;
        }

    }

}
