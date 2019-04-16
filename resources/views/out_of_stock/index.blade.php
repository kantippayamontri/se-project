@extends('layouts.app')
@section('title','Product')
@section('content')

<!-- Page Content -->
<div class="container">

    <!-- Page Heading -->
    <h1 class="my-4">422 Shopping Mall
        <small>out of stock</small>
    </h1>

    @if (session('success'))
    <div class="alert alert-success">
        <p>{{ session('success') }}</p>
    </div>
    @endif

    @guest
    @else
    @if (auth()->user()->isAdmin())
    @endif
    @endguest

    <div class="row">

        @foreach($out_of_stock as $row)
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
                        <div>
                            <a href="{{ url('/out_of_stock/store' , $row['id']) }}" class="btn btn-success">Add to product</a>
                        </div>
                        <div>
                            <a href="{{ url('/out_of_stock/edit' , $row['id']) }}" class="btn btn-warning">Edit</a>
                        </div>
                        <form method="post" class="delete_form" action="{{ url('/out_of_stock/delete' , $row['id']) }}">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="DELETE" />
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </center>

                    @else
                    <!-- <div class="row"> -->
                    <!-- <div class="col-lg-1 col-centered"> -->
                    <center>

                        <a href="{{ url('/cart/store' , $row) }}" class="btn btn-success">Add To Cart</a>

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