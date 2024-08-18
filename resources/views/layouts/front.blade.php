<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Title Of Site -->
        
        {{-- <title>IT Consulting Company - Enterprise Software Solutions - Implementation</title>
        <meta name="description" content="">
        <meta name="keywords" content=""> --}}

        @yield('meta', View::make('layouts.meta'))
        
        <!-- Favicon -->
        <link rel="shortcut icon" href="{{asset('front/assets/images/favicon.ico')}}" />
        <!-- Font Awesome Icon -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" /> 

         <!-- Link Swiper's CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />


        
        <!-- Main Style CSS -->
        <link rel="stylesheet" href="{{asset('front/assets/css/aos.min.css')}}">
        <link rel="stylesheet" href="{{asset('front/assets/css/plugins.css')}}">
        <link rel="stylesheet" href="{{asset('front/assets/css/style.css')}}">
        <link rel="stylesheet" href="{{asset('front/assets/css/responsive.css')}}">

        <style type="text/css">
            .skiptranslate span{
                display: none !important;
            }
        </style>
        @stack('css')
    </head>
    <body class="template-index">
        <div class="page-wrapper style1">
        @component('layouts.front-components.header')
        @endcomponent
        
        @yield('content')

        @component('layouts.front-components.footer')
        @endcomponent
        </div>
        <script src="{{asset('front/assets/js/aos.min.js')}}"></script>
        <script src="{{asset('front/assets/js/plugins.js')}}"></script>
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
        <!-- Main JS -->
        <script src="{{asset('front/assets/js/main.js')}}"></script>
        <script src="{{asset('front/assets/js/front.js')}}"></script>

        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>

        
        <script type="text/javascript">
            var path = "{{ route('autocomplete') }}";
            $('input.typeahead').typeahead({
                source: function (query, process) {
                    return $.get(path, { query: query }, function (data) {
                        // console.log("Data from server:", data); // Debug the data structure
                        return process(data);
                    });
                },
                displayText: function(item) {
                    // console.log("Display text item:", item); // Debug the display text item
                    return JSON.stringify(item); // Display the name in the input box, but keep the item object intact
                },
                highlighter: function (item) {
                    data = JSON.parse(item);
                    console.log(data);
                    return `<div data-href="${data.url}" class="search-result-item">
                                <div>
                                    <strong>${data.name}</strong><br>
                                    <small>In ${data.flag}</small>
                                </div>
                            </div>`;
                },
                updater: function (item) {
                    console.log(item.name);
                    window.location.href = item.url;
                    return item.name;
                }
            });
        </script>
        
        <script type="text/javascript">
            function googleTranslateElementInit() {
                new google.translate.TranslateElement({
                    pageLanguage: 'en',
                    includedLanguages: 'en,nl,es',
                    layout: google.translate.TranslateElement.InlineLayout.SIMPLE
                }, 'google_translate_element');
            }
        </script>

        <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

        <script type="text/javascript">
//             setTimeout(function(){
//             // Find the specific element that contains the "Powered by" text
// let gadgetElement = document.querySelector('.skiptranslate');

// // Iterate through the child nodes of the element
// gadgetElement.childNodes.forEach(node => {
//     if (node.nodeType === Node.TEXT_NODE && node.nodeValue.trim() === "Powered by") {
//         node.nodeValue = '';  // Hide the "Powered by" text
//     }
// });
// },1000);
        </script>
        @stack('js')
    </body>
</html>
