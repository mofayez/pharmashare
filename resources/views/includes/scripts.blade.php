{{Html::script('assets/js/core/jquery.min.js')}}
{{Html::script('assets/js/core/popper.min.js')}}
{{Html::script('assets/js/core/bootstrap.min.js')}}
{{Html::script('assets/js/bootstrap-datepicker.js')}}
{{Html::script('assets/js/bootstrap-selectpicker.js')}}
{{Html::script('assets/js/sweetalert2.min.js')}}
{{Html::script('assets/js/bootstrap-switch.js')}}
{{Html::script('assets/js/nouislider.min.js')}}
{{Html::script('assets/js/now-ui-kit.min.js')}}
{{Html::script('assets/js/bootstrap-growl.min.js')}}
{{Html::script("assets/js/bootstrap-typeahead.js")}}
{{Html::script('assets/js/snap.svg-min.js')}}
{{Html::script('assets/js/emotion-ratings.min.js')}}
{{Html::script('assets/js/classie.js')}}
{{Html::script('assets/js/plugin.js')}}
{{--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">--}}
{{--<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>--}}

{{Html::style('assets/css/flatpickr.min.css')}}
{{Html::script('assets/js/flatpickr.min.js')}}
<script>
    window.user = '{{auth()->user()->id ?? ''}}';
    window.user_role = '{{auth()->user()->role_id ?? ''}}';

    function globalAddNotify(message, type) {

        $.growl({
            message: `<b>   ${message}   </b>`
        }, {
            type: type,
            allow_dismiss: !1,
            label: "Cancel",
            className: "btn-xs text-right btn-inverse",
            placement: {
                from: "bottom",
                align: "center"
            },
            delay: 2500,
            animate: {
                enter: "animated bounceInUp",
                exit: "animated fadeOut"
            },
            offset: {
                x: 30,
                y: 30
            }
        });
    }
</script>
<script>

    // $(document).on('switchChange.bootstrapSwitch', '.bootstrap-switch', function (e) {
    //     e.preventDefault();
    //     let link;
    //     @if(app()->getLocale() == 'ar')
    //         link = "{{route('setEn')}}";
    //     @else
    //         link = "{{route('setAr')}}";
    //     @endif
    //         location.href = link;
    // });
</script>
{{Html::script('public/js/general.js')}}