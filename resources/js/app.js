//import './bootstrap';

import { createApp } from 'vue';
import { Bootstrap4Pagination } from 'laravel-vue-pagination';
import { Bootstrap5Pagination } from 'laravel-vue-pagination';
import { TailwindPagination } from 'laravel-vue-pagination';
//import store from './store'
import router from './routes/index'
//import VueSweetalert2 from "vue-sweetalert2";
//import { abilitiesPlugin } from '@casl/vue';
//import ability from './services/ability';
//import vSelect from "vue-select";
//import useAuth from './composables/auth';
//import i18n from "./plugins/i18n";

/*import 'sweetalert2/dist/sweetalert2.min.css';
import 'vue-select/dist/vue-select.css';*/

const app = createApp({
    created() {
        //useAuth().getUser()
    }
});

/*import ExampleComponent from './components/ExampleComponent.vue';

app.component('example-component', ExampleComponent);*/


app.use(router)
//app.use(store)
//app.use(VueSweetalert2)
//app.use(i18n)
//app.use(abilitiesPlugin, ability)
app.component('Pagination', TailwindPagination)
//app.component("v-select", vSelect);
app.mount('#app');

// menu
/*const menu = document.querySelector('.menu');
const burger = document.querySelector('.burger');

function toggleMenu() {
    const expanded = burger.getAttribute('aria-expanded') === 'true' || false;
    burger.setAttribute('aria-expanded', !expanded);
    menu.setAttribute('aria-hidden', expanded);
    burger.classList.toggle('open');
    menu.classList.toggle('active');
}

burger.addEventListener('click', toggleMenu);

document.addEventListener("click", (event) => {
    if (!burger.contains(event.target) && !menu.contains(event.target)) {
        menu.classList.remove("active");
        burger.classList.remove('open');
    }
});

document.addEventListener("keydown", (event) => {
    if (event.key === 'Escape') {
        menu.classList.remove("active");
        burger.classList.remove('open');
    }
});*/
