import { createApp } from 'vue/dist/vue.esm-bundler';
import App from './Posts.vue';
const app = createApp(App);


const mountedApp = app.mount("#app");