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
<div class="pageContentWrapper ">
    <div class="section">
        <div class="postWrapper departmentWrapper">
            <div class="post">
                <p>
                <span>Internet</span>
                As the academic programme at the Gyalpozhing College of Information Technology focuses on IT, the campus is equipped with an optical fiber backbone and WiFi connection. The IT infrastructure includes servers for centrally hosted services, network-accessed shared storage, and a Virtual Learning Environment (VLE). The college maintains a 58 Mbps internet connection via a fiber backbone, and all the specified equipment supports external connectivity to the National Research and Education Network (DrukREN), which enhances accessibility and supports research.
                <span>ICT Labs</span>
                The Gyalpozhing College of Information Technology provides two fully-equipped computer labs with projectors, furniture, computers, and internet connections. The labs are used during scheduled classes as well as open hours, and come equipped with standard office productivity software.
                <span>Maintenance & Support</span>
                Students will be provided with access to necessary technological resources and support. These services may include troubleshooting technical issues with computers and printers. ICT services may also provide guidance and training to students on how to use various software and hardware tools effectively. This ensures students have a positive learning experience and can focus on their studies without worrying about technology issues
                </p>
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
                </div>


            </div>
            
            <div class="otherCourseContainer otherDepartment">
                 <div class="header">
                     <h1>More on Academics</h1>
                 </div>
                 <div class="otherContent">
                     <h1>Other Courses</h1>
                     <a href="">Full Stack Development</a>
                     <a href="">Blockchain Development</a>
                     <a href="">Cybersecurity</a>
                     <a href="">Interactive Design & Development</a>
                 </div>
             </div>
        </div>
    </div>
</div>
@endsection
