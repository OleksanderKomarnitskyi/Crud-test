<script setup>
import {Head, Link, useForm} from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const form = useForm({
    title: '',
    content: '',
});

</script>

<template>

    <Head title="Create new post" />
    <div class="mx-40" >
        <div class="pt-4 pl-4 btn_row_grouper">
            <div class="mb-4">
                <Link :href="route('posts.index')"
                      class="py-2 px-2 ml-4 hover:bg-sky-500 w-32 bg-green-500 rounded-lg text-sm text-center text-white"  style="cursor: pointer">Go back
                </Link>
            </div>
        </div>
        <div class="mt-8 pt-8 border-t border-gray-300" >
            <form @submit.prevent="form.post(route('posts.store'))" class="mt-6 space-y-6">
                <div>
                    <InputLabel for="title" value="Title" />
                    <TextInput
                        id="title"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.title"
                        autofocus
                    />
                    <InputError class="mt-2" :message="form.errors.title" />
                </div>
                <div>
                    <label for="content">Content</label>
                    <textarea
                        id="content"
                        name="content"
                        type="text"
                        v-model="form.content"
                        class=" w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                    </textarea>
                    <InputError class="mt-2" :message="form.errors.content" />
                </div>
                <div class="flex items-center gap-4">
                    <PrimaryButton :disabled="form.processing">Create</PrimaryButton>
                    <Transition
                        enter-active-class="transition ease-in-out"
                        enter-from-class="opacity-0"
                        leave-active-class="transition ease-in-out"
                        leave-to-class="opacity-0"
                    >
                        <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                    </Transition>
                </div>
            </form>
        </div>
    </div>

</template>

<style scoped>

</style>
