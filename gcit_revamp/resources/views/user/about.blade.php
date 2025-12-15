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
            <br>
        </div>
        <div class="aboutDetailsWrapper">
            <div class="bgColorUnderlay"></div>
            <div class="aboutDetails">
                @if($overview)
                <img src="{{ asset('storage/' . $overview->image) }}" alt="">
                <p>{!! $overview->description !!}</p>
                @endif
                </div>
            </div>
            <div class="mottoWrapper">
                <img src="{{asset('images/&.png')}}" alt="" class="underlay">
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
                     <h1>More on Non Academic</h1>
                 </div>
                 <div class="otherContent">
                     <h1>Other Departments</h1>
                     @foreach ($courses as $course)
                        <a href="/courseDetails/{{ $course->id }}">{{ $course->name }}</a>
                     @endforeach
                 </div>
    </div>
</div>


@endsection
