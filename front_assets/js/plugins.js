jQuery(document).ready(function () {
    jQuery('.scroll').on('click', function () {

        jQuery('html, body').animate({
            scrollTop: jQuery('#freatures').offset().top - 100
        }, 1000);
    });

    jQuery('#toTop').on('click', function () {

        jQuery('html, body').animate({
            scrollTop: 0
        }, 1000);
    });

    // $(function () {
    //     if ($(window).width() > 767) {
    //         skrollr.init({
    //             forceHeight: false
    //         });
    //     }
    //
    //     $(window).on('resize', function () {
    //         if ($(window).width() <= 767) {
    //             skrollr.init().destroy();
    //         }
    //     });
    // });

    $(function () {
        var section = $(document).on('mouseenter mouseleave', '.sections:not(.open) .skew', function () {
            section.toggleClass('active');
        }).on('click', '.skew:not(.open)', function (e) {
            section.removeClass('open')
                .add(this)
                .addClass('open')
                .siblings()
                .removeClass('open');
        }).on('click', '.skew.open', function (e) {
            section.add(this).removeClass('open');
        })
            .find('.sections');
    });


    $(".hover").mouseleave(
        function () {
            $(this).removeClass("hover");
        }
    );
});
