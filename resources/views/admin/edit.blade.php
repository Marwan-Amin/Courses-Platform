@extends('layouts.admin')
@section('content')

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Edit User</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" action="/admin/{{$user->id}}" method="post" enctype="multipart/form-data">
              @method('PATCH')
              @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">National Id</label>
                  <input type="number" class="form-control" name="Nid" value={{$user->Nid}} id="exampleInputNID" placeholder="Enter User N_id">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Name</label>
                  <input type="text" class="form-control" name="name" value={{$user->name}} id="exampleInputName" placeholder="Enter User Name">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Email address</label>
                  <input type="email" class="form-control" name="email" value={{$user->email}} id="exampleInputEmail" placeholder="Enter User email">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Password</label>
                  <input type="password" class="form-control" name="password" value={{$user->password}} id="exampleInputPassword" placeholder="Password">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">User Role</label><br>
                  <input type="radio" name="role" value="teacher" {{$role=$user->roles=="teacher"?"checked":''}}>Teacher<br>
                  <input type="radio" name="role" value="supporter" {{$role=$user->roles=="supporter"?"checked":''}}>Supporter<br>  
                  <input type="radio" name="role" value="supporter" {{$role=$user->roles=="student"?"checked":''}}>Student<br>              
                </div>
                <div class="form-group">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Gender</label><br>
                    <input type="radio" name="gender" value="male" {{$gender=$user->gender=="male"?"checked":''}}> Male<br>
                    <input type="radio" name="gender" value="female" {{$role=$user->gender=="female"?"checked":''}}> Female<br>                  
                  </div>
                  <div class="form-group">
                  <label for="exampleInputFile">File input</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="avatar" value={{$user->avatar}} id="exampleInputFile">
                      <label class="custom-file-label" for="exampleInputFile">Avatar Image</label>
                    </div>
              
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button class="btn btn-primary" type="submit">Update User</button>              
              </div>
            </form>
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div>
  </section>

@endsection