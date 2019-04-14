@extends('layouts.app')
@section('title','Promotion')
@section('content')

<h1>Promotion</h1>
<div class="container">
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


    @if (auth()->user()->isAdmin())
    <a class="btn btn-success pull-right" href="/promotion/add">Add</a>
    @endif
    <table class="table table-striped table-dark">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">description</th>
                <th scope="col">number</th>
                <th scope="col">Min Money</th>
                <th scope="col">Percent</th>
                <th scope="col">Discount</th>
                <th scope="col">Point</th>
                <th scope="col">Picture</th>
                @if (auth()->user()->isAdmin())
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
                @else
                <th scope="col">Buy</th>
                @endif

            </tr>
        </thead>
        <tbody>
            @foreach($promotion as $row)
            @if($row['now_number'] !== $row['number'])
            <tr>
                <th scope="row">{{$row['name']}}</th>
                <td>{{$row['description']}}</td>
                <td>{{$row['now_number']."/".$row['number']}}</td>
                <td>{{$row['min_money']}}</td>
                <td>{{$row['percent']}}</td>
                <td>{{$row['discount']}}</td>
                <td>{{$row['point']}}</td>
                <td>
                    <img src="{{ url( 'picture/promotion/'.$row['picture'] ) }}" class="img-rounded " alt="{{$row['picture']}}" width="100px">
                </td>
                @if (auth()->user()->isAdmin())
                <td>
                    <a class="btn btn-warning" href="{{ url( 'promotion/edit' , $row['id'] ) }}">Edit</a>
                </td>
                <td>
                    <a class="btn btn-danger" href="{{ url( 'promotion/delete' , $row['id'] ) }}">Delete</a>
                </td>
                @else
                <td>
                    <a class="btn btn-success" href="{{ url( 'coupon/store' ,$row['id'] ) }}">Buy</a>
                </td>
                @endif
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
</div>

@endsection