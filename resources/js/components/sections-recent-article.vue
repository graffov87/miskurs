<template>
    <div class="flex flex-col bg-white px-8 py-6 max-w-sm mx-auto rounded-lg shadow-md">
            <div class="flex justify-center items-center">
                <a class="px-2 py-1 bg-gray-600 text-sm text-green-100 rounded hover:bg-gray-500" href="#" v-text="post.categories[0].name"></a>
            </div>
            <div class="mt-4">
                <a class="text-lg text-gray-700 font-medium hover:underline" href="#" v-html="post.title"></a>
            </div>
            <div class="flex justify-between items-center mt-4">
                <div class="flex items-center">
                    <img :src=" imgUrl + post.user.profile.avatar"
                         class="w-8 h-8 object-cover rounded-full" alt="avatar"/>
                    <a class="text-gray-700 text-sm mx-3 hover:underline" href="#" v-html="post.user.profile.first_name + ' ' + post.user.profile.last_name"></a>
                </div>
                <span class="font-light text-sm text-gray-600" v-text="post.date"></span>
            </div>
    </div>
</template>


<script>
import Request from '../methods/request';

export default {
    data() {
        return {
            post:null,
            imgUrl: window.Laravel.baseUrl + '/storage/'
        }
    },
    methods: {
        async getData() {
            let req = new Request();
                const graphqlQuery = {
                        "query": `{posts(orderBy: [{ column: CREATED_AT, order: DESC }]) {
                                title
                                created_at  
                                categories {
                                    name
                                }
                                user {
                                    profile {
                                        first_name
                                        last_name
                                        avatar
                                    }
                                }
                                }}`
                };
                let data = await req.getData(graphqlQuery);
                this.post = data.data.posts[0];
                let date = new Date(this.post.created_at);
                this.post.date = (date.getDate() > 9 ? '' : '0') + date.getDate() +"/" + ((date.getMonth() + 1) > 9 ? '' : '0') + (date.getMonth() + 1) +"/" + date.getFullYear() ;
                

            }
    },
    mounted() {
      this.getData()
    }
}
</script>