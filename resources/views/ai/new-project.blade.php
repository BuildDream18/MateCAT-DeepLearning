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
                            <!-- <option value="Matecat">Matecat</option>
                            <option value="deepl">DeepL</option> -->
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
                            <!-- <h1 id="mt_model" name="mt_model" value="{{ old('mt_model') }}"> -->
                            <input type="text" name="mt_model" value="" id="mt_model_input" hidden>
                            <!-- <h1 id="mt_model_display">{{ old('mt_model') }}</h1> -->
                        </div>
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
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="targetLang" class="form-label">Target Language</label>
                            <select class="form-select" id="targetLang" name="targetLang">
                                <option value="">Select Language</option>
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
                            <pre id="filetype" style="margin-top : 10px;"></pre>
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
    var matecatLanguages = {!! json_encode($Matecat_languages) !!};
    var deeplLanguages = {!! json_encode($DeepL_languages) !!};
    var filetype = document.getElementById("filetype");
    var mt_models = {!! json_encode($mt_models) !!};
    var MTmodelOptions = "";
    var MTmodelSelect = document.getElementById("MTmodel");

    for (const mt_model of mt_models) {
        MTmodelOptions += `<option value="${mt_model.name}">${mt_model.name}</option>`;
    }
    MTmodelSelect.innerHTML = '<option value="">Select Model</option>' + MTmodelOptions;

    function updateModelPage() {
        var mt_model = document.getElementById("mt_model_input");
        var selectedModel = document.getElementById("MTmodel").value;
        var sourceLangSelect = document.getElementById("sourceLang");
        var sourceLangOptions = "";
        var targetLangSelect = document.getElementById("targetLang");
        var targetLangOptions = "";

        if (selectedModel === "Matecat") {
            // Generate options for Matecat languages
            for (const language of matecatLanguages) {
                var isSelected = (language.name === "{{ old('sourceLang') }}");
                sourceLangOptions += `<option value="${language.code}" ${isSelected ? 'selected' : ''}>${language.name}</option>`;
                var isSelected = (language.name === "{{ old('targetLang') }}");
                targetLangOptions += `<option value="${language.code}" ${isSelected ? 'selected' : ''}>${language.name}</option>`;
            }
            filetype.textContent = `Matecat supports a variety of file formats:\nOffice file formats : doc, pages, dot, docx, rtf, pdf, odt, xls, txt, pps, ppt, xml, etc\nWeb file formats : htm, html, xhtml, xml, dtd, json, jsont, yaml, etc\nScanned File formats : pdf, bmp, png, gif, jpeg, jpg, jfif, tiff\nInterchange Formats : xliff, sdlxliff, tmx,ttx, itd, xlf\nDesktop Publishing : mif, idml, icml, xml, dita\n Localization : properties, resx, xml, sxml, txml, dita, Android xml, strings, etc`;
        } else if (selectedModel === "DeepL") {
            // Generate options for DeepL languages
            for (const language of deeplLanguages) {
                var isSelected = (language.name === "{{ old('sourceLang') }}");
                sourceLangOptions += `<option value="${language.language.slice(0, 2)}" ${isSelected ? 'selected' : ''}>${language.name}</option>`;
                var isSelected = (language.name === "{{ old('targetLang') }}");
                targetLangOptions += `<option value="${language.language.slice(0, 2)}" ${isSelected ? 'selected' : ''}>${language.name}</option>`;
            }
            filetype.textContent = `Information about API usage and value ranges\ndocx- Microsoft Word Document\npptx- Microsoft PowerPoint Document\npdf- Portable document format\nhtm / html- HTML documents\ntxt- Plain Text Document\nxlf / xliff- XLIFF Document, version 2.1\nPlease note that with every submitted document of type .pptx, .docx, or .pdf,\nyou are billed a minimum of 50,000 characters with the DeepL API plan, no matter\nhow many characters are included in the document.`;
        } else {
            filetype.textContent = "";
        }

        // Update source and target language dropdown with the generated options
        sourceLangSelect.innerHTML = '<option value="">Select Language</option>' + sourceLangOptions;
        targetLangSelect.innerHTML = '<option value="">Select Language</option>' + targetLangOptions;
        mt_model.value = selectedModel;
    }

    // Call the updateModelPage() initially to populate the target language dropdown
    updateModelPage();
</script>
@endsection
