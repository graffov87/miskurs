/*import './bootstrap';

import { createApp } from 'vue/dist/vue.esm-bundler';

import ExampleCounter from "./components/ExampleCounter.vue";

const app = createApp({});

app.component("example-counter", ExampleCounter);

const mountedApp = app.mount("#app");*/
/*
import Vue from 'vue/dist/vue.esm-bundler';
import App from './App.vue'

Vue.config.productionTip = false

new Vue({
  render: h => h(App),
}).$mount('#app')
*/
import { createApp } from 'vue/dist/vue.esm-bundler';
import App from './App.vue';
const app = createApp(App);


const mountedApp = app.mount("#app");