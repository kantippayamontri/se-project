@extends('layouts.app')
@section('title','User')
@section('content')

<style>
    .card {
        margin: 0 auto; /* Added */
        float: none; /* Added */
        margin-bottom: 10px; /* Added */
}
</style>

<section class="pricing py-5">
    <div class="container">
        @if (session('success'))
        <div class="alert alert-success">
            <p>{{ session('success') }}</p>
        </div>
        @endif
        <div class="row">
            @foreach($user as $row)
            <!-- Free Tier -->
            <div class="col-lg-4">
                <div class="card mb-5 mb-lg-0">
                    <div class="card-body ">

                        <h6 class="card-price text-center">
                            <a href="#"><img class="card-img-top" src="{{ url( 'picture/user/'.$row['picture'] ) }}" alt="" width="100px"></a>
                        </h6>
                        <hr>
                        <ul class="fa-ul">
                            <li><span class="fa-li"><i class="fas fa-check"></i></span>{{'Email : '.$row['email']}}</li>
                            <li><span class="fa-li"><i class="fas fa-check"></i></span>{{'Name : '.$row['name']}}</li>
                            <li><span class="fa-li"><i class="fas fa-check"></i></span>{{'description : '.$row['description']}}</li>
                            <li><span class="fa-li"><i class="fas fa-check"></i></span>{{'Money : '.$row['money']}}</li>
                            <li><span class="fa-li"><i class="fas fa-check"></i></span>{{'Point : '.$row['point']}}</li>
                        </ul>

                        <!-- <a href="#" class="btn btn-block btn-primary text-uppercase">Edit</a> -->
                        <a href="{{ url('/user/edit' , $row['id']) }}" class="btn btn-warning btn-block text-uppercase">Edit</a>

                        @if (Auth::user()->id !== $row['id'])
                        <form method="post" class="delete_form" action="{{ url('/user/delete' , $row['id']) }}">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="DELETE" />
                            <button type="submit" class="btn btn-danger btn-block text-uppercase">Delete</button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
            <!-- plus here -->
        </div>
    </div>
</section>

<script type="text/javascript">
        $(document).ready(function() {
            $('.delete_form').on('submit', function() {
                if (confirm("Do you want to delete this product?")) {
                    return true;
                } else {
                    return false;
                }
            });

        });
</script>

@endsection 