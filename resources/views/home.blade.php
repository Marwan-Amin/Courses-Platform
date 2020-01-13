@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
<<<<<<< HEAD

                    You are logged in!
=======
@can('list-teachers')
iam admin
@endcan
>>>>>>> 478984a18f64a3445e593c70eb4aabdde72586aa
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
