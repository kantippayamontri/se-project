@extends('layouts.app')
@section('title','Promotion')
@section('content')

<h1>Promotion</h1>
<div class="container">
    @if (session('delete'))
    <div class="alert alert-success">
        <p>{{ "Promotion ".session('delete')." has deleted." }}</p>
    </div>
    @endif
    <a class="btn btn-success pull-right" href="/promotion/add">Add</a>
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
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>

            </tr>
        </thead>
        <tbody>
            @foreach($promotion as $row)
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
                <td>
                    <a class="btn btn-warning" href="{{ url( 'promotion/edit' , $row['id'] ) }}">Edit</a>
                </td>
                <td>
                    <a class="btn btn-danger" href="{{ url( 'promotion/delete' , $row['id'] ) }}">Delete</a>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection