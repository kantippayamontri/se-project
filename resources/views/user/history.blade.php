@extends('layouts.app')
@section('title','Product')
@section('content')
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

<div class="container">
    <table class="table table-striped table-dark">
        <thead>
            <tr>
                <th scope="col">Code</th>
                <th scope="col">Name</th>
                <th scope="col">picture</th>
                <th scope="col">description</th>
                <th scope="col">min_money</th>
                <th scope="col">percent</th>
                <th scope="col">discount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($coupon as $row)
            <tr>
                <th scope="row">{{$row['code']}}</th>
                <th scope="row">{{$row['name']}}</th>
                <td>
                    <img src="{{ url( 'picture/promotion/'.$row['picture'] ) }}" class="img-rounded " alt="{{$row['picture']}}" width="100px">
                </td>
                <td>{{$row['description']}}</td>
                <td>{{$row['min_money']}}</td>
                <td>{{$row['percent']}}</td>
                <td>{{$row['discount']}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection