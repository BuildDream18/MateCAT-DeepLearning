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

                        <h4>Project Name: {{$projectName}}</h4>


                        <div class="my-5">

                            <form method="post" action="{{route('hire-translator',['hash'=>$hash])}}">
                                @csrf
                                <table class="table mb-5">

                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Experience</th>
                                    </tr>


                                    @foreach($translators as $translator)

                                        <tr>
                                            <td><input type="radio" name="translator_id" value="{{$translator->id}}"></td>
                                            <td>{{$translator->name}}</td>
                                            <td>{{$translator->experience}}</td>
                                        <tr>

                                    @endforeach

                                </table>


                                <input type="submit" value="Hire Translator" class="btn btn-success m-1">

                                <a href="{{route('ai-home')}}" class="btn btn-primary">Go home</a>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

