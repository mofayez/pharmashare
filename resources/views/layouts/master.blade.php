<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">

<head>
    {{-- languages meta --}}
    <meta charset="utf-8"/>
    {{-- page title --}}
    <title>{{$pageTitle ?? "SITE"}}</title>
    {{-- browser tab icon --}}
    <link rel="apple-touch-icon" sizes="76x76" href="">
    <link rel="icon" type="image/png" href="">
    {{-- mobile compatiblity --}}
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
          name='viewport'/>
    {{--  canonical link helps webmasters prevent duplicate content issues --}}
    <link rel="canonical" href="{{app('request')->url()}}"/>
    {{-- meta for search engine --}}
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{csrf_token()}}">

    @include('includes.styles')
    @yield('styles')

</head>
@yield('body')

@include("includes.footer")
@include('includes.scripts')
@yield('scripts')

@if(session()->has('message'))
    <script>
        $.growl({
            message: `<p>{{session()->get('message')}}</p>`
        }, {
            type: 'info',
            allow_dismiss: !1,
            label: "Cancel",
            className: "btn-xs text-right btn-inverse",
            placement: {
                from: "bottom",
                align: "right"
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
    </script>
@endif
</html>
