import { createApp } from 'vue'
import axios from '../src/plugins/axios'
import VueAxios from 'vue-axios'
import router from './router'
import App from './App.vue'
import { createPinia } from 'pinia'
import vSelect from "vue-select";
import "vue-select/dist/vue-select.css";

const pinia = createPinia()
const app = createApp(App)
app.use(router)
app.use(VueAxios, { axios })
app.use(pinia)
app.component('v-select', vSelect)
app.provide('axios', app.config.globalProperties.axios)
app.mount('#app')