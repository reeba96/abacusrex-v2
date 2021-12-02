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
    @endif

    <div class="card">

        <div class="card-header">

            <div class="float-left">
                <h4>{{ __('Mailables') }}</h4>
            </div>

            <div class="btn-group btn-group-sm float-right" role="group">
                <a href="#newMailableModal" class="btn btn-success" data-toggle="modal" data-target="#newMailableModal" title="Create New Mailable">
                    <i class="fas fa-plus-square"></i>
                </a> 
            </div>

        </div>

        @if ($mailables->isEmpty())
            <div class="card-body text-center">
                <h4>{{ trans("translate.empty_space") }}</h4><button class="btn btn-primary mt-3" data-toggle="modal" data-target="#newMailableModal">{{ __('Add New Mailable') }}</button>
            </div>
        @else
        <div class="card-body card-body-with-table">
            <div class="table-responsive">
            <form method="POST" action="{{ route('language_lines.language_lines.filter') }}" id="filter_language_lines" name="filter_language_lines" accept-charset="UTF-8" class="form-horizontal">
                {{ csrf_field() }}
            </form>
                <table id="mailables_list" class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">{{ __('Name') }}</th>
                            <th scope="col">{{ __('Namespace') }}</th>
                            <th scope="col">{{ __('Last edited') }}</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mailables->all() as $mailable)
                        <tr id="mailable_item_{{ $mailable['name'] }}">
                            <td>{{ $mailable['name'] }}</td>
                            <td>{{ $mailable['namespace'] }} </td>
                            <td>{{ (\Carbon\Carbon::createFromTimeStamp($mailable['modified']))->diffForHumans() }}</td>
                            <td>
                                <div class="btn-group btn-group-xs float-right" role="group">
                                    <a href="{{ route('viewMailable', ['name' => $mailable['name']]) }}" class="btn btn-info" title="Show Mailable">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="#" class="table-action remove-item" data-mailable-name="{{ $mailable['name'] }}">
                                        <button class="btn btn-danger" title="Delete Mailable"><i class="fas fa-trash-alt"></i></button>
                                    </a>
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
    <div class="modal fade" id="newMailableModal" tabindex="-1" role="dialog" aria-labelledby="newMailableModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="create_mailable" action="{{ route('generateMailable') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Mailable</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                <div class="alert alert-warning new-mailable-alerts d-none" role="alert">
        
                </div>
                    <div class="form-group">
                    <label for="mailableName">Name</label>
                    <input type="text" class="form-control" id="mailableName" name="name" placeholder="Mailable name" required>
                    <small class="form-text text-muted">Enter mailable name e.g <b>Welcome User</b>, <b>WelcomeUser</b></small>
                    </div>
                    <div class="form-group">
                    <label class="checkbox-inline">
                        <input type="checkbox" id="markdown--truth" value="option1"> Markdown Template
                        <small class="form-text text-muted">Use markdown template</small>
                    </label>
                </div>
                <div class="form-group markdown-input" style="display: none;">
                    <label for="markdownView">Markdown</label>
                    <input type="text" class="form-control" name="markdown" id="markdownView" placeholder="e.g markdown.view">
                </div>
        
                <div class="form-group">
                    <label class="checkbox-inline">
                        <input type="checkbox" id="forceCreation" name="force"> Force
                        <small class="form-text text-muted">Force mailable creation even if already exists</small>
                    </label>
                </div>
                </form>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Create Mailable</button>
                </div>
            </div>
            </form>
        </div>
    </div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script type="text/javascript">

        $(document).ready(function(){

            if ($('#markdown--truth').is(':checked')) { $('.markdown-input').show(); } else { $('.markdown-input').hide(); }
    
            $('#markdown--truth').change(
                function(){ if ($(this).is(':checked')) { $('.markdown-input').show(); } else { $('.markdown-input').hide(); } });
    
                $('.remove-item').click(function(){
                    var mailableName = $(this).data('mailable-name');


                    if (confirm('Are you sure you want to delete mailable '+ mailableName +' ?')) {
                        axios.post('{{ route('deleteMailable') }}', {
                            mailablename: mailableName,
                        })
                        .then(function (response) {
                            if (response.data.status == 'ok'){
                                alert('Mailable deleted'); 
                                jQuery('tr#mailable_item_' + mailableName).fadeOut('slow');
            
                                var tbody = $("#mailables_list tbody");
            
                                if (tbody.children().length <= 1) { location.reload(); }
                            } else { alert('Mailable not deleted'); }
                        })
                        .catch(function (error) { alert(error) });
                    }

                })
    
            });

    
            $('form#create_mailable').on('submit', function(e){
                e.preventDefault();
                if ( $('input#markdown--truth').is(':checked') && $('#markdownView').val() == ''){
                    $('#markdownView').addClass('is-invalid');
                    return;
                }
                axios.post( $(this).attr('action'), $(this).serialize() )
        
                .then(function (response) {
                    if (response.data.status == 'ok')
                    {
                        $('#newMailableModal').modal('toggle');
                        alert(response.data.message);
        
                        setTimeout(function(){ location.reload(); }, 1000);
                    } else {
                        $('.new-mailable-alerts').text(response.data.message);
                        $('.new-mailable-alerts').removeClass('d-none');
                    }
                })
        
                .catch(function (error) { alert(error); });
        
        });

    </script>
    
@endsection