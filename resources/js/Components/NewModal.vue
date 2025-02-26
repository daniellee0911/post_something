<script setup>
import { ref, computed, onUpdated } from 'vue';
const props = defineProps(["modelValue","message"])
const emits = defineEmits(["update:modelValue"]);


onUpdated(() => {
   console.log('Modal onUpdated...')
   
})

const Ok =() => {
    emits('update:modelValue', !props.modelValue)
    location.reload()
}

const onToggle = () => {
    emits('update:modelValue', !props.modelValue)
    location.reload()
}

</script>

<style>
.fade-enter,
.fade-leave-to {
 opacity: 0;
}


.fade-enter-active,
.fade-leave-active {
 transition: opacity 500ms ease-out;
}
</style>
<template>
  
   <transition name="fade">
     <div v-if="props.modelValue">
       <div @click="onToggle"
         class="fixed bg-black opacity-70 inset-0 z-10">
       </div>
       <div class="flex   justify-center">
         <div class="w-full max-w-lg p-3 fixed mx-auto my-auto rounded-xl shadow-lg bg-white z-20">
           <div class="text-center p-3 flex-auto justify-center leading-6">
            
             <h2 class="text-2xl font-bold py-4">{{ props.message.title }}</h2>
            
             <p class="text-md text-gray-500 px-8">
               {{ props.message.content }}
             </p>
             
           </div>
           <div class="p-3 mt-2 text-center space-x-4 md:block">
             <button
               @click="Ok"

               class="mb-2 md:mb-0 bg-green-500 border border-green-500 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-md hover:shadow-lg hover:bg-green-600"
             >
               確定
             </button>
            
           </div>
         </div>
       </div>
     </div>
   </transition>




</template>
