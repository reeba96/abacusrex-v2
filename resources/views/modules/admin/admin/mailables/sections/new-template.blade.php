@extends('admin::admin.layouts.master')

@section('editor', true)

@section('content')

    @if(Session::has('success_message'))
    <div class="alert alert-success">
        <span class="glyphicon glyphicon-ok"></span>
        {!! session('success_message') !!}

        <button type="button" class="close" data-dismiss="alert" aria-label="close">
            <span aria-hidden="true">&times;</span>
        </button>

    </div>
    @endif

    <div class="card">

        <div class="card-header">

            <div class="float-left">
                <h4>{{ trans("translate.templates") }}</h4>
            </div>

        </div>

        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-html" role="tabpanel" aria-labelledby="pills-html-tab">
                <div class="card-columns">

                    @foreach( $skeletons->get('html') as $name => $subskeleton )

                        <div class="card">
                            <div class="content template-item" data-toggle="modal" data-target="#select{{ $name }}Modal">
                            <div class="content-overlay"></div>

                            @if ( file_exists( public_path("vendor/maileclipse/images/skeletons/html/{$name}.png") ) )

                                <img class="content-image card-img-top" src="{{ asset('vendor/maileclipse/images/skeletons/html/'.$name.'.png' ) }}" alt="{{ $name }}">

                            @elseif( file_exists( public_path( "vendor/maileclipse/images/skeletons/html/{$name}.jpg" ) ) )

                                <img class="content-image card-img-top" src="{{ asset('vendor/maileclipse/images/skeletons/html/'.$name.'.jpg' ) }}" alt="{{ $name }}">

                            @else

                            <img class="content-image card-img-top" src="{{ asset('vendor/maileclipse/images/skeletons/no-image.png' ) }}" alt="{{ $name }}">

                            @endif

                            <div class="content-details">
                                <h4 class="content-title mb-3">{{ $name }}</h4>
                                <!-- <p class="content-text">This is a short description</p> -->
                            </div>

                            </div>
                        </div>

                        <!-- Modal -->
                        @foreach($subskeleton as $skeleton)
                            <div class="modal fade" id="select{{ $name }}Modal" tabindex="-1" role="dialog" aria-labelledby="selectTemplateModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="selectTemplateModalLabel">{{ ucfirst($name) }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label='{{ trans("translate.close") }}'>
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>{{ trans("translate.select_template") }}</p>
                                            <div class="list-group list-group-flush">
                                                @foreach($subskeleton as $skeleton)
                                                    <a href="{{ route('newTemplate', ['type' => 'html','name' => $name, 'skeleton' => $skeleton]) }}" class="list-group-item list-group-item-action">{{ $skeleton }}</a>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans("translate.close") }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <!-- End modal -->

                    @endforeach

                </div>

            </div>
            <div class="tab-pane fade" id="pills-markdown" role="tabpanel" aria-labelledby="pills-markdown-tab">
                <div class="card-columns">
                    <!-- markdown -->
                    @foreach( $skeletons->get('markdown') as $name => $subskeleton )
                        <div class="card">
                            <div class="content template-item" data-toggle="modal" data-target="#{{ $name }}Modal">
                                <div class="content-overlay"></div>

                                @if ( file_exists( public_path("vendor/maileclipse/images/skeletons/markdown/{$name}.png") ) )

                                    <img class="content-image card-img-top" src="{{ asset('vendor/maileclipse/images/skeletons/markdown/'.$name.'.png' ) }}" alt="{{ $name }}">

                                @elseif( file_exists( public_path( "vendor/maileclipse/images/skeletons/markdown/{$name}.jpg" ) ) )

                                    <img class="content-image card-img-top" src="{{ asset('vendor/maileclipse/images/skeletons/markdown/'.$name.'.jpg' ) }}" alt="{{ $name }}">

                                @else

                                <img class="content-image card-img-top" src="{{ asset('vendor/maileclipse/images/skeletons/no-image.png' ) }}" alt="{{ $name }}">

                                @endif

                                <div class="content-details">
                                    <h4 class="content-title mb-3">{{ $name }}</h4>
                                </div>

                            </div>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="{{ $name }}Modal" tabindex="-1" role="dialog" aria-labelledby="selectTemplateModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="selectTemplateModalLabel">{{ ucfirst($name) }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label='{{ trans("translate.close") }}'>
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>{{ trans("translate.select_template") }}</p>
                                        <div class="list-group list-group-flush">
                                            @foreach($subskeleton as $skeleton)
                                        <a href="{{ route('newTemplate', ['type' => 'markdown','name' => $name, 'skeleton' => $skeleton]) }}" class="list-group-item list-group-item-action">{{ $skeleton }}</a>
                                        @endforeach
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans("translate.close") }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End modal -->

                    @endforeach
                </div>
            </div>
        </div>

    </div>
   
@endsection