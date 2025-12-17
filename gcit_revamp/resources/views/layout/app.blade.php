<!DOCTYPE html>
<html>
  <head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>GCIT</title>
  <link rel="icon" href="{{ asset('images/logo/logo1.png') }}" type="image/png" />
  <link rel="stylesheet" href="{{ asset('css/theme.css') }}">
  <link rel="stylesheet" href="{{ asset('css/nav.css') }}">
  <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
  <link rel="stylesheet" href="{{ asset('css/home.css') }}">
  <link rel="stylesheet" href="{{ asset('css/pageTemplate.css') }}">
  <link rel="stylesheet" href="{{ asset('css/announcement.css') }}">
  <link rel="stylesheet" href="{{ asset('css/course.css') }}">
  <link rel="stylesheet" href="{{ asset('css/post.css') }}">
  <link rel="stylesheet" href="{{ asset('css/courseDetails.css') }}">
  <link rel="stylesheet" href="{{ asset('css/department.css') }}">
  <link rel="stylesheet" href="{{ asset('css/staff.css') }}">
  <link rel="stylesheet" href="{{ asset('css/about.css') }}">
  <link rel="stylesheet" href="{{ asset('css/project.css') }}">
  <link rel="stylesheet" href="{{ asset('css/search.css') }}">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <title>@yield('title')</title>
</head>

<body>


@include('layout.header')
<div class="smooth-wrapper">
    <div class="smooth-content">
        <!-- your entire page -->
        <div class="content">
            @yield('content')
        </div>
    </div>
</div>

@include('layout.footer')

<script src="https://cdn.jsdelivr.net/npm/gsap@3.13.0/dist/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollToPlugin.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/@studio-freight/lenis/dist/lenis.min.js"></script>
<script src="https://kit.fontawesome.com/8d21368d12.js" crossorigin="anonymous"></script>

<script type = "module" src = "{{ asset('js/website/animation.icon.js') }}"></script>
<script type = "module" src = "{{ asset('js/website/animation.smoothscroll.js') }}"></script>
<script src = "{{ asset('js/website/nav.js') }}"></script>
<script type = "module" src = "{{ asset('js/website/slider.js') }}"></script>
<script type = "module" src = "{{ asset('js/website/homeScroll.js') }}"></script>
<script type = "module" src = "{{ asset('js/website/templateScroll.js') }}"></script>
<script type = "module" src = "{{ asset('js/website/courseScroll.js') }}"></script>
<script type = "module" src = "{{ asset('js/website/detailsScroll.js') }}"></script>
<script type = "module" src = "{{ asset('js/website/projectSlider.animation.js') }}"></script>
<script src = "{{ asset('js/website/filter.js') }}"></script>
<script type = "module" src = "{{ asset('js/website/projectPageSlider.js') }}"></script>

<div class="filterOverlay"></div>

</body>
</html>
