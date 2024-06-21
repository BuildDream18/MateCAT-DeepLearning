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


                        <div class="my-5" id="translation-loader">
                            <h6>Files is being analyzed</h6>
                            <img src="/assets/images/icons/loading.gif" width="50">

                        </div>

                        <div class="my-5" id="analysis">

                        </div>

                        <div class="my-5" id="actions">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('customJs')
    <script>
        $(document).ready(function () {
            setTimeout(getAnalysis, 1000);
            setTimeout(generateDownloadLinks, 1000);
        });

        getAnalysis = () => {
            $.get("{{route('analysis',['hash'=>$hash])}}", function (data) {

                if (data.id) {
                    $('#translation-loader').hide();

                    const analysis = JSON.parse(data.analysis);
                    if({{$mt_model_check}} === 1){
                        $('#analysis').append(`

<table class="table mb-5">
<thead>
<tr>
    <th>Total word count</th>
    <th>Industry weighted</th>
</tr>
</thead>
<tbody>
<tr>
    <td>${analysis.TOTAL_RAW_WC}</td>
    <td>${analysis.TOTAL_STANDARD_WC}</td>
</tr>
</tbody>
</table>

                    `);
                    } else {
                        $('#analysis').append(`<h3>Translated Successfully.</h1>`);
                    }



                } else {
                    setTimeout(getAnalysis, 1000);
                }


            });
        }

        generateDownloadLinks = () => {
            $.get("{{route('translation-status',['hash'=>$hash])}}", function (data) {

                if (data.length) {
                    $('#translation-loader').hide();

                    data.map((item) => {
                        $('#actions').append(`<a class="btn btn-success" href="/download-file?file=${item.file}">Download and Consume the translation in the document format</a>`);
                    })

                    $('#actions').append(`<a class="btn btn-success m-1" href="/hire-translator/{{$hash}}">Hire Translator to Make the Document Production Ready</a>`);

                    $('#actions').append(`<a href="{{route('ai-home')}}" class="btn btn-primary m-2">Go home</a>`);


                } else {
                    setTimeout(generateDownloadLinks, 5000);
                }


            });
        }

    </script>
@endsection
