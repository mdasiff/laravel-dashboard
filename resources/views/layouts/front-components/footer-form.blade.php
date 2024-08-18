@if(!Str::contains(\Request::route()->getName(), Config::get('const.exclude_form')))
<!--Footer Form Start-->
<section class="home-form sec-pad" id="common-query-form-wrapper">
    <div class="container">
        <div class="row g-5 justify-content-center">
        <div class="col-md-12">
        <div class="form-heading aos-init aos-animate" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="100">
            <h1>How can we help you</h1>
        </div>
        </div>
        </div>
        <div class="row g-5 justify-content-center">
            <div class="col-8 col-md-8  align-v-center">
                <div class="holder">
                <!-- Form -->
                    <div class="form-area scheme-1 secondary-50 aos-init aos-animate" data-aos="zoom-in" data-aos-duration="1500" data-aos-delay="300">
                        <form id="common-query-form" class="form-fields" method="post" action="{{route('query.contact')}}">
                            @csrf
                            <div class="form-row row">
                                <div class="form-col form-floating col-12 col-md-12 col-lg-6">
                                    <input type="text" name="first_name" class="form-control" id="first_name" placeholder="First Name" required value="{{old('first_name')}}">
                                    <label for="first_name" class="form-label"> First Name <sup>*<sup> </label>

                                    @error('first_name')
                                        <div class="text-danger-light"><small>{{ $message }}</small></div>
                                    @enderror
                                </div>
                                <div class="form-col form-floating col-12 col-md-12 col-lg-6">
                                    <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Last Name" required value="{{old('last_name')}}">
                                    <label for="last_name" class="form-label"> Last Name <sup>*<sup> </label>
                                        @error('last_name')
                                            <div class="text-danger-light"><small>{{ $message }}</small></div>
                                        @enderror
                                </div>
                            </div>
                            <div class="form-row row">
                                <div class="form-col form-floating col-12 col-md-12 col-lg-6">
                                    <input type="text" name="company" class="form-control" id="company" placeholder="Company" required value="{{old('company')}}">
                                    <label for="company" class="form-label"> Company <sup>*<sup> </label>
                                    @error('company')
                                        <div class="text-danger-light"><small>{{ $message }}</small></div>
                                    @enderror
                                </div>
                                <div class="form-col form-floating col-12 col-md-12 col-lg-6">
                                    <input type="text" name="job_title" class="form-control" id="job_title" placeholder="Job Title" required value="{{old('job_title')}}">
                                    <label for="job_title" class="form-label"> Job Title <sup>*<sup> </label>
                                        @error('job_title')
                                            <div class="text-danger-light"><small>{{ $message }}</small></div>
                                        @enderror
                                </div>
                            </div>
                            <div class="form-row row">
                                <div class="form-col form-floating col-12 col-md-12 col-lg-6">
                                    <input type="text" name="email" class="form-control" id="email" placeholder="Email" required value="{{old('email')}}">
                                    <label for="email" class="form-label"> Email <sup>*<sup> </label>
                                        @error('email')
                                            <div class="text-danger-light"><small>{{ $message }}</small></div>
                                        @enderror
                                </div>
                                <div class="form-col form-floating col-12 col-md-12 col-lg-6">
                                    <input type="text" name="contact" class="form-control" id="contact" placeholder="Contact" required value="{{old('contact')}}">
                                    <label for="contact" class="form-label"> Contact </label>
                                    @error('contact')
                                            <div class="text-danger-light"><small>{{ $message }}</small></div>
                                        @enderror
                                </div>
                            </div>
                            <div class="form-row row">
                                <div class="form-col form-floating col-12 col-md-12">
                                    <input name="country" id="country" class="form-control form-datalist" list="InputFloatingCategoryOptions" placeholder="Country" required value="{{old('country')}}">
                                    <label for="country" class="form-label">Country <sup>*<sup></label>
                                    <datalist id="InputFloatingCategoryOptions">
                                        @foreach(\App\Models\Country::get() as $country)
                                        <option value="{{$country->name}}">{{$country->name}}</option>
                                        @endforeach
                                    </datalist>
                                    @error('country')
                                            <div class="text-danger-light"><small>{{ $message }}</small></div>
                                        @enderror
                                </div>
                            </div>
                            <div class="form-row row">
                                <div class="form-col form-floating col-12 col-md-12 ">
                                <textarea class="form-control" id="message" placeholder="Message" required name="message" rows="3" >{{old('message')}}</textarea>
                                    <label for="message" class="form-label"> Message <sup>*<sup> </label>
                                </div>
                                @error('message')
                                    <div class="text-danger-light"><small>{{ $message }}</small></div>
                                @enderror
                            </div>
                        
                            <div class="mt-3">
                                {!! NoCaptcha::renderJs() !!}
                                {!! NoCaptcha::display() !!}

                                @error('g-recaptcha-response')
                                    <div class="text-danger-light"><small>{{ $message }}</small></div>
                                @enderror
                            </div>

                            <div class="form-row row">
                                <div class="home-form-btn text-center">
                                <!-- Button -->
                                    <input type="submit" name="submit" class="pad-50 mt-2  btn-full-green" value="Submit">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Footer Form Start-->

@if($errors->any())
@push('js')
<script>
    $(document).ready(function() {
        // Function to scroll smoothly to the middle of the target element
        function scrollToMiddle(targetId) {
            var targetElement = $(targetId);
            if (targetElement.length) {
                var targetOffset = targetElement.offset().top;
                var targetHeight = targetElement.height();
                var windowHeight = $(window).height();
                
                // Calculate the scroll position to bring the element to the middle of the page
                var scrollToPosition = targetOffset - ((windowHeight / 2) - (targetHeight / 2));
                
                // Smooth scroll to the calculated position
                $('html, body').animate({
                    scrollTop: scrollToPosition
                }, 1000); // 1000 milliseconds for the animation duration
            }
        }
        
        // Call the function on page load
        scrollToMiddle('#common-query-form');
    });
</script>
@endpush
@endif

@endif