const Axios = require('axios').default
let token = document.head.querySelector('meta[name="csrf-token"]')

Axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

if (token) {
    Axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

export default Axios
