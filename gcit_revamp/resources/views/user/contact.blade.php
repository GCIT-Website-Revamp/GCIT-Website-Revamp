@extends('layout.app')

@section('title', 'Home')

@section('content')

<div class="pageBannerWrapper">
    <div class="backgroundWrapper">
        <div class="overlay"></div>
        <img src="{{ asset('images/pageBanner.png') }}" alt="">
    </div>
    <div class="bannerContent sectionWrapper">
        <div class="breadCrumbs">
            <a href="/">Home</a>
            
        </div>
        <div class="contentWrapper">
            <h1>Contact Us</h1>
        </div>
    </div>
</div>
<div class="pageContentWrapper">
    <div class="section sectionWrapper">
       
        <h1>Reach Out to Us for any further Inquiries</h1>
        <br>
        <p>Gyalpozhing College of Information Technology</p>
        <p>Royal University of Bhutan</p>

        <p>Chamjekha, Thimphu, Bhutan</p>
        <br>


        <p>Tel No. : +975 236 1194</p>
        <p>info.gcit@rub.edu.bt</p>
        <p>ict.gcit@rub.edu.bt</p>
    </div>
</div>
@endsection
