<template>
    <div id="app" class="font-roboto bg-gray-100">
        <navbar></navbar>

        <div class="px-6 py-8">
            <div class="flex justify-between container mx-auto">
                <div class="w-full">
                    <div class="flex items-center justify-between">
                        <h1 class="text-xl font-bold text-gray-700 md:text-2xl">Статьи</h1>
                        <post-filter :order="order" :click="change"></post-filter>
                    </div>
                    <div class="mt-6" v-for="post in posts" :key="post.id">
                        <post :data="post" :size="0"></post>
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
import Post from "./components/elements-blog-post-article-review.vue";
import Pagination from "./components/elements-pagination.vue";
import Request from './methods/request';

export default {
    name: 'app',
    components: {
        Navbar,
        PostFilter,
        Post,
        Pagination,
        SimpleFooter
    },
    data() {
        return {
            imgUrl: window.Laravel.baseUrl + '/storage/',
            posts:[],
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
                        "query": `{posts_limit(orderBy: [{ column: CREATED_AT, order: `+order+` }],first:`+size+`,page:`+page+`) {
                            data {
                                id
                                title
                                short_content
                                created_at
                                url
                                categories {
                                    name
                                }
                                tags {
                                    id
                                    name
                                }
                                user {
                                    profile {
                                        first_name
                                        last_name
                                        avatar
                                    }
                                }
                                }
                                paginatorInfo {
                                currentPage
                                lastPage
                                }
                                }}`
                };
                let data = await req.getData(graphqlQuery);
                let posts = data.data.posts_limit.data;
                let newPosts = [];
                posts.forEach(el => {
                    let postImg = window.Laravel.baseUrl + "/post/" + el.url;
                    newPosts.push({
                    id: el.id,
                    date: el.created_at,
                    tag: el.categories[0].name,
                    tags: el.tags,
                    title: el.title,
                    body: el.short_content,
                    url: postImg,
                    image: this.imgUrl + el.user.profile.avatar,
                    userName: el.user.profile.first_name + ' ' + el.user.profile.last_name
                    });
                });

                this.posts = newPosts;
            },
            async getCounts() {
        let req = new Request();
                const graphqlQuery = {
                        "query": `{postsCount}`
                };
                let data = await req.getData(graphqlQuery);
        if (data.data.postsCount > this.size) {
        this.counts = Math.ceil(data.data.postsCount/this.size);
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
