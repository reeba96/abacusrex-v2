<!DOCTYPE html>

<html>
	<head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
		<link rel="shortcut icon" href="{{ asset('./images/icons/abacus_icon.png') }}" type="image/x-icon">
		@include ('admin::admin.layouts.head')

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script src="/admin/js/jquery-form/dist/jquery.form.min.js"></script>

	 	<!-- <script type="text/javascript" src="/admin/jquery/dist/jquery.min.js"></script> -->

	   	<!-- jQuery Core -->
	  	<!-- <script src="https://code.jquery.com/jquery-2.2.4.js"
	  	integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
	  	<meta name="viewport" content="width=device-width, initial-scale=1"> -->

	  	<!-- jQuery UI
	  	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"
	    integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
		-->

    	<!-- Bootstrap 3.3.7
		<script src="/admin/bootstrap/dist/js/bootstrap.min.js"></script>-->
		<!-- Bootstrap-Confirmation
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-confirmation/1.0.5/bootstrap-confirmation.js"></script>
		-->

		@yield ('css')
		@stack('head-scripts')
		<style>

			.sidebar-mini .brand-link .brand-image {
				max-height: 110% !important;
				margin-left: 11px;
			}

			.sidebar-collapse .brand-link > img {
				display: none;
			}

			.sidebar-collapse .brand-link {
				background: url('/images/alteo_only_logo_transparent.png') center no-repeat;
				margin-left: 7px;
			}

			.sidebar-collapse .brand-link > img:hover {
				display: block;
			}

		  </style>
		  <link rel="stylesheet" href="/css/access.css">
		  <link rel="stylesheet" href="{{ asset('/css/customAdmin.css') }}">
	</head>

	<body class="hold-transition sidebar-mini"> <!-- sidebar collapse removed -->

            <?php //$modules = \Modules\Admin\Entities\CmsModule::getAll(); ?>

		<div class="wrapper"  id="appOFF">

			@include('admin::admin.layouts.header')

			@include ('admin::admin.layouts.sidebar')

			<div class="content-wrapper">
				@yield ('content-header')

				<div class="content mt-3">
					@yield ('content')
				</div>

			</div>

			<footer class="main-footer">
				@include ('admin::admin.layouts.footer')
			</footer>

		</div>

<script src="{{ mix('/js/admin.js') }}"></script>
<script src="{{ mix('/js/all.js') }}"></script>

<!--<script src="{{ asset('js/app.js') }}" defer></script>-->
<script>
    $(function() {
       $.ajaxSetup({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
       });
   });
</script>



	<script type="text/javascript">
	$(function(){
		$(document).ajaxStart(function(){
			$('#ajax-loader').show();
		});

		$(document).ajaxSuccess(function(e, xhr, settings){
			$('#ajax-loader').hide();
				/*var url = settings.url;
				if(settings.type == "GET" && settings.url){
						if(typeof(Storage)!=="undefined"){
						localStorage.where=url;
				}
				}*/
		});
	});
	</script>
	@stack('scripts')

	<div id="ajax-loader" style="display:none"></div>
	</body>
</html>
