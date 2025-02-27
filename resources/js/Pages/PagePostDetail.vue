<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
import { Head, usePage, useForm } from '@inertiajs/vue3';

import NewModal from '@/Components/NewModal.vue';
import Pagination from '@/Components/Pagination.vue';

const props = defineProps({
    isAuth:{
        type: Boolean,
    },
    post:{
        type: Array,
    },
    comments:{
        type: Object,
    }
   
});


const formData = useForm({
    message:'',
})

const sendMessage = () => {
    console.log('sendMessage')
    formData.post(route('comments.edit',props.post[0].id))

}


</script>
<template>
    <NewModal  v-model="$page.props.flash.message"  :message="$page.props.flash.message"/>
    <div>
        <div class="min-h-screen bg-gray-100">
            <nav
                class="border-b border-gray-100 bg-white"
            >
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="flex h-16 justify-between">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="flex shrink-0 items-center">
                                <Link :href="route('posts.index')">
                                    <p>廢文網</p>
                                </Link>
                            </div>  
                        </div>

                        <div   class="-mx-3 flex flex-1 justify-end"> 
                            <Link
                                v-if="isAuth"
                                :href="route('dashboard')"
                                class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none"
                            >
                                個人後台
                            </Link>

                            <template v-else>
                                <Link
                                    :href="route('login')"
                                    class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none"
                                >
                                    Log in
                                </Link>

                                <Link
                                   
                                    :href="route('register')"
                                    class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none"
                                >
                                    Register
                                </Link>
                            </template>
                        </div>
                    </div>
                </div>          
            </nav>

           

            <!-- Page Content -->
            <main>
                <div class="pt-6">
                    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                        <div
                            class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                        >
                            <div class="p-6 text-gray-900">
                                <div class="py-2 flex flex-wrap">
                                    <div class=" bg-gray-200 rounded-lg h-10">
                                        <p class="font-medium font-bold  p-2 w-auto">{{ post[0].user.name }}</p>
                                    </div>
                                    <div class="pt-2 ml-2">
                                        <p class="text-2xl">{{ post[0].title }}</p>
                                    </div>
                                    
                                    <div class="pt-2 ml-2">
                                        <p class="text-lg">({{ post[0].created_at }})</p>
                                    </div>
                                </div>
                                <div class="pt-2">
                                    <p class="text-lg">{{ post[0].content }}</p>
                                </div>
                                <!-- Message Input -->
                                <div class=" pt-4">
                                    <form @submit.prevent="sendMessage">
                                    <div class="flex items-center">
                                        <input
                                        name="message"
                                        v-model="formData.message"
                                        type="text"
                                        class="flex-1 border p-3 rounded-lg focus:border-purple-600"
                                        placeholder="寫下對此想法..."
                                        />
                                        <button type="submit" class="ml-2 bg-purple-600 text-white p-3 rounded-lg shadow hover:bg-purple-700 transition duration-300 flex items-center justify-center">
                                        <i class="fas fa-paper-plane"></i>
                                        <span class="ml-2">送出</span>
                                        </button>
                                    </div>
                                    <p v-if="formData.errors.message" class="text-sm text-red-600">
                                        {{ formData.errors.message }}
                                    </p>
                                    </form>
                                </div>
                                <div class="pt-6">
                                    <p class="text-2xl">留言</p>
                                </div>
                                <div v-for="comment in comments.data" class="py-2 flex flex-wrap border-t">
                                    <div class=" bg-gray-200 rounded-lg h-10">
                                        <p class="font-medium font-bold  p-2 w-auto">{{ comment.user.name }}</p>
                                    </div>
                                    <div class="pt-2 ml-2">
                                        <p class="text-lg">{{ comment.message }}</p>
                                    </div>
                                    <div class="pt-2 ml-2">
                                        <p class="text-sm">({{ comment.created_at }})</p>
                                    </div>
                                </div>
                                <Pagination class="mt-6" :links="comments.links"/>
                               
                            </div>
                        </div>
                    </div>
                </div>
               
            </main>
        </div>
    </div>
</template>