@extends('layouts.app')
@section('title','Product')
@section('content')

@if (session('success'))
<div class="alert alert-success">
    <p>{{ session('success') }}</p>
</div>
@endif



<table class="table">
    <thead class="thead-dark">
        <th scope="col">Name</th>
        <th scope="col">Price</th>
        <th scope="col"></th>
        <th scope="col">Quantity</th>
        <th scope="col"></th>
        <th scope="col">Total Price</th>
        <th scope="col">Delete</th>
    </thead>
    <tbody>
        <?php $total = 0; ?>
        @foreach($cart as $row)
        <?php $total += $row['total_price']; ?>
        <tr class="table-info">
            <th scope="col">{{$row['name']}}</th>
            <th scope="col">{{$row['price']}}</th>
            <th scope="col">

                <form method="post" action="{{ url('/cart/minus' ,$row['id']) }}" class="main-form" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group ">
                        <input type="hidden" name="_method" value="PATCH" />
                        <div class="float-right"><input type="submit" class="btn btn-warning pull-right" value="-" /></div>
                    </div>
                </form>

            </th>
            <th scope="col" style="text-align: center; padding: 40px;">
                {{$row['quantity']}}
            </th>
            <th scope="col">
                <form method="post" action="{{ url('/cart/plus' ,$row['id']) }}" class="main-form" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group">
                        <input type="hidden" name="_method" value="PATCH" />
                        <div class="float-left"><input type="submit" class="btn btn-warning" value="+" /></div>
                    </div>
                </form>
            </th>
            <th scope="col">{{$row['total_price']}}</th>
            <th scope="col">
                <form method="post" class="delete_form" action="{{ url('cart/delete' ,$row['id'] ) }}">
                    {{csrf_field()}}
                    <input type="hidden" name="_method" value="DELETE" />
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </th>

        </tr>
        @endforeach

    </tbody>

</table>





<div class="container">
    <table class="table">

        <thead class="thead-dark">
            <th scope="col">Your Money</th>
            <th scope="col">
                <?php
                $currentUser = app('Illuminate\Contracts\Auth\Guard')->user();
                echo $currentUser->money;
                ?>
        </thead>
        <thead class="thead-dark">
            <th scope="col">Total Price</th>
            <th scope="col">{{$total}}</th>
        </thead>
        <thead class="thead-dark">
            <th scope="col">Balance</th>
            <th scope="col">
                <?php
                $balance = $currentUser->money - $total;
                echo $balance;
                ?>
                
            </th>
        </thead>
        </tr>
    </table>
</div>



<div class="row">
    <div class="col"></div>
    <div class="col">
        <a href="{{ url('' ,) }}" class="btn btn-success">Check out</a>
    </div>
    <div class="col"></div>
</div>




@endsection