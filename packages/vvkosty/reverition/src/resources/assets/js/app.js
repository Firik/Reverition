import Vue from "vue";
import DragNDropComponent from './components/DragNDropComponent.vue';
import resultPage from './components/resultPage';


Vue.component('drag-n-drop-component', DragNDropComponent);
Vue.component('result', resultPage);

window.packageNameEvent = new Vue();