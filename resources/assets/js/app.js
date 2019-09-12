/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
// import Echo from "laravel-echo"
//
// window.io = require('socket.io-client');
//
// let token = document.head.querySelector('meta[name="csrf-token"]');
//
// window.Echo = new Echo({
//     broadcaster: 'socket.io',
//     host: window.location.hostname + ':6001',
//     reconnectionAttempts: 5,
//     csrfToken: token.content
// });

// current online users
window.Echo.join('online-users')
    .here((users) => {
        console.log(users);
    })
    .joining((user) => {
        console.log(user);
    })
    .leaving((user) => {
        console.log(user);
    });

// post.like.created
window.Echo.channel(`post-like`)
    .listen('CreatePostLike', (e) => {
        console.log(e);
    });
