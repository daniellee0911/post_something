<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
import Pagination from '@/Components/Pagination.vue';


defineProps({

    isAuth:{
        type: Boolean,
    },
    posts:{
        type: Object,
    }
   
});

</script>
<template>
    <div>
        <div class="min-h-screen bg-gray-100">
            <nav
                class="border-b border-gray-100 bg-white"
            >
                
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="flex h-16 justify-between">
                        <div class="flex">
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
                <div v-for="post in posts.data" class="pt-3">
                    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                        <div
                            class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                        >
                            <div class="p-6 text-gray-900">
                                <div class="pt-2 flex flex-wrap">
                                    <div class=" bg-gray-200 rounded-lg h-10">
                                        <p class="font-medium font-bold  p-2 w-auto">{{ post.user.name }}</p>
                                    </div>
                                    <div class="pt-2 ml-2 ">
                                        <p class="text-2xl">{{ post.title }}</p>
                                    </div>
                                    <div class="pt-2 ml-2">
                                        <p class="text-lg">({{ post.created_at }})</p>
                                    </div>
                                    
                                </div>
                                <!-- <div class="relative inline-flex items-center justify-center  h-10  bg-gray-200 rounded-lg ">
                                    <p class="font-medium font-bold p-2">test1</p>
                                </div>
                                
                                <div class="py-2">
                                    <p class="text-2xl">title</p>
                                </div> -->
                                <div class="pt-3">
                                    <p class="text-lg">{{ post.content }}</p>
                                </div>
                                <div class="pt-3">
                                    <Link
                                        :href="route('posts.show',post.id)"
                                        class="rounded-lg p-2 text-lg text-white bg-purple-700 hover:bg-purple-600"
                                    >
                                        看留言
                                    </Link>
                                   
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    
                </div>
                <Pagination class="mt-6" :links="posts.links"/>
            </main>
        </div>
    </div>
</template>