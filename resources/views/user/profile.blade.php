@extends('layouts.app')
@section('title','Product')
@section('content')

<h1>{{$user['name']}}</h1>

<style>
    .card {
        margin: 0 auto;
        /* Added */
        float: none;
        /* Added */
        margin-bottom: 10px;
        /* Added */
    }
</style>

    <div class="container ">
        @if (session('success'))
        <div class="alert alert-success">
            <p>{{ session('success') }}</p>
        </div>
        @endif
        <div class="row">
            
            <!-- Free Tier -->
            <div class="col">
                <div class="card mb-5 mb-lg-0">
                    <div class="card-body ">

                        <h6 class="card-price text-center">
                            <img class="card-img-top" src="{{ url( 'picture/user/'.$user['picture'] ) }}" alt="" width="50px">
                        </h6>
                        <hr>
                        <ul class="fa-ul"><h5><b>
                            <li><span class="fa-li"><i class="fas fa-check"></i></span>{{'Email : '.$user['email']}}</li><br>
                            <li><span class="fa-li"><i class="fas fa-check"></i></span>{{'Name : '.$user['name']}}</li><br>
                            <li><span class="fa-li"><i class="fas fa-check"></i></span>{{'description : '.$user['description']}}</li><br>
                            <li><span class="fa-li"><i class="fas fa-check"></i></span>{{'Money : '.$user['money']}}</li><br>
                            <li><span class="fa-li"><i class="fas fa-check"></i></span>{{'Point : '.$user['point']}}</li></h5></b>
                        </ul>

                        <!-- <a href="#" class="btn btn-block btn-primary text-uppercase">Edit</a> -->
                        <a href="{{ url('/user/edit' , $user['id']) }}" class="btn btn-warning btn-block text-uppercase">Edit</a>
                        <a href="{{ url('/user/history' , $user['id']) }}" class="btn btn-success btn-block text-uppercase">History</a>
                
                        
                    </div>
                </div>
            </div>
            
            <!-- plus here -->
        </div>
    </div>

@endsection