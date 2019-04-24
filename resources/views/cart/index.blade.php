@extends('layouts.app')
@section('title','Product')
@section('content')

@if (session('success'))
<div class="alert alert-success">
    <p>{{ session('success') }}</p>
</div>
@endif

@if (session('test'))
<div class="alert alert-success">
    <p>{{ session('test') }}</p>
</div>
@endif

@if (session('percent'))
<div class="alert alert-success">
    <p>{{ "percent : " . session('percent') }}</p>
</div>
@endif
@if (session('discount'))
<div class="alert alert-success">
    <p>{{ "discount : " . session('discount') }}</p>
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
        <?php $total = 0;
        $total_point = 0; ?>
        @foreach($cart as $row)
        <?php $total += $row['total_price'];
        $total_point += $row['total_point']; ?>
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
    @if (session('fail'))
    <div class="alert alert-danger">
        <p>{{ session('fail') }}</p>
    </div>
    @elseif(session('found'))
    <div class="alert alert-success">
        <p>{{ session('found') }}</p>
    </div>
    @endif
    <form class="form-inline main-form " method="post" action="{{url('/coupon/check' , $total)}}" enctype="multipart/form-data">
        {{csrf_field()}}
        <center><div class="form-group mx-sm-3 mb-2">
            <label for="coupon" class="sr-auto">Coupon</label>
            <input type="text" class="form-control" id="coupon" placeholder="Coupon" name="coupon">
        </div></center>
        <input type="hidden" name="_method" value="POST" />
        <button type="submit" class="btn btn-primary mb-2">Confirm</button>
    </form>
</div>




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
        <!-- cal if has coupon -->
        <?php
        $percent = 0;
        $discount = 0;
        $coupon_id = 0;
        if (session('percent')) {
            $percent = session('percent');
        }
        if (session('discount')) {
            $discount = session('discount');
        }
        if (session('coupon_id')) {
            $coupon_id = session('coupon_id');
        }

        $value_percent = $total * ($percent / 100.0);

        $total -= $value_percent;
        $total -= $discount;

        ?>
        <!-- ------------------------------------------------------------- -->

        @if(session('percent'))
        <thead class="thead-dark">
            <th scope="col">{{"Coupon(" . session('percent') ."%)"}}</th>
            <th scope="col">{{$value_percent}}</th>
        </thead>
        @endif

        @if(session('discount'))
        <thead class="thead-dark">
            <th scope="col">Coupon(baht)</th>
            <th scope="col">{{session('discount')}}</th>
        </thead>
        @endif

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
       <center> <a href="{{ url('/history/store' , [$total ,$total_point,$coupon_id]) }}" class="btn btn-success">Check out</a></center>
    </div>
    <div class="col"></div>
</div>




@endsection