<template>
    <div id="app" class="font-roboto bg-gray-100">
        <navbar></navbar>

        <div class="px-6 py-8">
            <div class="flex flex-col gap-4 container mx-auto">
                    <h1 class="text-xl font-bold text-gray-700 md:text-2xl" v-text="post.title"></h1>
                <div class="w-full" v-html="post.content">
                </div>
                <template v-if="post.materials.length">
                <h3>Материалы для скачивания</h3>
                <template v-for="link in post.materials">
                    <a :href="link.url" v-html="link.name" download></a>
                </template>
                </template>
            </div>
        </div>

        <simple-footer></simple-footer>
    </div>
</template>

<script>
import Navbar from "./components/navigation-navbar-simple.vue";
import SimpleFooter from "./components/navigation-footer-simple-with-icon.vue";
import Request from './methods/request';

export default {
    name: 'app',
    components: {
        Navbar,
        SimpleFooter
    },
    data() {
        return {
            imgUrl: window.Laravel.baseUrl + '/storage/',
            post:{}       
        }
    },
    methods: {
        async getData() {
                let req = new Request();
                let url = window.location.pathname.replace("/","");
                url = url.replace("post/","");
                const graphqlQuery = {
                        "query": `{post(url:"`+url+`") {
                                id
                                title
                                content
                                created_at
                                url
                                categories {
                                    name
                                }
                                materials {
                                    type
                                    filename
                                    url
                                }
                                user {
                                    profile {
                                        first_name
                                        last_name
                                        avatar
                                    }
                                }
                                materials {
                                    type
                                    name
                                    filename
                                    url
                                }
                                }}`
                };
                let data = await req.getData(graphqlQuery);
                 this.post = data.data.post;
            },
    },
    mounted() {
                this.getData()
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
