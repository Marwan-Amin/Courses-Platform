@extends('layouts.admin')
@section('content')
<h3 class="mt-4 mb-4">Social Widgets</h3>

<div class="row">
  <div class="col-md-4">
    <!-- Widget: user widget style 2 -->
    <div class="card card-widget widget-user-2">
      <!-- Add the bg color to the header using any of the bg-* classes -->
      <div class="widget-user-header bg-warning">
        <div class="widget-user-image">
        <img class="img-circle elevation-2" src="" alt="User Avatar">
        </div>
        <!-- /.widget-user-image -->
        <h3 class="widget-user-username">{{$user->name}}</h3>
        <h5 class="widget-user-desc">{{$user->roles}}</h5>
      </div>
      <div class="card-footer p-0">
        <ul class="nav flex-column">
          <li class="nav-item">
              Nid <span class="float-right badge bg-primary">{{$user->Nid}}</span>
          </li>
          <li class="nav-item">
              Email <span class="float-right badge bg-info">{{$user->email}}</span>
          </li>
          <li>
            <a class="btn btn-primary" href="{{route('admin.index',["value"=>"all"])}}" role="button">Show All Users</a>
          </li>
        </ul>
      </div>
    </div>
    <!-- /.widget-user -->
  </div>

@endsection