require('./bootstrap');

import Echo from "laravel-echo"

let current_id = window.user;
let current_role = window.user_role;

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

console.log(current_role)

// current online users
// window.Echo.join('online-users')
//     .here((users) => {
//         console.log('sada')
//         $.each(users, function (index, user) {
//             $("#current_online_users").prepend(`<div class="media">
//             <div id="online_user_${user.id}" class="media-body"
//                  style="display: flex;border-bottom: 1px solid #eee;padding-bottom: 5px;margin-bottom: 5px;">
//                 <div>
//                     <div class="alert-status position-absolute" style="width: 10px;border-radius: 50%;height: 10px;background:#18ce0f"></div>
//                     <img style="width: 40px;height:40px;flex:1;border-radius: 50%;margin: 0;"
//                          class="media-object avatar img-raised" alt="64x64"
//                          src="${user.image_path ? user.image_path.replace('https', 'http') : "../assets/img/user_avatar.jpg" }">
//                 </div>
//                 <h6 class="text-capitalize media-heading text-left p-1 text-dark" style="flex:4">
//                     ${user.firstname + " " + user.lastname}
//                     <br>
//                     <small style="font-size:10px">@${user.username} </small>
//                 </h6>
//             </div>
//         </div>`);
//         });
//
//     })
//     .joining((user) => {
//         setTimeout(() => {
//             $("#current_online_users").prepend(`<div class="media">
//             <div id="online_user_${user.id}" class="media-body"
//                  style="display: flex;border-bottom: 1px solid #eee;padding-bottom: 5px;margin-bottom: 5px;">
//                 <div>
//                     <div class="alert-status position-absolute" style="width: 10px;border-radius: 50%;height: 10px;background:#18ce0f"></div>
//                     <img style="width: 40px;height:40px;flex:1;border-radius: 50%;margin: 0;"
//                          class="media-object avatar img-raised" alt="64x64"
//                          src="${user.image_path ? user.image_path.replace('https', 'http') : "../assets/img/user_avatar.jpg" }">
//                 </div>
//                 <h6 class="text-capitalize media-heading text-left p-1 text-dark" style="flex:4">
//                     ${user.firstname + " " + user.lastname}
//                     <br>
//                     <small style="font-size:10px">@${user.username} </small>
//                 </h6>
//             </div>
//         </div>`);
//         }, 500);
//         $(`#online_user_${user.id}`).find("div.alert-status").css("background", "#18ce0f");
//     })
//     .leaving((user) => {
//         $(`#online_user_${user.id}`).find("div.alert-status").css("background", "#9e9e9e");
//         setTimeout(() => {
//             $(`#online_user_${user.id}`).remove();
//         }, 500)
//     });

// post.like.created
window.Echo.channel(`post-like`)
    .listen('CreatePostLike', (e) => {
        console.log(e);
        if (e.status) {
            if (e.data.user.id == current_id) {
                return false;
            }
            if (e.data.post.user_id != current_id) {
                return false;
            }
            iziToast.show({
                theme: 'light',
                icon: 'fas fa-heart',
                title: `${e.data.notification}`,
                message: `${e.data.message}`,
                position: 'bottomRight',
                transitionIn: 'flipInX',
                transitionOut: 'flipOutX',
                progressBarColor: '#a772da',
                image: `${e.data.user.image_path ? e.data.user.image_path.replace('https', 'http') : '../assets/img/user_avatar.jpg'}`,
                imageWidth: 70,
                layout: 2,
                onClosing: function () {
                    console.info('onClosing');
                },
                onClosed: function (instance, toast, closedBy) {
                    console.info('Closed | closedBy: ' + closedBy);
                },
                iconColor: '#e91e63'
            });

            let post_sound = new Audio("../assets/sounds/notification.mp3");
            post_sound.play();
        }
    });

// post.comment.created
window.Echo.channel(`post-comment`)
    .listen('CreatePostComment', (e) => {
        console.log(e);
        if (e.status) {
            if (e.data.comment.user.id == current_id) {
                return false;
            }
            if (e.data.post.user_id != current_id) {
                return false;
            }
            iziToast.show({
                theme: 'light',
                icon: 'fas fa-comment',
                title: `${e.data.notification}`,
                message: `${e.data.message}`,
                position: 'bottomRight',
                transitionIn: 'flipInX',
                transitionOut: 'flipOutX',
                progressBarColor: '#a772da',
                image: `${e.data.user.image_path ? e.data.user.image_path.replace('https', 'http') : '../assets/img/user_avatar.jpg'}`,
                imageWidth: 70,
                layout: 2,
                onClosing: function () {
                    console.info('onClosing');
                },
                onClosed: function (instance, toast, closedBy) {
                    console.info('Closed | closedBy: ' + closedBy);
                },
                iconColor: '#e91e63'
            });
            let post_sound = new Audio("../assets/sounds/notification.mp3");
            post_sound.play();
        }
        // e.data.current_user
        // e.data.notification
        // e.data.user
        // e.data.post
        console.log(e.data)
        // }
    });

