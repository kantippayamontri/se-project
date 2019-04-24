@extends('layouts.app')
@section('title','Product')
@section('content')

<div class="container-fluid">
    <br>
    @if (session('delete'))
    <div class="alert alert-success">
        <p>{{ "Promotion ".session('delete')." has deleted." }}</p>
    </div>
    @elseif(session('fail'))
    <div class="alert alert-success">
        <p>{{ "fail :".session('fail') }}</p>
    </div>
    @elseif(session('success'))
    <div class="alert alert-success">
        <p>{{ session('success') }}</p>
    </div>
    @endif

    @if (session('code'))
    <div class="alert alert-success">
        <p>{{ "Your code is ".session('code') }}</p>
    </div>
    @endif
    <br>
    @if (auth()->user()->isAdmin())
    <a class="btn btn-success pull-right" href="/promotion/add">Add</a>
    @endif

    <div class="row">
        @foreach($promotion as $row)
        @if($row['now_number'] !== $row['number'])
        <div class="col-12 mt-3">
            <div class="card">
                <div class="card-horizontal">
                    <div class="img-square-wrapper">
                        <img class="" src="{{ url( 'picture/promotion/'.$row['picture'] ) }}" width="200px" alt="Card image cap">
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">{{$row['name']}}</h4>
                        <p class="card-text">{{$row['description'] . " เมื่อซื้อสินค้าขั้นต่ำ " . $row['min_money'] . " บาท" }}</p>
                        <p class="card-text">{{"Can be exchanged ".$row['point']." point."}}</p>
                        <p class="card-text">{{"available Code ".$row['now_number']."/".$row['number']}}</p>
                        @if (auth()->user()->isAdmin())
                        <a class="btn btn-warning" href="{{ url( 'promotion/edit' , $row['id'] ) }}">Edit</a>
                        <a class="btn btn-danger" href="{{ url( 'promotion/delete' , $row['id'] ) }}">Delete</a>
                        @else
                        <a class="btn btn-success" href="{{ url( 'coupon/store' ,$row['id'] ) }}">Buy</a>
                        @endif
                    </div>

                </div>

            </div>
        </div>

        @endif
        @endforeach
    </div>
</div>

@endsection
