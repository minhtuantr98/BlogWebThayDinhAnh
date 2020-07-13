@extends('layouts/app')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading"><h1>{{ "Change Password" }}</h1></div>
    @if (count($errors) > 0)
    <div class="alert alert-danger">
      <strong>Sorry !</strong> There were some problems with your input.<br><br>
      <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif

      @if(session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div> 
      @endif
    <div class="panel-body">
        <br>
        <form method="POST" action="/user/password/{{ Auth::user()->id }}">
            @csrf
            {{ method_field('PUT') }}
            <div class="form-group row">
                <label for="password-old" class="col-md-4 col-form-label text-md-right">{{ __('Old Password') }}</label>
        
                <div class="col-md-6">
                    <input id="password-old"  type="password" class="form-control" name="old_password" required >
                </div>
            </div>
            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
        
                <div class="col-md-6">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
        
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        
            <div class="form-group row">
                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
        
                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>
            </div>
            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Change') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection