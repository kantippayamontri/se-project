@extends('layouts.app')
@section('title','Edit Promotion')
@section('content')
<h1>Edit Promotion</h1>
<form method="post" action="{{url('promotion/update' , $id)}}" class="main-form" enctype="multipart/form-data">
    {{csrf_field()}}
    <br>
    <h2>Add Promotion</h2>
    @if(count($errors) > 0)
    <!-- กรณีผิดพลาด -->
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @if(\Session::has('success'))
    <!-- กรณีสำเร็จ -->
    <div class="alert alert-success">
        <p>{{ \Session::get('success') }}</p>
    </div>

    @endif
    <br>
    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" class="form-control" id="name" name="name" value="{{$promotion['name']}}">
    </div>
    <div class="form-group">
        <label for="price">Number of Promotion:</label>
        <input class="form-control" type="number" id="number" name="number" value="{{$promotion['number']}}">
    </div>
    <div class="form-group">
        <label for="point">Min Money:</label>
        <input class="form-control" type="number" id="min_money" name="min_money" value="{{$promotion['min_money']}}">
    </div>
    <div class="form-group">
        <label for="point">Percent discount(%) :</label>
        <input class="form-control" type="number" id="percent" name="percent" value="{{$promotion['percent']}}">
    </div>
    <div class="form-group">
        <label for="point">Discount(bath) : </label>
        <input class="form-control" type="number" id="discount" name="discount" value="{{$promotion['discount']}}">
    </div>


    <div class="form-group">
        <label> Choose file for upload: </label><br>
        <input type="file" name="image" />
        <span class="text-muted">jpg, png, gif</span><br><br>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </div>

    <div class="form-group">
        <label for="name">Point:</label>
        <input type="text" class="form-control" id="point" name="point" value="{{$promotion['point']}}">
    </div>

    <div class="form-group">
        <label for="name">Description:</label>
        <input type="text" class="form-control" id="description" name="description" value="{{$promotion['description']}}">
    </div>

    <div class="form-group">
        <input type="hidden" name="_method" value="PATCH" />
        <input type="submit" class="btn btn-primary" value="UPDATE" />
    </div>


</form>
@endsection