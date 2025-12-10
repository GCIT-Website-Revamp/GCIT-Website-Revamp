@extends('layout.app')

@section('title', 'Home')

@section('content')

<div class="pageBannerWrapper">
    <div class="backgroundWrapper">
        <div class="overlay"></div>
        <img src="{{ asset('images/pageBanner.png') }}" alt="">
    </div>
    <div class="bannerContent">
        <div class="breadCrumbs">
            <a href="">Home</a>
            <span class="material-symbols-outlined">keyboard_arrow_right</span>
            <a href="">Updates</a>
        </div>
        <div class="contentWrapper">
            @if($resources)
            <h1>{{ $resources->name }}</h1>
            @endif
        </div>
    </div>
</div>
<div class="pageContentWrapper ">
    <div class="section">
        <div class="postWrapper departmentWrapper">
            <div class="post">
                @if($resources)
                <p>{!! $resources->description !!}</p>
                @endif

            </div>
            
            <div class="otherCourseContainer otherDepartment">
                 <div class="header">
                     <h1>More on Academics</h1>
                 </div>
                 <div class="otherContent">
                     <h1>Other Courses</h1>
                     @foreach ($courses as $course)
                        <a href="/courseDetails/{{ $course->id }}">{{ $course->name }}</a>
                     @endforeach
                 </div>
             </div>
        </div>
    </div>
</div>
@endsection
