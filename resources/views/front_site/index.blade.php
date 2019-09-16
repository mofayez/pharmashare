<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns#">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title> Pharmacy </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
    <link rel='stylesheet' href='front_assets/js/revslider/css/typewriter-1.0.0.css' type='text/css' media='all'/>

    <link rel='stylesheet' href='front_assets/css/style.css' type='text/css' media='all'/>
    <link rel='stylesheet' href='front_assets/css/bootstrap.min.css' type='text/css' media='all'/>
    @if(app()->getLocale() == 'ar')
        <link rel='stylesheet' href='front_assets/css/bootstrap-rtl.min.css' type='text/css' media='all'/>
    @endif
    <link rel='stylesheet' href='front_assets/css/now-ui-kit.min.css' type='text/css' media='all'/>
    <link rel='stylesheet' href='front_assets/css/main.css' type='text/css' media='all'/>
    <link rel='stylesheet' href='front_assets/css/swiper.min.css' type='text/css' media='all'/>
    <link rel='stylesheet' href='front_assets/css/custom.css' type='text/css' media='all'/>
    @if(app()->getLocale() == 'ar')
        <link rel='stylesheet' href='front_assets/css/ar.css' type='text/css' media='all'/>
    @else
        <link rel='stylesheet' href='front_assets/css/en.css' type='text/css' media='all'/>
    @endif
    <style>
        .modal-backdrop {
            z-index: 0;
        }
    </style>
    <script type='text/javascript' src='front_assets/js/jquery-3.2.1.min.js'></script>
    <script type='text/javascript' src='front_assets/js/jquery-1.12.4.js'></script>
    <script type='text/javascript' src='front_assets/js/jquery-migrate.min-1.4.1.js'></script>
</head>

<body>

<div class="loading-overlay">
    <div class="loading-overlay-icon"></div>
</div>

@include('front_site.templates.navbar')

<!--<div id="toTop" class="to_top" data-800="background:rgb(0, 0, 0)" data-1200="background:rgb(103, 58, 183)">-->
<!--    <i class="zmdi zmdi-long-arrow-up" data-800="color:rgb(255, 255, 255)" data-1200="color:rgb(255,255,255)"></i>-->
<!--</div>-->

