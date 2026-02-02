<footer>
    <div class="footerContentWrapper sectionWrapper">
        <div class="logoContentWrapper">
            <div class="logoWrapper">
                <img src="{{ asset('images/logo/logoWhite.png') }}" alt="">
            </div>
            <div class="addressWrapper">
                <div class="address">
                    <p>GCIT</p>
                    <p>Royal University of Bhutan</p>
                    <p>Chamjekha, Thimphu, Bhutan</p>
                </div>
                <div class="contact">
                    <p>Tel No. : +975 236 1194</p>
                    <p>info.gcit@rub.edu.bt</p>
                    <p>ict.gcit@rub.edu.bt</p>
                </div>
            </div>
        </div>
        <div class="linkWrapper">
            <div class="dash"></div>

            <div class="linkContainer">
                <h1>Quick Links</h1>
                <a href = "/admission">Admissions</a>
                <a href="https://tech.gov.bt/">GovTech</a>
                <a href="https://www.citizenservices.gov.bt/g2cportal/ListOfLifeEventComponent">G2C</a>
                <a href="https://education.gov.bt/">MoESD</a>
                <a href="https://www.moice.gov.bt/">MoICE</a>
                <a href="https://rcsc.gov.bt/">RCSC</a>
                <a href="https://www.rub.edu.bt/">RUB</a>
            </div>

            <div class="linkContainer">
                <h1>E-Services</h1>
                <a href = "https://cca.gcit.edu.bt/">CCA</a>
                <a href = "https://ims.rub.edu.bt/public/auth/view-login">RUB IMS</a>
                <a href = "http://mail.rub.edu.bt/">RUB Mail</a>
            </div>

            <div class="linkContainer">
                <h1>Downloads</h1>
                <a href = "https://forms.gle/wYpLd2ZaMtFDcrCa7">Class Trip Form</a>
            </div>

        </div>
    </div>
    <div class="subContentWrapper sectionWrapper">
        <div class="socialWrapper">
            <a href="https://www.linkedin.com/company/gyalpozhingcollegeit/"><i class="fa-brands fa-linkedin"></i></a>
            <a href="https://www.facebook.com/GCIT.Bhutan"><i class="fa-brands fa-facebook"></i></a>
        </div>
        <div class="copyRight">
            <div class="dash"></div>
            <p class='desktop'>
                Copyright © GCIT
                <span class="currentYear">2025</span>.
                All Rights Reserved.
            </p>
            <p class="mobile">
                Copyright © GCIT
                <span class="currentYear">2025</span>.
                <br>
                All Rights Reserved.
            </p>
        </div>
    </div>
    <script>
        document.querySelectorAll(".currentYear").forEach(element => {
            element.textContent = new Date().getFullYear();
        });

    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {

            document.querySelectorAll('.searchWrapper').forEach(wrapper => {
                const input = wrapper.querySelector('[data-search-input]');
                const icon = wrapper.querySelector('.searchIcon');

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