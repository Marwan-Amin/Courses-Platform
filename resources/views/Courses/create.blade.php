@extends('Layout.layout');

@section("content")

<section class="content">
      <div class="row">
        <div class="col-md-6 mx-auto mt-5">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Enter new course information</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>

            <form action = "/courses" enctype="multipart/form-data" method="POST">
@csrf
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
            <div class="card-body" style="display: block;">
              <div class="form-group">
                <label for="inputName">Course Name</label>
                <input type="text" id="Course name"  name="name" class="form-control">
              </div>
              <div class="form-group">
                <label for="inputName">Choose course image</label><br>
                  <input type="file" id="myFile" name="image">
              </div>
              <div class="form-group">
                <label for="inputClientCompany">Price</label>
                <input type="integer" id="price" name="price" class="form-control">
              </div>
              <div class="form-group">
                <label for="inputProjectLeader">Course starts at</label>
                <input type="datetime-local" id="start_at" name="start_at" class="form-control">
              </div>
              <div class="form-group">
                <label for="inputProjectLeader">Course ends at</label>
                <input type="datetime-local" id="end_at" name="end_at" class="form-control">
              </div>

          </div>
      </div>
      <div class="row">
        <div class="col-12">
          <a href="/courses" class="btn btn-secondary">Cancel</a>
          <input type="submit" value="Create new course" class="btn btn-success float-right">
        </div>
      </div>
      </form>
    </section>

@endsection