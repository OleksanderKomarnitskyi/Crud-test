<script>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head, Link} from "@inertiajs/vue3";
import Pagination from "@/Components/Pagination.vue";

export default {
    name: "Edit",
    layout: AuthenticatedLayout,

    props: [
        'post'
    ],
    components: {
        Pagination,
        Link,
        Head,
        AuthenticatedLayout,
    },
}
</script>

<template>

    <Head title="Show" />
    <div class="mx-40" >
        <div class="pt-4 pl-4 btn_row_grouper">
            <div class="mb-4">
                <Link :href="route('posts.index')"
                      class="py-2 px-2 ml-4 hover:bg-sky-500 w-32 bg-green-500 rounded-lg text-sm text-center text-white"  style="cursor: pointer">Go back
                </Link>
                <Link :href="route('posts.create')"
                      class="py-2 px-2 ml-4  hover:bg-sky-500 w-32 bg-green-500 rounded-lg text-sm text-center text-white"  style="cursor: pointer">Add new post
                </Link>
            </div>
        </div>
            <div class="mt-8 pt-8 border-t border-gray-300" >
                <div class="mb-4 py-4 pl-4 bg-gray-100 rounded-lg">{{ post.title }}</div>
                <div class="mb-4 pl-4" >{{ post.content }}</div>
            </div>
        </div>

</template>

<style scoped>

</style>