<article id="bodywrapper">

    <!--! Content -->
    <article class="nosidebar  post-10451 page type-page status-publish hentry category-wordpress">

        <!-- Content -->
        <section id="content_inner_wrapper" class="dark" style="margin:auto;width:100%;background-color:#ffffff">
            <section id="content-container">
                <!--data-800="background:rgb(255, 255, 255)" data-1200="background:rgb(0, 0, 0)"-->
                <!--data-2200="background:rgb(255, 255, 255)">-->

                <!-- start slider-->
                <section style="zoom: 100%" class="tp_vc_mw_rowwrapper">
                    <article style="padding-top: 0px ; padding-bottom: 0px;"
                             class="tp_vc_mw_rowinner  darkonlight bottomzero">
                        <div class="content_max_width">
                            <div data-vc-full-width="true" data-vc-full-width-init="false"
                                 data-vc-stretch-content="true"
                                 class="vc_row wpb_row vc_row-fluid bottomzero vc_row-no-padding">
                                <div class="wpb_column vc_column_container vc_col-sm-12">
                                    <div class="vc_column-inner ">
                                        <div class="wpb_wrapper">
                                            <div class="wpb_revslider_element wpb_content_element bottomzero">
                                                <div class="contianers">
                                                    <div class="row direction">
                                                        <div class="col-md-1"></div>
                                                        <div class="col-md-3 pt-2" style="margin-top: 7rem">
                                                            <h2 class="text-left text_purple_gradient p-1">
                                                                {{$slider->last()->translated->title ?? ' '}}
                                                            </h2>
                                                            <hr class="hr">
                                                            <p class="text-left p-1" style="font-size: 15px">
                                                                {{$slider->last()->translated->description ?? ' '}}
                                                            </p>
                                                            <div class="text-center mb-5">
                                                                <a href="{{route('getLoginView')}}"
                                                                   class="btn btn-main btn-round">
                                                                    <i class="now-ui-icons users_single-02"></i>
                                                                    {{__('front.login_pharmacy')}}

                                                                </a>
                                                                <a href="{{route('getLoginView')}}"
                                                                   class="btn btn-main btn-round">
                                                                    <i class="now-ui-icons users_circle-08"></i>
                                                                    {{__('front.login_store')}}
                                                                </a>
                                                                <a href="{{route('getLoginView')}}"
                                                                   class="btn btn-main btn-round">
                                                                    <i class="now-ui-icons users_circle-08"></i>
                                                                    {{__('front.login_pharmacist')}}
                                                                </a>  
                                                            </div>
                                                        </div>
                                                        <div class="col-md-8 d-none d-md-block">
                                                            <div class="square-box">
                                                                <div class="square-content">
                                                                    <div class="image-over"></div>
                                                                    <img src="{{asset('storage/files/slider').'/'}}{{$slider->last()->image->name ?? '-'}}"
                                                                         alt="">
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="vc_row-full-width vc_clearfix"></div>
                            <div style="clear:both"></div>
                        </div>
                    </article>
                </section>
                <!--end slider-->

                <div class="container-fluid" style="padding: 0">

                    <!--start features -->
                    <section id="freatures" class="tp_vc_mw_rowwrapper pb-5">
                        <!--<div id="particles-js" style="position:absolute"></div>-->
                        <article style="padding-top: 70px;" class="tp_vc_mw_rowinner  darkonlight ">
                            <div class="rowbgimage_overlay" style="background-color:#f6f7f9;"></div>
                            <div class="content_max_width">
                                <div class="vc_row wpb_row vc_row-fluid">
                                    <div class="wpb_column vc_column_container vc_col-sm-12">
                                        <div class="vc_column-inner ">
                                            <div class="wpb_wrapper">
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col-md-12 text-sm-center">
                                                            <h2 class="text-capitalize text_purple_gradient header-text">
                                                                @if(app()->getLocale() == 'ar')
                                                                    {{$translation->where('title','services')->first()->text_ar}}
                                                                @else
                                                                    {{$translation->where('title','services')->first()->text_en}}
                                                                @endif
                                                            </h2>
                                                            <p class="text-black-50">
                                                                @if(app()->getLocale() == 'ar')
                                                                    {{$translation->where('title','services_p')->first()->text_ar}}
                                                                @else
                                                                    {{$translation->where('title','services_p')->first()->text_en}}
                                                                @endif
                                                            </p>
                                                        </div>
                                                        <div class="col-md-12 mt-5"></div>
                                                        @foreach($services as $service)
                                                            <div class="col-md-4">
                                                                <div class="card">
                                                                    <div class="feature card-blog card-plain card-body p-0 pt-5 pb-5 text-center">
                                                                        <img src="{{asset('front_assets/images/'.$service->image)}}"
                                                                             alt="">
                                                                        <h4>{{$service->translated->title}}</h4>
                                                                        <p class="text-black-50">
                                                                            {{$service->translated->description}}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div style="clear:both"></div>
                            </div>
                        </article>
                    </section>
                    <!--end features -->

                    <!--start pharmacy2 size-->
                    <section class="tp_vc_mw_rowwrapper p-0" style="background: #EEE">
                        <!--<div id="particles-js" style="position:absolute"></div>-->
                        <article class="tp_vc_mw_rowinner  darkonlight">
                            <div class="rowbgimage_overlay" style="background-color:transparent;"></div>
                            <div class="content_max_width">
                                <div class="vc_row wpb_row vc_row-fluid">
                                    <div class="wpb_column vc_column_container vc_col-sm-12">
                                        <div class="vc_column-inner ">
                                            <div class="wpb_wrapper">
                                                <div class="container-fluids">
                                                    <div id="particles-js"
                                                         style="position: absolute;height: 100%;width: 100%"></div>
                                                    <div class="row">
                                                        <div class="col-md-6 pt-5 mt-5">
                                                            <div class="container">
                                                                <div id="counter" class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="card">
                                                                            <div class="card-body card-plain">
                                                                                <div class="row">
                                                                                    <div class="col-4">
                                                                                        <div class="header-icon"
                                                                                             style="background-position: -10px 0"></div>
                                                                                    </div>
                                                                                    <div class="col-8">
                                                                                        <h3 class="m-0"
                                                                                            style="color:#6037bd;">{{__('front.stock_size')}}</h3>
                                                                                        <h3 class="mb-0">
                                                                                            {{--<span id="drugs_store">{{$statistics['drugs_store']}}</span>--}}
                                                                                            <span class="counter-value"
                                                                                                  data-count="{{$statistics['drugs_store']}}">0</span>
                                                                                            <small style="color:mediumpurple;">
                                                                                                {{__('front.stock_size_p')}}
                                                                                            </small>
                                                                                        </h3>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="card">
                                                                            <div class="card-body card-plain">
                                                                                <div class="row">
                                                                                    <div class="col-4">
                                                                                        <div class="header-icon"
                                                                                             style="background-position:0 -90px"></div>
                                                                                    </div>
                                                                                    <div class="col-8">
                                                                                        <h3 class="m-0"
                                                                                            style="color:#6037bd;">
                                                                                            {{__('front.account_size')}}</h3>
                                                                                        <h3 class="m-0">
                                                                                            {{--<span id="pharmacy_store">{{$statistics['pharmacy'] + $statistics['store']}}</span>--}}
                                                                                            <span class="counter-value"
                                                                                                  data-count="{{$statistics['pharmacy'] + $statistics['store']}}">0</span>
                                                                                            <small style="color:mediumpurple;">
                                                                                                {{__('front.account_size_p')}}
                                                                                            </small>
                                                                                        </h3>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="card">
                                                                            <div class="card-body card-plain">
                                                                                <div class="row">
                                                                                    <div class="col-4">
                                                                                        <div class="header-icon"
                                                                                             style="background-position: -100px -85px"></div>
                                                                                    </div>
                                                                                    <div class="col-8">
                                                                                        <h3 class="m-0"
                                                                                            style="color:#6037bd;">
                                                                                            {{__('front.drugs_size')}}</h3>
                                                                                        <h3 class="mb-0">
                                                                                            <span class="counter-value"
                                                                                                  data-count="{{$statistics['drugs'] ?? 0}}">0</span>
                                                                                            <small style="color:mediumpurple;">
                                                                                                {{__('front.drugs_size_p')}}
                                                                                            </small>
                                                                                        </h3>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="card">
                                                                            <div class="card-body card-plain">
                                                                                <div class="row">
                                                                                    <div class="col-4">
                                                                                        <div class="header-icon"
                                                                                             style="background-position: -90px 0"></div>
                                                                                    </div>
                                                                                    <div class="col-8">
                                                                                        <h3 class="m-0"
                                                                                            style="color:#6037bd;">{{__('front.jobs_size')}}</h3>
                                                                                        <h3 class="mb-0">
                                                                                            <span class="counter-value"
                                                                                                  data-count="{{count($jobs)}}">0</span>
                                                                                            <small style="color:mediumpurple;">
                                                                                                {{__('front.jobs_size_p')}}
                                                                                            </small>
                                                                                        </h3>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 d-none d-md-block d-sm-none">
                                                            <div class="rightside" filter-color="#6037bd"></div>
                                                            <div class="page-header header-filter register-part-one"
                                                                 filter-color="purple"
                                                                 style="clip-path: polygon(24% 0%, 100% 0%, 100% 100%, 24% 99%, 0% 37%);">
                                                                <div class="content">
                                                                    <div class="container">
                                                                        <div class="col-md-12">
                                                                            <h2 class="title text-center">

                                                                                @if(app()->getLocale() == 'ar')
                                                                                    {{$translation->where('title','store_size')->first()->text_ar}}
                                                                                @else
                                                                                    {{$translation->where('title','store_size')->first()->text_en}}
                                                                                @endif
                                                                            </h2>
                                                                            <div class="mdl-card mdl-shadow--2dp">
                                                                                <p class="text-left pl-4">

                                                                                    @if(app()->getLocale() == 'ar')
                                                                                        {{$translation->where('title','store_size_p')->first()->text_ar}}
                                                                                    @else
                                                                                        {{$translation->where('title','store_size_p')->first()->text_en}}
                                                                                    @endif
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div style="clear:both"></div>
                            </div>
                        </article>
                    </section>
                    <!--end pharmacy2 size-->

                    <!--start pricing -->
                    <section class="tp_vc_mw_rowwrapper" style="padding: 0">
                        <!--<div id="particles-js" style="position:absolute"></div>-->
                        <article style="padding-top: 70px;" class="tp_vc_mw_rowinner  darkonlight">
                            <div class="rowbgimage_overlay" style="background-color:#FFF;"></div>
                            <div class="content_max_width">
                                <div class="vc_row wpb_row vc_row-fluid mb-0">
                                    <div class="wpb_column vc_column_container vc_col-sm-12">
                                        <div class="vc_column-inner ">
                                            <div class="wpb_wrapper">
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col-md-12 text-center">
                                                            <h2 class="text-capitalize text_purple_gradient header-text">

                                                                <!--@if(app()->getLocale() == 'ar')-->
                                                                <!--    {{$translation->where('title','pricing')->first()->text_ar}}-->
                                                                <!--@else-->
                                                                <!--    {{$translation->where('title','pricing')->first()->text_en}}-->
                                                                <!--@endif-->
                                                                
                                                                  @if(app()->getLocale() == 'ar')
                                                                    {{$translation->where('title','whyus')->first()->text_ar}}
                                                                @else
                                                                    {{$translation->where('title','whyus')->first()->text_en}}
                                                                @endif
                                                            </h2>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="container-fluid">
                                                    <div class="row"> 
                                                        <div class="col-md-12 p-0">
                                                            <div class="background">
                                                                <div class="containers">
                                                                    <div class="panel pricing-table">
                                                                        <!--@foreach($pricing as $price)-->
                                                                        <!--    <div class="pricing-plan">-->
                                                                        <!--        <img src="{{asset('front_assets/images/').'/'.$price->image}}"-->
                                                                        <!--             alt="" class="pricing-img">-->
                                                                        <!--        @if(app()->getLocale() == 'ar')-->
                                                                        <!--            <h2 class="pricing-header">{{$price->title_ar}}</h2>-->
                                                                        <!--        @else-->
                                                                        <!--            <h2 class="pricing-header">{{$price->title_en}}</h2>-->
                                                                        <!--        @endif-->
                                                                        <!--        <span class="pricing-price" style="direction:{{app()->getLocale() == 'ar' ? 'rtl' : 'ltr'}}">{{   $price->price  }}-->
                                                                        <!--            <small style="font-size:12px"> {{ __('front.dirham') }}</small>-->
                                                                        <!--        </span>-->
                                                                        <!--        {{--<a href="#/" class="pricing-button">Sign--}}-->
                                                                        <!--        {{--up</a>--}}-->
                                                                        <!--    </div>-->
                                                                        <!--@endforeach-->
                                                                        
                                                                        
