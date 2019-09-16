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
 

// post.like.created
window.Echo.channel(`post-like`)
    .listen('CreatePostLike', (e) => {
        if (e.status) {
            let parent = $(`#post_${e.data.post.id}`);
            let likes = parent.find('b.post_likes').text();
            parent.find('b.post_likes').text(parseInt(likes) + 1).addClass("fadeInDown");
            parent.find('div.like_avatars').prepend(`
                <div class="avatar ss m-0" style="width: 45px;height: 45px;border-radius: 50%">
                    <img src="${e.data.user.image_path ? e.data.user.image_path.replace('https','http') : '../assets/img/user_avatar.jpg'}" class="media-object img-raised" style="width: 40px;height: 40px;border-radius: 50%" alt="">
                </div>
            `);
        }
    });

// post.comment.created
window.Echo.channel(`post-comment`)
    .listen('CreatePostComment', (e) => {
        if (e.status) {
            let parent = $(`#post_${e.data.post.id}`);
            parent.find("div.post-comments-view").append(`
                                <div id="comment_${e.data.comment.id}" class="media-area test new-comment-border">
                                    <div class="media">
                                        <a class="float-left" href="#">
                                            <div class="avatar" style="width: 65px">
                                                <img class="media-object img-raised" style="width: 70%"
                                                     src="${e.data.comment.user.image_path ? e.data.comment.user.image_path.replace('https','http') : '../assets/img/user_avatar.jpg' }"
                                                     alt="...">
                                            </div>
                                        </a>
                                        <div class="media-body">
                                            <h5 class="media-heading text-left mb-0 text-capitalize"> ${e.data.comment.user.firstname + " " + e.data.comment.user.lastname}
                                                <small class="text-muted"></small>
                                            </h5>
                                        <div>
                                        <p class="text-left post-text-comment p-2">${e.data.comment.comment}</p>
                                        <hr>
                                </div>
                            </div>
                        </div>
                    </div>`);
        }
    });

// post.created
window.Echo.channel(`post-created`)
    .listen('CreatePost', (e) => {
        console.log(e);
        if (e.status) {
            window.axios.get(window.location.href + '/getPostTemplateAjax?post_id=' + e.data.post.id)
                .then(function (response) {
                    console.log(response)
                    if (response.data.status) {
                        $("#posts-div").prepend(response.data.data.view);
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });
        }
        // e.data.current_user
        // e.data.notification
        // e.data.user
        // e.data.post
        console.log(e.data)
        // }
    });

