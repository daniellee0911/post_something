<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, usePage, useForm } from '@inertiajs/vue3';
import { ref,reactive, computed, watch } from 'vue';

import NewModal from '@/Components/NewModal.vue';




const formData = useForm({
    title:'',
    content:'',
})


const submit = () => {
    console.log('submit')
    formData.post(route('posts.edit'))
    
  
}
</script>

<template>
    <Head title="Dashboard" />

    <NewModal  v-model="$page.props.flash.message"  :message="$page.props.flash.message"/>
    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                個人後台
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                >
                    <!-- <div v-if="$page.props.flash.message"  class="p-6 text-gray-900">
                        {{ $page.props.flash.message }}
                    </div> -->
                    <form class="p-12 space-y-4" @submit.prevent="submit">
                        <div class="text-center">
                            <input
                                type="title"
                                name="title"
                                v-model="formData.title"
                                placeholder="標題..." 
                                class="w-3/4 px-4 py-2 mt-2 text-purple-700 bg-white border rounded-md focus:border-purple-400 focus:ring-purple-300 focus:outline-none focus:ring focus:ring-opacity-40"
                            />
                            <p v-if="formData.errors.title" class="text-sm text-red-600">
                                {{ formData.errors.title }}
                            </p>
                        </div>
                    
                        <div class="text-center"> 
                            <textarea 
                            v-model="formData.content"
                            name="content" 
                            placeholder="寫點什麼吧..." 
                            class="w-3/4 px-4 py-2 mt-2 text-purple-700 bg-white border rounded-md focus:border-purple-400 focus:ring-purple-300 focus:outline-none focus:ring focus:ring-opacity-40" 
                                rows="5" ></textarea>
                            <p v-if="formData.errors.content" class="text-sm text-red-600">
                                {{ formData.errors.content }}
                            </p>
                        </div>
                       
                    
                        <div class="text-center">
                            <button
                                type="submit"
                                class="w-3/4 px-4 py-2 tracking-wide text-white transition-colors duration-200 transform bg-purple-600 rounded-md hover:bg-purple-700 focus:outline-none focus:bg-purple-600"
                            >
                                送出
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
