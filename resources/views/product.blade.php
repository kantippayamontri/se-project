@extends('layouts.app')
@section('title','Product')
@section('content')

<!-- Page Content -->
<div class="container">

    <!-- Page Heading -->
    <h1 class="my-4">422 Shopping Mall
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
            <a class="btn btn-success" href="/product/add">Add</a>
        </div>
    </div>
    <br>
    @endif
    @endguest

    <div class="row">

        @foreach($product as $row)
        <div class="pricing col-lg-3 col-sm-6 mb-4">
            <div class="card h-100">
                <a href="#"><img class="card-img-top" src="{{ url( 'picture/product/'.$row['picture'] ) }}" alt="" width="100px"></a>
                <div class="card-body">
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

                    @guest
                    @else

                    @if (auth()->user()->isAdmin())
                    <br>
                    <center>
                        <!-- <button type="button" class="btn btn-warning">Edit</button> -->
                        <a href="{{ url('/product/edit' , $row['id']) }}" class="btn btn-warning">Edit</a>

                        <form method="post" class="delete_form" action="{{ url('/product/delete' , $row['id']) }}">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="DELETE" />
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </center>

                    @else
                    <!-- <div class="row"> -->
                        <!-- <div class="col-lg-1 col-centered"> -->
                        <center>
                            <button type="button btn-lg" class="btn btn-success">BUY</button>
                        </center>
                        <!-- </div> -->
                    <!-- </div> -->
                    @endif


                    @endguest


                </div>
            </div>
        </div>
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