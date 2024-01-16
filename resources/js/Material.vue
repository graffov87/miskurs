<template>
    <div id="app" class="font-roboto bg-gray-100">
        <navbar></navbar>

        <div class="px-6 py-8">
            <div class="flex justify-between container mx-auto">
                <div class="w-full">
                    <div class="flex items-center justify-between">
                        <h1 class="text-xl font-bold text-gray-700 md:text-2xl">Материалы для скачивания</h1>
                        <post-filter :order="order" :click="change"></post-filter>
                    </div>
                    <div class="mt-6" v-for="post in materials" :key="post.id">
                        <material :data="post" :size="0"></material>
                    </div>
                    <div class="mt-8">
                        <Pagination :step="step" :counts="counts" :click="next"></Pagination>
                    </div>
                </div>
            </div>
        </div>

        <simple-footer></simple-footer>
    </div>
</template>

<script>
import Navbar from "./components/navigation-navbar-simple.vue";
import SimpleFooter from "./components/navigation-footer-simple-with-icon.vue";
import PostFilter from "./components/elements-select-option.vue";
import Material from "./components/element-material.vue";
import Pagination from "./components/elements-pagination.vue";
import Request from './methods/request';

export default {
    name: 'app',
    components: {
        Navbar,
        PostFilter,
        Material,
        Pagination,
        SimpleFooter
    },
    data() {
        return {
            imgUrl: window.Laravel.baseUrl + '/storage/',
            materials:[]  ,
            step:1,
            counts:0,
            size:10,
            order:"DESC"
        }
    },
    methods: {
        async getData(size, page, order) {
            let req = new Request();
                const graphqlQuery = {
                        "query": `{materials(orderBy: [{ column: CREATED_AT, order: `+order+` }],first:`+size+`,page:`+page+`) {
                            data {
                                id
                                type
                                name
                                filename
                                url
                            }
                            paginatorInfo {
                                currentPage
                                lastPage
                                }
                                }}`
                };
                let data = await req.getData(graphqlQuery);
                this.materials = data.data.materials.data;
            },
       async getCounts() {
        let req = new Request();
                const graphqlQuery = {
                        "query": `{materialsCount}`
                };
                let data = await req.getData(graphqlQuery);
        if (data.data.materialsCount > this.size) {
        this.counts = Math.ceil(data.data.materialsCount/this.size);
        } else {
            this.counts = 0;
        }

       },
       next(step) {
        this.step = step;
        this.getData(this.size, this.step,this.order);
       },
       change(event) {
        this.order =  event.target.value;
        this.getData(this.size, this.step,this.order);
       }
    },
    mounted() {
                this.getData(this.size, this.step, this.order);
                this.getCounts();
        }
}
</script>

<style>
@import "../css/app.css";

::-webkit-scrollbar {
    width: 5px;
}

::-webkit-scrollbar-track {
    background: #2D3748;
}

::-webkit-scrollbar-thumb {
    background: #CBD5E0;
}

::-webkit-scrollbar-thumb:hover {
    background: #2D3748;
}
</style>