<!--                                                                        <div class="pricing-plan col-md-6 p-0"> -->
                                                                       
<!--<iframe width="400" height="250" src="https://www.youtube.com/embed/1TeEgLzjdko" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>-->

                                                                            
                                                                               
                                                                            
<!--                                                                        </div>-->
                                                                        
<!--                                                                        <div class="pricing-plan col-md-6 p-0"> -->
                                                                       
<!--<iframe width="400" height="250" src="https://www.youtube.com/embed/CO2qbWwUN90" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>-->
                                                                            
                                                                               
                                                                            
<!--                                                                        </div>-->


<div class="embed-responsive embed-responsive-16by9">
  <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/1TeEgLzjdko" allowfullscreen></iframe>
</div>

<div class="embed-responsive embed-responsive-16by9">
  <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/CO2qbWwUN90" allowfullscreen></iframe>
</div>


                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div style="clear:both"></div>
                            </div>
                        </article>
                    </section>
                    <!--end pricing size-->

                    <!--start -->
                    <section class="tp_vc_mw_rowwrapper pb-0" style="background: #efefef;padding: 0;">
                        <!--<div id="particles-js" style="position:absolute"></div>-->
                        <article style="padding-top: 70px;" class="tp_vc_mw_rowinner  darkonlight">
                            <div class="rowbgimage_overlay" style="background-color:transparent;"></div>
                            <div class="content_max_width">
                                <div class="vc_row wpb_row vc_row-fluid mb-0">
                                    <div class="wpb_column vc_column_container vc_col-sm-12">
                                        <div class="vc_column-inner ">
                                            <div class="wpb_wrapper">
                                                <div class="container-fluid p-0">
                                                    <div class="row">
                                                        <div class="col-md-2 d-none d-md-block">
                                                            <div style="clip-path: polygon(0 0, 51% 0, 100% 50%, 75% 100%, 0 100%, 0% 60%, 0 18%);background: linear-gradient(to right, #3e4bb3, #7929c4);height: 450px"></div>
                                                            <h3 class="text-white"
                                                                style="position: absolute;top: 45%;left: 50px">
                                                                @if(app()->getLocale() == 'ar')
                                                                    {{$translation->where('title','faqs')->first()->text_ar}}
                                                                @else
                                                                    {{$translation->where('title','faqs')->first()->text_en}}
                                                                @endif
                                                            </h3>
                                                        </div>
                                                        
                                                        <div class="col-md-4">
                                                             
                                                            @if(app()->getLocale() == 'ar')
                                                                <h4> {{$translation->where('title','faqs')->first()->text_ar}} </h4>
                                                            @else
                                                                <h4> {{$translation->where('title','faqs')->first()->text_en}} </h4>
                                                            @endif
                                                            <div id="accordion" role="tablist" aria-multiselectable="true" class="card-collapse">
                                                                @foreach($faq as $k => $fq)
                            									  <div class="card card-plain">
                            									    <div class="card-header" role="tab" id="heading{{$k}}">
                            									        <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{$k}}" aria-expanded="false" aria-controls="collapse{{$k}}" class="collapsed">
                            									            &nbsp;    
                                                                            @if(app()->getLocale() == 'ar')
                                                                                {{$fq->question_ar}}
                                                                            @else
                                                                                {{$fq->question_en}}
                                                                            @endif
                            												<i class="now-ui-icons arrows-1_minimal-down"></i>
                            									        </a>
                            									    </div>
                            
                            									    <div id="collapse{{$k}}" class="collapse" role="tabpanel" aria-labelledby="heading{{$k}}" style="">
                            									      <div class="card-body">
                                                                            @if(app()->getLocale() == 'ar')
                                                                                {{$fq->answer_ar}}
                                                                            @else
                                                                                {{$fq->answer_en}}
                                                                            @endif
                            									      </div>
                            									    </div>
                            									  </div> 
                        									  @endforeach
                        									</div>
                                                        </div>
                                                        
                                                        <div class="col-md-4">
                                                            <div class="tesimonial">

                                                                <div class="swiper-container">
                                                                    <div style="height: 50px;position: absolute;width: 100%;z-index: 99">
                                                                        <div class="stripes">
                                                                            <div class="stripe stripe1"></div>
                                                                            <div class="stripe stripe2"></div>
                                                                            <div class="stripe stripe3"></div>
                                                                            <div class="stripe stripe4"></div>
                                                                            <div class="stripe stripe5"></div>
                                                                            <div class="stripe stripe6"></div>
                                                                            <div class="stripe stripe7"></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="swiper-wrapper">
                                                                        @foreach($testimonials as $testimonial)
                                                                            <div class="swiper-slide">
                                                                                <div class="row p-2">
                                                                                    <div class="col-8 text-left">
                                                                                        <h4 class="title3">
                                                                                            @if(app()->getLocale() == 'ar')
                                                                                                {{$testimonial->client_name_ar}}
                                                                                            @else
                                                                                                {{$testimonial->client_name_en}}
                                                                                            @endif
                                                                                        </h4>
                                                                                    </div>
                                                                                    <div class="col-4 text-center">
                                                                                        <img src="{{asset('storage/files/testimonial/'.$testimonial->image)}}"
                                                                                             class="img-responsive"
                                                                                             style="width:120px;margin:auto"
                                                                                             alt="">
                                                                                    </div>
                                                                                    <div class="col-12">
                                                                                        <p class="text-black text-left"
                                                                                           style="font-size: 15px">
                                                                                            @if(app()->getLocale() == 'ar')
                                                                                                {{$testimonial->description_ar}}
                                                                                            @else
                                                                                                {{$testimonial->description_en}}
                                                                                            @endif
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        @endforeach

                                                                    </div>
                                                                    <!-- Add Pagination -->
                                                                    <div class="swiper-pagination"></div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-2 d-none d-md-block">
                                                            <div style="clip-path: polygon(46% 0, 100% 0, 100% 50%, 100% 100%, 39% 100%, 0 50%, 40% 0);background: linear-gradient(to right, #7929c4 , #3e4bb3);height: 450px"></div>
                                                            <h3 class="text-white"
                                                                style="position: absolute;top: 45%;right: 50px">

                                                                @if(app()->getLocale() == 'ar')
                                                                    {{$translation->where('title','testimonial')->first()->text_ar}}
                                                                @else
                                                                    {{$translation->where('title','testimonial')->first()->text_en}}
                                                                @endif
                                                            </h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div style="clear:both"></div>
                            </div>
                        </article>
                    </section>
                    <!--end -->


                    <!--start jobs-->
                    <section class="tp_vc_mw_rowwrapper pb-0" style="background: #EEE;padding: 0;">
                        <!--<div id="particles-js" style="position:absolute"></div>-->
                        <article style="padding-top: 70px;" class="tp_vc_mw_rowinner  darkonlight">
                            <div class="rowbgimage_overlay" style="background-color:transparent;"></div>
                            <div class="content_max_width">
                                <div class="vc_row wpb_row vc_row-fluid mb-0">
                                    <div class="wpb_column vc_column_container vc_col-sm-12">
                                        <div class="vc_column-inner ">
                                            <div class="wpb_wrapper">
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col-md-12 text-center">
                                                            <h2  class="text-capitalize text_purple_gradient header-text">
                                                                @if(app()->getLocale() == 'ar')
                                                                    {{$translation->where('title','jobs')->first()->text_ar}}
                                                                @else
                                                                    {{$translation->where('title','jobs')->first()->text_en}}
                                                                @endif</h2>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="container-fluid">
                                                    <div class="row"> 
                                                        <div class="col-md-12">
                                                            <ul id="jobs">
                                                                @foreach($jobs as $job)
                                                                    @if($loop->index > 3)
                                                                        @break
                                                                    @endif
                                                                    <li>
                                                                        <span class="term-and-company">{{$job->user->username}} / {{$job->user->phone}} </span>
                                                                        <h2 class="title">{{$job->job_name}}</h2>
                                                                        <p class="description">{{$job->requirements}}</p>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                        @if(count($jobs) > 0)
                                                            <div class="col-md-12 text-center mb-3 mt-3">
                                                                <a href="{{route('getJobsView')}}"
                                                                   class="btn btn-main btn-md">
                                                                    View More
                                                                </a>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div style="clear:both"></div>
                            </div>
                        </article>
                    </section>
                    <!--end jobs-->

                    <!--start sponsored-->
                    <section class="tp_vc_mw_rowwrapper pb-0" style="background: #FFF;padding: 0;">
                        <!--<div id="particles-js" style="position:absolute"></div>-->
                        <article style="padding-top: 70px;" class="tp_vc_mw_rowinner  darkonlight">
                            <div class="rowbgimage_overlay" style="background-color:transparent;"></div>
                            <div class="content_max_width">
                                <div class="vc_row wpb_row vc_row-fluid mb-0">
                                    <div class="wpb_column vc_column_container vc_col-sm-12">
                                        <div class="vc_column-inner ">
                                            <div class="wpb_wrapper">
                                                <div class="container">
                                                    <div class="row" style="direction: {{app()->getLocale() == 'ar' ? 'rtl' : 'ltr'}}">
                                                        <div class="col-md-5 text-center">
                                                            <h2  class="text-capitalize text_purple_gradient text-left">
                                                                @if(app()->getLocale() == 'ar')
                                                                    {{$translation->where('title','sponsored')->first()->text_ar}}
                                                                @else
                                                                    {{$translation->where('title','sponsored')->first()->text_en}}
                                                                @endif</h2>
                                                        </div>
                                                        <div class="col-md-7 text-center">
                                                            <img src="{{asset('front_assets/images/company_brand.jpg')}}" style="height:200px;margin:auto" alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div style="clear:both"></div>
                            </div>
                        </article>
                    </section>
                    <!--end jobs-->

                    <!--start footer-->
                    <hr>
                    <footer style="background: url('{{asset('front_assets/images/footer_bg.jpg')}}') center bottom no-repeat;background-size: contain">
                        <div class="row mt-2">
                            <div class="col-md-12 text-center">
                                <p>
                                    Copy Rights Are Reseved
                                    <a style="color: #6037bd" href="">@approc</a>
                                    Inc .
                                </p>
                                 <ul class="list-unstyled" style="display: -webkit-inline-box;">
                                     <li>
                                        <a class="dropdown-item" href="{{route('setEn')}}"> 
                                            English 
                                        </a> 
                                     </li>
                                     <li>
                                        <a class="dropdown-item" href="{{route('setAr')}}"> 
                                            العربية 
                                        </a> 
                                     </li>
                                 </ul>
                            </div>
                        </div>
                    </footer>
                    <!--end footer-->
                </div>

                <div class="content_max_width"></div>
            </section>
            <!-- End Of Content -->

            <div class="clearfix"></div>
        </section>

    </article>


