@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session('success'))
            <div class="alert alert-success">
                <p>{{ session('success') }}</p>
            </div>
            @endif
            <br>
            <div class="card">
                <div class="card-header bg-primary text-white"><b>{{ __('Register') }}</b></div>

                <div class="card-body bg-info">
                    <form method="POST" action="{{url('/register/store') }}" enctype="multipart/form-data" >
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right"><b>{{ __('E-Mail Address') }}</b></label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right"><b>{{ __('Password') }}</b></label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right"><b>{{ __('Confirm Password') }}</b></label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right"><b>{{ __('Name') }}</b></label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right"><b>{{ __('description') }}</b></label>

                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control" name="description" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <b><label><font color="purple"> Choose file for upload: </font></b></label><br>
                            <input type="file" name="image" />
                            <span class="text-muted">jpg, png, gif</span><br><br>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-success">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 