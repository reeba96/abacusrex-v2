@extends('admin::admin.layouts.master')

@section('content')

    @if(Session::has('success_message'))
        <div class="alert alert-success">
            <span class="glyphicon glyphicon-ok"></span>
            {!! session('success_message') !!}

            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>

        </div>
    @elseif(Session::has('error_message'))
        <div class="alert alert-danger">
            <span class="glyphicon glyphicon-ok"></span>
            {!! session('error_message') !!}

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

            <div class="btn-group btn-group-sm float-right" role="group">
                @if (!$templates->isEmpty())
                    <a href="{{ route('selectNewTemplate') }}" class="btn btn-success" title='{{ trans("translate.create") }}'>
                        <i class="fas fa-plus-square"></i>
                    </a>
                @endif  
            </div>

        </div>

        @if ($templates->isEmpty())
            <div class="card-body text-center">
                <span class="mt-4">{{ trans("translate.empty_space") }}</span>
                <a class="btn btn-primary mt-3" href="{{ route('selectNewTemplate') }}">{{ __('Add New Template') }}</a>
            </div>
        @else
        <div class="card-body card-body-with-table">
            <div class="table-responsive">
            <form method="POST" action="{{ route('language_lines.language_lines.filter') }}" id="filter_language_lines" name="filter_language_lines" accept-charset="UTF-8" class="form-horizontal">
                {{ csrf_field() }}
            </form>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">{{ trans("translate.name") }}</th>
                            <th scope="col">{{ trans("translate.description") }}</th>
                            <th scope="col">{{ trans("translate.template") }}</th>
                            <th scope="col">{{ trans("translate.skeleton") }}</th>
                            <th scope="col" class="text-center">{{ trans("translate.type") }}</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($templates->all() as $template)
                        <tr>
                            <td>{{ ucwords($template->template_name) }}</td>
                            <td>{{ $template->template_description }}</td>
                            <td>{{ ucfirst($template->template_view_name) }}</td>
                            <td>{{ ucfirst($template->template_skeleton) }}</td>
                            <td>{{ ucfirst($template->template_type) }}</td>
                            <td>
                                <div class="btn-group btn-group-xs float-right" role="group">
                                    <a href="{{ route('viewTemplate', [ 'templatename' => $template->template_slug ]) }}" class="btn btn-primary" title='{{ trans("translate.edit") }}'>
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="submit" class="btn btn-danger table-action remove-item" data-template-slug="{{ $template->template_slug }}" data-template-name="{{ $template->template_name }}" title='{{ trans("translate.delete") }}'>
                                        <i class="fas fa-trash-alt"></i>
                                    </button> 
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>

        @endif

    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
    <script type="text/javascript">

        $('.remove-item').click(function(){
            var templateSlug = $(this).data('template-slug');
            var templateName = $(this).data('template-name');

            if (confirm('{{ trans("translate.delete_confirm") }} ')) {
                axios.post('{{ route('deleteTemplate') }}', {
                    templateslug: templateSlug,
                })
                .then(function (response) {
            
                    if (response.data.status == 'ok'){
                        // alert('Template deleted successfully!');
            
                        jQuery('tr#template_item_' + templateSlug).fadeOut('slow');
            
                        var tbody = $("#templates_list tbody");
            
                        console.log(tbody.children().length);
            
                        if (tbody.children().length <= 1) {
                            location.reload();
                        }
            
                    } else { alert('Template not deleted!'); }
                })
                .catch(function (error) { alert(error); });
            } 
        });
                    
    </script>

@endsection