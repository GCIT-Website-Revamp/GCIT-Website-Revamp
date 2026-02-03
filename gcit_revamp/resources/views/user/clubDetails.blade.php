@extends('layout.app')

@section('title', 'Home')

@section('content')

<div class="pageBannerWrapper">
    <div class="backgroundWrapper">
        <div class="overlay"></div>
        <img src="{{ asset('images/pageBanner.png') }}" alt="">
    </div>
    <div class="bannerContent sectionWrapper">
        <div class="breadCrumbs ">
            <a href="">Home</a>
            <span class="material-symbols-outlined">keyboard_arrow_right</span>
            <a>Student Services</a>
        </div>
        <div class="contentWrapper">
            @if($club)
            <h1>{{ $club->name }}</h1>
            @endif
        </div>
    </div>
</div>
<div class="pageContentWrapper detailsWrapper">
    <div class="section">
        <div class="postWrapper departmentWrapper">
            <div class="post">
                @if($club)
                    <p>{!! $club->description !!}</p>

                    <div class="staffProfileWrapper">
                        @foreach ($club->roles as $role)
                            <div class="staff">
                                @if(isset($role['image']) && $role['image'])
                                    <img src="{{ asset('storage/' . $role['image']) }}" alt="">
                                @endif
                                <div class="staffDescription">
                                    <h1>{{ $role['team_name'] ?? '' }}</h1>
                                    <p>{{ $role['name'] ?? '' }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

            </div>
            
            <div class="otherCourseContainer otherDepartment">
                 <div class="header">
                     <h1>More on CCA Clubs</h1>
                 </div>
                 <div class="otherContent">
                     <h1>Other Clubs</h1>
                     @if ($otherClubs)
                        @foreach ($otherClubs as $item)
                            <a href="/clubDetails/{{ $item->id }}">{{ $item->name }}</a>
                        @endforeach
                     @endif
                 </div>
             </div>
        </div>
    </div>
</div>
@endsection