// post.created
window.Echo.channel(`post-created`)
    .listen('CreatePost', (e) => {
        console.log(e);
        if (e.status) {
            if (e.data.user.id == current_id) {
                return false;
            }
            iziToast.show({
                theme: 'light',
                icon: 'fas fa-heart',
                title: `${e.data.notification}`,
                message: `${e.data.message}`,
                position: 'bottomRight',
                transitionIn: 'flipInX',
                transitionOut: 'flipOutX',
                progressBarColor: '#a772da',
                image: `${e.data.user.image_path ? e.data.user.image_path.replace('https', 'http') : '../assets/img/user_avatar.jpg'}`,
                imageWidth: 70,
                layout: 2,
                onClosing: function () {
                    console.info('onClosing');
                },
                onClosed: function (instance, toast, closedBy) {
                    console.info('Closed | closedBy: ' + closedBy);
                },
                iconColor: '#e91e63'
            });
            let post_sound = new Audio("../assets/sounds/notification.mp3");
            post_sound.play();
        }
        // e.data.current_user
        // e.data.notification
        // e.data.user
        // e.data.post
        console.log(e.data)
        // }
    });

// chat messages
window.Echo.channel(`privateChannel.` + current_id)
    .listen('MessageEvent', (response) => {
        console.log(response)
        let from_user_id = response.message.from_user_id;
        let to_user_id = response.message.to_user_id;
        let message = response.message.message;
        let to_user = response.to_user;
        let from_user = response.from_user;
        let message_link = $(`#message_link_${from_user_id}`); 
        $('#no_message').hide();
        
        if(message_link.length != 0){
            message_link.find('span.msg').text(message)
        } else{
            console.log('not found link')
            let chat_count = $('div.message_counter');
            chat_count.text();
            let count = parseInt(chat_count.text()) + 1;
            chat_count.text(count)
            
            $('#message_unread').append(` <a class="dropdown-item p-1" id="message_link_${from_user_id}" href="http://pharmashare.ae/store/messages?chat_id=${from_user_id}">
                            <div class="media-body direction">
                                    <div class="media">
                                        <div class="media-body"
                                             style="display: flex;border-bottom: 1px solid #eee;padding-bottom: 5px;margin-bottom: 5px;"> 
                                                <img style="width: 35px;height:42px;flex:1;border-radius: 50%;margin: 0;"
                                                     class="media-object avatar img-raised" alt="64x64"
                                                     src="${from_user.image_path ? from_user.image_path.replace('https', 'http') : '../assets/img/user_avatar.jpg'}"> 
                                            <h6 class="text-capitalize media-heading text-left p-1 text-dark"
                                                style="flex:4">
                                                ${from_user.firstname + ' ' + from_user.lastname}
                                                <br>
                                                <span class="msg" style="font-size:10px;font-weight: 100;">
                                                    ${message}
                                                </span>
                                            </h6>
                                        </div>
                                    </div>
                            </div>
                        </a>`);
        }
        
        iziToast.show({
            theme: 'light',
            icon: 'fas fa-comment',
            title: `New Message`,
            message: `${message}`,
            position: 'bottomRight',
            transitionIn: 'flipInX',
            transitionOut: 'flipOutX',
            progressBarColor: '#a772da',
            image: `${from_user.image_path ? from_user.image_path.replace('https', 'http') : '../assets/img/user_avatar.jpg'}`,
            imageWidth: 70,
            layout: 2,
            onClosing: function () {
                // console.info('onClosing');
            },
            onClosed: function (instance, toast, closedBy) {
                // console.info('Closed | closedBy: ' + closedBy);
            },
            iconColor: '#2196f3'
        });
        let post_sound = new Audio("../assets/sounds/facebook_chat.mp3");
        post_sound.play();
    });

// order. OrderResponseNotification
window.Echo.channel(`privateOrderResponseChannel.` + current_id)
    .listen('OrderResponseNotification', (e) => {
        console.log(e);

        iziToast.show({
            theme: 'light',
            icon: 'fas fa-bell',
            title: `${e.title}`,
            message: `${e.description}`,
            position: 'bottomRight',
            transitionIn: 'flipInX',
            transitionOut: 'flipOutX',
            progressBarColor: '#a772da',
            imageWidth: 70,
            layout: 1,
            onClosing: function () {
                // console.info('onClosing');
            },
            onClosed: function (instance, toast, closedBy) {
                // console.info('Closed | closedBy: ' + closedBy);
            },
            iconColor: '#f3555c'
        });
        let order_sound = new Audio("../assets/sounds/facebook_chat.mp3");
        order_sound.play();
    });


