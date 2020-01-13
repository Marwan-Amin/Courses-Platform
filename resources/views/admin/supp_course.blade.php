@extends('Layout.admin')

@section("content")
<section class="content">
      <div class="row">
        <div class="col-md-6 mx-auto mt-5">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Assign Course To a Supporter</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>

            <form action = "/courses" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="form-group">
                <label for="inputProjectLeader">Choose Course:</label>
                <select name="course" class="form-control" id="course">
                @foreach ($courses as $course)
                <option value="{{$course->id}}">{{$course->name}}</option>
                @endforeach
              </select>
              </div>

              <div class="form-group">
                <label for="inputProjectLeader">Assign course to:</label>
                <select name="supporter" class="form-control" id="supporter">
                @foreach ($supporters as $supporter)
                <option value="{{$supporter->id}}">{{$supporter->name}}</option>
                @endforeach 
              </select>
              </div>

          </div>
      <div class="row">
        <div class="col-12">
          <input type="submit" value="Assign course" class="btn btn-success">
        </div>
      </div>
      </form>
    </section>

@endsection