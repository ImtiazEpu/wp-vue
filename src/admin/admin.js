import Vue from 'vue'
import Vuex from 'vuex'
import store from '../store/index'
import VueRouter from 'vue-router'
import App from './App'
import Notifications from 'vue-notification'
import GeneralTab from "./components/tabs/GeneralTab";
import AnotherTab from "./components/tabs/AnotherTab";
import Navigation from "./components/tabs/Navigation";
import Settings from "./components/pages/Settings";

Vue.use(Vuex)
Vue.use(VueRouter);
Vue.use(Notifications)
const routes = [
    {
        path: '/',
        components: {
            default: GeneralTab,
            tab: Navigation
        }
    },
    {
        path: '/another',
        components: {
            default: AnotherTab,
            tab: Navigation
        }
    },
    {
        path: '/settings',
        components: {
            default: Settings,
        }
    }
];

const router = new VueRouter({
    routes
});

const app = new Vue({
    el: '#wpvk-admin-app',
    router,
    store,
    render: h => h(App)
});