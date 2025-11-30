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
            <p>At the Gyalpozhing College of Information Technology (GCIT), we are dedicated to shaping Bhutan’s digital future through innovation, education, and research. Our mission is to cultivate creative problem solvers and ethical leaders who use technology to drive positive change in society.
            </p>
        </div>
        <div class="aboutDetailsWrapper">
            <div class="bgColorUnderlay"></div>
            <div class="aboutDetails">

                <img src="{{asset('Images/events/dummyEventImg.png')}}" alt="">
                <p>
                    As educators, we believe that learning extends beyond the classroom — it’s a process of discovery, experimentation, and collaboration. Through hands-on projects, interdisciplinary research, and partnerships with industry and government, our students and faculty push the boundaries of what’s possible in computing and digital innovation.
                    <br><br>
                    GCIT thrives as a dynamic academic community where curiosity meets creativity. Whether developing software that serves local communities, exploring artificial intelligence and cybersecurity, or designing interactive digital experiences, our students are inspired to learn by building, innovate with purpose, and lead with integrity.</p>
                </div>
            </div>
            <div class="mottoWrapper">
                <img src="{{asset('Images/&.png')}}" alt="" class="underlay">
                <div class="visionWrapper">
                    <h1>Vision</h1>
                    <p>Our vision is to be a leading institution in software technology and interactive design that produces future ready graduates with commitment to academic excellence, innovation, and social responsibility.</p>
                </div>
                <div class="missionWrapper">
                    <h1>Mission</h1>
                    <p>Our mission is to empower the tech generation of learners with cutting-edge skills and knowledge in modern software technology and interactive design, and equip our students with expertise, practical skills, and values necessary to become contributors and leaders in the technology and design industry.</p>
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


@endsection
