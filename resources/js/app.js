require('./bootstrap');

import { createApp } from 'vue';
import VueAxios from 'vue-axios';
import { axios } from 'axios';
import MetamaskSign from "./components/Metamask/Sign";

const app = createApp({
    components: {
        VueAxios,
        axios
    }
});
app.component('metamask-sign', MetamaskSign);

app.mount('#app');
