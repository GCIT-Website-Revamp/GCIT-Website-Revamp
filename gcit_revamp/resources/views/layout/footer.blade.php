<footer>
   <div class="footerContentWrapper">
    <div class="logoContentWrapper">
        <div class="logoWrapper">
            <img src="{{ asset('images/logo/logoWhite.png') }}" alt="">
        </div>
        <div class="addressWrapper">
            <div class="address">
                <p>Gyalpozhing College of Information Technology</p>
                <p>Royal University of Bhutan</p>
                <p>Chamjekha, Thimphu, Bhutan</p>
            </div>
            <div class="contact">
                <p>Tel No. :  +975 236 1194</p>
                <p>info.gcit@rub.edu.bt</p>
                <p>ict.gcit@rub.edu.bt</p>
            </div>
        </div>
    </div>
    <div class="linkWrapper">
        <div class="dash"></div>

       <div class="linkContainer">
            <h1>Quick Links</h1>
            <a>Admissions 2024</a>
            <a>GovTech</a>
            <a>MoESD</a>
            <a>MoICE</a>
            <a>G2C</a>
            <a>RCSC</a>
            <a>RUB</a>
        </div>

        <div class="linkContainer">
            <h1>E-Services</h1>
            <a>Wellbeing Center</a>
            <a>ICT Desk</a>
            <a>Estate Desk</a>
            <a>CCA</a>
            <a>Library Catalog</a>
            <a>RUB IMS</a>
            <a>RUB Mail</a>
            <a>Moodle VLE</a>
            <a>Residence Form</a>
        </div>

        <div class="linkContainer">
            <h1>Downloads</h1>
            <a>Class Trip</a>
            <a>Forms</a>
            <a>Strategic Plan</a>
            <a>Assembly Agenda</a>
            <a>Stress Management</a>
        </div>

    </div>
   </div>
   <div class="subContentWrapper">
     <div class="socialWrapper">
                        <a href=""><i class="fa-brands fa-instagram"></i></a>
                        <a href=""><i class="fa-brands fa-linkedin"></i></a>
                        <a href=""><i class="fa-brands fa-facebook"></i></a>
    </div>
    <div class="copyRight">
        <div class="dash"></div>
        <p>Copyright © Gyalpozhing College of Information Technology 2025. All Rights Reserved.</p>
    </div>
   </div>
    <script>
    document.addEventListener('DOMContentLoaded', () => {

        document.querySelectorAll('.searchWrapper').forEach(wrapper => {
            const input = wrapper.querySelector('[data-search-input]');
            const icon  = wrapper.querySelector('.searchIcon');

            if (!input || !icon) return;

            const triggerSearch = () => {
                const q = input.value.trim();
                if (q.length < 2) return;

                window.location.href = `/search?q=${encodeURIComponent(q)}`;
            };

            input.addEventListener('keydown', (e) => {
                if (e.key === 'Enter') {
                    triggerSearch();
                }
            });

            icon.addEventListener('click', triggerSearch);
        });

    });
    </script>
</footer>