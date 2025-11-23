<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="viewport" content="initial-scale=1, maximum-scale=1">
   <title>GCIT Admin</title>
   <meta name="csrf-token" content="{{ csrf_token() }}">
   <link rel="icon" href="{{ asset('images/logo/logo1.png') }}" type="image/png" />
   <link rel="stylesheet" href="{{ asset('css/admin/login.css') }}" />
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

   <style>
      .password-wrapper {
         position: relative;
      }

      .toggle-eye {
         position: absolute;
         right: 12px;
         top: 50%;
         transform: translateY(-50%);
         cursor: pointer;
         width: 22px;
         height: 22px;
         opacity: 0.6;
         transition: opacity 0.2s;
         margin-top: 0.6rem;
      }

      .toggle-eye:hover {
         opacity: 1;
      }

      .eye-open, .eye-closed {
         display: none;
      }

      .eye-open.active, .eye-closed.active {
         display: block;
      }
   </style>
</head>

<body class="inner_page login">
   <form id="loginForm" class="form_container">
      @csrf

      <div class="logo_container">
         <img width="80" src="{{ asset('images/logo/logo1.png') }}" alt="#" />
      </div>

      <div class="title_container">
         <p class="title">Login to your Account</p>
      </div>
      <br>

      <div class="input_container">
         <label class="input_label">Email</label>
         <input placeholder="name@mail.com" name="email" type="email" class="input_field" required>
      </div>

      <div class="input_container password-wrapper">
         <label class="input_label">Password</label>
         <input placeholder="Password" name="password" type="password" id="password_field" class="input_field" required>
         <div class="toggle-eye" id="togglePassword">
            <!-- Open eye SVG -->
            <svg class="eye-open active" fill="none" viewBox="0 0 24 24" width="100%" height="100%">
               <path stroke="#000" stroke-width="1.5"
                  d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7S2 12 2 12z" />
               <circle cx="12" cy="12" r="3" stroke="#000" stroke-width="1.5" />
            </svg>
            <!-- Closed eye SVG -->
            <svg class="eye-closed" fill="none" viewBox="0 0 24 24" width="100%" height="100%">
               <path stroke="#000" stroke-width="1.5"
                  d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7S2 12 2 12z" />
               <path stroke="#000" stroke-width="1.5" d="M4 4l16 16" />
            </svg>
         </div>
      </div>

      <button type="submit" class="sign-in_btn">
         <span>Sign In</span>
      </button>

      <p class="note">Forgot Password?</p>
   </form>

   <script>
      const passwordField = document.getElementById("password_field");
      const togglePassword = document.getElementById("togglePassword");
      const eyeOpen = document.querySelector(".eye-open");
      const eyeClosed = document.querySelector(".eye-closed");

      togglePassword.addEventListener("click", () => {
         const type = passwordField.type === "password" ? "text" : "password";
         passwordField.type = type;
         
         // Toggle eye icons
         if (type === "text") {
            eyeOpen.classList.remove("active");
            eyeClosed.classList.add("active");
         } else {
            eyeOpen.classList.add("active");
            eyeClosed.classList.remove("active");
         }
      });

      document.getElementById("loginForm").addEventListener("submit", function (e) {
         e.preventDefault();

         const form = e.target;
         const formData = new FormData(form);

         fetch("{{ route('login') }}", {
            method: "POST",
            body: formData,
            headers: {
               "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
            }
         })
         .then(res => res.json())
         .then(data => {
            if (data.success) {
               Swal.fire({
                  icon: "success",
                  title: "Login Successful!",
                  text: data.message
               }).then(() => {
                  window.location.href = data.redirect ?? "/dashboard";
               });
            } else {
               Swal.fire({
                  icon: "error",
                  title: "Login Failed",
                  text: data.message ?? "Invalid credentials"
               });
            }
         })
         .catch(error => {
            Swal.fire({
               icon: "error",
               title: "Server Error",
               text: "Something went wrong!"
            });
            console.error(error);
         });
      });
   </script>
</body>
</html>