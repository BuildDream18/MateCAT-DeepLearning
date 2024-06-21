@extends('site.global')
@section('title','Contact Us')
@section('page')
    <div class="site-wrapper-reveal">
        <!--====================  Conact us Section Start ====================-->
        <div class="contact-us-section-wrappaer section-space--pt_100 section-space--pb_70">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-lg-6">
                        <div class="conact-us-wrap-one mb-30">
                            <h3 class="heading">Have a project in the works and need to contact us right away?</h3>
                            <div class="sub-heading">We take pride in being overly responsive to our clients’ needs and
                                respond back within 30 minutes.
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-lg-6">
                        <div class="contact-form-wrap">

                            <form id="contact-form" action="{{route('contact-form')}}" method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="contact-form">
                                    <div class="contact-input">
                                        <div class="contact-inner">
                                            <input name="name" type="text" placeholder="Name *">
                                            <div id="validation_name" class="text-danger"></div>
                                        </div>
                                        <div class="contact-inner">
                                            <input name="email" type="email" placeholder="Email *">
                                            <div id="validation_email" class="text-danger"></div>
                                        </div>
                                    </div>
                                    <div class="contact-inner">
                                        <input name="subject" type="text" placeholder="Subject *">
                                        <div id="validation_subject" class="text-danger"></div>
                                    </div>
                                    <div class="contact-inner contact-message">
                                        <textarea name="message"
                                                  placeholder="Please describe what you need."></textarea>
                                        <div id="validation_message" class="text-danger"></div>
                                    </div>
                                    <div class="contact-inner">
                                        <input class="form-control" type="file" name="files[]" accept="file_extension|image/*|media_type" multiple>
                                    </div>
                                    <div class="submit-btn mt-20">
                                        <button class="ht-btn ht-btn-md" type="submit">Send message</button>
                                        <p class="form-messege"></p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--====================  Conact us Section End  ====================-->


        <!--========== Call to Action Area Start ============-->
        <div class="cta-image-area_one section-space--ptb_80 cta-bg-image_two">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-8 col-lg-7">
                        <div class="cta-content md-text-center">
                            <h3 class="heading">Translate like it's native content</h3>
                            <h6 class="heading">Our translators have localized content for the best companies in the
                                world.</h6>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-5">
                        <div class="cta-button-group--two text-center">
                            <a href="https://jivo.chat/NOKti8bvLm" target="_blank" class="btn btn--white btn-one"><span
                                    class="btn-icon me-2"><i class="far fa-comment-alt-dots"></i></span> Let's talk</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--========== Call to Action Area End ============-->


    </div>
@endsection
