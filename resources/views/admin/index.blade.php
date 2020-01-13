@extends('Layout.admin')
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
                <th>Birth date</th>
                <th>Avatar</th>
                <th>Role</th>
                <th></th>
                <th></th>
                <th></th>
              </tr>
              </thead>
              <tbody>
                @foreach ($users as $user)
                
              <tr>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->birth_date}}</td>
                <td class="text-center"><img class="profile-user-img img-circle" width=100px height=100px src={{asset($user->avatar)}} ></td>
                <td>{{$user->roles}} </td>
                <td class="text-center"><a class="btn btn-success btn-sm" href="{{route('admin.show',$user->id)}}" role="button"> <i class="fas fa-folder"></i>  view</a></td>
                <td class="text-center"><a class="btn btn-primary" href="{{route('admin.edit',$user->id)}}" role="button"><i class="fas fa-pencil-alt""></i>   Edit</a></td>
                <td class="text-center"><form method="POST" action="/admin/{{$user->id}}"> 
                  @csrf
                  @method('DELETE')
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