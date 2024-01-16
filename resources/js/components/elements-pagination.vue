<template v-if="counts">
    <ul class="flex">
        <li class="mx-1 px-3 py-2 bg-gray-200 text-gray-500 rounded-lg hover:bg-gray-700 hover:text-gray-200" v-if="step > 1">
            <a class="flex items-center font-bold" href="#" v-on:click="click(step-1)">Предыдущая</a>
        </li>
        <li v-for="li in counts" class="mx-1 px-3 py-2  hover:bg-gray-700 hover:text-gray-200 rounded-lg" :class="{'bg-gray-700': li == step,'text-gray-200': li == step,'bg-gray-200': li!=step,'text-gray-700': li!=step}">
            <a class="font-bold" href="#" v-text="li" v-on:click="click(li)"></a>
        </li>
        <li class="mx-1 px-3 py-2 bg-gray-200 text-gray-700 hover:bg-gray-700 hover:text-gray-200 rounded-lg" v-if="step < counts">
            <a class="flex items-center font-bold" href="#" v-on:click="click(step+1)">Следующая</a>
        </li>
    </ul>
</template>

<script>
    export default {
        props: ['step','counts','click']
    }
</script>