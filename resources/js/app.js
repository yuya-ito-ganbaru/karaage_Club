import './bootstrap';
import '../css/app.css';
import { createApp } from 'vue';
import App from '../views/App.vue';
import '@mdi/font/css/materialdesignicons.css'
import { createVuetify } from 'vuetify';
import router from './router';
import 'vuetify/dist/vuetify.min.css';

const app = createApp(App);
const vuetify = createVuetify();
app.use(router);
app.use(vuetify);
app.mount('#app');