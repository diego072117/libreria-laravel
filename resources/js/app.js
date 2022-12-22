

import './bootstrap';
import { createApp } from 'vue';
import ExampleComponent from './components/ExampleComponent.vue';
import BooksList from './components/Books/Index.vue';


// components ------------------------------
const app = createApp({
    components:{
        ExampleComponent,
        BooksList
    }
});


app.mount('#app');
