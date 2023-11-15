<script xmlns="http://www.w3.org/1999/html">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Pagination from "@/Components/Pagination.vue";
import {Head, Link, useForm} from "@inertiajs/vue3";

const deletePost = (id) => {
    console.log(id, " post  delete")
    // form.delete(route('profile.destroy'), {
    //     preserveScroll: true,
    //     onSuccess: () => closeModal(),
    //     onError: () => passwordInput.value.focus(),
    //     onFinish: () => form.reset(),
    // });
};
export default {
    name: "post-index",
    layout: AuthenticatedLayout,

    props: [
        'posts'
    ],

    components: {
        Link,
        Head,
        AuthenticatedLayout,
        Pagination
    },

}

</script>

<template>
    <Head title="May Posts" />
    <div class="mx-40" >
        <div class="pt-4 pl-4 btn_row_grouper">
            <div class="mb-4">
                <Link :href="route('posts.create')"
                      class="py-2 px-2 hover:bg-sky-500 w-32 bg-green-500 rounded-lg text-sm text-center text-white"  style="cursor: pointer">Add post
                </Link>
            </div>
        </div>

        <div v-if="posts">
            <div v-for="post in posts.data">
                <div class="mt-8 pt-8 border-t border-gray-300" >
                    <div class="mb-4 pl-4 btn_row_grouper" >
                        <div class="py-1 hover:bg-sky-500 w-24 bg-green-500 rounded-lg text-sm text-center text-white"  style="cursor: pointer">
                            <Link :href="route('posts.show', post.id)">
                                Show more
                            </Link>
                        </div>
                        <div class="py-1 hover:bg-sky-500 w-24 bg-green-500 rounded-lg text-sm text-center text-white"  style="cursor: pointer">
                            <Link :href="route('posts.edit', post.id)">
                                Edit
                            </Link>
                        </div>
                        <div class="py-1 hover:bg-red-500 w-24 bg-green-500 rounded-lg text-sm text-center text-white"  style="cursor: pointer">
                            <Link @click="deletePost(post.id)">
                                Delete
                            </Link>
                        </div>
                        <div class="text-sm text-right" style="display: contents">
                            {{ post.date }}
                        </div>
                    </div>
                    <div class="mb-4 py-4 pl-4 bg-gray-100 rounded-lg">{{ post.title }}</div>
                    <div class="mb-4 pl-4" >{{ post.content }}</div>
                </div>
            </div>
            <pagination v-if="posts.meta" class="mt-6" :links="posts.meta.links" />
        </div>
        <div v-if="posts.data.length === 0" >
            <div class="mt-8 pt-8 border-t border-gray-300" >
                <div class="mb-4 pl-4 btn_row_grouper" >
                    <h1> Not found posts </h1>
                </div>
            </div>
        </div>
    </div>
</template>

<style>
.btn_row_grouper {
    display: flex;
    gap: 20px;
}
</style>
