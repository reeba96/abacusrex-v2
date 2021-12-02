@if (count($errors))
<div style="margin-top:20px">
  <div class="col-lg-12 alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
</div>
@endif
@if (Session::has('message'))
  <div class="row">
    <div class="col-md-4 col-md-offset-4 alert alert-success">
      {{ Session::get('message') }}
    </div>
  </div>
@endif