// drug. UnApprovedDrugInsertionEvent
window.Echo.channel(`UnApprovedDrugInsertion.` + current_role)
    .listen('UnApprovedDrugInsertionEvent', (e) => {
        console.log(e);

        iziToast.show({
            theme: 'light',
            icon: 'fas fa-bell',
            title: `${e.title}`,
            message: `${e.description}`,
            position: 'bottomRight',
            transitionIn: 'flipInX',
            transitionOut: 'flipOutX',
            progressBarColor: '#a772da',
            imageWidth: 70,
            layout: 1,
            onClosing: function () {
                // console.info('onClosing');
            },
            onClosed: function (instance, toast, closedBy) {
                // console.info('Closed | closedBy: ' + closedBy);
            },
            iconColor: '#f3555c'
        });
        let order_sound = new Audio("../assets/sounds/facebook_chat.mp3");
        order_sound.play();
    });


// drug. RejectDrugEvent
window.Echo.channel(`RejectDrug.` + current_id)
    .listen('RejectDrugEvent', (e) => {
        console.log(e);

        iziToast.show({
            theme: 'light',
            icon: 'fas fa-bell',
            title: `${e.title}`,
            message: `${e.description}`,
            position: 'bottomRight',
            transitionIn: 'flipInX',
            transitionOut: 'flipOutX',
            progressBarColor: '#a772da',
            imageWidth: 70,
            layout: 1,
            onClosing: function () {
                // console.info('onClosing');
            },
            onClosed: function (instance, toast, closedBy) {
                // console.info('Closed | closedBy: ' + closedBy);
            },
            iconColor: '#f3555c'
        });
        let order_sound = new Audio("../assets/sounds/facebook_chat.mp3");
        order_sound.play();
    });

// drug. ApprovedDrugEvent
window.Echo.channel(`ApproveDrug.` + current_id)
    .listen('ApprovedDrugEvent', (e) => {
        console.log(e);

        iziToast.show({
            theme: 'light',
            icon: 'fas fa-bell',
            title: `${e.title}`,
            message: `${e.description}`,
            position: 'bottomRight',
            transitionIn: 'flipInX',
            transitionOut: 'flipOutX',
            progressBarColor: '#a772da',
            imageWidth: 70,
            layout: 1,
            onClosing: function () {
                // console.info('onClosing');
            },
            onClosed: function (instance, toast, closedBy) {
                // console.info('Closed | closedBy: ' + closedBy);
            },
            iconColor: '#f3555c'
        });
        let order_sound = new Audio("../assets/sounds/facebook_chat.mp3");
        order_sound.play();
    });


// user. CreateUser
window.Echo.channel(`user-created.` + current_role)
    .listen('CreateUser', (e) => {
        console.log(e);

        iziToast.show({
            theme: 'light',
            icon: 'fas fa-user',
            title: `مستخدم جديد`,
            message: `${e.data.user.username}`,
            position: 'bottomRight',
            transitionIn: 'flipInX',
            transitionOut: 'flipOutX',
            progressBarColor: '#a772da',
            imageWidth: 70,
            layout: 1,
            onClosing: function () {
                // console.info('onClosing');
            },
            onClosed: function (instance, toast, closedBy) {
                // console.info('Closed | closedBy: ' + closedBy);
            },
            iconColor: '#3c97f3'
        });
        let order_sound = new Audio("../assets/sounds/facebook_chat.mp3");
        order_sound.play();
    });

// user. ActivateUser
window.Echo.channel(`user-activated.` + current_id)
    .listen('ActivateUser', (e) => {
        console.log(e);

        iziToast.show({
            theme: 'light',
            icon: 'fas fa-user',
            title: `تنشيط المستخدم`,
            message: `${e.data.username}`,
            position: 'bottomRight',
            transitionIn: 'flipInX',
            transitionOut: 'flipOutX',
            progressBarColor: '#a772da',
            imageWidth: 70,
            layout: 1,
            onClosing: function () {
                // console.info('onClosing');
            },
            onClosed: function (instance, toast, closedBy) {
                // console.info('Closed | closedBy: ' + closedBy);
            },
            iconColor: '#23f386'
        });
        let order_sound = new Audio("../assets/sounds/facebook_chat.mp3");
        order_sound.play();
    });
    
//  NewOrder

window.Echo.channel(`order-created.` + current_id)
    .listen('NewOrder', (e) => {
        console.log(e);

        iziToast.show({
            theme: 'light',
            icon: 'fas fa-gift',
            title: `طلب جديد  `,
            message: `${e.data.description}`,
            position: 'bottomRight',
            transitionIn: 'flipInX',
            transitionOut: 'flipOutX',
            progressBarColor: '#a772da',
            imageWidth: 70,
            layout: 1,
            onClosing: function () {
                // console.info('onClosing');
            },
            onClosed: function (instance, toast, closedBy) {
                // console.info('Closed | closedBy: ' + closedBy);
            },
            iconColor: '#23f386'
        });
        let order_sound = new Audio("../assets/sounds/facebook_chat.mp3");
        order_sound.play();
    });

