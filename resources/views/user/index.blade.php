@extends('layouts.app')
@section('title','User')
@section('content')

<section class="pricing py-5">
    <div class="container">
        <div class="row">
            @foreach($user as $row)
            <!-- Free Tier -->
            <div class="col-lg-4">
                <div class="card mb-5 mb-lg-0">
                    <div class="card-body">
    
                        <h6 class="card-price text-center">
                            
                        </h6>
                        <hr>
                        <ul class="fa-ul">
                            <li><span class="fa-li"><i class="fas fa-check"></i></span>{{'Email : '.$row['email']}}</li>
                            <li><span class="fa-li"><i class="fas fa-check"></i></span>{{'Name : '.$row['name']}}</li>
                            <li><span class="fa-li"><i class="fas fa-check"></i></span>{{'description : '.$row['description']}}</li>
                            <li><span class="fa-li"><i class="fas fa-check"></i></span>{{'Money : '.$row['money']}}</li>
                            <li><span class="fa-li"><i class="fas fa-check"></i></span>{{'Point : '.$row['point']}}</li>
                        </ul>
                        <a href="#" class="btn btn-block btn-primary text-uppercase">Edit</a>
                        <a href="#" class="btn btn-block btn-primary text-uppercase">Delete</a>
                    </div>
                </div>
            </div>
            @endforeach
            <!-- plus here -->
        </div>
    </div>
</section>

@endsection 