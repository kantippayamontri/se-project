@extends('layouts.app')
@section('title','Product')
@section('content')

<h1>{{$user['name']}}</h1>
<div class="container">
    <table class="table table-striped table-dark">
        <thead>
            <tr>
                <th scope="col">Time</th>
                <th scope="col">Name</th>
                <th scope="col">Quantity</th>
                <th scope="col">total_price</th>
            </tr>
        </thead>
        <tbody>
            @foreach($history as $row)
            <tr>
                <th scope="row">{{$row['time']}}</th>
                <td>{{$row['name']}}</td>
                <td>{{$row['quantity']}}</td>
                <td>{{$row['total_price']}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection