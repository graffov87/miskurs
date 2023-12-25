<template>
    <div class="flex flex-col bg-white px-4 py-6 max-w-sm mx-auto rounded-lg shadow-md">
        <ul class=""  v-for="item in categories">
            <li class="mt-2">
                <a class="text-gray-700 font-bold mx-1 hover:text-gray-600 hover:underline" href="#" v-text="item.name"></a>
            </li>
        </ul>
    </div>
</template>


<script>
import Request from '../methods/request';

export default {
    data() {
        return {
            categories:[]
        }
    },
    methods: {
        async getData() {
            let req = new Request();
                const graphqlQuery = {
                        "query": `{categories(orderBy: [{ column: SORT, order: ASC }]) {
                                name
                                }}`
                };
                let data = await req.getData(graphqlQuery);
                this.categories = data.data.categories;        

            }
    },
    mounted() {
      this.getData()
    }
}
</script>