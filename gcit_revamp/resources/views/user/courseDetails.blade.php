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
                <a href="/">Study</a>
                <span class="material-symbols-outlined">keyboard_arrow_right</span>
                <a href="/course">Courses</a>
            </div>
            <div class="contentWrapper">
                <h2>{{ $course->type }}:</h2>
                <h1>{{ $course->name }}</h1>

            </div>
        </div>
    </div>
    <div class="pageContentWrapper">
        <input type="checkbox" id="courseMenuToggle" hidden>

<label for="courseMenuToggle" class="courseMenuBtn">
    <span class="material-symbols-outlined">menu</span>
    Quick Index

</label>
        <div class="section">
            <div class="courseDetailsContainer">
                <div class="sideMenu">
                    <div class="menuHeader">
                        <label for="courseMenuToggle">
                            <span class="material-symbols-outlined">menu</span>
                            Quick Index

                    </label>
                    </div>
                    <div class="menuSection">
                        <div class="header">
                            <div class="circle"></div>
                            <h1>About Course</h1>
                        </div>
                        <a href="#why">Why This Program?</a>
                        <a href="#learnSection">What Would I Learn?</a>
                        <a href="#structureSection">Program Structure</a>
                        <a href="#careerSection">Your Career Prospects</a>
                    </div>
                    <div class="menuSection">
                        <div class="header">
                            <div class="circle"></div>
                            <h1>Course Modules</h1>
                        </div>
                        <a href="#year1sem1Section">Year I Sem I</a>
                        <a href="#year1sem2Section">Year I Sem II</a>
                        <a href="#year2sem1Section">Year II Sem I</a>
                        <a href="#year2sem2Section">Year II Sem II</a>
                        <a href="#year3sem1Section">Year III Sem I</a>
                        <a href="#year3sem2Section">Year III Sem II</a>
                        <a href="#year4sem1Section">Year IV Sem I</a>
                        <a href="#year4sem2Section">Year IV Sem II</a>
                    </div>
                </div>
                <div class="courseDetails">
                    <div class="courseDetailsWrapper">

                        <div class="courseHeaderWrapper">
                            <h1>{{ $course->header }}</h1>
                            <p>{!! nl2br(e($course->description)) !!}</p>

                        </div>
                        <div class="courseDetailContent whythisprogram" id="why">
                            <input type="checkbox" id="whyProgram">
                            <label for="whyProgram">
                                <h1>Why This Program? <span class="material-symbols-outlined">keyboard_arrow_right</span>
                                </h1>
                            </label>
                            <p>{!! nl2br(e($course->why)) !!}</p>
                        </div>
                        <div class="courseDetailContent whatwouldilearn" id="learnSection">
                            <input type="checkbox" id="learn">
                            <label for="learn">
                                <h1>What Would I Learn? <span class="material-symbols-outlined">keyboard_arrow_right</span>
                                </h1>
                            </label>

                            <p>{!! nl2br(e($course->what)) !!}</p>
                        </div>
                        <div class="courseDetailContent programstructure" id="structureSection">
                            <input type="checkbox" id="structure">
                            <label for="structure">
                                <h1>Program Structure <span class="material-symbols-outlined">keyboard_arrow_right</span>
                                </h1>
                            </label>

                            <p>{!! nl2br(e($course->structure)) !!}</p>
                        </div>
                        <div class="courseDetailContent careerprospects" id="careerSection">
                            <input type="checkbox" id="career">
                            <label for="career">
                                <h1>Your Career Prospects <span
                                        class="material-symbols-outlined">keyboard_arrow_right</span></h1>
                            </label>

                            <p>{!! nl2br(e($course->career)) !!}</p>
                        </div>


                    </div>
                    <div class="courseDetailsWrapper mt-3">
                        <div class="courseHeaderWrapper">
                            <h1>Course Modules </h1>
                            <p>Students will have to complete 60 credits in each semester. In total, a student has to
                                complete 480 credits to be eligible for the award of a Bachelor of Computer Science
                                ({{ $course->name }}).</p>
                        </div>
                        <!-- YEAR I — SEM I -->
                        <div class="courseDetailContent moduleDropdown" id="year1sem1Section">
                            <input type="checkbox" id="year1sem1">
                            <label for="year1sem1">
                                <h1>Year I, Sem I <span class="material-symbols-outlined">keyboard_arrow_right</span></h1>
                            </label>

                            <p>
                                @foreach ($modules as $module)
                                    @if($module->year == 1 && $module->semester == 1)
                                        <strong>{{ $module->name }}</strong><br>
                                        {{$module->description}}
                                        <br><br>
                                    @endif
                                @endforeach
                            </p>
                        </div>

                        <!-- YEAR I — SEM II -->
                        <div class="courseDetailContent moduleDropdown" id="year1sem2Section">
                            <input type="checkbox" id="year1sem2">
                            <label for="year1sem2">
                                <h1>Year I, Sem II <span class="material-symbols-outlined">keyboard_arrow_right</span></h1>
                            </label>

                            <p>
                                @foreach ($modules as $module)
                                    @if($module->year == 1 && $module->semester == 2)
                                        <strong>{{ $module->name }}</strong><br>
                                        {{$module->description}}
                                        <br><br>
                                    @endif
                                @endforeach
                            </p>
                        </div>

                        <!-- YEAR II — SEM I -->
                        <div class="courseDetailContent moduleDropdown" id="year2sem2Section">
                            <input type="checkbox" id="year2sem1">
                            <label for="year2sem1">
                                <h1>Year II, Sem I <span class="material-symbols-outlined">keyboard_arrow_right</span></h1>
                            </label>

                            <p>
                                @foreach ($modules as $module)
                                    @if($module->year == 2 && $module->semester == 1)
                                        <strong>{{ $module->name }}</strong><br>
                                        {{$module->description}}
                                        <br><br>
                                    @endif
                                @endforeach
                            </p>
                        </div>

                        <!-- YEAR II — SEM II -->
                        <div class="courseDetailContent moduleDropdown" id="year2sem2Section">
                            <input type="checkbox" id="year2sem2">
                            <label for="year2sem2">
                                <h1>Year II, Sem II <span class="material-symbols-outlined">keyboard_arrow_right</span></h1>
                            </label>

                            <p>
                                @foreach ($modules as $module)
                                    @if($module->year == 2 && $module->semester == 2)
                                        <strong>{{ $module->name }}</strong><br>
                                        {{$module->description}}
                                        <br><br>
                                    @endif
                                @endforeach
                            </p>
                        </div>

                        <!-- YEAR III — SEM I -->
                        <div class="courseDetailContent moduleDropdown" id="year3sem1Section">
                            <input type="checkbox" id="year3sem1">
                            <label for="year3sem1">
                                <h1>Year III, Sem I <span class="material-symbols-outlined">keyboard_arrow_right</span></h1>
                            </label>

                            <p>
                                @foreach ($modules as $module)
                                    @if($module->year == 3 && $module->semester == 1)
                                        <strong>{{ $module->name }}</strong><br>
                                        {{$module->description}}
                                        <br><br>
                                    @endif
                                @endforeach
                            </p>
                        </div>

                        <!-- YEAR III — SEM II -->
                        <div class="courseDetailContent moduleDropdown" id="year3sem2Section">
                            <input type="checkbox" id="year3sem2">
                            <label for="year3sem2">
                                <h1>Year III, Sem II <span class="material-symbols-outlined">keyboard_arrow_right</span>
                                </h1>
                            </label>

                            <p>
                                @foreach ($modules as $module)
                                    @if($module->year == 3 && $module->semester == 2)
                                        <strong>{{ $module->name }}</strong><br>
                                        {{$module->description}}
                                        <br><br>
                                    @endif
                                @endforeach
                            </p>
                        </div>

                        <!-- YEAR IV — SEM I -->
                        <div class="courseDetailContent moduleDropdown" id="year4sem1Section">
                            <input type="checkbox" id="year4sem1">
                            <label for="year4sem1">
                                <h1>Year IV, Sem I <span class="material-symbols-outlined">keyboard_arrow_right</span></h1>
                            </label>

                            <p>
                                @foreach ($modules as $module)
                                    @if($module->year == 4 && $module->semester == 1)
                                        <strong>{{ $module->name }}</strong><br>
                                        {{$module->description}}
                                        <br><br>
                                    @endif
                                @endforeach
                            </p>
                        </div>

                        <!-- YEAR IV — SEM II -->
                        <div class="courseDetailContent moduleDropdown" id="year4sem2Section">
                            <input type="checkbox" id="year4sem2">
                            <label for="year4sem2">
                                <h1>Year IV, Sem II <span class="material-symbols-outlined">keyboard_arrow_right</span></h1>
                            </label>

                            <p>
                                @foreach ($modules as $module)
                                    @if($module->year == 4 && $module->semester == 2)
                                        <strong>{{ $module->name }}</strong><br>
                                        {{$module->description}}
                                        <br><br>
                                    @endif
                                @endforeach
                            </p>
                        </div>


                    </div>
                </div>
                <div class="otherCourseContainer">
                    <div class="header">
                        <h1>More on Academics</h1>
                    </div>
                    <div class="otherContent">
                        <h1>Other Courses</h1>
                        @foreach ($otherCourses as $item)
                            <a href="/courseDetails/{{ $item->id }}">{{$item->name}}</a>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection