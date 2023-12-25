import { createApp } from 'vue/dist/vue.esm-bundler';
import App from './Post.vue';
const app = createApp(App);


const mountedApp = app.mount("#app");