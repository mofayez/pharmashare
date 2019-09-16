<?php $__env->startSection("styles"); ?>
    <link href='https://fonts.googleapis.com/css?family=PT+Sans&subset=latin' rel='stylesheet' type='text/css'>
    <link rel='stylesheet' href='https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css'>
    <?php echo e(Html::style('assets/css/iziToast.min.css')); ?>

    <style>
        @media  only screen and (max-width: 600px) {
            .ads_text {
                font-size: 13px;
            }
        }

        .videoContainer {
            width: 100%;
            height: 400px;
            margin: auto;
            border-radius: 5px;
            position: relative;
            overflow: hidden;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        .videoContainer.fullScreen {
            width: 100vw !important;
            height: 100vh !important;
        }

        .videoContainer.small .intensityBar {
            width: 50px !important;
        }

        .videoContainer.small .playButton {
            margin: 0 !important;
            margin-right: 5px !important;
        }

        .videoContainer .overlay {
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, rgba(3, 169, 244, 0.8), #3F51B5);
            position: absolute;
            top: 0;
            left: 0;
            z-index: 999;
            border-radius: 5px;
        }

        .videoContainer .video {
            width: 100%;
            height: calc(100% - 60px);
            position: relative;
            top: 0;
            left: 0;
            overflow: hidden;
            border-radius: 5px;
            border-bottom-left-radius: 0;
            border-bottom-right-radius: 0;
        }

        .videoContainer .video video {
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            border-radius: 5px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection("body"); ?>

    <body class="profile-page">
    <?php if($user->role_id == 4): ?>
        <?php echo $__env->make("includes.navbar_alt", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php else: ?>
        <?php echo $__env->make("includes.navbar", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php endif; ?>

    <div class="wrapper">
        <?php echo $__env->make("pages.feeds.templates.top_header", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make("pages.feeds.templates.center_content", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>
    <?php echo $__env->make("pages.feeds.templates.likes_modal", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make("pages.feeds.templates.all_users_modal", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make("pages.feeds.templates.images_modal", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    </body>

<?php $__env->stopSection(); ?>

<?php $__env->startSection("scripts"); ?>

    <?php echo e(Html::script('public/js/profile.js')); ?>

    <?php echo e(Html::script('assets/js/mention.js')); ?>

    <?php echo e(Html::script("assets/js/emojionearea.min.js")); ?>

    <?php echo e(Html::script("assets/js/iziToast.min.js")); ?>

    <?php echo e(Html::script('assets/js/infinite-scroll.pkgd.min.js')); ?>

    <?php echo e(Html::script('assets/js/jquery.jscroll.min.js')); ?>


    <script type="text/javascript">
        $('ul.pagination').hide();
        $(function () {
            $('.infinite-scroll').jscroll({
                autoTrigger: true,
                loadingHtml: '<img class="img-responsive" style="margin:0 auto;width:100%" src="<?php echo e(asset('assets/img/fbloader.gif')); ?>" alt="Loading..." />',
                padding: 0,
                nextSelector: '.pagination li.active + li a',
                contentSelector: 'div.infinite-scroll',
                callback: function () {
                    $('ul.pagination').remove();
                }
            });
        });
    </script>

    <script>

        $(document).ready(function () {

            $('#link_input').slideUp();

            // loading posts
            setTimeout(() => {

                $(".post-load").hide();
                $("#posts-div").fadeIn();
            }, 1000);

            // smooth scroll
            $('html,body').animate({
                scrollTop: $('#compose').offset().top - 150
            }, 1000);

            // like button
            $(document).on('click', 'a.like-button', function () {
                if (!$(this).hasClass("liked")) {
                    let btn = $(this);
                    let post_id = btn.attr('data-post-id');
                    let parent = btn.parents().eq(2);
                    let likes = parent.find('b.post_likes').text();
                    $.ajax({
                        type: "post",
                        data: {
                            "_token": "<?php echo e(csrf_token()); ?>",
                            "reaction_id": 1,
                            "likeable_id": post_id,
                            "likeable_type": "post",
                            "user_id": "<?php echo e(auth()->user()->id); ?>",
                        },
                        url: "<?php echo e(route('addPostLike')); ?>",
                        success: function (resp, textStatus, jqXHR) {
                            if (resp.status) {
                                btn.addClass('liked');
                                parent.find('b.post_likes').text(parseInt(likes) + 1).addClass("fadeInDown");
                                parent.find('div.like_avatars').prepend(`
                                        <div class="avatar m-0" style="width: 45px;height: 45px;border-radius:50%">
                                            <img src="<?php echo e($user->image_path ?? asset("assets/img/user_avatar.jpg")); ?>" class="media-object img-raised" style="width: 40px;height: 40px;border-radius:50%" alt="">
                                        </div>
                                    `);
                                let post_sound = new Audio("<?php echo e(asset("assets/sounds/like_ringtone.mp3")); ?>");
                                post_sound.play();
                            }
                        }
                    });
                }
            });
            let add_text_post = $('#add_text_post');
            let add_attachment_file = $('#add_attachment_file');
            let add_attachment_media = $('#add_attachment_media');
            let add_link = $('#add_link');

            // file upload trigger
            add_text_post.on('click', function () {

                // add_link.addClass('disabled').prop('disabled', true);
                // add_attachment_file.addClass('disabled').prop('disabled', true);
                // add_attachment_media.addClass('disabled').prop('disabled', true);
                // add_text_post.removeClass('disabled').prop('disabled', false);
                $('input[name="post_type"]').val('text')
                // $('input[name="post_type"]:nth-child(1)').prop("checked", true);
            });
            add_attachment_file.on('click', function () {
                $('#compose_post_file').trigger("click");

                // add_link.addClass('disabled').prop('disabled', true);
                // add_attachment_file.removeClass('disabled').prop('disabled', false);
                // add_attachment_media.addClass('disabled').prop('disabled', true);
                // add_text_post.addClass('disabled').prop('disabled', true);
                $('input[name="post_type"]').val('file')
                // $('input[name="post_type"]:nth-child(3)').prop("checked", true);
            });

            // media upload trigger
            add_attachment_media.on('click', function () {
                $('#compose_post_media').trigger("click");

                // add_link.addClass('disabled').prop('disabled', true);
                // add_attachment_file.addClass('disabled').prop('disabled', true);
                // add_text_post.addClass('disabled').prop('disabled', true);
                // add_attachment_media.removeClass('disabled').prop('disabled', false);
                $('input[name="post_type"]').val('media')
                // $('input[name="post_type"]:nth-child(2)').prop("checked", true);
            });

            // link trigger
            add_link.on('click', function () {

                $('#link_input').slideToggle().val('');

                // add_link.removeClass('disabled').prop('disabled', false);
                // add_attachment_file.addClass('disabled').prop('disabled', true);
                // add_attachment_media.addClass('disabled').prop('disabled', true);
                // add_text_post.addClass('disabled').prop('disabled', true);
                $('input[name="post_type"]').val('link')
                // $('input[name="post_type"]:nth-child(4)').prop("checked", true);
            });

            //emotions
            $('#add_emotions').on('click', function () {
                $(".emojionearea-button").trigger("click")
            });

            // file upload preview
            $('#compose_post_media').on('change', function () {
                showMyImage(this);
            });

            // submit compose post
            $('#compose_post_form').submit(function (e) {
                e.preventDefault(); 
                let formData = new FormData(this);

                $.ajax({
                    type: "post",
                    processData: false,  // Important!
                    contentType: false,
                    cache: false,
                    data: formData,
                    url: "<?php echo e(route('addNewGroupPosts')); ?>",
                    success: function (resp, textStatus, jqXHR) {
                        if (resp.status == false) {
                            $('#prgs').hide();
                            if (resp.data.errors.post) { 
                                console.log(resp.data.errors.post[0])
                                $("#compose_post_error").text(resp.data.errors.post[0]);

                            } else {
                                $("#compose_post_error").text("");
                            }
                            if (resp.data.errors.link) { 
                                console.log(resp.data.errors.link[0])
                                $("#compose_link_error").text(resp.data.errors.link[0]);

                            } else {
                                $("#compose_link_error").text("");
                            }
                            return false;
                        }
                        if (resp.status) {
                            $('.mentions').empty();
                            $('.emojionearea-editor').empty();
                            $('#compose_post_form')[0].reset();
                            $("#image_preview").html("");
                            $("#compose_post_error").text("");
                            $('#prgs').fadeOut();
                            $("#posts-div").prepend(resp.view);
                            let post_sound = new Audio("<?php echo e(asset("assets/sounds/post_ringtone.mp3")); ?>");
                            post_sound.play();
                        }
                        $("#compose_post_error").text("");
                    },
                    error: function (error) {
                        $('#prgs').hide();
                        $("#compose_post_error").text("");
                        var errors = error.responseJSON;
                        console.log(errors)
                    },
                    xhr: function () {
                        $('#prgs').show();
                        var custom_xhr = $.ajaxSettings.xhr();
                        //
                        if (custom_xhr.upload) {
                            custom_xhr.upload.addEventListener('progress', function (event) {
                                var percentCompleted = Math.round((event.loaded / event.total) * 100);
                                $("#progress").css('width', percentCompleted + '%');
                                $("#percentage").text(percentCompleted + '%');
                            }, false);
                        }

                        return custom_xhr;
                    },
                });

            });

            // submit add comment
            $(document).on('submit', ".add_comment_form", function (e) {
                e.preventDefault();
                let form = $(this)[0];
                let parent = $(this).parents().eq(2);
                let form_data = $(this).serialize();
                $.ajax({
                    method: "post",
                    data: form_data,
                    url: "<?php echo e(route('addPostComment')); ?>",
                    success: function (resp) {
                        if (resp.status) {
                            console.log(resp.data.comment);
                            parent.find("div.post-comments-view").append(`
                                <div id="comment_${resp.data.comment.id}" class="media-area new-comment-border">
                                    <div class="media">
                                        <a class="float-left" href="<?php echo e(url('store/profile')); ?>/@${resp.data.comment.user.username}/${resp.data.comment.user.id}">
                                            <div class="avatar">
                                                <img class="media-object img-raised" style="width: 70%"
                                                     src="${resp.data.comment.user.image_path ? resp.data.comment.user.image_path : "<?php echo e(asset('assets/img/user_avatar.jpg')); ?>"}"
                                                     alt="...">
                                            </div>
                                        </a>
                                        <div class="media-body">
                                            <h5 class="media-heading text-left mb-0 text-capitalize"> 
                                                <a href="<?php echo e(url('store/profile')); ?>/@${resp.data.comment.user.username}/${resp.data.comment.user.id}">
                                                    ${resp.data.comment.user.firstname + " " + resp.data.comment.user.lastname}
                                                </a>
                                                <small class="text-muted"><?php echo e(__('profile.afew_seconds')); ?></small>
                                            </h5>
                                        <div>
                                        <p class="text-left post-text-comment p-2">${resp.data.comment.comment}</p>
                                        <hr>
                                </div>
                            </div>
                        </div>
                    </div>`);
                            form.reset();
                        }
                    },
                    error: function (error) {

                    }
                });

            });

            // comment mention
            $('input[name="comment"]').mention({
                users: JSON.parse('<?php echo $all_users; ?>')
            });

        });

        //helpers
        function showMyImage(fileInput) {
            $("#image_preview").html("");
            var files = fileInput.files;
            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                var imageType = /image.*/;
                if (!file.type.match(imageType)) {
                    continue;
                }
                var reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = function (e) {
                    $("#image_preview").append(`
                            <div class="card-avatar p-1">
                                <img class="img img-raised" width="100" height="100"
                                     src="${this.result}">
                            </div>
                            `);
                }
            }
        }

        //open likes modal
        function likesModal(post_id) {
            $.ajax({
                url: "<?php echo e(route('getPostReactions')); ?>",
                method: "get",
                data: {
                    "_token": "<?php echo e(csrf_token()); ?>",
                    "post_id": post_id,
                },
                success: function (response) {
                    if (response.status) {
                        $('#modal_likes_content').empty();
                        $.each(response.data.post.likes, function (index, item) {
                            console.log(item.user)
                            $('#modal_likes_content').prepend(`
                            <div class="media">
                            <a href="<?php echo e(url('store/profile')); ?>/@${item.user.username}/${item.user.id}" class="media-body" style="display: flex;border-bottom: 1px solid #7b7b7b;padding-bottom: 2px;margin-bottom: 5px;">
                                <img style="width: 40px;height:45px;flex:1;border-radius: 50%;" class="media-object avatar img-raised" alt="64x64" src="${item.user.image_path ? item.user.image_path : "<?php echo e(asset('assets/img/user_avatar.jpg')); ?>"}">
                                <h6 class="text-capitalize media-heading text-left p-1 ${index % 2 == 1 ? "text-white" : "text-white"}" style="flex:4">
                                    ${item.user.firstname + " " + item.user.lastname}
                                    <br>
                                    <small style="font-size:10px">@${item.user.username}</small>
                                </h6>
                            </a>
                        </div>
                        `)
                        })
                    }
                }
            });
            // $('#likes-modal-sm').modal("show");
        }

        // postImagesPreview
        function postImagesPreview(post_id) {
            $.ajax({
                method: "get",
                url: "<?php echo e(route("getPostJsonAjax")); ?>",
                data: {
                    "_token": "<?php echo e(csrf_token()); ?>",
                    "post_id": post_id,
                },
                success: function (response) {
                    console.log(response);
                    if (response.status) {
                        let post = response.data.post;
                        let files = post.files;
                        let user_avatar = "<?php echo e(asset('assets/img/user_avatar.jpg')); ?>";
                        let comments = post.comments;
                        $("#SlidePost").empty();
                        $("#CommetsPost").empty();
                        $.each(files, function (index, file) {
                            $("#SlidePost").append(`
                                <img class="${index == 0 ? "active" : ""} slideimg" src="${file.name}" style="max-height: 580px;min-height: 470px">
                                `);
                        });
                        $.each(comments, function (index, comment) {
                            $("#CommetsPost").append(`
                                <div class="media">
                                        <a class="float-left" href="#">
                                            <div class="avatar">
                                                <img class="media-object img-raised" style="width: 70%" src="${comment.user.image_path ? comment.user.image_path : user_avatar}" alt="...">
                                            </div>
                                        </a>
                                        <div class="media-body">
                                            <h6 class="media-heading text-left mb-0 text-capitalize"> ${comment.user.firstname + ' ' + comment.user.lastname}
                                                <small class="text-muted"> ${comment.commented_at}</small>
                                            </h6>
                                            <div>
                                                <p class="text-left post-text-comment p-2"> ${comment.comment} </p>
                                                <hr>
                                            </div>
                                        </div>
                                    </div>
                                `);
                        });

                    }
                },
                error: function (errors) {

                },
            });
            $("#comment-images-modal-lg").modal('show');
        }

        // emotions
        $(function () {

            $('textarea[name="post"]').emojioneArea({
                pickerPosition: "bottom",
                filtersPosition: "bottom",
                tonesStyle: "bullet",
                hidePickerOnBlur: true,
                search: false
            });

        });

        // delete post
        function deletePost(id) {
            swal({
                text: '<?php echo e(__('profile.are_you_sure')); ?>',
                title: "<?php echo e(__('profile.warning')); ?> ",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                showLoaderOnConfirm: true,
                confirmButtonText: "<?php echo e(__('profile.yes')); ?>",
                cancelButtonText: "<?php echo e(__('profile.no')); ?>"
            }).then((result) => {
                if (result) {
                    $.ajax({
                        method: 'post',
                        url: '<?php echo e(route('deletePost')); ?>',
                        data: {
                            _token: '<?php echo e(csrf_token()); ?>',
                            post_id: id,
                        },
                        success: function (resposne) {
                            if (resposne.status) {
                                location.reload();
                            }
                        }
                    })
                }
            });

        }

        // delete comment
        function deleteComment(id) {
            swal({
                text: '<?php echo e(__('profile.are_you_sure')); ?>',
                title: "<?php echo e(__('profile.warning')); ?> ",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                showLoaderOnConfirm: true,
                confirmButtonText: "<?php echo e(__('profile.yes')); ?>",
                cancelButtonText: "<?php echo e(__('profile.no')); ?>"
            }).then((result) => {
                if (result) {
                    $.ajax({
                        method: 'post',
                        url: '<?php echo e(route('deleteComment')); ?>',
                        data: {
                            _token: '<?php echo e(csrf_token()); ?>',
                            comment_id: id,
                        },
                        success: function (resposne) {
                            if (resposne.status) {
                                location.reload();
                            }
                        }
                    })
                }
            });

        }


    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.master", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>