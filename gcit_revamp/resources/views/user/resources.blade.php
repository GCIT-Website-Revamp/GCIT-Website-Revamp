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
            <span class="material-symbols-outlined">keyboard_arrow_right</span>
            <a>Support & Services</a>
        </div>
        <div class="contentWrapper">
            @if($resources)
            <h1>{{ $resources->name }}</h1>
            @endif
        </div>
    </div>
</div>
<div class="pageContentWrapper">
    <div class="section">
        <div class="postWrapper departmentWrapper">
            <div class="post">
                @if($resources)
                <p>{!! $resources->description !!}</p>
                @endif

            </div>
            
              <div class="otherCourseContainer otherDepartment">
                    <div class="header">
                        <h1>More on Student Services</h1>
                    </div>
                    <div class="otherContent">
                        <h1>Other Services</h1>
                            <a href="/clubs">Clubs</a>
                            <a href="/resources/ICT">ICT</a>
                            <a href="/resources/Student-Welfare">Student Welfare</a>
                    </div>
        </div>
        </div>
    </div>
</div>
@endsection
