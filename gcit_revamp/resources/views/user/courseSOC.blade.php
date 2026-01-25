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
                <a href="">Home</a>
                <span class="material-symbols-outlined">keyboard_arrow_right</span>
                <a>Study</a>
            </div>
            <div class="contentWrapper">
                <h1>School of Future Computing</h1>
            </div>
        </div>
    </div>
    <div class="pageContentWrapper">
        <div class="section eventsWrapper">

            <div class="mainContent courseContent boxImgWrapper">
                @forelse ($courses as $index => $course)
                    <a href="/courseDetails/{{ $course->id }}" class="card" data-tag="{{$course->type}}">
                        <img src="{{ asset('storage/' . $course->image) }}" alt="">
                        <div class="cardContent">
                            <span class="coursePreHeader">{{ $course->type }}</span>
                            <h1>{{ $course->name }}</h1>
                            <p class="multi-truncate">{!! $course->description !!}</p>
                        </div>
                    </a>
                @empty
                    <p>No courses found.</p>
                @endforelse
            </div>
            <div class="otherCourseContainer">
                <div class="header">
                    <h1>More on Academics</h1>
                </div>
                <div class="otherContent">
                    <h1>Other Schools</h1>
                    <a href="/courseDetails/soc">School of Future Computing</a>
                    <a href="/courseDetails/electives">Speculative Electives</a>
                </div>
            </div>
        </div>
    </div>
@endsection