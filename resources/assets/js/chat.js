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
import Echo from "laravel-echo"

// window.io = require('socket.io-client');
//
// let token = document.head.querySelector('meta[name="csrf-token"]');

// window.Echo = new Echo({
//     broadcaster: 'socket.io',
//     host: window.location.hostname + ':6001',
//     reconnectionAttempts: 5,
//     csrfToken: token.content
// });
 

// post.like.created
let id = window.user;
let active_scroll_chat = $('.chat-overflow');
window.Echo.channel(`privateChannel.` + id)
    .listen('MessageEvent', (response) => {
        let from_user_id = response.message.from_user_id;
        let to_user_id = response.message.to_user_id;
        let message = response.message.message;
        let to_user = response.to_user;
        let from_user = response.from_user;
        if ($(`li[data-user-id='${from_user_id}']`).length != 0) {

            $(`li[data-user-id='${from_user_id}'] > .time`).text('Now');
            $(`li[data-user-id='${from_user_id}'] > .preview`).text(message);
            console.log(from_user_id);
            if ($(`li[data-user-id='${from_user_id}']`).hasClass('active')) {
                console.log('is active')
                $(`.chat-overflow`).append(`
                    <div class="bubble me">
                        ${message}
                    </div>
                `);
            }
        } else {
            console.log("chat not found user item add new one");
            // location.reload();
            $('.people').prepend(`
                    <li class="person unread" data-chat="person${from_user_id}"
                        data-user-id="${from_user_id}">
                        <img src="${from_user.image_path ? from_user.image_path : '../assets/img/user_avatar.jpg'}" alt=""/>
                        <span class="name text-capitalize">${from_user.firstname + ' ' + from_user.lastname}</span>
                        <span class="time">Now</span>
                        <div class="preview">${message}</div>
                    </li>
            `);

        }
        active_scroll_chat.scrollTop(active_scroll_chat[0].scrollHeight);
    });
