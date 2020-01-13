@extends('Layout.admin')


@section('content')
<div class="container">




<div class="card">
  <img src="{{asset($aaaa->cover_image)}}" height="500px" class="card-img-top" alt="img1">
  <div class="card-body">
    <h1 >Course name: {{$aaaa->name}} </h1>
    <h1 >Price: {{$aaaa->price *0.01}} $</h1>
    <h1 >Course will start at: {{$aaaa->start_at}} </h1>
    <h1 >Course will end at: {{$aaaa->end_at}} </h1>
  </div>
</div>

</div>
</div>


@endsection