</article>

<script type='text/javascript' src='front_assets/js/revslider/js/jquery.themepunch.tools.min-2.2.4.js'></script>
<script type='text/javascript' src='front_assets/js/revslider/js/revolution.addon.typewriter.min-1.0.0.js'></script>
<script src="front_assets/js/bootstrap.min.js"></script>
<script src="front_assets/js/popper.min.js"></script>
<script src="front_assets/js/now-ui-kit.min.js"></script>
<script type='text/javascript' src='front_assets/js/revslider/js/revolution.addon.paintbrush.min-1.0.0.js'></script>
<script type='text/javascript' src='front_assets/js/particles.min.js'></script>
<script type='text/javascript' src='front_assets/js/particlesTrigger.js'></script>
<script type='text/javascript' src='front_assets/js/swiper.min.js'></script>
<script type='text/javascript' src='front_assets/js/plugins.js'></script>
<script type="text/javascript">
    var swiper = new Swiper('.swiper-container', {
        direction: 'vertical',
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
    });
</script>
<script>
    $(document).ready(function () {
        setTimeout(() => {

            $('.loading-overlay').fadeOut();
        }, 1000);
    });

    function animateValue(id, start, end, duration) {

        if (start == end) {
            return;
        }
        var range = end - start;
        var current = start;
        var increment = end > start ? 1 : -1;
        var stepTime = Math.abs(Math.floor(duration / range));
        var obj = document.getElementById(id);
        var timer = setInterval(function () {
            current += increment;
            obj.innerHTML = current;
            if (current == end) {
                clearInterval(timer);
            }
        }, stepTime);
    }

    var a = 0;
    $(window).scroll(function () {

        var oTop = $('#counter').offset().top - window.innerHeight;
        if (a == 0 && $(window).scrollTop() > oTop) {
            $('.counter-value').each(function () {
                var $this = $(this),
                    countTo = $this.attr('data-count');
                $({
                    countNum: $this.text()
                }).animate({
                        countNum: countTo
                    },

                    {

                        duration: 2000,
                        easing: 'swing',
                        step: function () {
                            $this.text(Math.floor(this.countNum));
                        },
                        complete: function () {
                            $this.text(this.countNum);
                            //alert('finished');
                        }

                    });
            });
            a = 1;
        }

    });
</script>
</body>
</html>