@extends('Layout.admin')


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

            <form action="/courses/{{$aabb->id}}" enctype="multipart/form-data" method="POST" >
@csrf
{{ method_field('PUT') }}

            <div class="card-body" style="display: block;">
              <div class="form-group">
                <label for="inputName">Course Name</label>
                <input type="text" id="Course name" class="form-control" name="name"  value="{{$aabb->name}}">
              </div>
              <div class="form-group">
                <label for="inputName">Choose course image</label><br>
                  <input type="file" id="myFile" name="image" value="{{$aabb->cover_image}}">
              </div>
              <div class="form-group">
                <label for="inputClientCompany">Price</label>
                <input type="integer" id="price" class="form-control"  name="price" value="{{$aabb->price}}">
              </div>
              <div class="form-group">
                <label for="inputProjectLeader">Course starts at</label>
                <input type="datetime-local" id="start_at" class="form-control"  name="start_at"  value="{{$aabb->start_at}}>
              </div>
              <div class="form-group">
                <label for="inputProjectLeader">Course ends at</label>
                <input type="datetime-local" id="end_at" class="form-control"  name="end_at" value="{{$aabb->end_at}}">
              </div>
              <div class="form-group">
                <label for="inputProjectLeader">Assign course to:</label>
                <select name="teacher" class="form-control" id="teacher">
                <option value="{{$aabb->teacher_id}}">{{$aabb->teacher_id}}</option>
                
              </select>
              </div>

              

          </div>
      </div>
      <div class="row">
        <div class="col-12">
          <a href="/courses" class="btn btn-secondary">Cancel</a>
          <input type="submit" value="update course" class="btn btn-success float-right">
        </div>
      </div>
      </form>
    </section>

@endsection