<!-- testimonial-section end -->
<section class="testimonial-section bg-color-1 centred">
    <div class="pattern-layer" style="background-image: url({{ asset('frontend/assets/images/shape/shape-1.png') }});"></div>
    <div class="auto-container">
        <div class="sec-title">
            <h5>Testimonials</h5>
            <h2>What They Say About Us</h2>
        </div>
        @php
            $testimonials = App\Models\Testimonial::latest()->get();
        @endphp
        <div class="single-item-carousel owl-carousel owl-theme owl-dots-none nav-style-one">

            @foreach ($testimonials as $test)
                
           
            <div class="testimonial-block-one">
                <div class="inner-box">
                    <figure class="thumb-box"><img src="{{ (!empty($test->image)) ? asset($test->image) : url('upload/no_image.jpg') }}" alt=""></figure>
                    <div class="text">
                        <p>{{$test->message}}</p>
                    </div>
                    <div class="author-info">
                        <h4>{{$test->name}}</h4>
                        <span class="designation">{{$test->position}}</span>
                    </div>
                </div>
            </div>
            @endforeach
            {{-- <div class="testimonial-block-one">
                <div class="inner-box">
                    <figure class="thumb-box"><img src="{{ asset('frontend/assets/images/resource/testimonial-2.jpg') }}" alt=""></figure>
                    <div class="text">
                        <p>Our goal each day is to ensure that our residents’ needs are not only met but exceeded. To make that happen we are committed to provid ing an environment in which residents can enjoy.</p>
                    </div>
                    <div class="author-info">
                        <h4>Marc Kenneth</h4>
                        <span class="designation">Founder CEO</span>
                    </div>
                </div>
            </div>
            <div class="testimonial-block-one">
                <div class="inner-box">
                    <figure class="thumb-box"><img src="{{ asset('frontend/assets/images/resource/testimonial-1.jpg') }}" alt=""></figure>
                    <div class="text">
                        <p>Our goal each day is to ensure that our residents’ needs are not only met but exceeded. To make that happen we are committed to provid ing an environment in which residents can enjoy.</p>
                    </div>
                    <div class="author-info">
                        <h4>Owen Lester</h4>
                        <span class="designation">Manager</span>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
</section>
<!-- testimonial-section end -->
