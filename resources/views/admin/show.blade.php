@extends('Layout.admin')
@section('content')


<h3 class="mt-4 mb-4">Profile</h3>
<div class="container">


<div class="col-md-6">

          <!-- Profile Image -->
          <div class="box box-primary text-center">
            <div class="box-body box-profile">
              <img class="profile-user-img img-circle" src="{{asset($user->avatar)}}" alt="User profile picture">

              <h3 class="profile-username text-center">{{$user->name}}</h3>

              <p class="text-muted text-center">{{$user->roles}}</p>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary text-center">
            <div class="box-header with-border">
              <h3 class="box-title">About user</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong>  Email</strong>

              <p class="text-muted">
              {{$user->email}}   
              </p>

              <hr>

              <strong> Gender</strong>

              <p class="text-muted">{{$user->gender}}</p>

              <hr>

            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
</div>


</div>

@endsection