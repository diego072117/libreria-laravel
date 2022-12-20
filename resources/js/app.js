

import './bootstrap';
import { createApp } from 'vue';
import ExampleComponent from './components/ExampleComponent.vue';

// components ------------------------------
const app = createApp({
    components:{
        ExampleComponent
    }
});


app.mount('#app');
