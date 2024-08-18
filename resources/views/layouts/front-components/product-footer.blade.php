<section class="all-product sec-pad">
    <div class="container aos-init aos-animate" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="500">
        <div class="row">
            <div class="colm-12">
                <div class="main-heading">
                    <h2 class="text-black">All Products</h2>
                </div>
            </div>
        </div>
        <div class="row justify-content-between">
            <div class="col-md-6">
                <div class="feature-product-sol-box">
                    <img class="img-fluid" src="{{asset('front/assets/images/products/all-product1.png')}}" alt="Feature product" />
                    <div class="row">
                        
                        @php $products_infor = \App\Helpers\FrontHelper::getInforProducts() @endphp

                        @foreach($products_infor as $product_inf)
                        <div class="col-md-6">
                            <p> <a href="{{route('products.page',$product_inf->slug)}}">{{$product_inf->name}}</a></p>
                        </div>
                        @endforeach

                        {{-- <div class="col-md-6">
                            <p> <a href="{{route('inforCloudSuiteIndustrial')}}">Infor CloudSuite Industrial</a></p>
                            <p> <a href="{{route('inforCloudSuiteIndustrialEnterprise')}}">Infor CloudSuite Industrial Enterprise</a></p>
                            <p> <a href="{{route('inforCloudSuiteAutomotive')}}">Infor CloudSuite Automotive</a></p>
                            <p> <a href="{{route('inforCloudSuiteAD')}}">Infor CloudSuite A&D</a></p>
                            <p> <a href="{{route('inforCloudSuiteEenggConstruction')}}">Infor CloudSuite Engg. & Construction</a></p>
                            <p> <a href="{{route('inforCloudSuiteDistrubution')}}">Infor CloudSuite Distrubution</a></p> 
                            <p> <a href="{{route('inforCloudSuiteFashion')}}">Infor CloudSuite Fashion</a></p> 
                            <p> <a href="{{route('inforCloudSuiteFB')}}">Infor CloudSuite F&B</a></p> 
                            <p> <a href="{{route('inforCloudSuiteEquipment')}}">Infor CloudSuite Equipment</a></p> 
                            <p> <a href="{{route('inforCloudSuiteChemical')}}">Infor CloudSuite Chemical</a></p> 
                            <p> <a href="{{route('inforCloudSuiteCrm')}}">Infor CloudSuite CRM</a></p> 
                            <p> <a href="{{route('inforCloudSuiteWms')}}">Infor CloudSuite WMS</a></p> 
                        </div>
                        <div class="col-md-6">
                            <p> <a href="{{route('inforScp')}}">Infor SCP</a></p> 
                            <p> <a href="{{route('inforEPM')}}">Infor EPM</a></p> 
                            <p> <a href="{{route('inforXM')}}">Infor XM</a></p> 
                            <p> <a href="{{route('InforBirstEnterprise')}}">Infor BIRST Enterprise</a></p> 
                            <p> <a href="{{route('inforHCM')}}">Infor HCM</a></p> 
                            <p> <a href="{{route('inforGRC')}}">Infor GRC</a></p> 
                            <p> <a href="{{route('InforCPQ')}}">Infor CPQ</a></p> 
                            <p> <a href="{{route('inforMES')}}">Infor MES</a></p> 
                            <p> <a href="{{route('inforION')}}">Infor ION</a></p> 
                            <p> <a href="{{route('inforPLMDiscreteManufacturing')}}">Infor PLM - Discrete Manufacturing</a></p> 
                            <p> <a href="{{route('inforPlmProcessIndustries')}}">Infor PLM _ Process Industries</a></p> 
                        </div> --}}
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="feature-product-sol-box">
                    <img class="img-fluid" src="{{asset('front/assets/images/products/all-product2.png')}}" alt="Feature product" />

                    @php $product_saps = \App\Helpers\FrontHelper::getSapProducts() @endphp

                    @foreach($product_saps as $product_sap)
                    <p> <a href="{{route('products.page',$product_sap->slug)}}">{{$product_sap->name}}</a></p> 
                    @endforeach

                    {{-- <p> <a href="{{route('riseWithSap')}}">Rise with SAP</a></p> 
                    <p> <a href="{{route('sapc4')}}">SAP C4</a></p> 
                    <p> <a href="{{route('sapIbp')}}">SAP IBP</a></p> 
                    <p> <a href="{{route('sapBpc')}}">SAP BPC</a></p> 
                    <p> <a href="{{route('sapAribaSM')}}">SAP Ariba SM</a></p> 
                    <p> <a href="{{route('sapConcur')}}">SAP Concur</a></p> 
                    <p> <a href="{{route('sapAnalyticsCloud')}}">SAP Analytics Cloud</a></p> 
                    <p> <a href="{{route('sapAriba')}}">SAP Ariba</a></p> 
                    <p> <a href="{{route('sapSuccessFactor')}}">SAP Success Factor</a></p> 
                    <p> <a href="{{route('sapBTP')}}">SAP BTP</a></p> --}}
                </div>
            </div>
            <div class="col-md-3">
                <div class="feature-product-sol-box">
                    <img class="img-fluid" src="{{asset('front/assets/images/products/all-product3.png')}}" alt="Feature product" />

                    @php $product_mss = \App\Helpers\FrontHelper::getMSProducts() @endphp

                    @foreach($product_mss as $product_ms)
                    <p> <a href="{{route('products.page',$product_ms->slug)}}">{{$product_ms->name}}</a></p> 
                    @endforeach
                </div>
            </div>
        </div>
        <div class="row justify-content-between align-items-center">
        <div class="col-md-2">
                <div class="feature-product-sol-box">
                    <a href="{{route('products.page','boomi')}}"><img class="img-fluid" src="{{asset('front/assets/images/products/all-product4.png')}}" alt="Feature product" /></a>
                </div>
            </div>
            <div class="col-md-2">
                <div class="feature-product-sol-box">
                    <a href="{{route('products.page','hxgn')}}"><img class="img-fluid" src="{{asset('front/assets/images/products/all-product5.png')}}" alt="Feature product" /></a>
                </div>
            </div>
            <div class="col-md-2">
                <div class="feature-product-sol-box">
                    <a href="{{route('products.page','hubspot')}}"><img class="img-fluid" src="{{asset('front/assets/images/products/all-product6.png')}}" alt="Feature product" /></a>
                </div>
            </div>
            <div class="col-md-2">
                <div class="feature-product-sol-box">
                    <a href="{{route('products.page','kinaxisanaplan')}}"><img class="img-fluid" src="{{asset('front/assets/images/products/all-product7.png')}}" alt="Feature product" /></a>
                </div>
            </div>
            <div class="col-md-2">
                <div class="feature-product-sol-box">
                    <a href="{{route('products.page','sfdc')}}"><img class="img-fluid" src="{{asset('front/assets/images/products/all-product8.png')}}" alt="Feature product" /></a>
                </div>
            </div>
        </div>
    </div>
</section>