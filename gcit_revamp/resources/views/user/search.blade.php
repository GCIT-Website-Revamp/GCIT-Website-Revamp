@extends('layout.app')

@section('title', 'Home')

@section('content')

    <div>
        <div class="searchHeader ">
            <div class="sectionWrapper">
                <div class="searchHeaderContent ">
                    <h2>Showing 123 results for:</h2>
                    <h1>Courses</h1>
                </div>
                <div class="searchPageBar">
                    <input type="text" placeholder = "Search">
                    <span></span>
                </div>
            </div>
        </div>
        <div class="searchResultWrapper sectionWrapper">
            <div class="searchResult">
                <div class="searchBoxContainer">
                    <div class="resultBox">
                        <p class="page">Courses</p>
                        <h1 class="">School of AI and Data Science</h1>
                        <p class="searchDescription">
                            "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
                        </p>
                        <a href="" class="searchLink"><p>View More</p><span class="material-symbols-outlined">keyboard_arrow_right</span></a>
                        
                    </div>
                    <div class="resultBox">
                        <p class="page">Courses</p>
                        <h1 class="">School of AI and Data Science</h1>
                        <p class="searchDescription">
                            "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
                        </p>
                        <a href="" class="searchLink"><p>View More</p><span class="material-symbols-outlined">keyboard_arrow_right</span></a>
                    </div>
                    <div class="resultBox">
                        <p class="page">Courses</p>
                        <h1 class="">School of AI and Data Science</h1>
                        <p class="searchDescription">
                            "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
                        </p>
                        <a href="" class="searchLink"><p>View More</p><span class="material-symbols-outlined">keyboard_arrow_right</span></a>
                    </div>
                    <!-- <div class="notFoundBox">
                        No search Results found for Courses
                    </div> -->
                </div>
            </div>
        </div>
    </div>

@endsection
