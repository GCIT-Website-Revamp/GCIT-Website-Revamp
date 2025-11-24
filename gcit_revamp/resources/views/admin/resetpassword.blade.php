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

      .eye-open,
      .eye-closed {
         display: none;
      }

      .eye-open.active,
      .eye-closed.active {
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
         <p class="title">Reset your Password</p>
      </div>
      <br>
      <input type="hidden" name="email" value="{{ request('email') }}">
      <!-- NEW PASSWORD -->
      <div class="input_container password-wrapper">
         <label class="input_label">New Password</label>
         <input placeholder="New Password" id="new_password" name="new_password" type="password" class="input_field"
            required>

         <div class="toggle-eye" id="toggleNewPassword">
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


      <!-- CONFIRM PASSWORD -->
      <div class="input_container password-wrapper">
         <label class="input_label">Confirm Password</label>
         <input placeholder="Confirm Password" id="confirm_password" name="confirm_password" type="password"
            class="input_field" required>

         <div class="toggle-eye" id="toggleConfirmPassword">
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
         <span>Reset Password</span>
      </button>

      <a class="note" href="/admin">Login</a>
   </form>

   <script>
      function setupPasswordToggle(inputId, toggleId) {
         const input = document.getElementById(inputId);
         const toggle = document.getElementById(toggleId);
         const eyeOpen = toggle.querySelector(".eye-open");
         const eyeClosed = toggle.querySelector(".eye-closed");

         toggle.addEventListener("click", () => {
            const isHidden = input.type === "password";
            input.type = isHidden ? "text" : "password";

            eyeOpen.classList.toggle("active", !isHidden);
            eyeClosed.classList.toggle("active", isHidden);
         });
      }

      setupPasswordToggle("new_password", "toggleNewPassword");
      setupPasswordToggle("confirm_password", "toggleConfirmPassword");

      document.getElementById("loginForm").addEventListener("submit", function (e) {
         e.preventDefault();

         let form = e.target;
         let formData = new FormData(form);

         // Confirm password check (frontend)
         if (formData.get("new_password") !== formData.get("confirm_password")) {
            Swal.fire({
               icon: "error",
               title: "Password Mismatch",
               text: "New password and confirm password do not match."
            });
            return;
         }

         fetch("/api/reset-password", {
            method: "POST",
            body: formData,
            headers: {
               "X-CSRF-TOKEN": document.querySelector('meta[name=\"csrf-token\"]').content
            }
         })
            .then(res => res.json())
            .then(data => {
               if (data.success) {
                  Swal.fire({
                     icon: "success",
                     title: "Password Reset!",
                     text: data.message
                  }).then(() => {
                     window.location.href = "/admin"; // redirect to login
                  });
               } else {
                  Swal.fire({
                     icon: "error",
                     title: "Error",
                     text: data.message
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