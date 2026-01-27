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
        <div class="contactFormSection">
            <div class="formContainer">
                <div class="formHeader">
                    <h2 class="main-header">Send Us a Message</h2>
                    <p>Have a question? Fill out the form below and we'll get back to you as soon as possible.</p>
                </div>

                <form id="contactForm" class="contactForm">
                    @csrf

                    <div class="formRow">
                        <div class="formGroup">
                            <label>First Name *</label>
                            <input type="text" name="first_name" required>
                        </div>
                        <div class="formGroup">
                            <label>Last Name *</label>
                            <input type="text" name="last_name" required>
                        </div>
                    </div>

                    <div class="formRow">
                        <div class="formGroup">
                            <label>Email *</label>
                            <input type="email" name="email" required>
                        </div>
                        <div class="formGroup">
                            <label>Contact Number</label>
                            <input type="tel" name="contact_number">
                        </div>
                    </div>

                    <div class="formGroup">
                        <label>Subject *</label>
                        <select name="type" required>
                            <option value="">Select a subject</option> 
                            <option value="Admission Inquiry">Admission Inquiry</option> 
                            <option value="General Information">General Information</option> 
                            <option value="Technical Support">Technical Support</option> 
                            <option value="Partnership Opportunity">Partnership Opportunity</option>
                            <option value="Campus Complaints">Campus Complaints</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <div class="formGroup">
                        <label>Message *</label>
                        <textarea name="message" required></textarea>
                    </div>

                    <button type="submit" class="submitBtn">
                        Send Message
                    </button>
                </form>
            </div>
        </div>

        <!-- Quick Links Section -->
        <div class="section sectionWrapper quickLinksSection">
            <h2 class="main-header">Looking for Something Specific?</h2>
            <div class="quickLinksGrid">
                <a href="/admission" class="quickLinkCard">
                    <span class="material-symbols-outlined">school</span>
                    <h3>Admissions</h3>
                    <p>Learn about our programs and application process</p>
                </a>
                <a href="/project" class="quickLinkCard">
                    <span class="material-symbols-outlined">menu_book</span>
                    <h3>Industry Projects</h3>
                    <p>Explore our Project Catalog</p>
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
    <script>
        document.getElementById('contactForm').addEventListener('submit', function (e) {
            e.preventDefault();

            const form = this;
            const formData = new FormData(form);
            formData.append('status', 'Unread');

            fetch("/api/contact", {
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value,
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(async response => {
                const data = await response.json();

                if (!response.ok) {
                    throw data;
                }
                Swal.fire({
                    icon: 'success',
                    title: 'Message Sent!',
                    text: 'We will get back to you shortly.',
                });

                form.reset();
            })
            .catch(error => {
                let message = 'Something went wrong. Please try again.';
                if (error.errors) {
                    message = Object.values(error.errors)
                        .map(err => err[0])
                        .join('\n');
                }

                Swal.fire({
                    icon: 'error',
                    title: 'Oops!',
                    text: message,
                });
            });
        });
    </script>

@endsection