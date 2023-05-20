import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import store from "./store";
import './assets/styles/tailwind.css';
import './assets/styles/theme.scss'

import 'virtual:svg-icons-register';
import {maska} from "maska";
import Toast from "vue-toastification";
const options = {}

createApp(App).use(router).use(store).directive('maska', maska).use(Toast, options).mount('#app')
