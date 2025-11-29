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
            <h1>GCIT Graduation Day 2025</h1>
        </div>
    </div>
</div>
<div class="pageContentWrapper">
    <div class="section">
        <div class="postWrapper">
            <div class="post">
                <img src="{{ asset('images/events/dummyEventImg.png') }}" alt="">
                <p>The GCIT campus was filled with pride, gratitude, and a profound sense of achievement today as families and the GCIT community came together to celebrate the graduation of the Class of 2025.
                        <br>
                        <br>
                    This exceptional cohort marks a historic milestone — the first-ever GCIT graduates under our transformative new curriculum. This bold shift in reimagining education has set a new standard for academic excellence and innovation. 🎉
                    <br>
                    <br>
                    They didn’t just graduate — they made history. As trailblazers of a new era, they embraced change, led with purpose, and laid the foundation for future generations. The entire GCIT community is immensely proud of their journey. And this is only the beginning.</p>
                    <div class="btnWrapper">
                        <button class="left"><span class="material-symbols-outlined">keyboard_arrow_right</span>Previous
                        </button>
                        <button class="right">
                            Next<span class="material-symbols-outlined">keyboard_arrow_right</span>
                        </button>
                      
                    </div>
            </div>
            <div class="suggestionWrapper">
                <div class="suggestion">
                    <span class="date"><span class="material-symbols-outlined">calendar_month</span>June 24, 2025</span>
                    <h1>GCIT Innovation Week 2025</h1>
                     <a href=""><span class="material-symbols-outlined">expand_circle_right</span>Read More</a>
                </div>
                <div class="suggestion">
                    <span class="date"><span class="material-symbols-outlined">calendar_month</span>June 24, 2025</span>
                    <h1>GCIT Innovation Week 2025</h1>
                     <a href=""><span class="material-symbols-outlined">expand_circle_right</span>Read More</a>
                </div>
                <div class="suggestion">
                    <span class="date"><span class="material-symbols-outlined">calendar_month</span>June 24, 2025</span>
                    <h1>GCIT Innovation Week 2025</h1>
                     <a href=""><span class="material-symbols-outlined">expand_circle_right</span>Read More</a>
                </div>
                <div class="suggestion">
                    <span class="date"><span class="material-symbols-outlined">calendar_month</span>June 24, 2025</span>
                    <h1>GCIT Innovation Week 2025</h1>
                     <a href=""><span class="material-symbols-outlined">expand_circle_right</span>Read More</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
