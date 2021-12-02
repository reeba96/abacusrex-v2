@extends ('admin::admin.layouts.master')



@section('content')

<?php
  $title = 'title_' . app()->getLocale();
?>
{{-- Include chart.js CDN --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

<div class="content">
  <h2>{{trans('translate.home') }}</h2>
</div>


@if (session('error_msg'))
    <div class="alert alert-danger">
        {{ trans(session('error_msg')) }}
    </div>
@endif

<section class="content">
  <div>
      <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?=$user_count?></h3>
                <p style="text-transform:capitalize">{{trans('translate.users') }}</p>
              </div>
              <div class="icon">
                <i class="far fa fa-users  nav-icon"></i>
              </div>
              <a href="{{ route('users.user.index') }}" class="small-box-footer">{{trans('translate.more_info') }} <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3></h3>
                <p>{{trans('translate.transactions') }}</p>
              </div>
              <div class="icon">
                  <i class="nav-icon fas fa-school"></i>
              </div>
              <a href="#" class="small-box-footer">{{trans('translate.more_info') }}  <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?=$invitation_count?></h3>
                <p>{{trans('translate.invitations') }}</p>
              </div>
              <div class="icon">
                  <i class="nav-icon fas fa-chalkboard-teacher"></i>
              </div>
              <a href="{{ route('invitations.invitation.index') }}" class="small-box-footer">{{trans('translate.more_info') }}  <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3></h3>
                <p>{{trans('translate.rfid') }}</p>
              </div>
              <div class="icon">
                  <i class="nav-icon fa fa-address-card"></i>
              </div>
              <a href="#" class="small-box-footer">{{trans('translate.more_info') }}  <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
  </div>
</section>


@endsection
