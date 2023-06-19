@extends('template')
@section('content')
<div class="container">
    <div class="row">
        <div class="col"></div>
        <div class="col pt-5">
            <form action="{{ url('login') }}" method="POST">
                @csrf
                <input type="password" class="form-control" name="access_key" placeholder="Access Key">
                <button class="btn btn-success mt-2">
                    <i class="fa-solid fa-lock"></i> Login
                </button>
            </form>
        </div>
        <div class="col"></div>
    </div>
</div>
@endsection