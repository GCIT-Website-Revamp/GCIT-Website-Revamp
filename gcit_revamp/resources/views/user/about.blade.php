@extends('layout.app')

@section('title', 'Home')

@section('content')
<!-- <div class="bgColorUnderlay"></div> -->

<div class="preAboutHeader sectionWrapper">
        <div class="breadCrumbs">
            <a href="/">Home</a>
            <span class="material-symbols-outlined">keyboard_arrow_right</span>
            <a >About GCIT</a>
        </div>
</div>

<div class="aboutContentWrapper sectionWrapper">
    <div class="aboutContent">
        <div class="aboutHeader">
            <h1>Institutional Overview</h1>
            <br>
        </div>
        <div class="aboutDetailsWrapper">
            <div class="aboutDetails">
                @if($overview)
                <img src="{{ asset('storage/' . $overview->image) }}" alt="">
                 <div class="mottoWrapper">
                <img src="{{asset('images/&.png')}}" alt="" class="underlay">
                <div class="visionWrapper">
                    @if($overview)
                    <h1>VISION</h1>
                    <p>{{$overview->vision}}</p>
                    @endif
                </div>
                <div class="missionWrapper">
                    @if($overview)
                    <h1>MISSION</h1>
                    <p>{{$overview->mission}}</p>
                    @endif
                </div>
            </div>
                <p>{!! $overview->description !!}</p>
                @endif
                </div>
            </div>
           
        </div>
    <div class="otherCourseContainer paddingContainer otherDepartment">
                 <div class="header">
                     <h1>More on GCIT</h1>
                 </div>
                 <div class="otherContent">
                     <h1>Support & Services</h1>
                        <a href="/department/Finance">Finance</a>
                        <a href="/department/Human Resources & Administration">Human Resources & Administration</a>
                        <a href="/department/Information & Communication Technology">Information & Communication Technology</a>
                        <a href="/department/School Affairs">Student Welfare</a>
                </div>
    </div>
</div>


@endsection
