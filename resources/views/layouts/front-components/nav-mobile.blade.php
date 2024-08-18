<!--Mobile Menu-->
<div class="mobile-nav-wrapper" role="navigation">
    <div class="closemobileMenu">Menu <i class="icon anm anm-times-l"></i></div>
    <ul id="MobileNav" class="mobile-nav">
        <!--Industries-->
        <li class="lvl1 parent megamenu">
            <a href="#">Industries <i class="icon anm anm-angle-down-l"></i></a>
            <ul class="lvl-2">

                @foreach($industry_cats as $industry_cat)
                <li>
                    <a href="#" class="site-nav">{{$industry_cat->name}} <i class="icon anm anm-angle-down-l"></i></a>
                    <ul class="subLinks">
                    @if($industry_cat->active_industries)
                        @foreach($industry_cat->active_industries as $inds)
                            <li class="lvl-2"><a href="{{route('industry_page', $inds->slug)}}" class="site-nav">{{$inds->name}}</a></li>
                        @endforeach
                    @endif
                    </ul>
                </li>
                @endforeach
                
            </ul>
        </li>

        <li class="lvl1 parent megamenu">
            <a href="#">Solutions <i class="icon anm anm-angle-down-l"></i></a>
            <ul class="lvl-2">

                @foreach($solutions as $solution)
                <li class="lvl-2"><a href="{{route('solutions.page',$solution->slug)}}" class="site-nav">{{$solution->name}}</a></li>
                @endforeach
                
            </ul>
        </li>

        <!--Products-->
        <li class="lvl1 parent megamenu">
            <a href="#">Products <i class="icon anm anm-angle-down-l"></i></a>
            <ul class="lvl-2">

                @foreach($product_cats['row'] as $pc)
                <li>
                    <a href="#" class="site-nav">{{$pc->name}} <i class="icon anm anm-angle-down-l"></i></a>
                    <ul class="subLinks">
                        @foreach($pc->active_products as $ap)
                        <li><a href="{{route('products.page',$ap->slug)}}" class="site-nav">{{$ap->name}}</a></li>
                        @endforeach
                    </ul>
                </li>
                @endforeach

                {{--<li>
                    <a href="#" class="site-nav">Customer Relationship Management <i class="icon anm anm-angle-down-l"></i></a>
                    <ul class="lvl-3">
                        <li><a href="" class="site-nav"> Infor CloudSuite CRM </a></li>
                        <li><a href="" class="site-nav"> SAP C4 </a></li>
                        <li><a href="" class="site-nav"> SFDC </a></li>
                        <li><a href="" class="site-nav"> MS Dynamics 365 </a></li>
                        <li><a href="" class="site-nav"> HubSpot </a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="site-nav">Enterprise Asset Management <i class="icon anm anm-angle-down-l"></i></a>
                    <ul class="lvl-3">
                        <li><a href="" class="site-nav"> HxGN </a></li>
                        <li><a href="" class="site-nav"> IBM Maximo </a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="site-nav"> Supply Chain Execution <i class="icon anm anm-angle-down-l"></i></a>
                    <ul class="lvl-3">
                        <li><a href="" class="site-nav"> Infor CloudSuite WMS </a></li>
                        <li><a href="" class="site-nav"> Infor Factory Track </a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="site-nav"> Supply Chain Planning <i class="icon anm anm-angle-down-l"></i></a>
                    <ul class="lvl-3">
                        <li><a href="" class="site-nav">Infor SCP </a></li>
                        <li><a href="" class="site-nav">SAP IBP </a></li>
                        <li><a href="" class="site-nav">Kinaxis/Anaplan </a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="site-nav"> Financials <i class="icon anm anm-angle-down-l"></i></a>
                    <ul class="lvl-3">
                        <li><a href="" class="site-nav">SAP BPC </a></li>
                        <li><a href="" class="site-nav">Infor EPM </a></li>
                        <li><a href="" class="site-nav">SAP Ariba SM </a></li>
                        <li><a href="" class="site-nav">Infor XM </a></li>
                        <li><a href="" class="site-nav">SAP Concur </a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="site-nav"> Analytics <i class="icon anm anm-angle-down-l"></i></a>
                    <ul class="lvl-3">
                        <li><a href="" class="site-nav">SAP Analytics Cloud </a></li>
                        <li><a href="" class="site-nav">Infor BIRST Enterprise </a></li>
                        <li><a href="" class="site-nav">MS BI </a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="site-nav"> Sourcing <i class="icon anm anm-angle-down-l"></i></a>
                    <ul class="lvl-3">
                        <li><a href="" class="site-nav">SAP Ariba </a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="site-nav"> Human Capital Management <i class="icon anm anm-angle-down-l"></i></a>
                    <ul class="lvl-3">
                        <li><a href="" class="site-nav">Infor HCM </a></li>
                        <li><a href="" class="site-nav">SAP Success Factor </a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="site-nav"> Governance, Risk & Compliance <i class="icon anm anm-angle-down-l"></i></a>
                    <ul class="lvl-3">
                        <li><a href="" class="site-nav">Infor GRC </a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="site-nav"> Configure Price Quote <i class="icon anm anm-angle-down-l"></i></a>
                    <ul class="lvl-3">
                        <li><a href="" class="site-nav">Infor CPQ </a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="site-nav"> Manufacturing Execution Software <i class="icon anm anm-angle-down-l"></i></a>
                    <ul class="lvl-3">
                        <li><a href="" class="site-nav">Infor MES </a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="site-nav"> Product Lifecycle Management <i class="icon anm anm-angle-down-l"></i></a>
                    <ul class="lvl-3">
                        <li><a href="" class="site-nav">Infor PLM - Discrete Manufacturing </a></li>
                        <li><a href="" class="site-nav">Infor PLM _ Process Industries </a></li>
                    </ul>
                </li>
                <-!-!- <li>
                    <a href="#" class="site-nav"> Transport Management System </a>
                </li> -!->
                <li>
                    <a href="#" class="site-nav"> Integrations <i class="icon anm anm-angle-down-l"></i></a>
                    <ul class="lvl-3">
                        <li><a href="" class="site-nav">SAP BTP </a></li>
                        <li><a href="" class="site-nav">Infor ION </a></li>
                        <li><a href="" class="site-nav">Boomi </a></li>
                    </ul>
                </li>--}}
            </ul>
        </li>

        <!--Services-->
        <li class="lvl1 parent megamenu">
            <a href="#"> Services <i class="icon anm anm-angle-down-l"></i></a>
            <ul class="lvl-2">
                @foreach($service_cats as $service_cat)
                <li>
                    <a href="{{route('services.page',$service_cat->slug)}}" class="site-nav">{{$service_cat->name}}</a>
                    <!-- <ul class="lvl-3">
                        @foreach($service_cat->active_services as $service)
                        <li><a href="" class="site-nav">{{$service->name}}</a></li>
                        @endforeach
                    </ul> -->
                </li>
                @endforeach
                {{-- <li>
                    <a href="#" class="site-nav">Process Audit Services  <i class="icon anm anm-angle-down-l"></i></a>
                    <ul class="lvl-3">
                        <li><a href="" class="site-nav"> Business Process Study / Discovery </a></li>
                        <li><a href="" class="site-nav"> Application System Audit </a></li>
                        <li><a href="" class="site-nav"> Diagnosis </a></li>
                        <li><a href="" class="site-nav"> Product Selection </a></li>
                        <li><a href="" class="site-nav"> Cloud Readiness Assessment  </a></li>
                        <li><a href="" class="site-nav"> Education & Training </a></li>
                        <li><a href="" class="site-nav"> Cloud Readiness Assessment </a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="site-nav">Implementation Services <i class="icon anm anm-angle-down-l"></i></a>
                    <ul class="lvl-3">
                        <li><a href="" class="site-nav"> Enterprise Applications implementation services </a></li>
                        
                    </ul>
                </li>
                <li>
                    <a href="#" class="site-nav">Migration & Upgrade Services<i class="icon anm anm-angle-down-l"></i></a>
                    <ul class="lvl-3">
                        <li><a href="" class="site-nav"> Migration to cloud </a></li>
                        <li><a href="" class="site-nav"> Version Upgrade </a></li>
                        <li><a href="" class="site-nav"> Platform migration services </a></li>
                        <li><a href="" class="site-nav"> Platfrom Upgrade </a></li>
                        <li><a href="" class="site-nav"> Application Upgrade </a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="site-nav">Data Migration Services</a>
                </li>
                <li>
                    <a href="#" class="site-nav">Data Archiving Services</a>
                </li>
                <li>
                    <a href="#" class="site-nav">Application Managed Services <i class="icon anm anm-angle-down-l"></i></a>
                    <ul class="lvl-3">
                        <li><a href="" class="site-nav"> AMS </a></li>
                        <li><a href="" class="site-nav"> On Demand Support & Services </a></li>
                    </ul>
                </li> --}}
               
            </ul>
        </li>

         <!--Marketplace-->
         <!-- <li class="lvl1 parent dropdown">
            <a href="">Marketplace <i class="icon anm anm-angle-down-l"></i></a>
            <ul class="lvl-2">
                <li><a href="" class="site-nav">MBP Textile</a></li>
                <li><a href="" class="site-nav">MBP FIBC Manufacturing</a></li>
                <li><a href="" class="site-nav">MBP Shoe Manufacturing</a></li>
                <li><a href="" class="site-nav">MBP Battery Manufacturing</a></li>
                <li><a href="" class="site-nav">MBP AquaCulture</a></li>
                <li><a href="" class="site-nav">MBP Agri Farming/Crop Management</a></li>
                <li><a href="" class="site-nav">MBP Furniture Manufacturing</a></li>
                <li><a href="" class="site-nav">MBP Field Services Mobile Applications</a></li>
            </ul>
        </li> -->
        <!-- Global Academy -->
        <!-- <li class="lvl1 parent dropdown"><a href=""> Global Academy </a></li> -->

        <!--About Us-->
        <li class="lvl1 parent dropdown">
            <a href="">About Us <i class="icon anm anm-angle-down-l"></i></a>
            <ul class="lvl-2">
                <li><a href="{{route('about')}}" class="site-nav">The Company</a></li>
                <li><a href="{{route('leadership')}}" class="site-nav"> Leadership</a></li>
                <li><a href="{{route('testimonial')}}" class="site-nav">Testimonials</a></li>
                <li><a href="{{route('locations')}}" class="site-nav">Locations</a></li>
                <li><a href="{{route('globalPresence')}}" class="site-nav">Global Presence</a></li>
            </ul>
        </li>
        <!--Resources-->
        <li class="lvl1 parent dropdown">
            <a href="">Resources <i class="icon anm anm-angle-down-l"></i></a>
            <ul class="lvl-2">
                @foreach($resources as $rc)
                <li><a href="{{route('resources.index',$rc->slug)}}" class="site-nav">{{$rc->name}}</a></li>
                @endforeach
            </ul>
        </li>

        <!--News & Events-->
        <li class="lvl1 parent dropdown">
            <a href="">News & Events <i class="icon anm anm-angle-down-l"></i></a>
            <ul class="lvl-2">
                <li><a href="{{route('news')}}" class="site-nav">Latest @ MSL</a></li>
                <li><a href="{{route('webinar')}}" class="site-nav">Webinars</a></li>
                <li><a href="" class="site-nav">Events</a></li>
            </ul>
        </li>
        <!-- Careers -->
        <li class="lvl1 parent dropdown"><a href="{{route('careers')}}"> Careers </a></li>
        <!-- Partners -->
        <!-- <li class="lvl1 parent dropdown"><a href=""> Partners </a></li> -->
    </ul>
</div>
<!--End Mobile Menu-->