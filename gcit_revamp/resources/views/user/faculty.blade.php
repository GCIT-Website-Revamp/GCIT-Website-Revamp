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
            <h1>Faculty</h1>
            <p>GCIT offers specialized programs designed to equip students with both technical expertise and creative problem-solving skills. Courses span areas such as Full Stack Development, Artificial Intelligence & Data Science, Blockchain Technology, Cybersecurity, and Interactive Design & Development, providing hands-on learning experiences that prepare graduates to lead Bhutan’s digital future.</p>
        </div>
    </div>
</div>
<div class="pageContentWrapper ">
    <div class="section">
        <div class="facultyWrapper">
            <div class="staffProfileWrapper">
                    <div class="staff">
                        <img src="{{ asset('images/staff/bishal.png') }}" alt="">
                        <div class="staffDescription">
                            <h1>Bishal Limbu</h1>
                            <p>Finance Officer</p>
                        </div>
                    </div>
                    <div class="staff">
                        <img src="{{ asset('images/staff/bishal.png') }}" alt="">
                        <div class="staffDescription">
                            <h1>Bishal Limbu</h1>
                            <p>Finance Officer</p>
                        </div>
                    </div>
                    <div class="staff">
                        <img src="{{ asset('images/staff/bishal.png') }}" alt="">
                        <div class="staffDescription">
                            <h1>Bishal Limbu</h1>
                            <p>Finance Officer</p>
                        </div>
                    </div>
                    <div class="staff">
                        <img src="{{ asset('images/staff/bishal.png') }}" alt="">
                        <div class="staffDescription">
                            <h1>Bishal Limbu</h1>
                            <p>Finance Officer</p>
                        </div>
                    </div>
                    <div class="staff">
                        <img src="{{ asset('images/staff/bishal.png') }}" alt="">
                        <div class="staffDescription">
                            <h1>Bishal Limbu</h1>
                            <p>Finance Officer</p>
                        </div>
                    </div>
                    <div class="staff">
                        <img src="{{ asset('images/staff/bishal.png') }}" alt="">
                        <div class="staffDescription">
                            <h1>Bishal Limbu</h1>
                            <p>Finance Officer</p>
                        </div>
                    </div>
                </div>
           <div class="filterWrapper">
            <div class="headerWrapper">
                <h1>Filters</h1>
            </div>
            <div class="filterContent">
                <div class="filterHeader">
                    <h1>Categories</h1>
                </div>
                <div class="filterContainer">

                    <div class="filter">
                        <input type="checkbox">
                        <p>Administration</p>
                    </div>
                    <div class="filter">
                        <input type="checkbox">
                        <p>Blockchain Department</p>
                    </div>
                    <div class="filter">
                        <input type="checkbox">
                        <p>AI Department</p>
                    </div>
                    <div class="filter">
                        <input type="checkbox">
                        <p>Fullstack Department</p>
                    </div>
                    <div class="filter">
                        <input type="checkbox">
                        <p>Cyber Department</p>
                    </div>
                    <div class="filter">
                        <input type="checkbox">
                        <p>Interactive Design & Development</p>
                    </div>
                    <div class="filter">
                        <input type="checkbox">
                        <p>Supporting Staff</p>
                    </div>
                    <div class="filter">
                        <input type="checkbox">
                        <p>Finance Department</p>
                    </div>
                    <div class="filter">
                        <input type="checkbox">
                        <p>HR Department</p>
                    </div>
                    <div class="filter">
                        <input type="checkbox">
                        <p>ICT Department</p>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection
