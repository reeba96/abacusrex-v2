
@extends ('admin::admin.layouts.master')

@section ('content')

<div class="content" style="position: relative;">
  	
    <div>
        <h2>{{ trans("translate.modules") }}</h2><br>
    </div>
 
    <div id='ajax-loader' style="display: none;">
        
      </div>

    <div class="row">
        <div id="colOne" class="col-md-3">
            <div id="banners" class="panel panel-success">	
                <div class="panel-heading">
                <h3 class="panel-title">{{ trans("translate.installed_modules") }}</h3>
                </div>

                <div class="panel-body">
                    <ul id="slideshow" class="list-group sortable sortable-disabled ui-sortable">
                        
                        @foreach ($installed as $key => $module)
                            <li class="list-group-item sortable-handle ui-sortable-handle">
                                <div class="row">
                                    <div class="col-md-5">
                                        <p class="cursor"  data-id="{{ $key }}">{{ $module }}</p>
                                    </div>
                                    
                                    <div class="col-md-6 pull-right install-module-button">
                                        
                                       <a href="{{ route('module.uninstall',$module)}}">
                                            <span class="label label-danger uninstall" id="{{ $module }}" style="font-size:80%;"> {{ trans("translate.uninstall") }}</span>
                                       </a>
                                             
                                               
                                        
                                    </div>
                                </div>
                            </li>
                        @endforeach
                        
                    </ul>
                </div>
            </div><br>
          
            <div id="banners" class="panel panel-info">	
                <div class="panel-heading">
                <h3 class="panel-title">{{ trans("translate.available_modules") }}</h3>
                </div>

                <div class="panel-body">
                    <ul id="slideshow" class="list-group sortable sortable-disabled ui-sortable">
                        
                        @foreach ($not_installed as $key => $module)
                            <li class="list-group-item sortable-handle ui-sortable-handle">
                                <div class="row">
                                    <div class="col-md-5">
                                        <p class="cursor"  data-id="{{ $key }}">{{ $module }}</p>
                                    </div>
                                    
                                    <div class="col-md-6 pull-right install-module-button">
                                        
                                       <a href="{{ route('module.install',$module)}}">
                                            <span class="label label-success install" id="{{ $module }}" style="font-size:80%;"> {{ trans("translate.install") }}</span>
                                       </a>
                                             
                                               
                                        
                                    </div>
                                </div>
                            </li>
                        @endforeach
                        
                    </ul>
                </div>
            </div>
            
            
        </div>	
        
        <div id="colTwo" class="col-md-offset-1 col-md-5 center"></div>
        
    </div>
</div>	<!-- end of content -->

<script>
    
    $(function() {
       
  /*     $(document).on('click', '.install', function() {
          //  $('#ajax-loader').show();
            var id = $(this).attr('id');
            $(".content").load('install-modules/' + id);
            
        });
        */
        $(document).on('click', '.cursor', function() {
            var id = $(this).attr('data-id');
            url = 'get-module-information/' + id;
            $('#colTwo').load(url); 
        });
       
    });
    
</script>

@endsection 
