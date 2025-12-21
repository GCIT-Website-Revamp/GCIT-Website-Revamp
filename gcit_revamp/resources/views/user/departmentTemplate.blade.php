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
            <p>Support & Services</p>
        </div>
        <div class="contentWrapper">
            @if($service)
            <h1>{{ $service->name }}</h1>
            @endif
        </div>
    </div>
</div>
<div class="pageContentWrapper ">
    <div class="">
        <div class="postWrapper departmentWrapper">
            <div class="post">
                @if($service)
                <p>{!! $service->description !!}</p>
                <div class="staffProfileWrapper">
                    @foreach ($service->roles as $role)
                        <div class="staff">
                                @if(isset($role['image']) && $role['image'])
                                    <img src="{{ asset('storage/' . $role['image']) }}" alt="">
                                @endif                        <div class="staffDescription">
                            <h1>{{ $role['team_name'] }}</h1>
                            <p>{{ $role['name'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif

            </div>
            
            <div class="otherCourseContainer otherDepartment">
                 <div class="header">
                     <h1>More on Support & Services</h1>
                 </div>
                 <div class="otherContent">
                     <h1>Other Departments</h1>
                     <a href="/department/Finance">Finance</a>
                        <a href="/department/Human Resources & Administration">Human Resources & Administration</a>
                        <a href="/department/Information & Communication Technology">Information & Communication Technology</a>
                        <a href="/department/School Affairs">School Affairs</a>
                        <a href="/department/Student Affairs">Student Affairs</a>
                 </div>
             </div>
        </div>
    </div>
</div>
@endsection
