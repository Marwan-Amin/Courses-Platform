@extends('Layout.admin')
@section('content')

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6 mx-auto mt-3">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Add User</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" action="/admin/user" method="post" enctype="multipart/form-data">
              @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">National Id</label>
                  <input type="number" class="form-control" name="Nid" id="exampleInputNID" placeholder="Enter User N_id">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Name</label>
                  <input type="text" class="form-control" name="name" id="exampleInputName" placeholder="Enter User Name">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Email address</label>
                  <input type="email" class="form-control" name="email" id="exampleInputEmail" placeholder="Enter User email">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Password</label>
                  <input type="password" class="form-control" name="password" id="exampleInputPassword" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Gender</label><br>
                    <input type="radio" name="gender" value="male"> Male<br>
                    <input type="radio" name="gender" value="female"> Female<br>                  
                  </div>
                
                <div class="form-group">
                  <label for="exampleInputEmail1">User Role</label><br>
                  <input type="radio" name="role" value="teacher">Teacher<br>
                  <input type="radio" name="role" value="supporter">Supporter<br>
                  <input type="radio" name="role" value="student">Student<br>                
                </div>
                
                <div class="form-group">
                  <label for="exampleInputEmail1">Birth Date</label><br>
                  <input type="date" name="birth" value="teacher">
                </div>
                  
                  <div class="form-group">
                  <label for="exampleInputFile">File input</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="avatar" id="exampleInputFile">
                      <label class="custom-file-label" for="exampleInputFile">Avatar Image</label>
                    </div>
                  </div>
                </div>
                
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Add User</button>
              </div>
            </form>
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div>
  </section>

@endsection