@extends('layouts.app')
@section('title','Vote')
@section('content')

<!-- Page Content -->
<div class="container">

    <!-- Page Heading -->
    <h1 class="my-4">Vote
        <small>products</small>
    </h1>

    @if (session('success'))
    <div class="alert alert-success">
        <p>{{ session('success') }}</p>
    </div>
    @endif

    @guest
    @else
    @if (auth()->user()->isAdmin())
    <div class="row">
        <div class="col-11"></div>
        <div class="col-1">
            <a class="btn btn-success" href="/vote/add">Add</a>
        </div>
    </div>
    <br>
    @endif
    @endguest


    <div class="row">

        @foreach($vote as $row)

        <?php
        
        $check = true;
        $currentuser = app('Illuminate\Contracts\Auth\Guard')->user();
        foreach($vote_user as $vote_){

            if($row['id'] === $vote_['vote_id']){
                $check = false;
            }

        }

        ?>

        @if($check)
        <div class="pricing col-lg-3 col-sm-6 mb-4">
            <div class="card h-100">
                <a href="#"><img class="card-img-top" src="{{ url( 'picture/product/'.$row['picture'] ) }}" alt="" width="100px"></a>
                <div class="card-body">

                    <!--  -->

                    <h4 class="card-title">
                        <a href="#">{{$row['name']}}</a>
                    </h4>
                    <div>
                        <button type="button" class="btn btn-primary">Price</button>
                        <a> <?php echo "****** " . $row['price'] . " ******" ?></a>
                    </div>
                    <br>
                    <div>
                        <button type="button" class="btn btn-primary">Point</button>
                        <a> <?php echo "****** " . $row['point'] . " ******" ?></a>
                    </div>

                    <!--  -->

                    @guest
                    @else

                    @if (auth()->user()->isAdmin())
                    <br>
                    <center>
                        <!-- <button type="button" class="btn btn-warning">Edit</button> -->
                        <a href="{{ url('/vote/edit' , $row['id']) }}" class="btn btn-warning">Edit</a>

                        <form method="post" class="delete_form" action="{{ url('/vote/delete' , $row['id']) }}">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="DELETE" />
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>

                        <a href="{{ url('/vote/addtoproduct' , $row['id']) }}" class="btn btn-success">Add to Product</a>
                    </center>

                    @else
                    <!-- <div class="row"> -->
                    <!-- <div class="col-lg-1 col-centered"> -->
                    <center>

                        <a href="{{ url('/vote/vote' , $row['id']) }}" class="btn btn-success">Vote</a>

                    </center>
                    <!-- </div> -->
                    <!-- </div> -->
                    @endif


                    @endguest


                </div>
            </div>
        </div>
        @endif
        @endforeach


        <!-- /.row -->



    </div>

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
    <!-- /.container -->

    @endsection