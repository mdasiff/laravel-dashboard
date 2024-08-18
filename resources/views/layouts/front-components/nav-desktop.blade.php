<nav class="navigation" id="AccessibleNav">
    <ul id="siteNav" class="site-nav medium left">
        <li class="lvl1 parent megamenu">
            <a href="{{route('industries')}}">Industries <i class="icon anm anm-angle-down-l"></i></a>
            <div class="megamenu style1">
                <ul class="row grid--uniform mmWrapper">
                    
                    @foreach($industry_cats as $industry_cat)
                    <li class="lvl-1 col-md-4 col-lg-4">
                        <a href="#" class="site-nav lvl-1 menu-title">{{$industry_cat->name}}</a>
                        <ul class="subLinks">
                            
                            @foreach($industry_cat->active_industries as $inds)
                            <li class="lvl-2"><a href="{{route('industry_page', $inds->slug)}}" class="site-nav lvl-2">{{$inds->name}}</a></li>
                            @endforeach
                            
                        </ul>
                    </li>
                    @endforeach

                    {{-- <li class="lvl-1 col-md-4 col-lg-4">
                        <a href="#" class="site-nav lvl-1 menu-title">Discrete</a>
                        <ul class="subLinks">
                            <li class="lvl-2"><a href="http://3.6.191.207/industries/aerospace-defense" class="site-nav lvl-2">Aerospace &amp; Defence </a></li>
                            <li class="lvl-2"><a href="http://3.6.191.207/industries/automotive" class="site-nav lvl-2">Automotive </a></li>
                            <li class="lvl-2"><a href="http://3.6.191.207/industries/industrial-equipment-manufacturing" class="site-nav lvl-2">Industrial Equipment Manufacturing </a></li>
                            <li class="lvl-2"><a href="http://3.6.191.207/industries/engineering-construction" class="site-nav lvl-2">Engineering &amp; Construction </a></li>
                            <li class="lvl-2"><a href="http://3.6.191.207/industries/hi-tech-electronics" class="site-nav lvl-2">Hi-Tech Electronics </a></li>
                            <li class="lvl-2"><a href="http://3.6.191.207/industries/fmcg" class="site-nav lvl-2">FMCG </a></li>
                            
                        </ul>
                    </li>
                    <li class="lvl-1 col-md-4 col-lg-4">
                        <a href="#" class="site-nav lvl-1 menu-title">Process </a>
                        <ul class="subLinks">
                            <li class="lvl-2"><a href="http://3.6.191.207/industries/chemical" class="site-nav lvl-2">Chemical </a></li>
                            <li class="lvl-2"><a href="http://3.6.191.207/industries/fb" class="site-nav lvl-2">F&amp;B </a></li>
                            <li class="lvl-2"><a href="http://3.6.191.207/industries/utilities" class="site-nav lvl-2">Utilities </a></li>
                        </ul>
                    </li>
                    <li class="lvl-1 col-md-4 col-lg-4">
                        <a href="#" class="site-nav lvl-1 menu-title">Distribution</a>
                        <ul class="subLinks">
                            <li class="lvl-2"><a href="http://3.6.191.207/industries/textile" class="site-nav lvl-2">Textile </a></li>
                            <li class="lvl-2"><a href="http://3.6.191.207/industries/fibc" class="site-nav lvl-2">FIBC </a></li>
                            <li class="lvl-2"><a href="http://3.6.191.207/industries/fashion" class="site-nav lvl-2">Fashion </a></li>
                            <!-- <li class="lvl-2"><a href="" class="site-nav lvl-2">Industrial Equipment Rentals </a></li> -->
                            <li class="lvl-2"><a href="http://3.6.191.207/industries/distribution" class="site-nav lvl-2">Distribution </a></li>
                        </ul>
                    </li> --}}

                </ul>
            </div>
        </li>
        {{-- <li class="lvl1 parent megamenu">
            <a href="#">Industries <i class="icon anm anm-angle-down-l"></i></a>
            <div class="megamenu style1">
                <ul class="row grid--uniform mmWrapper">
                    <li class="lvl-1 col-md-3 col-lg-4">
                        <a href="#;" class="site-nav lvl-1 menu-title">Discrete Manufacturing Industries</a>
                        <ul class="subLinks">
                            <li class="lvl-2"><a href="" class="site-nav lvl-2">Aerospace & Defence </a></li>
                            <li class="lvl-2"><a href="" class="site-nav lvl-2">Automotive </a></li>
                            <li class="lvl-2"><a href="" class="site-nav lvl-2">Industrial Equipment Manufacturing </a></li>
                            <li class="lvl-2"><a href="" class="site-nav lvl-2">Engineering & Construction </a></li>
                            <li class="lvl-2"><a href="" class="site-nav lvl-2">Hi-Tech Electronics </a></li>
                            <li class="lvl-2"><a href="" class="site-nav lvl-2">Textile </a></li>
                            <li class="lvl-2"><a href="" class="site-nav lvl-2">FIBC </a></li>
                        </ul>
                    </li>
                    <li class="lvl-1 col-md-3 col-lg-3">
                        <a href="#;" class="site-nav lvl-1 menu-title">Process Manufacturing Industries</a>
                        <ul class="subLinks">
                            <li class="lvl-2"><a href="" class="site-nav lvl-2">Food & Beverage </a></li>
                            <li class="lvl-2"><a href="" class="site-nav lvl-2">Chemicals </a></li>
                            <li class="lvl-2"><a href="" class="site-nav lvl-2">Utilities </a></li>
                        </ul>
                    </li>
                    <li class="lvl-1 col-md-3 col-lg-2">
                        <a href="#;" class="site-nav lvl-1 menu-title">Solutions</a>
                        <ul class="subLinks">
                            <li class="lvl-2"><a href="" class="site-nav lvl-2">ERP </a></li>
                            <li class="lvl-2"><a href="" class="site-nav lvl-2">CRM </a></li>
                            <li class="lvl-2"><a href="" class="site-nav lvl-2">EAM </a></li>
                        </ul>
                    </li>
                    <li class="lvl-1 col-md-3 col-lg-3">
                        <a href="#;" class="site-nav lvl-1 menu-title">Core Products</a>
                        <ul class="subLinks">
                            <li class="lvl-2"><a href="" class="site-nav lvl-2">Baan (IV & V) </a></li>
                            <li class="lvl-2"><a href="" class="site-nav lvl-2">Infor ERP LN (ST) </a></li>
                            <li class="lvl-2"><a href="" class="site-nav lvl-2">Infor Syteline (ST) </a></li>
                            <li class="lvl-2"><a href="" class="site-nav lvl-2">Infor CloudSuite IE </a></li>
                            <li class="lvl-2"><a href="" class="site-nav lvl-2">Infor CloudSuite Automotive </a></li>
                            <li class="lvl-2"><a href="" class="site-nav lvl-2">Infor CloudSuite A&D </a></li>
                            <li class="lvl-2"><a href="" class="site-nav lvl-2">Infor CloudSuite E&C </a></li>
                            <li class="lvl-2"><a href="" class="site-nav lvl-2">Infor CloudSuite Industrial </a></li>
                            <li class="lvl-2"><a href="" class="site-nav lvl-2">Rise With SAP </a></li>
                            <li class="lvl-2"><a href="" class="site-nav lvl-2">Grow With SAP </a></li>
                            <li class="lvl-2"><a href="" class="site-nav lvl-2 fs-20 mt-1"> All Products </a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </li> --}}
        <!--Industries-->
        {{-- <li class="lvl1 parent megamenu">
            <a href="#">Industries <i class="icon anm anm-angle-down-l"></i></a>
            <div class="megamenu style1">
                <ul class="row grid--uniform mmWrapper">

                    @foreach($industries as $industry_cat)
                    <li class="lvl-1 col-md-4 col-lg-4">
                        <a href="{{$industry_cat->slug}}" class="site-nav lvl-1 menu-title">{{$industry_cat->name}} <i class="icon anm anm-angle-down-l"></i></a>
                        <ul class="subLinks">
                        @if($industry_cat->active_industries)
                            @foreach($industry_cat->active_industries as $industry)
                                <li class="lvl-2"><a href="{{route($industry->slug)}}" class="site-nav lvl-2">{{$industry->name}}</a></li>
                            @endforeach
                        @endif
                        </ul>
                    </li>
                    @endforeach

                </ul>
            </div>
        </li> --}}


        <!--Solutions-->
        <li class="lvl1 parent megamenu">
            <a href="{{route('solutions')}}">Solutions <i class="icon anm anm-angle-down-l"></i></a>
            <div class="megamenu style1">
                <ul class="row grid--uniform mmWrapper">

                    <li class="lvl-1">
                        <ul class="subLinks row">
                            @foreach($solutions as $solution)
                            <li class="col-md-4 col-lg-4 lvl-2"><a href="{{route('solutions.page',$solution->slug)}}" class="site-nav lvl-2 fs-14">
                                {{$solution->name}}
                            </a></li>
                            @endforeach
                        </ul>
                    </li>
                    {{-- <hr>
                    <li class="lvl-1 col-md-4 col-lg-4">
                        <ul class="subLinks">
                            <li class="lvl-2"><a href="{{route('erp')}}" class="site-nav lvl-2 fs-14">Enterprise Resource Planning</a></li>
                            <li class="lvl-2"><a href="{{route('crm')}}" class="site-nav lvl-2 fs-14">Customer Relationship Management</a></li>
                            <li class="lvl-2"><a href="{{route('eam')}}" class="site-nav lvl-2 fs-14">Enterprise Asset Management</a></li>
                            <li class="lvl-2"><a href="" class="site-nav lvl-2 fs-14">Supply Chain Execution</a></li>
                            <li class="lvl-2"><a href="" class="site-nav lvl-2 fs-14">Supply Chain Planning</a></li>
                        </ul>
                    </li>
                    <li class="lvl-1 col-md-4 col-lg-4">
                        <ul class="subLinks">
                            <!-- <li class="lvl-2"><a href="" class="site-nav lvl-2 fs-14">Financials</a></li> -->
                            <li class="lvl-2"><a href="{{route('analytics')}}" class="site-nav lvl-2 fs-14">Analytics</a></li>
                            <li class="lvl-2"><a href="" class="site-nav lvl-2 fs-14">Sourcing</a></li>
                            <li class="lvl-2"><a href="{{route('hcm')}}" class="site-nav lvl-2 fs-14">Human Capital Management</a></li>
                            <li class="lvl-2"><a href="{{route('grc')}}" class="site-nav lvl-2 fs-14">Governance, Risk & Compliance</a></li>
                            
                        </ul>
                    </li>
                    <li class="lvl-1 col-md-4 col-lg-4">
                        <ul class="subLinks">
                            <li class="lvl-2"><a href="{{route('cpq')}}" class="site-nav lvl-2 fs-14">Configure Price Quote</a></li>
                            <li class="lvl-2"><a href="{{route('mes')}}" class="site-nav lvl-2 fs-14">Manufacturing Execution Software</a></li>
                            <li class="lvl-2"><a href="{{route('plm')}}" class="site-nav lvl-2 fs-14">Product Lifecycle Management</a></li>
                            <li class="lvl-2"><a href="" class="site-nav lvl-2 fs-14">Transport Management System</a></li>
                            <li class="lvl-2"><a href="{{route('integrations')}}" class="site-nav lvl-2 fs-14">Integrations</a></li>
                        </ul>
                    </li> --}}
                </ul>
            </div>
        </li>
         <!--Solutions-->
         <!-- <li class="lvl1 parent dropdown">
            <a href="#">Solutions <i class="icon anm anm-angle-down-l"></i></a>
            <ul class="dropdown">
                
                <li><a href="" class="site-nav">Financials </a></li>
                <li><a href="" class="site-nav">Analytics  </a></li>
                <li><a href="" class="site-nav">Sourcing  </a></li>
                <li><a href="" class="site-nav">Human Capital Management  </a></li>
                <li><a href="" class="site-nav">Governance, Risk & Compliance  </a></li>
                <li><a href="" class="site-nav">Configure Price Quote  </a></li>
                <li><a href="" class="site-nav">Manufacturing Execution Software  </a></li>
                <li><a href="" class="site-nav">Product Lifecycle Management  </a></li>
                <li><a href="" class="site-nav">Transport Management System  </a></li>
                <li><a href="" class="site-nav">Integrations  </a></li>
            </ul>
        </li> -->
        <!--Products-->
        <li class="lvl1 parent megamenu">
            <a href="{{route('products')}}">Products <i class="icon anm anm-angle-down-l"></i></a>
            <div class="megamenu style1">
                <ul class="row grid--uniform mmWrapper">

                    <li class="lvl-1 col-md-4 col-lg-4">
                        <ul>

                            @foreach($product_cats['row_1'] as $pc)
                            
                            <li class="lvl-1 mb-3">
                            <a href="#" class="site-nav lvl-1 menu-title">{{$pc->name}}</a>
                            <ul  class="subLinks">
                            @foreach($pc->active_products as $ap)
                                <li class="lvl-2">
                                    <a href="{{route('products.page',$ap->slug)}}" class="site-nav lvl-2">{{$ap->name}} </a>
                                </li>
                            @endforeach
                            </ul>
                            </li>

                            @endforeach
                        </ul>
                    </li>

                    <li class="lvl-1 col-md-4 col-lg-4">
                        <ul>
                            @foreach($product_cats['row_2'] as $pc)
                            
                            <li class="lvl-1 mb-3">
                            <a href="#" class="site-nav lvl-1 menu-title">{{$pc->name}}</a>
                            <ul class="subLinks">
                            @foreach($pc->active_products as $ap)
                                <li class="lvl-2">
                                    <a href="{{route('products.page',$ap->slug)}}" class="site-nav lvl-2">{{$ap->name}} </a>
                                </li>
                            @endforeach
                            </ul>
                            </li>

                            @endforeach
                        </ul>
                    </li>

                    <li class="lvl-1 col-md-4 col-lg-4">
                        <ul>

                            @foreach($product_cats['row_3'] as $pc)
                            
                            <li class="lvl-1 mb-3">
                            <a href="#" class="site-nav lvl-1 menu-title">{{$pc->name}}</a>
                            <ul class="subLinks">
                            @foreach($pc->active_products as $ap)
                                <li class="lvl-2">
                                    <a href="{{route('products.page',$ap->slug)}}" class="site-nav lvl-2">{{$ap->name}} </a>
                                </li>
                            @endforeach
                            </ul>
                            </li>

                            @endforeach
                        </ul>
                    </li>

                    {{-- <li class="lvl-1 col-md-4 col-lg-4">
                        <!-- <a href="#" class="site-nav lvl-1 menu-title">Enterprise Resource Planning</a> -->
                        <ul class="subLinks">
                            <a href="#" class="site-nav lvl-2 fs-14">Enterprise Resource Planninggggggggg</a>
                            <li class="lvl-2"><a href="{{route('growWithSap')}}" class="site-nav lvl-2">Grow With SAP </a></li>
                            <li class="lvl-2"><a href="{{route('riseWithSap')}}" class="site-nav lvl-2">Rise with SAP </a></li>
                            <li class="lvl-2"><a href="{{route('inforCloudSuiteIndustrial')}}" class="site-nav lvl-2">Infor CloudSuite Industrial  </a></li>
                            <li class="lvl-2"><a href="{{route('inforCloudSuiteIndustrialEnterprise')}}" class="site-nav lvl-2">Infor CloudSuite Industrial  Enterprise </a></li>
                            <li class="lvl-2"><a href="{{route('inforCloudSuiteAutomotive')}}" class="site-nav lvl-2">Infor CloudSuite Automotive </a></li>
                            <li class="lvl-2"><a href="{{route('inforCloudSuiteAD')}}" class="site-nav lvl-2">Infor CloudSuite A&amp;D </a></li>
                            <li class="lvl-2"><a href="{{route('inforCloudSuiteEenggConstruction')}}" class="site-nav lvl-2">Infor CloudSuite Engg. &amp; Construction </a></li>
                            <li class="lvl-2"><a href="{{route('inforCloudSuiteDistrubution')}}" class="site-nav lvl-2">Infor CloudSuite Distrubution </a></li>
                            <li class="lvl-2"><a href="{{route('inforCloudSuiteFashion')}}" class="site-nav lvl-2">Infor CloudSuite Fashion  </a></li>
                            <li class="lvl-2"><a href="{{route('inforCloudSuiteFB')}}" class="site-nav lvl-2">Infor CloudSuite F&amp;B  </a></li>
                            <li class="lvl-2"><a href="{{route('inforCloudSuiteEquipment')}}" class="site-nav lvl-2">Infor CloudSuite Equipment  </a></li>
                            <li class="lvl-2"><a href="{{route('inforCloudSuiteChemical')}}" class="site-nav   lvl-2">Infor CloudSuite Chemical  </a></li>
                            

                            <a href="#" class="site-nav lvl-1 menu-title mt-4">Customer Relationship Management</a>
                            <li class="lvl-2"><a href="{{route('inforCloudSuiteCrm')}}" class="site-nav lvl-2">Infor CloudSuite CRM </a></li>
                            <li class="lvl-2"><a href="{{route('sapc4')}}" class="site-nav lvl-2">SAP C4 </a></li>
                            <li class="lvl-2"><a href="{{route('sfdc')}}" class="site-nav lvl-2">SFDC </a></li>
                            <li class="lvl-2"><a href="{{route('msDynamics365')}}" class="site-nav lvl-2">MS Dynamics 365 </a></li>
                            <li class="lvl-2"><a href="{{route('hubSpot')}}" class="site-nav lvl-2">HubSpot </a></li>

                            <a href="#" class="site-nav lvl-1 menu-title mt-4">Enterprise Asset Management</a>
                            <li class="lvl-2"><a href="{{route('hxgn')}}" class="site-nav lvl-2">HxGN  </a></li>
                            <li class="lvl-2"><a href="{{route('ibmMaximo')}}" class="site-nav lvl-2">IBM Maximo  </a></li>
                        </ul>
                    </li>
                    <li class="lvl-1 col-md-4 col-lg-4">
                        <!-- <a href="#" class="site-nav lvl-1 menu-title">EDGE Products</a> -->
                        <ul class="subLinks">
                            <a href="#" class="site-nav lvl-1 menu-title ">Supply Chain Execution</a>
                            <li class="lvl-2"><a href="{{route('inforCloudSuiteWms')}}" class="site-nav lvl-2">Infor CloudSuite WMS  </a></li>
                            <li class="lvl-2"><a href="{{route('inforFactoryTrack')}}" class="site-nav lvl-2">Infor Factory Track  </a></li>

                            <a href="#" class="site-nav lvl-1 menu-title mt-4">Supply Chain Planning</a>
                            <li class="lvl-2"><a href="{{route('inforScp')}}" class="site-nav lvl-2">Infor SCP  </a></li>
                            <li class="lvl-2"><a href="{{route('sapIbp')}}" class="site-nav lvl-2">SAP IBP  </a></li>
                            <li class="lvl-2"><a href="{{route('kinaxis')}}" class="site-nav lvl-2">Kinaxis/Anaplan  </a></li>

                            <a href="#" class="site-nav lvl-1 menu-title mt-4">Financials</a>
                            <li class="lvl-2"><a href="{{route('sapBpc')}}" class="site-nav lvl-2">SAP BPC  </a></li>
                            <li class="lvl-2"><a href="{{route('inforEPM')}}" class="site-nav lvl-2">Infor EPM  </a></li>
                            <li class="lvl-2"><a href="{{route('sapAribaSM')}}" class="site-nav lvl-2">SAP Ariba SM  </a></li>
                            <li class="lvl-2"><a href="{{route('inforXM')}}" class="site-nav lvl-2">Infor XM  </a></li>
                            <li class="lvl-2"><a href="{{route('sapConcur')}}" class="site-nav lvl-2">SAP Concur  </a></li>

                            <a href="#" class="site-nav lvl-1 menu-title mt-4">Analytics </a>
                            <li class="lvl-2"><a href="{{route('sapAnalyticsCloud')}}" class="site-nav lvl-2">SAP Analytics Cloud </a></li>
                            <li class="lvl-2"><a href="{{route('InforBirstEnterprise')}}" class="site-nav lvl-2">Infor BIRST Enterprise </a></li>
                            <li class="lvl-2"><a href="{{route('msBI')}}" class="site-nav lvl-2">MS BI  </a></li>

                            <a href="#" class="site-nav lvl-1 menu-title mt-4">Sourcing </a>
                            <li class="lvl-2"><a href="{{route('sapAriba')}}" class="site-nav lvl-2">SAP Ariba  </a></li>
                        </ul>
                    </li>
                    <li class="lvl-1 col-md-4 col-lg-4">
                        <!-- <a href="#" class="site-nav lvl-1 menu-title">Merino Build Products</a> -->
                        <ul class="subLinks">
                            <a href="#" class="site-nav lvl-1 menu-title">Human Capital Management </a>
                            <li class="lvl-2"><a href="{{route('inforHCM')}}" class="site-nav lvl-2">Infor HCM  </a></li>
                            <li class="lvl-2"><a href="{{route('sapSuccessFactor')}}" class="site-nav lvl-2">SAP Success Factor  </a></li>

                            <a href="#" class="site-nav lvl-1 menu-title mt-4">Governance, Risk & Compliance </a>
                            <li class="lvl-2"><a href="{{route('inforGRC')}}" class="site-nav lvl-2">Infor GRC  </a></li>

                            <a href="#" class="site-nav lvl-1 menu-title mt-4">Configure Price Quote </a>
                            <li class="lvl-2"><a href="{{route('InforCPQ')}}" class="site-nav lvl-2">Infor CPQ   </a></li>

                            <a href="#" class="site-nav lvl-1 menu-title mt-4">Manufacturing Execution Software </a>
                            <li class="lvl-2"><a href="{{route('inforMES')}}" class="site-nav lvl-2">Infor MES   </a></li>

                            <a href="#" class="site-nav lvl-1 menu-title mt-4">Product Lifecycle Management </a>
                            <li class="lvl-2"><a href="{{route('inforPLMDiscreteManufacturing')}}" class="site-nav lvl-2">Infor PLM - Discrete Manufacturing   </a></li>
                            <li class="lvl-2"><a href="{{route('inforPlmProcessIndustries')}}" class="site-nav lvl-2">Infor PLM _ Process Industries   </a></li>

                            

                            <a href="#" class="site-nav lvl-1 menu-title mt-4">Integrations </a>
                            <li class="lvl-2"><a href="{{route('sapBTP')}}" class="site-nav lvl-2">SAP BTP   </a></li>
                            <li class="lvl-2"><a href="{{route('inforION')}}" class="site-nav lvl-2">Infor ION   </a></li>
                            <li class="lvl-2"><a href="{{route('boomi')}}" class="site-nav lvl-2">Bhoomi   </a></li>

                            <!-- <a href="#" class="site-nav lvl-1 menu-title mt-4">Transport Management System </a> -->
                            
                        </ul>
                    </li> --}}

                </ul>
            </div>
        </li>
        <!-- <li class="lvl1 parent megamenu">
            <a href="#">Products <i class="icon anm anm-angle-down-l"></i></a>
            <div class="megamenu style1">
                <ul class="row grid--uniform mmWrapper">
                    <li class="lvl-1 col-md-4 col-lg-3">
                        <a href="#" class="site-nav lvl-1 menu-title">Enterprise Resource Planning</a>
                        <ul class="subLinks">
                            <li class="lvl-2"><a href="" class="site-nav lvl-2">Grow With SAP </a></li>
                            <li class="lvl-2"><a href="" class="site-nav lvl-2">Rise with SAP </a></li>
                            <li class="lvl-2"><a href="" class="site-nav lvl-2">Infor CloudSuite Industrial  </a></li>
                            <li class="lvl-2"><a href="" class="site-nav lvl-2">Infor CloudSuite Industrial  Enterprise </a></li>
                            <li class="lvl-2"><a href="" class="site-nav lvl-2">Infor CloudSuite Automotive </a></li>
                            <li class="lvl-2"><a href="" class="site-nav lvl-2">Infor CloudSuite A&D </a></li>
                            <li class="lvl-2"><a href="" class="site-nav lvl-2">Infor CloudSuite Engg. & Construction </a></li>
                            <li class="lvl-2"><a href="" class="site-nav lvl-2">Infor CloudSuite Distrubution </a></li>
                            <li class="lvl-2"><a href="" class="site-nav lvl-2">Infor CloudSuite Fashion  </a></li>
                            <li class="lvl-2"><a href="" class="site-nav lvl-2">Infor CloudSuite F&B  </a></li>
                            <li class="lvl-2"><a href="" class="site-nav lvl-2">Infor CloudSuite Equipment  </a></li>
                            <li class="lvl-2"><a href="" class="site-nav lvl-2"> Infor CloudSuite Chemical  </a></li>
                            
                        </ul>
                    </li>
                    <li class="lvl-1 col-md-4 col-lg-3">
                        <a href="#" class="site-nav lvl-1 menu-title">Customer Relationship Management</a>
                        <ul class="subLinks">
                            <li class="lvl-2"><a href="" class="site-nav lvl-2"> Infor CloudSuite CRM </a></li>
                            <li class="lvl-2"><a href="" class="site-nav lvl-2"> SAP C4 </a></li>
                            <li class="lvl-2"><a href="" class="site-nav lvl-2"> SFDC </a></li>
                            <li class="lvl-2"><a href="" class="site-nav lvl-2"> MS Dynamics 365 </a></li>
                            <li class="lvl-2"><a href="" class="site-nav lvl-2"> HubSpot </a></li>
                        </ul>
                    </li>



                    <li class="lvl-1 col-md-4 col-lg-3">
                        <a href="#" class="site-nav lvl-1 menu-title">Enterprise Asset Management</a>
                        <ul class="subLinks">
                            <li class="lvl-2"><a href="" class="site-nav lvl-2">HxGN  </a></li>
                            <li class="lvl-2"><a href="" class="site-nav lvl-2">IBM Maximo  </a></li>
                            
                        </ul>
                    </li>

                    <li class="lvl-1 col-md-4 col-lg-3">
                        <a href="#" class="site-nav lvl-1 menu-title">Supply Chain Execution</a>
                        <ul class="subLinks">
                            <li class="lvl-2"><a href="" class="site-nav lvl-2"> Infor CloudSuite WMS  </a></li>
                            <li class="lvl-2"><a href="" class="site-nav lvl-2">Infor Factory Track  </a></li>
                           
                        </ul>
                    </li>
                    <li class="lvl-1 col-md-4 col-lg-3">
                        <a href="#" class="site-nav lvl-1 menu-title mt-4">Supply Chain Planning</a>
                        <ul class="subLinks">
                            <li class="lvl-2"><a href="" class="site-nav lvl-2">Infor SCP  </a></li>
                            <li class="lvl-2"><a href="" class="site-nav lvl-2"> SAP IBP  </a></li>
                            <li class="lvl-2"><a href="" class="site-nav lvl-2">Kinaxis/Anaplan  </a></li>
                           
                        </ul>
                    </li>
                    <li class="lvl-1 col-md-4 col-lg-3">
                        <a href="#" class="site-nav lvl-1 menu-title mt-4">Financials</a>
                        <ul class="subLinks">
                            <li class="lvl-2"><a href="" class="site-nav lvl-2"> SAP BPC  </a></li>
                            <li class="lvl-2"><a href="" class="site-nav lvl-2"> Infor EPM  </a></li>
                            <li class="lvl-2"><a href="" class="site-nav lvl-2"> SAP Ariba SM  </a></li>
                            <li class="lvl-2"><a href="" class="site-nav lvl-2"> Infor XM  </a></li>
                            <li class="lvl-2"><a href="" class="site-nav lvl-2"> SAP Concur </a></li>
                        </ul>
                    </li>
                    
                    


                    
                    <li class="lvl-1 col-md-4 col-lg-3">
                        <a href="#" class="site-nav lvl-1 menu-title mt-4">Analytics</a>
                        <ul class="subLinks">
                            <li class="lvl-2"><a href="" class="site-nav lvl-2">SAP Analytics Cloud </a></li>
                            <li class="lvl-2"><a href="" class="site-nav lvl-2"> Infor BIRST Enterprise </a></li>
                            <li class="lvl-2"><a href="" class="site-nav lvl-2"> MS BI  </a></li>
                            
                            
                        </ul>
                    </li>




                    <li class="lvl-1 col-md-4 col-lg-3">
                        <a href="#" class="site-nav lvl-1 menu-title mt-4">Sourcing</a>
                        <ul class="subLinks">
                            <li class="lvl-2"><a href="" class="site-nav lvl-2">SAP Ariba  </a></li>
                            
                        </ul>
                    </li>
                    <li class="lvl-1 col-md-4 col-lg-3">
                        <a href="#" class="site-nav lvl-1 menu-title mt-4">Human Capital Management</a>
                        <ul class="subLinks">
                            <li class="lvl-2"><a href="" class="site-nav lvl-2">Infor HCM  </a></li>
                            <li class="lvl-2"><a href="" class="site-nav lvl-2">SAP Success Factor  </a></li>
                            
                        </ul>
                    </li>
                    <li class="lvl-1 col-md-4 col-lg-3">
                        <a href="#" class="site-nav lvl-1 menu-title mt-4">Governance, Risk & Compliance</a>
                        <ul class="subLinks">
                            <li class="lvl-2"><a href="" class="site-nav lvl-2">Infor GRC  </a></li>
                            
                        </ul>
                    </li>
                    <li class="lvl-1 col-md-4 col-lg-3">
                        <a href="#" class="site-nav lvl-1 menu-title mt-4">Configure Price Quote</a>
                        <ul class="subLinks">
                            <li class="lvl-2"><a href="" class="site-nav lvl-2"> Infor CPQ   </a></li>
                            
                        </ul>
                    </li>
                    <li class="lvl-1 col-md-4 col-lg-3">
                        <a href="#" class="site-nav lvl-1 menu-title mt-4">Product Lifecycle Management</a>
                        <ul class="subLinks">
                            <li class="lvl-2"><a href="" class="site-nav lvl-2"> Infor PLM - Discrete Manufacturing   </a></li>
                            <li class="lvl-2"><a href="" class="site-nav lvl-2"> Infor PLM _ Process Industries   </a></li>
                            
                        </ul>
                    </li>
                    <li class="lvl-1 col-md-4 col-lg-3">
                        <a href="#" class="site-nav lvl-1 menu-title mt-4">Transport Management System</a>
                       
                    </li>
                    <li class="lvl-1 col-md-4 col-lg-3">
                        <a href="#" class="site-nav lvl-1 menu-title ">Integrations</a>
                        <ul class="subLinks">
                            <li class="lvl-2"><a href="" class="site-nav lvl-2"> SAP BTP   </a></li>
                            <li class="lvl-2"><a href="" class="site-nav lvl-2"> Infor ION   </a></li>
                            <li class="lvl-2"><a href="" class="site-nav lvl-2"> Bhoomi   </a></li>
                        </ul>
                    </li>
                    
                    


                </ul>
            </div>
        </li> -->
        <!--Services-->
        <li class="lvl1 parent megamenu">
            <a href="{{route('services')}}">Services <i class="icon anm anm-angle-down-l"></i></a>
            <div class="megamenu style1" style="min-width: 590px;">
                <ul class="row grid--uniform mmWrapper">

                    @foreach($service_cats as $service_cat)
                    <li class="lvl-1 col-md-6 col-lg-6 mb-1">
                        <a href="{{route('services.page',$service_cat->slug)}}" class="site-nav lvl-1 menu-title">{{$service_cat->name}}</a>


                        <ul class="subLinks">

                            @foreach($service_cat->active_services as $service)
                            <li class="lvl-2"><a href="#" class="site-nav lvl-2">{{$service->name}}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    @endforeach

                    {{-- 
                    <li class="lvl-1 col-md-4 col-lg-4">
                        <a href="#;" class="site-nav lvl-1 menu-title">Business Process Consulting</a>
                        <ul class="subLinks">
                            <li class="lvl-2"><a href="" class="site-nav lvl-2">Business Process Study / Discovery </a></li>
                            <li class="lvl-2"><a href="" class="site-nav lvl-2">Application System Audit </a></li>
                            <li class="lvl-2"><a href="" class="site-nav lvl-2">Diagnosis </a></li>
                            <li class="lvl-2"><a href="" class="site-nav lvl-2">Product Selection </a></li>
                            <li class="lvl-2"><a href="" class="site-nav lvl-2">Cloud Readiness Assessment </a></li>
                            <li class="lvl-2"><a href="" class="site-nav lvl-2">Education & Training </a></li>
                        </ul>
                    </li>
                    <li class="lvl-1 col-md-4 col-lg-4">
                        <a href="#;" class="site-nav lvl-1 menu-title">Implementation Services</a>
                        <ul class="subLinks">
                            <li class="lvl-2"><a href="" class="site-nav lvl-2">Enterprsie Applications </a></li>
                            <li class="lvl-2"><a href="" class="site-nav lvl-2">Core Model development </a></li>
                            <li class="lvl-2"><a href="" class="site-nav lvl-2">Roll Outs </a></li>
                            <li class="lvl-2"><a href="" class="site-nav lvl-2">Project Management </a></li>
                            <li class="lvl-2"><a href="" class="site-nav lvl-2">Programm Management </a></li>
                        </ul>
                    </li>
                    <li class="lvl-1 col-md-4 col-lg-4">
                        <a href="#;" class="site-nav lvl-1 menu-title">Migration & Upgrade</a>
                        <ul class="subLinks">
                            <li class="lvl-2"><a href="" class="site-nav lvl-2">Platform Migration </a></li>
                            <li class="lvl-2"><a href="" class="site-nav lvl-2">Platform Upgarde </a></li>
                            <li class="lvl-2"><a href="" class="site-nav lvl-2">Application Upgrade </a></li>
                            <li class="lvl-2"><a href="" class="site-nav lvl-2">Data Migration & Archiving </a></li>
                        </ul>
                    </li>
                    <li class="lvl-1 col-md-4 col-lg-4">
                        <a href="#;" class="site-nav lvl-1 menu-title mt-4">Application Managed Services</a>
                        <ul class="subLinks">
                            <li class="lvl-2"><a href="" class="site-nav lvl-2">Application Management Services </a></li>
                            <li class="lvl-2"><a href="" class="site-nav lvl-2">On Demand Support & Services </a></li>
                            <li class="lvl-2"><a href="" class="site-nav lvl-2">Resource Deployment </a></li>
                            <li class="lvl-2"><a href="" class="site-nav lvl-2">Training & Education </a></li>
                        </ul>
                    </li>
                    <li class="lvl-1 col-md-4 col-lg-4">
                        <a href="#;" class="site-nav lvl-1 menu-title mt-4">Technology Solutions & Integrations</a>
                        <ul class="subLinks">
                            <li class="lvl-2"><a href="" class="site-nav lvl-2">Integration and Interface with third-party applications </a></li>
                            <li class="lvl-2"><a href="" class="site-nav lvl-2">Bespoke Development </a></li>
                            <li class="lvl-2"><a href="" class="site-nav lvl-2">Extensibility Services </a></li>
                            <li class="lvl-2"><a href="" class="site-nav lvl-2">Mobile Apps/Web Portals </a></li>
                        </ul>
                    </li>
                    <li class="lvl-1 col-md-4 col-lg-4">
                        <a href="#;" class="site-nav lvl-1 menu-title mt-4">Allied Services</a>
                        <ul class="subLinks">
                            <li class="lvl-2"><a href="" class="site-nav lvl-2">Resource Deployment </a></li>
                            <li class="lvl-2"><a href="" class="site-nav lvl-2">Training & Staffing </a></li>
                        </ul>
                    </li> --}}
                </ul>
            </div>
        </li>
        {{-- <li class="lvl1 parent megamenu">
            <a href="#">Services <i class="icon anm anm-angle-down-l"></i></a>
            <div class="megamenu style1">
                <ul class="row grid--uniform mmWrapper">

                    @foreach($services as $service_cat)
                    <li class="lvl-1 col-md-4 col-lg-4">
                        <a href="{{route($service_cat->slug)}}" class="site-nav lvl-1 menu-title">{{$service_cat->name}}</a>
                        <ul class="subLinks">
                            @if($service_cat->active_services)
                                @foreach($service_cat->active_services as $service)
                                    <li class="lvl-2"><a href="" class="site-nav lvl-2">{{$service->name}}</a></li>
                                @endforeach
                            @endif
                        </ul>
                    </li>
                    @endforeach
                    
                    
                    
                   
                </ul>
            </div>
        </li> --}}

        <!--Marketplace-->
        <!-- <li class="lvl1 parent megamenu mrktplace">
            <a href="#">Marketplace <i class="icon anm anm-angle-down-l"></i></a>
            <div class="megamenu mrktplace style1">
                <ul class="row grid--uniform mmWrapper">
                    <li class="lvl-1 col-md-6 col-lg-6">
                       
                        <ul class="subLinks">
                            <li class="lvl-2"><a href="" class="site-nav lvl-2 fs-14">MBP Textile </a></li>
                            <li class="lvl-2"><a href="" class="site-nav lvl-2 fs-14">MBP FIBC Manufacturing </a></li>
                            <li class="lvl-2"><a href="" class="site-nav lvl-2 fs-14">MBP Shoe Manufacturing </a></li>
                            <li class="lvl-2"><a href="" class="site-nav lvl-2 fs-14">MBP Battery Manufacturing </a></li>
                        </ul>
                    </li>
                    <li class="lvl-1 col-md-6 col-lg-6">
                        <ul class="subLinks">
                            <li class="lvl-2"><a href="" class="site-nav lvl-2 fs-14">MBP AquaCulture </a></li>
                            <li class="lvl-2"><a href="" class="site-nav lvl-2 fs-14">MBP Agri Farming/Crop Management </a></li>
                            <li class="lvl-2"><a href="" class="site-nav lvl-2 fs-14">MBP Furniture Manufacturing </a></li>
                            <li class="lvl-2"><a href="" class="site-nav lvl-2 fs-14">MBP Field Services Mobile Applications </a></li>
                        </ul>
                    </li>
                    
                </ul>
            </div>
        </li> -->
        <!--Marketplace-->
        <!-- <li class="lvl1 parent dropdown">
            <a href="#">Marketplace <i class="icon anm anm-angle-down-l"></i></a>
            <ul class="dropdown">
                <li><a href="" class="site-nav">MBP Textile</a></li>
                <li><a href="" class="site-nav"> MBP FIBC Manufacturing </a></li>
                <li><a href="" class="site-nav"> MBP Shoe Manufacturing </a></li>
                <li><a href="" class="site-nav"> MBP Battery Manufacturing </a></li>
                <li><a href="" class="site-nav"> MBP AquaCulture </a></li>
                <li><a href="" class="site-nav"> MBP Agri Farming/Crop Management </a></li>
                <li><a href="" class="site-nav"> MBP Furniture Manufacturing </a></li>
                <li><a href="" class="site-nav"> MBP Field Services Mobile Applications </a></li>
            </ul>
        </li> -->
         <!--Global Academy-->
         <!-- <li class="lvl1 parent dropdown">
            <a href="#">Global Academy </a>
        </li> -->
    </ul>
</nav>