@extends('layouts.app')

@section('title', 'Barangay Lucbuban')

@section('content')
  <div class="d-flex justify-content-center align-items-center welcome-page">
    <form class="text-center" action="{{route('login')}}" method="POST">
      @csrf
      <img class="w-25 img-fluid" src="{{asset('images/user.png')}}" alt="logo">
      <h1 class="text-white">Barangay Lucbuban</h1>
      @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif
      <div class="form-group my-2">
        <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email">
      </div>
      <div class="form-group my-2">
        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password">
      </div>
      <div class="form-group my-2">
        <input type="submit" class="btn btn-dark w-100" placeholder="Password">
      </div>
    </form>
  </div>
@endsection