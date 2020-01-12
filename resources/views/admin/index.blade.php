@extends('layouts.admin')
@section('content')

 <!-- Main content -->
 <section class="content">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">DataTable Of {{$value}}</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example2" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>Name </th>
                <th>Email</th>
                <th>Avatar</th>
                <th>Role</th>
                <th></th>
                <th></th>
              </tr>
              </thead>
              <tbody>
                @foreach ($users as $user)
              <tr>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td><img width=100px height=100px src={{asset($user->avatar)}} ></td>
                <td>{{$user->roles}} </td>
                <td><a class="btn btn-primary" href="{{route('admin.edit',$user->id)}}" role="button">Edit</a>
                  <a class="btn btn-primary" href="{{route('admin.show',$user->id)}}" role="button">view</a></td></td>
                <td><form method="POST" action="/admin/{{$user->id}}"> 
                  @csrf
                  @method('delete')
                  <button class="btn btn-danger" type="submit" onclick="return confirm('Do you really want to delete?');">Delete</button></form> </td>
              </tr>
              @endforeach
            </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
 </section>
{{$users->links()}}
@endsection