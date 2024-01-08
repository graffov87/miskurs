<template>
    <div id="app" class="font-roboto bg-gray-100">
        <navbar></navbar>

        <div class="px-6 py-8">
            <div class="flex justify-between container mx-auto">
                <div class="w-full lg:w-7/12">
                    <div class="flex items-center justify-between">
                        <h1 class="text-xl font-bold text-gray-700 md:text-2xl">Статьи</h1>
                    </div>
                    <div class="mt-6" v-for="post in posts" :key="post.id">
                        <post :data="post" :size="1"></post>
                    </div>
                </div>
                <div class="-mx-8 w-4/12 hidden lg:block">
                    <div class="px-8">
                        <h1 class="mb-4 text-xl font-bold text-gray-700">Календарь дня</h1>
                        <calend></calend>
                    </div>
                    <div class="mt-10 px-8">
                        <h1 class="mb-4 text-xl font-bold text-gray-700">Категории</h1>
                        <categories></categories>
                    </div>
                   <!-- <div class="mt-10 px-8">
                        <h1 class="mb-4 text-xl font-bold text-gray-700">Последняя Статья</h1>
                        <recent-post></recent-post>
                    </div> -->
                </div>
            </div>
        </div>

        <simple-footer></simple-footer>
    </div>
</template>

<script>
import Navbar from "./components/navigation-navbar-simple.vue";
import PostFilter from "./components/elements-select-option.vue";
import Post from "./components/elements-blog-post-article-review.vue";
import Pagination from "./components/elements-pagination.vue";
import UsersList from "./components/sections-blog-users-list.vue";
import Categories from "./components/sections-categories-list.vue";
import RecentPost from "./components/sections-recent-article.vue";
import SimpleFooter from "./components/navigation-footer-simple-with-icon.vue";
import Calend from "./components/section-calendar.vue";
import Request from './methods/request';

export default {
    name: 'app',
    components: {
        Navbar,
        PostFilter,
        Post,
        Pagination,
        UsersList,
        Categories,
        RecentPost,
        SimpleFooter,
        Calend
    },
    data() {
        return {
            imgUrl: window.Laravel.baseUrl + '/storage/',
            posts: [],           
        }
    },
    methods: {
        async getData() {
                let req = new Request();
                const graphqlQuery = {
                        "query": `{posts(orderBy: [{ column: CREATED_AT, order: DESC }]) {
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
                                materials {
                                    type
                                    name
                                    filename
                                    url
                                }
                                }}`
                };
                let data = await req.getData(graphqlQuery);
                let posts = data.data.posts.slice(0,5);
                let newPosts = [];

                posts.forEach(el => {
                    let postImg = window.Laravel.baseUrl + "/" + el.url;
                    let date = new Date(el.created_at);
                    let newDate = (date.getDate() > 9 ? '' : '0') + date.getDate() +"/" + ((date.getMonth() + 1) > 9 ? '' : '0') + (date.getMonth() + 1) +"/" + date.getFullYear() ;
                    newPosts.push({
                    id: el.id,
                    date: newDate,
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
