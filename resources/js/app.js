import './bootstrap';

import { createApp } from 'vue';
import router from './routes/index'
import store from './store'
import useAuth from './composables/auth';
import VueSweetalert2 from 'vue-sweetalert2'
import { abilitiesPlugin } from '@casl/vue';
import ability from './services/ability';
import i18n from "./plugins/i18n";
import 'sweetalert2/dist/sweetalert2.min.css'
// 2. Assign the global variable before mounting
// define global properties


const app = createApp({
    created() {
        useAuth().getUser()
    }
});

app.config.globalProperties.apiPath = "http://localhost:8000/";
app.use(router)
app.use(store)
app.use(VueSweetalert2)
app.use(i18n)
app.use(abilitiesPlugin, ability)
app.mount('#app')