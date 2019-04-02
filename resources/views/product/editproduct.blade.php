@extends('layouts.app')
@section('title','Edit Product')
@section('content')
<!-- action="{{url('/product/store')}}" -->
<form method="post" action="{{ url('/product/update' ,$id) }}" class="main-form" enctype="multipart/form-data">
    {{csrf_field()}}
    <br>
    <h2>Edit Product</h2>
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
        <!-- <img src="/picture/product/{{ Session::get('path') }}" width='300px'/> -->
    </div>
   
    @endif
    <br>
    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" class="form-control" id="name" name="name" value="{{$product->name}}"/>
    </div>
    <div class="form-group">
        <label for="price">Price:</label>
        <input class="form-control" type="number" id="price" name="price" value="{{$product->price}}">
    </div>
    <div class="form-group">
        <label for="point">Point:</label>
        <input class="form-control" type="number" id="point" name="point" value="{{$product->point}}"/>
    </div>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <label class="input-group-text" for="category">category</label>
        </div>
        <select class="custom-select" id="category" name="category" value="{{$product->category}}">
    
            <option value="1" name='drink' <?php if($product->category=="1") echo 'selected="selected"'; ?> >drink</option>
            <option value="2" name='snack'<?php if($product->category=="2") echo 'selected="selected"'; ?> >Snack</option>
            <option value="3" name='noodle'<?php if($product->category=="3") echo 'selected="selected"'; ?> >Instant noodle</option>
            <option value="4" name='general'<?php if($product->category=="4") echo 'selected="selected"'; ?> >general</option>
        </select>
    </div>

    <div class="form-group">
        <label> Choose file for upload: </label><br>
        <input type="file" name="image"/>
        <span class="text-muted">jpg, png, gif</span><br><br>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </div>

    <div class="form-group">
        <input type="hidden" name="_method" value="PATCH" />
        <input type="submit" class="btn btn-primary" value="UPDATE" />
    </div>


</form>

@endsection 