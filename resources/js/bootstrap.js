import _ from 'lodash';
import * as bootstrap from 'bootstrap';
import axios from 'axios';
import swal from 'sweetalert2';

window._ = _;
window.swal = swal;
window.bootstrap = bootstrap;
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'; //ajax


const csrf_token = document.head.querySelector('meta[name="csrf-token"]')
if (csrf_token) {
	window.csrf_token = csrf_token.content
	window.axios.defaults.headers.common['X-CSRF-TOKEN'] = window.csrf_token
} else console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token')
