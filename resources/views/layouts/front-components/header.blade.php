@php 
    $resources = \App\Helpers\FrontHelper::resource_categories();
    $service_cats = \App\Helpers\FrontHelper::service_categories();
    $industry_cats = \App\Helpers\FrontHelper::industry_categories();
    $solutions = \App\Helpers\FrontHelper::solution_categories();
    $marketplaces = \App\Helpers\FrontHelper::marketplace_categories();

    $product_cats = \App\Helpers\FrontHelper::product_categories();

@endphp
<div class="classic-topHeader header-12 header classicHeader  header-fixed">
    <!--Top Header-->
    <div class="top-header classicTopbar">
        <div class="container-fluid">
            <div class="row align-items-center" id="siteNav">
                <div class="col-6 col-sm-6 col-md-3 col-lg-4 text-left">
                    <!--Logo-->

                    <a class="logoImg" href="{{route('welcome')}}">
                        <img class="mx-lg-auto default-logo" src="{{asset('front/assets/images/logo.png')}}" alt="" title="" width="165" height="auto" />
                        <img class="mx-lg-auto logo-small" src="{{asset('front/assets/images/logo-small.png')}}" alt="" title="" width="45" height="auto" />
                        
                    </a>
                    <!--End Logo-->
                </div>
                <!-- <div class="col-12 col-sm-12 col-md-6 col-lg-4 text-center d-none d-md-block">
                                Limited Time Only — Save 25%! Use Code: <strong>25OFF</strong>
                            </div> -->
                <div class="col-6 col-sm-6 col-md-3 col-lg-8 text-right d-flex align-items-center justify-content-end">
                    <div class="social-email left-brd d-inline-flex">
                         <!--Search-->
                    <div class="search-parent iconset">
                        <div class="site-search" title="Search">
                            <a href="#" class="search-icon clr-none" data-bs-toggle="offcanvas" data-bs-target="#search-drawer"><i class="hdr-icon icon anm anm-search-l"></i></a>
                        </div>
                        <div class="search-drawer offcanvas offcanvas-top" tabindex="-1" id="search-drawer">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-md-8">
                                        <div class="main-search-head">
                                            <div class="search-header d-flex-center justify-content-between mb-3">
                                                <h3 class="title m-0">What are you looking for?</h3>
                                                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                            </div>
                                            <div class="search-body">
                                                <form class="form minisearch" id="header-search" action="#" method="get">
                                                    <div class="d-flex searchField">
                                                        <div class="input-box d-flex fl-1">
                                                            <input type="text" class="input-text border-end-0 typeahead" placeholder="Search" value="" />
                                                            <button type="submit" class="action search d-flex-justify-center btn btn-primary rounded-5 rounded-start-0"><i class="icon anm anm-search-l"></i></button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End Search-->
                    <li><div id="google_translate_element"></div></li>
                    <!--Language-->
                    <div class="account-parent iconset">
                        <div class="account-link" title="Language"><i class="hdr-icon icon anm anm-globe"></i></div>
                        <div id="accountBox" class="">
                            <div class="customer-links">
                                <ul class="m-0">

                                    <li>
                                        <a href="">
                                            <!--<img src="assets/images/flag/english.png" alt="english" width="18" height="18">-->
                                            India
                                        </a>
                                    </li>
                                    <li><a href=""> US</a></li>
                                    <li><a href=""> MIddle EAST</a></li>
                                    <li><a href=""> Europe </a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!--End Language-->
                    <!--Mobile Toggle-->
                    <div class="top-off-menu">
                    <a class="" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="top-icon fas fa-bars"></i></a>

                    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
                            <div class="offcanvas-header">
                                <!-- <h5 id="offcanvasRightLabel">Offcanvas right</h5> -->
                                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="top-offcanvas-body" id="topOffcanvas">
                                <!-- <ul class="top-off-nav">
                                    <li class="ac">
                                        <a  href=""> About Us  <i class="top-icon fas fa-plus"></i> </a>
                                        <ul class="acSub">
                                            <li><a href="">The Company</a></li>
                                            <li><a href=""> Leadership </a></li>
                                            <li><a href=""> Testimonials </a></li>
                                            <li><a href=""> Locations </a></li>
                                            <li><a href=""> Global Presence </a></li>
                                        </ul>
                                    </li>
                                    <li class="ac">
                                        <a href=""> Resources  <i class="top-icon fas fa-plus"></i> </a>
                                        <ul class="acSub">
                                            @foreach($resources as $rc)
                                    <li><a href="{{route('resources.index',$rc->slug)}}">{{$rc->name}}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    <li class="ac">
                                        <a href=""> News & Events  <i class="top-icon fas fa-plus"></i> </a>
                                        <ul class="acSub">
                                            <li><a href=""> Latest @ MSL </a></li>
                                            <li><a href=""> Webinars </a></li>
                                            <li><a href=""> Events </a></li>
                                        </ul>
                                    </li>
                                    <li><a href="">  Careers   </a></li>
                                    <li><a href="">  Partners  </a></li>
                                </ul> -->

                                <ul class="top-off-nav">
                                    <li class="top-off-nav-first">
                                        <a  class="ac" data-bs-toggle="collapse" href="#collapseExample"  > About Us  <i class="top-icon fas fa-plus"></i> </a>
                                        <ul class="collapse ac" id="collapseExample">
                                            <li><a href="{{route('about')}}">The Company</a></li>
                                            <li><a href="{{route('leadership')}}"> Leadership </a></li>
                                            <li><a href="{{route('testimonial')}}"> Testimonials </a></li>
                                            <li><a href="{{route('locations')}}"> Locations </a></li>
                                            <li><a href="{{route('globalPresence')}}"> Global Presence </a></li>
                                        </ul>
                                    </li>
                                    <li class="top-off-nav-first">
                                        <a class="ac" data-bs-toggle="collapse" href="#collapseExample2"> Resources  <i class="top-icon fas fa-plus"></i> </a>
                                        <ul class="collapse ac" id="collapseExample2">
                                            @foreach($resources as $rc)
                                            <li><a href="{{route('resources.index',$rc->slug)}}">{{$rc->name}}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    <li class="top-off-nav-first">
                                        <a class="ac" data-bs-toggle="collapse" href="#collapseExample3"> News & Events  <i class="top-icon fas fa-plus"></i> </a>
                                        <ul class="collapse ac" id="collapseExample3">
                                            <li><a href="{{route('news')}}"> Latest @ MSL </a></li>
                                            <li><a href="{{route('webinar')}}"> Webinars </a></li>
                                            <li><a href=""> Events </a></li>
                                        </ul>
                                    </li>
                                    <li><a href="{{route('careers')}}">  Careers   </a></li>
                                    <!-- <li><a href="">  Partners  </a></li> -->
                                </ul>
                            </div>
                            <div class="offcanvas-footer">
                                <h5 id="offcanvasRightLabel"> Menu </h5>
                            </div>
                    </div>
                    </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End Top Header-->
    
    <!--Header-->
    <header class="d-flex align-items-center nav-bg">
        <div class="container-fluid">
            <div class="row">
                <!--Menu-->
                <div class="col-1 col-sm-1 col-md-8 col-lg-8 align-self-center d-menu-col hdr-menu-left menu-position-left">
                    @component('layouts.front-components.nav-desktop', [
                        'industry_cats'=>$industry_cats,
                        'solutions'=>$solutions,
                        'service_cats'=>$service_cats,
                        'product_cats'=>$product_cats
                    ])
                    @endcomponent
                </div>
                <!--End Menu-->

                <div class="logo col-4 col-sm-4 col-md-4 d-lg-none align-self-center">
                    <a class="logoImg" href="{{route('welcome')}}">
                        <img class="mx-lg-auto default-logo" src="{{asset('front/assets/images/logo.png')}}" alt="Merinoservices" width="149" />
                        <span class="logo-txt d-none">Merino</span>
                    </a>
                </div>
                <!--Right Icon-->
                <div class="col-8 col-sm-8 col-md-8 col-lg-4 d-flex justify-content-end align-self-center icons-col text-right">
                <a href="{{route('blog')}}">
                    <div class="blog-btn-home iconset">
                         Blog
                    </div>
                    </a>
                    <a href="{{route('contact')}}">
                        <div class="contact-btn-home iconset">
                            Contact
                        </div>
                    </a>
                    <!--Mobile Toggle-->
                    <button type="button" class="iconset pe-0 menu-icon js-mobile-nav-toggle mobile-nav--open d-lg-none" title="Menu"><i class="hdr-icon icon anm anm-times-l"></i><i class="hdr-icon icon anm anm-bars-r"></i></button>
                    <!--End Mobile Toggle-->
                </div>
                <!--End Right Icon-->
            </div>
        </div>
    </header>
    <!--End Header-->
</div>

@component('layouts.front-components.nav-mobile',[
    'resources'=>$resources,
    'solutions'=>$solutions,
    'industry_cats'=>$industry_cats,
    'service_cats'=>$service_cats,
    'product_cats'=>$product_cats
])
@endcomponent