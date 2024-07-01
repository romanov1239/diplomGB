import './bootstrap';
import { createApp } from 'vue';
import Home from './components/Home.vue';

import routes from './routes';

createApp(Home).use(routes)

.mount('#app');
