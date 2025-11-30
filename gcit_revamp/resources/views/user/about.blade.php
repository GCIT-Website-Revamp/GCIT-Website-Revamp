@extends('layout.app')

@section('title', 'Home')

@section('content')

<div class="preAboutHeader">
        <div class="breadCrumbs">
            <a href="">Home</a>
            <span class="material-symbols-outlined">keyboard_arrow_right</span>
            <a href="">About GCIT</a>
        </div>
</div>
<div class="aboutContentWrapper">
    <div class="aboutContent">
        <div class="aboutHeader">
            <h1>Institutional Overview</h1>
            <p>At the Gyalpozhing College of Information Technology (GCIT), we are dedicated to shaping Bhutan’s digital future through innovation, education, and research. Our mission is to cultivate creative problem solvers and ethical leaders who use technology to drive positive change in society.
            </p>
        </div>
        <div class="aboutDetailsWrapper">
            <div class="bgColorUnderlay"></div>
            <div class="aboutDetails">
                @if($overview)
                <img src="{{ asset('storage/' . $overview->image) }}" alt="">
                <p>{!! nl2br(e($overview->description)) !!}</p>
                @endif
                </div>
            </div>
            <div class="mottoWrapper">
                <img src="{{asset('Images/&.png')}}" alt="" class="underlay">
                <div class="visionWrapper">
                    @if($overview)
                    <h1>Vision</h1>
                    <p>{{$overview->vision}}</p>
                    @endif
                </div>
                <div class="missionWrapper">
                    @if($overview)
                    <h1>Mission</h1>
                    <p>{{$overview->mission}}</p>
                    @endif
                </div>
            </div>
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


@endsection
