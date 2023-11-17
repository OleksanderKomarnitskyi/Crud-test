<script setup>

import Pagination from "@/Components/Pagination.vue";
import {Head, Link, useForm, usePage} from "@inertiajs/vue3";
import DangerButton from "@/Components/DangerButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import Modal from "@/Components/Modal.vue";
import {ref} from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const confirmingPostDeletion = ref(false);
const passwordInput = ref(null);
const posts = ref(usePage().props.posts);
const form = useForm({});
const postId = ref(null);


const confirmPostDeletion = (id) => {
  postId.value = id;
  confirmingPostDeletion.value = true;
};

const closeModal = () => {
  confirmingPostDeletion.value = false;
  form.reset();
};

const deletePost = () => {
    form.delete(route('posts.destroy', postId.value), {
        preserveScroll: true,
        onSuccess: () => {
          const indexToDelete = posts.value.data.findIndex(post => post.id === postId.value);
          if (indexToDelete !== -1) {
            posts.value.data.splice(indexToDelete, 1);
          }
          closeModal();
        },
        onError: () => postId.value.focus(),
        onFinish: () => form.reset(),

    });
};

</script>

<template>
  <AuthenticatedLayout>
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
                        <div class="py-1 hover:bg-red-500 w-24 rounded-lg text-sm text-center text-white"  style="cursor: pointer">
                          <DangerButton @click="confirmPostDeletion(post.id)">Delete</DangerButton>
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
  </AuthenticatedLayout>

  <Modal :show="confirmingPostDeletion" @close="closeModal">
    <div class="p-6">
      <h2 class="text-lg font-medium text-gray-900">
        Are you sure you want to delete post?
      </h2>

      <div class="mt-6 flex justify-end">
        <SecondaryButton @click="closeModal"> Cancel </SecondaryButton>

        <DangerButton
            class="ms-3"
            @click="deletePost">
          Delete post
        </DangerButton>
      </div>
    </div>
  </Modal>

</template>

<style>
.btn_row_grouper {
    display: flex;
    gap: 20px;
}
</style>
