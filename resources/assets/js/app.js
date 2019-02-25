import Vue from "vue";
import VueRouter from 'vue-router'
import Vuex from "vuex";
import VueFlashMessage from 'vue-flash-message';
import DragNDropComponent from "./components/DragNDropComponent";
import ResultPageComponent from "./components/ResultPageComponent";

import 'vue-flash-message/dist/vue-flash-message.min.css';

Vue.use(VueRouter);
Vue.use(Vuex);
Vue.use(VueFlashMessage);

const store = new Vuex.Store({
    strict: true,
    state: {
        url: '',
        filename: '',
        preview: ''
    },
    mutations: {
        setUrl(state, url) {
            state.url = url;
        },
        setFilename(state, filename) {
            state.filename = filename;
        },
        setPreview(state, base64Data) {
            state.preview = base64Data;
        }
    }
});

const routes = [
    {path: '/', component: DragNDropComponent},
    {
        path: '/result',
        component: ResultPageComponent,
        beforeEnter: (to, from, next) => {
            if (store.state.url) {
                next();
            } else {
                next('/');
            }
        }
    }
];

const router = new VueRouter({
    routes
});

const app = new Vue({
    router,
    store
}).$mount('#app');
