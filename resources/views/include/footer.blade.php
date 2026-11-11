 <!-- Footer -->
    <footer id="primary-footer">
        <!-- footer widget start -->
        <div class="container footer-widget-area py-5">
            <div class="row">
                <div class="col-md-4 p-3">
                    <div class="footer-widget-heading">
                        <img src="https://pllohide.ca/public/assets/admin/images/logo_w.svg" alt="" height="60">
                    </div>
                    <div class="footer-address-row mt-4">
                        <a href="mailto:ceo@pllohide.ca" class="d-flex align-items-center g-3"><img
                                src="assets/images/mail-icon.svg" alt=""> ceo@pllohide.ca</a>
                    </div>
                    <div class="footer-address-row mt-4">
                        <img src="assets/images/location-icon.svg" alt="">
                        <p>C/O KUNG, LO&JIA LLP, 2025 WILLINGDON AVENUE, SUITE 900,BURNABY BC VSC 0J3 CANADA</p>
                    </div>

                </div>
                <div class="col-md-3 p-3">
                    <div class="footer-widget-heading">
                        <h4>Our Service</h4>
                    </div>
                    <ul class="linkediting mt-4">

                        <li><a href="https://pllohide.ca/public/#aboutSection">About Us</a></li>

                        <li><a href="https://pllohide.ca/public/#howitWorks">How It Works?</a></li>
                        <li><a href="https://pllohide.ca/public/#ourFeatures">Our Features</a></li>
                        <li><a href="https://pllohide.ca/public/#Community">Community</a></li>
                    </ul>
                </div>
                <div class="col-md-2 p-3">
                    <div class="footer-widget-heading">
                        <h4>More Links</h4>
                    </div>
                    <ul class="linkediting mt-4">
                        <li><a href="https://pllohide.ca/public/#subscriptionPlan">Pricing</a></li>
                        <li><a href="https://pllohide.ca/#faqs">FAQ</a></li>
                        <li><a href="{{ route('survey') }}">Survey</a></li>
                        <!-- <li><a href="">Team</a></li> -->
                        <li><a href="{{ route('blog') }}">Blog</a></li>
                    </ul>
                </div>
                <div class="col-md-3 p-3">
                    <div class="footer-social-icon">
                        <div class="footer-widget-heading">
                            <h4>Platform Connect</h4>
                        </div>
                        <div class="social-icon d-flex align-items-center justify-content-start gap-3 mt-4">



                            <a href="https://www.instagram.com/p/C_BQAs-uwgE/" target="_blank"
                                rel="noopener noreferrer">
                                <img loading="lazy" alt="Instagram" src="https://pllohide.ca/assets/admin/images/insta-icon.svg">
                            </a>

                            <!-- <img loading="lazy" alt="" src="https://ivory-eland-543071.hostingersite.com/pllohide/public/assets/admin/images/youtube-icon.svg"> -->
                            <a href="https://x.com/pllohide" target="_blank" rel="noopener noreferrer">
                                <img loading="lazy" alt="Twitter" src="https://pllohide.ca/assets/admin/images/twitter-icon.svg">
                            </a>

                            <a href="https://www.facebook.com/pllohide" target="_blank" rel="noopener noreferrer"><img
                                    loading="lazy" alt="Facebook" src="https://pllohide.ca/assets/admin/images/fb-icon.svg">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <!-- footer widget end -->

        <!-- footer credit -->
        <div class="copyright-area bg-white">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="copyright-text text-start">
                            <p>@ 2026 Copyright PlloHide. All Rights Reserved</p>
                        </div>
                    </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="copyright-link text-end d-flex align-items-center justify-content-end primary-text-color gap-2 py-2">
                            <a href="{{ route('privacy.policy') }}">Privacy Policy</a>  <a href="{{ route('terms') }}">Terms & Conditions</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- footer credit end -->
    </footer>

    <!-- Bootstrap JS -->
    <script src="{{ asset('/assets/admin/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('/assets/js/index.bundle.min.js') }}"></script>
    <script src="{{ asset('/assets/js/script.js') }}"></script>
       <script>
        baguetteBox.run('.tz-gallery');
    </script>
</body>

</html>