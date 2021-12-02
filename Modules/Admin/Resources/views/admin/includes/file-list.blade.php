<ul id="sortable">
    @foreach ($all_media as $media)
        <?php
        $name = $media->file_name;
        $ext = $media->extension;
        $file = $name . '.' . $ext;
        $url = "/storage/" . $media->storage . "/" . $file; ?>
        @if (Modules\Admin\Entities\Media::isImage($ext))
        <li class="ui-state-default img-wrap" id='{{$media->id}}'>
            <div class="card">
                <div class="card-header p-1">
                    <button type="button" class="btn btn-primary btn-xs float-left btn_media" style="padding-top:4px;padding-bottom:5px" data-toggle='modal' data-target='#edit_file_modal' data-id="{{$media->id}}" data-file="{{$url}}"><i class="fas fa-edit float-left" ></i> </button>
                    <button type="button" class="btn btn-primary btn-xs float-right btn-danger btn_delete_confirm" data-id="{{$media->id}}" data-url="{{$url}}"><i class="fas fa-trash "></i></button>
                </div>
                <div class="card-body">
                    <img src='{{$url}}' class='media' />
                </div>
            </div>
        </li>
        @else
        <li class="ui-state-default img-wrap" id='{{$media->id}}'>
            <div class="card-header p-1">
                <button type="button" class="btn btn-primary btn-xs float-left btn_media" style="padding-top:4px;padding-bottom:5px" data-toggle='modal' data-target='#edit_file_modal' data-id="{{$media->id}}" data-file="{{$url}}"><i class="fas fa-edit float-left" ></i> </button>
                <button type="button" class="btn btn-primary btn-xs float-right btn-danger"><i class="fas fa-trash "></i></button>
            </div>
            <div class="card-body">
                <img src='/images/text-file-icon.png' class='media' />
            </div>
        </li>
        @endif
    @endforeach
</ul>

<script>
    $(function () {
        var token = '{{ Session::token() }}';

        $("#sortable").sortable({
            update: function () {
                var img_ids = $("#sortable").sortable("toArray");
                $.ajax({
                    method: "POST",
                    url: '{{route("image.sort")}}',
                    data: {ids: img_ids, _token: token}
                }).done(function(msg) {

                });
            }
        });

        $("#sortable").disableSelection();


        $('.btn_delete_confirm').on('click', function() {

            var id = $(this).data('id');
            var url = $(this).data('url');
            var article_id = "{{$article->id}}";
            var storage = "{{$article->title_en}}";
            

            Swal.fire({
                title: '{{__('translate.Are_you_sure')}}',
                text: "{{__('translate.file_will_be_deleted')}}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '{{__('translate.yes')}}',
                cancelButtonText: '{{__('translate.cancel')}}'
                }).then((result) => {
                if (result.value) {
                    $.ajax({
                        method: "POST",
                        url: "{{route('delete-article-image')}}",
                        data: {image_id: id, url: url, _token: token}
                    }).done(function (msg) {
                        if (msg['delete'] == "success") {
                            $('#images').load("{{ route('get-article-images') }}", {article_id: article_id, storage: storage, _token: token, ajax_list : true})
                        } else {
                            console.log("Error deleting picture!");
                        }
                    });
                }
            })
        });

       /* $('.img-wrap .close').on('click', function () {
            var id = $(this).closest('.img-wrap').find('img').data('id');
            var img = $(this).closest('.img-wrap').find('img').data('file');
            var article_id = "{{$article->id}}";
            var storage = "{{$article->title_en}}";
            $.ajax({
                method: "POST",
                url: "{{route('delete-article-image')}}",
                data: {image_id: id, img: img, _token: token}
            }).done(function (msg) {
                if (msg['delete'] == "success") {
                    $('#images').load("{{ route('get-article-images') }}", {article_id: article_id, storage: storage, _token: token, ajax_list : true})
                } else {
                    console.log("Error deleting picture!");
                }
            });
        });
        */

    
    });
</script>