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
            <a>Tech Impact</a>
        </div>
        <div class="contentWrapper">
            <h1>GCITxBIL Fintech Innovation Lab</h1>
        </div>
    </div>
</div>
<div class="pageContentWrapper detailsWrapper">
    <div class="section">
        <div class="postWrapper departmentWrapper">
            <div class="post">
                @if($fintech)
                    <p>{!! $fintech->description !!}</p>

                    <div class="staffProfileWrapper">
                        @foreach ($fintech->roles as $role)
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
                     <h1>More on Tech Impact</h1>
                 </div>
                 <div class="otherContent">
                    <h1>Other Tech Impacts</h1>
                    <a href="/project">Industry Projects</a>
                    <a href="/studio">K Studio</a>
                 </div>
             </div>
        </div>
    </div>
</div>
@endsection
