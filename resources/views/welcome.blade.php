@extends('layouts.app')
@section('title','422 Shopping Mall')
@section('content')
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner" role="listbox">
        <!-- Slide One - Set the background image for this slide in the line below -->
        <div class="carousel-item active" style="background-image: url('picture/welcome/first.jpg')">
            <div class="carousel-caption d-none d-md-block">
                <h2 class="display-4">
                <font color="10E9FB">422 Shopping Mall</font>
                </h2>
                <p class="lead">
                <font color="10E9FB">Store for CPE</font> 
                </p>
            </div>
        </div>
        <!-- Slide Two - Set the background image for this slide in the line below -->
        <div class="carousel-item" style="background-image: url('https://tradeind.gov.tt/wp-content/uploads/2018/06/OE9TFP0.jpg')">
            <div class="carousel-caption d-none d-md-block">
                <h2 class="display-4">
                    <font color="021D43">422 Shopping Mall</font></h2>
                <p class="lead">
                    <font color="021D43">Store for CPE</font></p>
            </div>
        </div>
        <!-- Slide Three - Set the background image for this slide in the line below -->
        <div class="carousel-item" style="background-image: url('https://image.freepik.com/free-photo/smart-phone-with-white-screen-in-hand-on-blurred-in-shopping-mall-background-shopping-online-concept-shopping-by-smart-phone_1253-1430.jpg')">
            <div class="carousel-caption d-none d-md-block">
            <h2 class="display-4">
                    <font color="58073F">422 Shopping Mall</font></h2>
                <p class="lead">
                    <font color="58073F">Store for CPE</font></p>
            </div>
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
@endsection 