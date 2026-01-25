@extends('layout.app')

@section('title', 'Home')

@section('content')

    <div class="pageBannerWrapper courseContentContainer">
        <div class="backgroundWrapper">
            <div class="overlay"></div>
            <img src="{{ asset('images/pageBanner.png') }}" alt="">
        </div>
        <div class="bannerContent sectionWrapper noPadding">
            <div class="breadCrumbs">
                <a href="/">Home</a>
                <span class="material-symbols-outlined">keyboard_arrow_right</span>
                <a>Study</a>
                <span class="material-symbols-outlined">keyboard_arrow_right</span>
                <a href = "/course">Courses</a>
            </div>
            <div class="contentWrapper">
                <h2>{{ $course->type }}:</h2>
                <h1>{{ $course->name }}</h1>

            </div>
        </div>
    </div>
    <div class="pageContentWrapper courseContentContainer detailsWrapper">
        <input type="checkbox" id="courseMenuToggle" hidden>

<label for="courseMenuToggle" class="courseMenuBtn">
    <span class="material-symbols-outlined">menu</span>

</label>
        <div class="section">
            <div class="courseDetailsSection">
                
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
                        @if($course->type != "Speculative Electives")
                        <a href="#careerSection">Your Career Prospects</a>
                        @endif
                    </div>
                    <div class="menuSection">
                        <div class="header">
                            <div class="circle"></div>
                            <h1>Course Modules</h1>
                        </div>
                        <a href="#year1Section">Year I</a>
                        <a href="#year2Section">Year II</a>
                        <a href="#year3Section">Year III</a>
                        <a href="#year4Section">Year IV</a>
                    </div>
                </div>
                <div class="courseDetails">
                    <div class="courseDetailsWrapper">

                        <div class="courseHeaderWrapper">
                            <h1 class = "orange">{{ $course->header }}</h1><br>
                            <h1>{{ $course->header2 }}</h1>
                            <p>{!! $course->description !!}</p>

                        </div>
                        <div class="courseDetailContent whythisprogram" id="why">
                            <input type="checkbox" id="whyProgram">
                            <label for="whyProgram">
                                @if($course->type != "Speculative Electives")
                                    <h1>Why This Program? <span class="material-symbols-outlined">keyboard_arrow_right</span>
                                @else
                                    <h1>How This Track Empower You? <span class="material-symbols-outlined">keyboard_arrow_right</span>
                                @endif
                                
                                </h1>
                            </label>
                            <p>{!! $course->why !!}</p>
                        </div>
                        <div class="courseDetailContent whatwouldilearn" id="learnSection">
                            <input type="checkbox" id="learn">
                            <label for="learn">
                                <h1>What Would I Learn? <span class="material-symbols-outlined">keyboard_arrow_right</span>
                                </h1>
                            </label>

                            <p>{!! $course->what !!}</p>
                        </div>
                        <div class="courseDetailContent programstructure" id="structureSection">
                            <input type="checkbox" id="structure">
                            <label for="structure">
                                <h1>Program Structure <span class="material-symbols-outlined">keyboard_arrow_right</span>
                                </h1>
                            </label>

                            <p>{!! $course->structure !!}</p>
                        </div>
                        @if($course->type != "Speculative Electives")
                        <div class="courseDetailContent careerprospects" id="careerSection">
                            <input type="checkbox" id="career">
                            <label for="career">
                                <h1>Your Career Prospects <span
                                        class="material-symbols-outlined">keyboard_arrow_right</span></h1>
                            </label>

                            <p>{!! $course->career !!}</p>
                        </div>
                        @endif


                    </div>
                    <div class="courseDetailsWrapper mt-3">
                        <div class="courseHeaderWrapper">
                            <h1>Course Modules </h1>
                            <p>Students will have to complete 60 credits in each semester. In total, a student has to
                                complete 480 credits to be eligible for the award of a Bachelor of Computer Science
                                ({{ $course->name }}).</p>
                        </div>
                        
                        <!-- YEAR I -->
                        <div class="courseDetailContent moduleDropdown" id="year1Section">
                            <input type="checkbox" id="year1">
                            <label for="year1">
                                <h1>Year I <span class="material-symbols-outlined">keyboard_arrow_right</span></h1>
                            </label>

                            <div class="toggle-content">
                                <div class="module-table-wrapper">
                                    <table class="course-module-table">
                                        <thead>
                                            <tr>
                                                <th style="width: 80%;">Module Title</th>
                                                <th style="width: 20%;">Credit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- SEMESTER 1 -->
                                            <tr class="semester-row"><td colspan="2">Semester 1</td></tr>
                                            @if(isset($groupedModules[1][1]))
                                                @foreach($groupedModules[1][1] as $module)
                                                    <tr>
                                                        <td><strong>{{ $module->name }}</strong></td>
                                                        <td>{{ $module->description }}</td>
                                                    </tr>
                                                @endforeach
                                            @else
                                            <tr>
                                                    <td colspan="2">No modules available</td>
                                                </tr>
                                            @endif
                                            
                                            <!-- SEMESTER 2 -->
                                            <tr class="semester-row"><td colspan="2">Semester 2</td></tr>
                                            @if(isset($groupedModules[1][2]))
                                                @foreach($groupedModules[1][2] as $module)
                                                    <tr>
                                                        <td><strong>{{ $module->name }}</strong></td>
                                                        <td>{{ $module->description }}</td>
                                                    </tr>
                                                @endforeach
                                            @else
                                            <tr>
                                                    <td colspan="2">No modules available</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- YEAR II -->
                        <div class="courseDetailContent moduleDropdown" id="year2Section">
                            <input type="checkbox" id="year2">
                            <label for="year2">
                                <h1>Year II <span class="material-symbols-outlined">keyboard_arrow_right</span></h1>
                            </label>

                            <div class="toggle-content">
                                <div class="module-table-wrapper">
                                    <table class="course-module-table">
                                        <thead>
                                            <tr>
                                                <th style="width: 80%;">Module Title</th>
                                                <th style="width: 20%;">Credit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- SEMESTER 1 -->
                                            <tr class="semester-row"><td colspan="2">Semester 1</td></tr>
                                            @if(isset($groupedModules[2][1]))
                                                @foreach($groupedModules[2][1] as $module)
                                                    <tr>
                                                        <td><strong>{{ $module->name }}</strong></td>
                                                        <td>{{ $module->description }}</td>
                                                    </tr>
                                                @endforeach
                                            @else
                                            <tr>
                                                    <td colspan="2">No modules available</td>
                                                </tr>
                                            @endif
                                            
                                            <!-- SEMESTER 2 -->
                                            <tr class="semester-row"><td colspan="2">Semester 2</td></tr>
                                            @if(isset($groupedModules[2][2]))
                                                @foreach($groupedModules[2][2] as $module)
                                                    <tr>
                                                        <td><strong>{{ $module->name }}</strong></td>
                                                        <td>{{ $module->description }}</td>
                                                    </tr>
                                                @endforeach
                                            @else
                                            <tr>
                                                    <td colspan="2">No modules available</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- YEAR III -->
                        <div class="courseDetailContent moduleDropdown" id="year3Section">
                            <input type="checkbox" id="year3">
                            <label for="year3">
                                <h1>Year III <span class="material-symbols-outlined">keyboard_arrow_right</span></h1>
                            </label>

                            <div class="toggle-content">
                                <div class="module-table-wrapper">
                                    <table class="course-module-table">
                                        <thead>
                                            <tr>
                                                <th style="width: 80%;">Module Title</th>
                                                <th style="width: 20%;">Credit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- SEMESTER 1 -->
                                            <tr class="semester-row"><td colspan="2">Semester 1</td></tr>
                                            @if(isset($groupedModules[3][1]))
                                                @foreach($groupedModules[3][1] as $module)
                                                    <tr>
                                                        <td><strong>{{ $module->name }}</strong></td>
                                                        <td>{{ $module->description }}</td>
                                                    </tr>
                                                @endforeach
                                            @else
                                            <tr>
                                                    <td colspan="2">No modules available</td>
                                                </tr>
                                            @endif
                                            
                                            <!-- SEMESTER 2 -->
                                            <tr class="semester-row"><td colspan="2">Semester 2</td></tr>
                                            @if(isset($groupedModules[3][2]))
                                                @foreach($groupedModules[3][2] as $module)
                                                    <tr>
                                                        <td><strong>{{ $module->name }}</strong></td>
                                                        <td>{{ $module->description }}</td>
                                                    </tr>
                                                @endforeach
                                            @else
                                            <tr>
                                                    <td colspan="2">No modules available</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- YEAR IV -->
                        <div class="courseDetailContent moduleDropdown" id="year4Section">
                            <input type="checkbox" id="year4">
                            <label for="year4">
                                <h1>Year IV <span class="material-symbols-outlined">keyboard_arrow_right</span></h1>
                            </label>

                            <div class="toggle-content">
                                <div class="module-table-wrapper">
                                    <table class="course-module-table">
                                        <thead>
                                            <tr>
                                                <th style="width: 80%;">Module Title</th>
                                                <th style="width: 20%;">Credit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- SEMESTER 1 -->
                                            <tr class="semester-row"><td colspan="2">Semester 1</td></tr>
                                            @if(isset($groupedModules[4][1]))
                                                @foreach($groupedModules[4][1] as $module)
                                                    <tr>
                                                        <td><strong>{{ $module->name }}</strong></td>
                                                        <td>{{ $module->description }}</td>
                                                    </tr>
                                                @endforeach
                                            @else
                                            <tr>
                                                    <td colspan="2">No modules available</td>
                                                </tr>
                                            @endif
                                            
                                            <!-- SEMESTER 2 -->
                                            <tr class="semester-row"><td colspan="2">Semester 2</td></tr>
                                            @if(isset($groupedModules[4][2]))
                                                @foreach($groupedModules[4][2] as $module)
                                                    <tr>
                                                        <td><strong>{{ $module->name }}</strong></td>
                                                        <td>{{ $module->description }}</td>
                                                    </tr>
                                                @endforeach
                                            @else
                                            <tr>
                                                    <td colspan="2">No modules available</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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
    </div>
@endsection