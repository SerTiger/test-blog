require('./bootstrap');

import { createApp } from 'vue';
import VueAxios from 'vue-axios';
import { axios } from 'axios';
import MetamaskAuth from "./components/Metamask/Auth";

const app = createApp({
    components: {
        VueAxios,
        axios
    }
});
app.component('metamask-auth', MetamaskAuth);

app.mount('#app');
