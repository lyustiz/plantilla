window.axios = require('axios');

let auth = `Bearer ${localStorage.getItem("auth")}`
            
window.axios.defaults.headers.common['Authorization']= auth

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token)
{
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
}
else
{
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}
