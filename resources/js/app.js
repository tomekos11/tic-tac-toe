import { createApp } from 'vue';
import App from './App.vue';
import './bootstrap';

import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.min.js';
import bootstrap from 'bootstrap/dist/js/bootstrap.bundle.min.js';
import "/node_modules/bootstrap-icons/font/bootstrap-icons.min.css";

const app = createApp(App);

app.mount('#app');