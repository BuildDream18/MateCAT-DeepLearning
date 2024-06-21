@extends('ai.site.global')

@section('title','Ai Summary')
@section('page')
    <div class="site-wrapper-reveal">


        <div class="section-space--ptb_120">
            <div class="container">
                <div class="row d-flex justify-content-center">

                    <div class="col-lg-6 text-center">
                        <h4 class="mb-5">AI Translation Tool</h4>
                        <img
                            src="/assets/images/box-image/free_ai_translation_tool_square.png"
                            width="330"
                            height="330" class="img-fluid" alt="">
                    </div>
                    <div class="col-lg-6">

                        <div class="alert alert-success">Your translator request has been received, we will contact you.</div>

                        <a href="{{route('ai-home')}}" class="btn btn-primary">Go home</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

