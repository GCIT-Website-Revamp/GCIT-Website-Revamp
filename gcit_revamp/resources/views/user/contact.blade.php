<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact Us | GCIT</title>
  <link rel="stylesheet" href="{{ asset('css/contact.css') }}" />
  <link rel="stylesheet" href="{{asset('css/footer.css')}}" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>

  <!-- Contact Section -->
  <section class="contact-wrapper">
    <div class="contact-box">
      <!-- Contact Info -->
      <div class="contact-left">
        <h2>GET IN TOUCH WITH US</h2>
        <div class="info-block">
          <i class="fas fa-map-marker-alt icon"></i>
          <div>
            <strong>Office Address</strong><br>
            Gyalpozhing College of Information Technology<br>
            Royal University of Bhutan<br>
            PO-11007, Chamjekha, Thimphu, Bhutan
          </div>
        </div>

        <div class="info-block">
          <i class="fas fa-phone icon"></i>
          <div>
            <strong>Call Us</strong><br>
            ADM<br>Tel: +9752361194<br><br>
            Finance<br>Tel: 02-361195
          </div>
        </div>

        <div class="info-block">
          <i class="fas fa-envelope icon"></i>
          <div>
            <strong>Message Us</strong><br>
            Email: <a href="mailto:info.gcit@rub.edu.bt">info.gcit@rub.edu.bt</a><br>
            Web Admins: <a href="mailto:ict.gcit@rub.edu.bt">ict.gcit@rub.edu.bt</a>
          </div>
        </div>

        <div class="social-icons">
          <a href="#"><i class="fab fa-youtube"></i></a>
          <a href="#"><i class="fab fa-facebook"></i></a>
        </div>
      </div>

      <!-- Contact Form -->
      <div class="contact-right">
        <div class="contact-right-inner">
          <h2>WE WOULD LOVE TO HEAR FROM YOU</h2>
          <form>
            <input type="text" placeholder="Name" required />
            <input type="email" placeholder="Email" required />
            <textarea placeholder="Message" required></textarea>
            <button type="submit">Submit</button>
          </form>
        </div>

      </div>
    </div>
  </section>
  <footer class="gcit-footer">
    <div class="footer-content">
      <div class="footer-inner">
        <div class="footer-buttons">
          <button class="toggle-btn active" data-target="college-info">COLLEGE INFO</button>
          <button class="toggle-btn" data-target="e-services">E-SERVICES</button>
          <button class="toggle-btn" data-target="quick-links">QUICK-LINKS</button>
          <button class="toggle-btn" data-target="downloads">DOWNLOADS</button>
        </div>
        <div class="footer-details">
          <div class="footer-section show" id="college-info">
            <p class="info">Gyalpozhing College of Information Technology</p>
            <p class="info">Royal University of Bhutan</p>
            <p class="info">Chamjekha, Thimphu, Bhutan</p>
            <p class="info">Tel No.: +9752361194</p>
            <p class="info"><a class="links" href="mailto:info.gcit@rub.edu.bt">info.gcit@rub.edu.bt</a></p>
            <p class="info"><a class="links" href="mailto:ict.gcit@rub.edu.bt">ict.gcit@rub.edu.bt</a></p>
            <div class="social-icons">
              <a href="#"><i class="fab fa-facebook"></i></a>
              <a href="#"><i class="fab fa-youtube"></i></a>
              <a href="#"><i class="fab fa-linkedin"></i></a>
            </div>
          </div>

          <div class="footer-section" id="e-services">
            <ul>
              <p class="info"><a class="links" href="#">Happiness and Wellbeing Center</a></p>
              <p class="info"><a class="links" href="#">ICT Help Desk</a></p>
              <p class="info"><a class="links" href="#">Estate Help Desk</a></p>
              <p class="info"><a class="links" href="#">CCA</a></p>
              <p class="info"><a class="links" href="#">Library Catalog (OPAC) – Koha</a></p>
              <p class="info"><a class="links" href="#">RUB-Information Management System</a></p>
              <p class="info"><a class="links" href="#">RUB Web Mail</a></p>
              <p class="info"><a class="links" href="#">Virtual Learning Environment – Moodle</a></p>
              <p class="info"><a class="links" href="#">Staff Residence Application Form</a></p>
            </ul>
          </div>

          <div class="footer-section" id="quick-links">
            <ul>
              <p class="info"><a class="links" href="#">GCIT Calendar</a></p>
              <p class="info"><a class="links" href="#">Programs Offered</a></p>
              <p class="info"><a class="links" href="#">Alumni Network</a></p>
              <p class="info"><a class="links" href="#">Academic Resources</a></p>
            </ul>
          </div>

          <div class="footer-section" id="downloads">
            <ul>
              <p class="info"><a class="links" href="#">Class Trip Form</a></p>
              <p class="info"><a class="links" href="#">Forms</a></p>
              <p class="info"><a class="links" href="#">GCIT Strategic Plan</a></p>
              <p class="info"><a class="links" href="#">Monday Assembly Agenda Item</a></p>
              <p class="info"><a class="links"
                  href="https://www.gcit.edu.bt/revamp/wp-content/uploads/sites/4/2023/01/Time-and-stress-Management-Flyer.pdf"
                  target="_blank">Time and Stress Management Flyer</a></p>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="footer-bottom">
      <p>Copyright © Gyalpozhing College of Information Technology 2025. All Rights Reserved.</p>
    </div>
  </footer>
</body>
<script>
  const buttons = document.querySelectorAll(".toggle-btn");
  const sections = document.querySelectorAll(".footer-section");

  buttons.forEach(btn => {
    btn.addEventListener("click", () => {
      // Remove all active states
      buttons.forEach(b => b.classList.remove("active"));
      sections.forEach(s => s.classList.remove("show"));

      // Add to current
      btn.classList.add("active");
      document.getElementById(btn.dataset.target).classList.add("show");
    });
  });
</script>

</html>