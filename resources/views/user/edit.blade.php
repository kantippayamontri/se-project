@extends('layouts.app')
@section('title','User Edit')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session('success'))
            <div class="alert alert-success">
                <p>{{ session('success') }}</p>
            </div>
            @endif
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{url('/user/update' , $id) }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{$user->name}}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('description') }}</label>

                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control" name="description" value="{{$user->description}}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="point" class="col-md-4 col-form-label text-md-right" >Point</label>
                            <div class="col-md-6">
                                <input class="form-control" type="number" id="point" name="point" value="{{$user->point}}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="money" class="col-md-4 col-form-label text-md-right" >Money</label>
                            <div class="col-md-6">
                                <input class="form-control" type="money" id="point" name="money" value="{{$user->money}}" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label> Choose file for upload: </label><br>
                            <input type="file" name="image" />
                            <span class="text-muted">jpg, png, gif</span><br><br>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                            <input type="hidden" name="_method" value="PATCH" />
                                <button type="submit" class="btn btn-primary">
                                    {{ __('EDIT') }}
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