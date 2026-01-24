@extends('layout.app')

@section('title', 'Contact Us')

@section('content')

    <!-- Page Banner -->
    <div class="pageBannerWrapper">
        <div class="backgroundWrapper">
            <div class="overlay"></div>
            <img src="{{ asset('images/pageBanner.png') }}" alt="Contact Us Banner">
        </div>
        <div class="bannerContent sectionWrapper">
            <div class="breadCrumbs">
                <a href="/">Home</a>
                <span class="separator">/</span>
                <span class="current">Contact Us</span>
            </div>
            <div class="contentWrapper">
                <h1>Contact Us</h1>
                <p class="bannerSubtext">We're here to help and answer any questions you might have</p>
            </div>
        </div>
    </div>

    <!-- Contact Content -->
    <div class="pageContentWrapper contactPageWrapper detailsWrapper">

        <!-- Contact Cards Grid -->
      

        <!-- Contact Form Section -->
        <div class="sectionWrapper contactFormSection">
            <div class="formContainer">
                <div class="formHeader">
                    <h2 class="main-header">Send Us a Message</h2>
                    <p>Have a question? Fill out the form below and we'll get back to you as soon as possible.</p>
                </div>

                <form action="#" method="POST" class="contactForm">
                    @csrf

                    <div class="formRow">
                        <div class="formGroup">
                            <label for="first_name">First Name *</label>
                            <input type="text" id="first_name" name="first_name" required>
                        </div>
                        <div class="formGroup">
                            <label for="last_name">Last Name *</label>
                            <input type="text" id="last_name" name="last_name" required>
                        </div>
                    </div>

                    <div class="formRow">
                        <div class="formGroup">
                            <label for="email">Email Address *</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        <div class="formGroup">
                            <label for="phone">Phone Number</label>
                            <input type="tel" id="phone" name="phone">
                        </div>
                    </div>

                    <div class="formGroup">
                        <label for="subject">Subject *</label>
                        <select id="subject" name="subject" required>
                            <option value="">Select a subject</option>
                            <option value="admission">Admission Inquiry</option>
                            <option value="general">General Information</option>
                            <option value="technical">Technical Support</option>
                            <option value="partnership">Partnership Opportunity</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <div class="formGroup">
                        <label for="message">Message *</label>
                        <textarea id="message" name="message" rows="6" required></textarea>
                    </div>

                    <button type="submit" class="submitBtn">
                        Send Message
                        <span class="material-symbols-outlined">send</span>
                    </button>
                </form>
            </div>
        </div>

        <!-- Quick Links Section -->
        <div class="section sectionWrapper quickLinksSection">
            <h2 class="main-header">Looking for Something Specific?</h2>
            <div class="quickLinksGrid">
                <a href="/admissions" class="quickLinkCard">
                    <span class="material-symbols-outlined">school</span>
                    <h3>Admissions</h3>
                    <p>Learn about our programs and application process</p>
                </a>
                <a href="/programs" class="quickLinkCard">
                    <span class="material-symbols-outlined">menu_book</span>
                    <h3>Programs</h3>
                    <p>Explore our degree offerings</p>
                </a>
                <a href="/about" class="quickLinkCard">
                    <span class="material-symbols-outlined">info</span>
                    <h3>About GCIT</h3>
                    <p>Discover our mission and values</p>
                </a>
                <a href="/faculty" class="quickLinkCard">
                    <span class="material-symbols-outlined">groups</span>
                    <h3>Faculty</h3>
                    <p>Meet our expert teaching staff</p>
                </a>
            </div>
        </div>

    </div>

@endsection