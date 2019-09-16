<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet"/>
<link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
@if (app()->getLocale() == 'ar')
    {{Html::style('assets/css/bootstrap-rtl.min.css')}}
@else
    {{Html::style('assets/css/bootstrap.min.css')}}
@endif

{{Html::style("assets/css/emojionearea.min.css")}}
{{--{{Html::style("assets/css/jquery.mentionsInput.css")}}--}}
{{Html::style('assets/css/now-ui-kit.min.css')}}
{{Html::style('assets/css/animate.css')}}
{{Html::style('assets/css/demo.css')}}
{{Html::style('assets/css/main.css')}}
{{Html::style('assets/css/sweetalert2.min.css')}}
{{Html::style('assets/css/all.min.css')}}



@if (app()->getLocale() == 'ar')
    {{Html::style('assets/css/sidebar-ar.css')}}
    {{Html::style('assets/css/ar.css')}}
@else
    {{Html::style('assets/css/sidebar.css')}}
    {{Html::style('assets/css/en.css')}}
@endif
