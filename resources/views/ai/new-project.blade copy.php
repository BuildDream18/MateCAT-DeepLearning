@extends('ai.site.global')

@section('title','New Project')
@section('page')
<div class="site-wrapper-reveal">


    <div class="section-space--ptb_120">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-6 text-center">
                    <h4 class="mb-5">AI Translation Tool</h4>

                    <div class="mb-5">
                        <label for="model" class="form-label">Choose the model that is right for your use.</label>
                        <select class="form-select" id="MTmodel" name="MTmodel" onchange="updateModelPage()">
                            <option value="default" selected>Select Model</option>
                            <option value="Matecat">Matecat</option>
                            <option value="deepl">DeepL</option>
                            </select>
                        </select>
                    </div>

                    <img src="/assets/images/box-image/free_ai_translation_tool_square.png" width="330" height="330"
                        class="img-fluid mb-5" alt="">
                </div>

                <!-- <div id="modelpage" class="col-lg-6">
                    <div style = "background-color:lightgreen; border-radius:10px; padding:10% 10% 10% 10%; height:400px; ">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</div>
                </div> -->

                <div class="col-lg-6">
                    <form enctype="multipart/form-data" method="post" action="{{route('new-project')}}">
                        @csrf
                        <div class="mb-3">
                            <label for="projectName" class="form-label">Project Name</label>
                            <input type="text" name="projectName" class="form-control" id="projectName"
                                placeholder="Project Name" value="{{ old('projectName') }}">
                            @error('projectName')
                            <div class="d-flex invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="sourceLang" class="form-label">Source Language</label>
                            <select class="form-select" id="sourceLang" name="sourceLang">
                                <option value="">Select Language</option>
                                @foreach($languages as $language)
                                <option value="{{$language['name']}}"
                                    {{ old('sourceLang')===$language['name']?'selected':null}}>{{$language['name']}}
                                </option>
                                @endforeach
                            </select>
                            @error('sourceLang')
                            <div class="d-flex invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="targetLang" class="form-label">Target Language</label>
                            <select class="form-select" id="targetLang" name="targetLang">
                                <option value="">Select Language</option>
                                @foreach($languages as $language)
                                <option value="{{$language['name']}}"
                                    {{ old('targetLang')===$language['name']?'selected':null}}>{{$language['name']}}
                                </option>
                                @endforeach
                            </select>
                        </div>


                        <div class="mb-3">
                            <label for="ownerEmail" class="form-label">Email</label>
                            <input type="text" name="ownerEmail" class="form-control" id="ownerEmail"
                                placeholder="Email" value="{{ old('ownerEmail') }}">
                            @error('ownerEmail')
                            <div class="d-flex invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="files" class="form-label">Files</label>
                            <input id="files" class="form-control" type="file" name="files[]" multiple>
                            @error('files')
                            <div class="d-flex invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <hr class="my-4">
                        <button class="w-100 btn btn-primary btn-lg" type="submit">Next Step</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('customJs')
<script>
    function updateModelPage(){
        var selectedModel = document.getElementById("MTmodel").value;
        var modelPageDiv = document.getElementById("modelpage");
        var langs = [];
        if (selectedModel === "MateCat") {
            $languages = $Matecat_languages;
        } else if (selectedModel === "DeepL") {
            $languages = $DeepL_languages;
        } else {
            $languages = [];
        }
    }
</script>
@endsection
