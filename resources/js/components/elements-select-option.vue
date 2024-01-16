<template>
    <div>
        <select class="block bg-gray-300 text-gray-700 py-2 px-2 rounded-lg focus:outline-none md:py-3" v-on:change="click($event)">
            <option value="DESC">Новые</option>
            <option value="ASC">Старые</option>
        </select>
    </div>
</template>


<script>
    export default {
        props: ['order','click']
    }
</script>