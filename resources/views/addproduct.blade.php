@extends('layouts.app')
@section('title','Add Product')
@section('content')

<form action="" class="main-form">
<br>
    <h2>Add Product</h2>
    <br>
    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" class="form-control" id="name" name="name">
    </div>
    <div class="form-group">
        <label for="price">Price:</label>
        <input class="form-control" type="number" id="price" name="price">
    </div>
    <div class="form-group">
        <label for="point">Point:</label>
        <input class="form-control" type="number" id="point" name="point">
    </div>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <label class="input-group-text" for="category">category</label>
        </div>
        <select class="custom-select" id="category" name="category">
            <option selected>Choose...</option>
            <option value="1">drink</option>
            <option value="2">Snack</option>
            <option value="3">Instant noodle</option>
            <option value="4">general</option>
        </select>
    </div>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text">Picture Upload</span>
        </div>
        <div class="custom-file">
            <input type="file" class="custom-file-input" id="inputGroupFile01">
            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
        </div>
    </div>

</form>
@endsection 