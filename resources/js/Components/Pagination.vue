<script setup>
import { Link } from '@inertiajs/vue3';


defineProps({
   links: {
       type: Array,
       default: () => ([]),
   },
});
</script>


<style>

</style>


<template>
   <div v-if="links.length > 3">
       <div class="flex flex-wrap justify-center -mb-1">
           <template v-for="(link, p) in links" :key="p">
               <div v-if="link.url === null" class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-gray-400 border rounded"
                   v-html="link.label" />
               <Link v-else
                   class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded"
                   :class="{ 'bg-indigo-500 ': link.active }" :href="link.url" v-html="link.label" />
           </template>
       </div>
   </div>
</template>
