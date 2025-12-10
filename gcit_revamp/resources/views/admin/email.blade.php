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
         <p class="title">Please provide your Email</p>
      </div>
      <br>

      <div class="input_container">
         <label class="input_label">Email</label>
         <input placeholder="name@mail.com" name="email" type="email" class="input_field" required>
      </div>

      <button type="submit" class="sign-in_btn">
         <span>Send Email</span>
      </button>
      <a class="note" href="/admin">Login</a>
   </form>

   <script>
      document.getElementById("loginForm").addEventListener("submit", function (e) {
         e.preventDefault();

         let form = e.target;
         let formData = new FormData(form);

         fetch("/api/send-otp-email", {
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
                     title: "Email Sent!",
                     text: data.message
                  }).then(() => {
                     // Redirect to OTP verification page
                     window.location.href = "/verify-otp?email=" + formData.get("email");
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