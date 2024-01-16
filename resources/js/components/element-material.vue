<template>
    <div class="px-10 py-6 bg-white rounded-lg shadow-md" :class="{'max-w-4xl' : size}">
       
        <div class="mt-2">      
            <a class="text-2xl text-gray-700 font-bold hover:underline" :href="data.url" download>{{ data.name }}</a>
        </div>
   
    </div>
</template>

<script>
    export default {
        props: ['data','size']
    }
</script>