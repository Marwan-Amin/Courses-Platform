@extends('Layout.admin')


@section("content")
<section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"> All Courses created in the system </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>id</th>
                  <th>Course name</th>
                  <th>price</th>
                  <th>Start date</th>
                  <th>End date</th>
                  <th>Teacher</th>
                  <th></th>
                  <th></th>
                  <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($Courses as $index => $value)  
                 <tr>
                    <th scope="row">{{$value['id']}}</th>
                      <td>{{$value['name']}}</td>
                      <td>{{$value['price']*0.01}} $</td>
                      <td>{{$value['start_at']}}</td>
                      <td>{{$value['end_at']}}</td>
                      <td></td>
                      <td class="project-actions text-center">
                          <a class="btn btn-success btn-sm" href="{{route('courses.show',['course' => $value['id']])}}">
                            <i class="fas fa-folder"></i>
                            View
                          </a>
                      </td>
                      <td class="project-actions text-center">
                          <a  class="btn btn-primary btn-sm" href="{{route('courses.edit',['course' => $value['id']])}}">
                            <i class="fas fa-pencil-alt""></i>  
                            Edit
                          </a>
                      </td>
                      <td class="project-actions text-center">
                          <form action="/courses/{{$value['id']}}" method="POST">
                              @csrf 
                              @method('DELETE') 
                              <button class="btn btn-danger btn-sm" type=submit onclick="return confirm('Dou you want to delete this courses?')" >
                                Delete
                              </button> 
                          </form>
                      </td>  
                 </tr>
                @endforeach
                
                </tbody>
              </table>
            </div>
</div>
</div>
</div>
</section>
@endsection