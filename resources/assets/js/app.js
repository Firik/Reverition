import Vue from "vue";
import VueRouter from 'vue-router'
import DragNDropComponent from "./components/DragNDropComponent";
import ResultPageComponent from "./components/ResultPageComponent";
import Vuex from "vuex";

Vue.use(VueRouter);
Vue.use(Vuex);

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
