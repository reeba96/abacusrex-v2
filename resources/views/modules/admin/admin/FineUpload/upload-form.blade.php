<!DOCTYPE html>
<html>
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Fine Uploader New/Modern CSS file
        ====================================================================== -->
        <link href="/admin/fine-uploader/jquery.fine-uploader/fine-uploader-new.css" rel="stylesheet">

        <!-- Fine Uploader JS file
        ====================================================================== -->
        <script src="/admin/fine-uploader/jquery.fine-uploader/fine-uploader.js"></script>

        <!-- Fine Uploader Thumbnails template w/ customization
        ====================================================================== -->
        <script type="text/template" id="qq-template-manual-trigger">
            <div class="qq-uploader-selector qq-uploader" qq-drop-area-text="Drop files here">
                <div class="qq-total-progress-bar-container-selector qq-total-progress-bar-container">
                    <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="qq-total-progress-bar-selector qq-progress-bar qq-total-progress-bar"></div>
                </div>
                <div class="qq-upload-drop-area-selector qq-upload-drop-area" qq-hide-dropzone>
                    <span class="qq-upload-drop-area-text-selector"></span>
                </div>
                <div class="buttons">
                    <div class="qq-upload-button-selector qq-upload-button">
                    <div>{{trans('translate.select_files') }}</div>
                </div>
                <button type="button" id="trigger-upload" class="btn btn-success">
                    <i class="fas fa-upload"></i> {{trans('translate.upload') }}
                </button>
            </div>
            <span class="qq-drop-processing-selector qq-drop-processing">
                <span>{{trans('translate.processing_dropped_files') }}</span>
                <span class="qq-drop-processing-spinner-selector qq-drop-processing-spinner"></span>
            </span>
            <ul class="qq-upload-list-selector qq-upload-list" aria-live="polite" aria-relevant="additions removals">
                <li>
                    <div class="qq-progress-bar-container-selector">
                        <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="qq-progress-bar-selector qq-progress-bar"></div>
                    </div>
                    <span class="qq-upload-spinner-selector qq-upload-spinner"></span>
                    <img class="qq-thumbnail-selector" qq-max-size="100" qq-server-scale>
                    <span class="qq-upload-file-selector qq-upload-file"></span>
                    <span class="qq-edit-filename-icon-selector qq-edit-filename-icon" aria-label="Edit filename"></span>
                    <input class="qq-edit-filename-selector qq-edit-filename" tabindex="0" type="text">
                    <span class="qq-upload-size-selector qq-upload-size"></span>
                    <button type="button" class="qq-btn qq-upload-cancel-selector qq-upload-cancel">{{trans('translate.cancel') }}</button>
                    <button type="button" class="qq-btn qq-upload-retry-selector qq-upload-retry">{{trans('translate.retry') }}</button>
                    <button type="button" class="qq-btn qq-upload-delete-selector qq-upload-delete">{{trans('translate.delete') }}</button>
                    <span role="status" class="qq-upload-status-text-selector qq-upload-status-text"></span>
                </li>
                </ul>

                <dialog class="qq-alert-dialog-selector">
                    <div class="qq-dialog-message-selector"></div>
                    <div class="qq-dialog-buttons">
                        <button type="button" class="qq-cancel-button-selector">{{trans('translate.close') }}</button>
                    </div>
                </dialog>

                <dialog class="qq-confirm-dialog-selector">
                    <div class="qq-dialog-message-selector"></div>
                    <div class="qq-dialog-buttons">
                        <button type="button" class="qq-cancel-button-selector">{{trans('translate.no') }}</button>
                        <button type="button" class="qq-ok-button-selector">{{trans('translate.yes') }}</button>
                    </div>
                </dialog>

                <dialog class="qq-prompt-dialog-selector">
                    <div class="qq-dialog-message-selector"></div>
                    <input type="text">
                    <div class="qq-dialog-buttons">
                        <button type="button" class="qq-cancel-button-selector">{{ trans('transalte.cancel') }}</button>
                        <button type="button" class="qq-ok-button-selector">{{trans('translate.ok') }}</button>
                    </div>
                </dialog>
            </div>
        </script>

        <style>
            #trigger-upload {
                color: white;
              
                font-size: 14px;
                padding: 7px 20px;
                background-image: none;
            }

            #fine-uploader-manual-trigger .qq-upload-button {
                margin-right: 15px;
            }

            #fine-uploader-manual-trigger .buttons {
                width: 36%;
            }

            #fine-uploader-manual-trigger .qq-uploader .qq-total-progress-bar-container {
                width: 60%;
            }
            #sortable { list-style-type: none; margin: 0; padding: 0; width: 450px; }
            #sortable li { margin: 3px 3px 3px 0; padding: 1px; float: left; width: 100px; height: 90px; font-size: 17px; text-align: center; }

            

            

</style>

<title></title>
</head>
<body>
<!-- Fine Uploader DOM Element
====================================================================== -->
<div id="fine-uploader-manual-trigger"></div>
<div id="images">
    @include('admin::admin.includes.file-list',['all_media'=>$all_media])
</div>

<!-- Your code to create an instance of Fine Uploader and bind to the DOM/template
====================================================================== -->
<script>
$(function () {
    var token = '{{ Session::token() }}';

    
    var manualUploader = new qq.FineUploader({
        element: document.getElementById('fine-uploader-manual-trigger'),
        template: 'qq-template-manual-trigger',
        request: {
            //endpoint: "/upload-endpoint/endpoint.php",
            endpoint: "{{ route('file.upload') }}",
            customHeaders: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            params: {
                "folder": 'article', // "{{$article->title_en}}",
                "article_id": "{{$article->id}}"
            }
        },
        thumbnails: {
            placeholders: {
                waitingPath: '/node-modules/fine-uploader/placeholders/waiting-generic.png',
                notAvailablePath: '/node-modules/fine-uploader/placeholders/not_available-generic.png'
            }
        },
        validation: {
            itemLimit: 10,
            sizeLimit: 20000000 // 50 kB = 50 * 1024 bytes, 10 000 000 => 10M
        },
        callbacks: {
            onComplete: function () {
                var id = "{{$article->id}}";
                var storage = "{{$article->title_en}}";
                $('#images').load("{{ route('get-article-images') }}", {article_id: id, storage: storage, _token: token, ajax_list : true});

            }
        },
        autoUpload: false,
        debug: true
    });

    qq(document.getElementById("trigger-upload")).attach("click", function () {
        manualUploader.uploadStoredFiles();
    });
        });
        </script>
    </body>
</html>
