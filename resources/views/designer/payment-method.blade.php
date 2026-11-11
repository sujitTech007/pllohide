<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PlloHide</title>
    <!-- Bootstrap CSS -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
        integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/dashboard.css">
        <link rel="stylesheet" href="assets/css/footer.css">


</head>

<body>
    <div id="root">
        <div>
            <header class="header_top">
                <nav class="navbar navbar-expand-lg navbar navbar-expand-lg navbar-light">
                    <div class="container"><a href="/Community"><span to="/Community" class="navbar-brand"><img
                                    src="assets/images/logo.svg"></span></a><button
                            aria-controls="basic-navbar-nav" type="button" aria-label="Toggle navigation"
                            class="navbar-toggler collapsed"><span class="navbar-toggler-icon"></span></button>
                        <div class="navbar-collapse collapse" id="basic-navbar-nav">
                            <div class="me-auto navbar-nav"></div>
                            <div class="user_login dropdown"><button type="button" id="dropdown-basic"
                                    aria-expanded="false" class="btn dropdown-toggle btn btn-primary"><img
                                        src="data:image/png;base64,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"></button>
                            </div>
                        </div>
                    </div>
                </nav>
            </header>
            <div class="Subscrip_sect invdi_sect">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="box_plan">
                                <h3>Payment Method</h3>
                                <p class="brd_underline">Select your payment method and enter your payment information.
                                </p>
                                <div class="row">
                                    <div class="col-lg-7 col-md-12 col-sm-12">
                                        <div class="credit_card_bx mt-3">
                                            <ul>
                                                <li><span class="fa fa-credit-card"></span> net banking </li>
                                                <li><span class="fa fa-credit-card"></span> credit/debit card</li>
                                                <li><span class="fa fa-credit-card"></span> Add New Card </li>
                                            </ul>
                                            <h3>Card Number</h3>
                                            <div class="frm_grp"><label class="label_nrm" for="">Enter the 16- digit
                                                    card number</label><input type="text"
                                                    placeholder="xxxx xxxx xxxx xxxx" class="form-control "><span
                                                    class="icon_bx"><img
                                                        src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACgAAAAaCAYAAADFTB7LAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAOlSURBVHgB7ZdZSFRRGMf/o3fGGZ1SSzOdbNNsocgWy7BFkkJIo30j6qXorUUQog3bKIksq6eIfKhoz5aHsqQMTFMjc4HMCsYlt0ZHvDPOHWe5nXNGr5OoI9nDDfrB5X7n4yzf+X/nnHuuYsXRh+KyWeMgR96U1wlc/MxxOLRxAeSIw+EERw1Llx3bM15ALmhUHG6mJDKbBdhpteNRwTfIhUCtWrK9IHP+Bzhc2Br09eGwb/UcyAW6SXrgehwXdy3D38Jqd6C2hYcoAhGh/vD2UvRbj7fY4KP0gorzHrAvDoPQ3N6JqzkVuPTsEyu/S9+EKF0gs3dcyMGr0ho8ObIaq048Yb6Cc5vxtqIeqVn5aDcLzOenVpJzNkY6a/dfe4tbeVWYGxGMtG2LoPT2wvzIkD8LMCTAF6lr5+HYrUJWpscRJfv9d9x48xnHtixEmd4AQ4cFkWEBsHY5sPtKLkID/XD/4DpoNUo8/6DHxrgo1q66oR2ZT0uZXVVvROTYAFZnMAYNkKIm6efILO3kVBdsdpI2ESlEhYljRuLwpgVITMtm9RLnTMC9/GpmCzYHoicFI2ikBrFRoVJfG848Q3jQCNQZeLTyAoL9NZ6GH9ou1qhca8RMFMwk6da3dODynni08VbkkZRStiydiuWzw5ltNAmISbmNoi9NUh90qVTUtCJr30pXX4INfGeXx7GHFKCP0iU0TcvZByXYuXwGkmIm41VZLdsI4UFaxE0PA/2uZx9KZurSScSm3sHr8jqm2Kl7xazd0pk6KBSuTWPgLR7HHlKA6u4Az9wvZilO2xbLyg+6U5owe7xUd01sBErOb0XYKD9WziWTOHW3GHU/eVTWGJB04rFU19AheBzb4xqkqJSuefxoNSFzdzxTyCzYkVNay/ybl0zFyTtFmED8i6aFotFolo4OrVpFJkZUT5iOpPmTma9C38rq0KBjpoQMP8AeBaN0AdibHM3sl6V6WMmmGaX1wYro8Ugnqc+rrJfa0MM/fediXM+thG60Fqe3x7E3JePxRxZgm8mzgjh9t0j0BOlIbDKaRZOlS/JRm/qaydMDUVgsqm4UvzYYRYfTyXy0Du/Wzr2tqY+/L8dvF1pc0ljbgUdxA04isB+fX/fjTlj3407IENv+hsofWF/AzN4UO22QDW6x/Bu3GVmhDiKy9X7+5KegjtyqfMdIRZeCHPkHSMiCbPDu/Sfh6DexhXcSaeVzYWWQq56Z3BcVSM44ANmisP8C5wvC31hke8cAAAAASUVORK5CYII="
                                                        alt=""><img
                                                        src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAHpSURBVHgBvVQ7SMNQFD1Jo4guBT+bUAdHoTroalEHBzVOOgY/ODhYB0EHXVzFD65+Oupk1EHwQ50cbQcRxMGCmzjUwSLS5nlvmrRJm7RUxANJ7n3JOzn3nfse8MeQqn2gXaghpR4LhoEPI4tYbFhP/ZpQu1TDgQBOKAxZQ6ncNyKVSMsIp+PqAgRUCoP0DPvMurWe+n5E3/ElnLpRozSwhRoggMWDAX3bzmUXu4Qx1AhJuOfIqBGTnVPm5UDQk5DdJP39lchGOyYx2D5iXo1KkyUR4Vkyz0XIZIF6xCuRtTS0EeGEGZ+9HCGT/Sy8M6gTTEE2oaxAQ7E1CgQ2WM1Sz7oZP6UfiPC49H8hqQ5RDhS+CQlBp93drb2Y71rB+9cbNu5XMULKmukHnB8+7sILZE66SBjAtjAwJlkqM9mMWRKrXOvdLKzXOSlj0lJQ66QMBTGT2B7khaW1SDhL5jKbrdKvX89x9HzgqS4noyMWye8eV2NPX6sJds3OWRkbEW7tw/LdnCcZybvdH9Qjdqq4Xsq0DqKYctmsysMEX7gaWwicen3kbJEygZJ7TtnhMHOlRsmk/Hbya3SBJFcj5XC6N1Tcx56ETmhxNSQbiNvum27KGCcDkn5zqh+wTJqFRgdHMEftZbv5b/gBay+hxqYW/GsAAAAASUVORK5CYII="
                                                        alt=""></span></div>
                                            <h3>Card Holder Name</h3>
                                            <div class="frm_grp"><label class="label_nrm" for="">Enter Card holder name
                                                </label><input type="text" placeholder="Maria Barrymore"
                                                    class="form-control" required=""><span class="icon_bx"><img
                                                        src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAHpSURBVHgBvVQ7SMNQFD1Jo4guBT+bUAdHoTroalEHBzVOOgY/ODhYB0EHXVzFD65+Oupk1EHwQ50cbQcRxMGCmzjUwSLS5nlvmrRJm7RUxANJ7n3JOzn3nfse8MeQqn2gXaghpR4LhoEPI4tYbFhP/ZpQu1TDgQBOKAxZQ6ncNyKVSMsIp+PqAgRUCoP0DPvMurWe+n5E3/ElnLpRozSwhRoggMWDAX3bzmUXu4Qx1AhJuOfIqBGTnVPm5UDQk5DdJP39lchGOyYx2D5iXo1KkyUR4Vkyz0XIZIF6xCuRtTS0EeGEGZ+9HCGT/Sy8M6gTTEE2oaxAQ7E1CgQ2WM1Sz7oZP6UfiPC49H8hqQ5RDhS+CQlBp93drb2Y71rB+9cbNu5XMULKmukHnB8+7sILZE66SBjAtjAwJlkqM9mMWRKrXOvdLKzXOSlj0lJQ66QMBTGT2B7khaW1SDhL5jKbrdKvX89x9HzgqS4noyMWye8eV2NPX6sJds3OWRkbEW7tw/LdnCcZybvdH9Qjdqq4Xsq0DqKYctmsysMEX7gaWwicen3kbJEygZJ7TtnhMHOlRsmk/Hbya3SBJFcj5XC6N1Tcx56ETmhxNSQbiNvum27KGCcDkn5zqh+wTJqFRgdHMEftZbv5b/gBay+hxqYW/GsAAAAASUVORK5CYII="
                                                        alt=""></span></div>
                                            <div class="grp_sect mb-3">
                                                <div class="lft_bx">
                                                    <h3>CVV Number</h3><label class="label_nrm" for="">Enter the 3 digit
                                                        number</label>
                                                </div>
                                                <div class="lft_bx"><input type="text" class="form-control"
                                                        maxlength="3" required=""></div>
                                            </div>
                                            <div class="grp_sect">
                                                <div class="lft_bx">
                                                    <h3>Expiry Date</h3><label class="label_nrm" for="">Enter the
                                                        Expiration date of the card</label>
                                                </div>
                                                <div class="rgt_bx"><input type="text" class="form-control"
                                                        placeholder="MM" maxlength="2" required=""><span>/</span><input
                                                        type="text" class="form-control" placeholder="YY" maxlength="2"
                                                        required=""></div>
                                            </div>
                                            <div class="btn_grp_com"><button class="btn bg_btn">Confirm and Pay</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5 col-md-12 col-sm-12">
                                        <div class="paym_card">
                                            <div class="crd_details">
                                                <div class="crd_img_wif"><img
                                                        src="data:image/png;base64,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"
                                                        alt=""></div>
                                                <h3>Card Holder name</h3>
                                                <p></p>
                                                <div class="crd_det">
                                                    <h3>MM/YY</h3>
                                                    <div class="crd_name "><img
                                                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACgAAAAaCAYAAADFTB7LAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAOlSURBVHgB7ZdZSFRRGMf/o3fGGZ1SSzOdbNNsocgWy7BFkkJIo30j6qXorUUQog3bKIksq6eIfKhoz5aHsqQMTFMjc4HMCsYlt0ZHvDPOHWe5nXNGr5OoI9nDDfrB5X7n4yzf+X/nnHuuYsXRh+KyWeMgR96U1wlc/MxxOLRxAeSIw+EERw1Llx3bM15ALmhUHG6mJDKbBdhpteNRwTfIhUCtWrK9IHP+Bzhc2Br09eGwb/UcyAW6SXrgehwXdy3D38Jqd6C2hYcoAhGh/vD2UvRbj7fY4KP0gorzHrAvDoPQ3N6JqzkVuPTsEyu/S9+EKF0gs3dcyMGr0ho8ObIaq048Yb6Cc5vxtqIeqVn5aDcLzOenVpJzNkY6a/dfe4tbeVWYGxGMtG2LoPT2wvzIkD8LMCTAF6lr5+HYrUJWpscRJfv9d9x48xnHtixEmd4AQ4cFkWEBsHY5sPtKLkID/XD/4DpoNUo8/6DHxrgo1q66oR2ZT0uZXVVvROTYAFZnMAYNkKIm6efILO3kVBdsdpI2ESlEhYljRuLwpgVITMtm9RLnTMC9/GpmCzYHoicFI2ikBrFRoVJfG848Q3jQCNQZeLTyAoL9NZ6GH9ou1qhca8RMFMwk6da3dODynni08VbkkZRStiydiuWzw5ltNAmISbmNoi9NUh90qVTUtCJr30pXX4INfGeXx7GHFKCP0iU0TcvZByXYuXwGkmIm41VZLdsI4UFaxE0PA/2uZx9KZurSScSm3sHr8jqm2Kl7xazd0pk6KBSuTWPgLR7HHlKA6u4Az9wvZilO2xbLyg+6U5owe7xUd01sBErOb0XYKD9WziWTOHW3GHU/eVTWGJB04rFU19AheBzb4xqkqJSuefxoNSFzdzxTyCzYkVNay/ybl0zFyTtFmED8i6aFotFolo4OrVpFJkZUT5iOpPmTma9C38rq0KBjpoQMP8AeBaN0AdibHM3sl6V6WMmmGaX1wYro8Ugnqc+rrJfa0MM/fediXM+thG60Fqe3x7E3JePxRxZgm8mzgjh9t0j0BOlIbDKaRZOlS/JRm/qaydMDUVgsqm4UvzYYRYfTyXy0Du/Wzr2tqY+/L8dvF1pc0ljbgUdxA04isB+fX/fjTlj3407IENv+hsofWF/AzN4UO22QDW6x/Bu3GVmhDiKy9X7+5KegjtyqfMdIRZeCHPkHSMiCbPDu/Sfh6DexhXcSaeVzYWWQq56Z3BcVSM44ANmisP8C5wvC31hke8cAAAAASUVORK5CYII="
                                                            alt="">
                                                        <p>Visa card</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="text">Amount to Pay</p>
                                            <div class="pay__bx">
                                                <p><span>CAD 400</span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                   </div>
    </div>

    <!-- Footer -->
    <footer id="primary-footer">
        <!-- footer widget start -->
        <div class="container footer-widget-area py-5">
            <div class="row">
                <div class="col-md-4 p-3">
                    <div class="footer-widget-heading">
                        <img src="assets/images/footer-logo.png" alt="" height="51">
                    </div>
                    <div class="footer-address-row mt-4">
                         <a href="mailto:ceo@pllohide.ca" class="d-flex align-items-center g-3"><img src="assets/images/mail-icon.svg" alt=""> ceo@pllohide.ca</a>
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
                        
                    <li><a href="/#about-us">About Us</a></li>
                    <li><a href="/#how-it-works">How It Works?</a></li>
                    <li><a href="/#our-feature">Our Features</a>
                    <li><a href="/#community">Community</a></li>                    
                    </ul>
                </div>
                <div class="col-md-2 p-3">
                    <div class="footer-widget-heading">
                        <h4>More Links</h4>
                    </div>
                    <ul class="linkediting mt-4">
                        <li><a href="/#pricing">Pricing</a></li>
                    <li><a href="/#founder">Team</a></li>
                    <li><a href="/#faq">FAQ</a></li>
                    <li><a href="/survey">Survey</a></li>
                    <li><a href="/blog">Blog</a></li>
                    </ul>
                </div>
                <div class="col-md-3 p-3">
                    <div class="footer-social-icon">
                         <div class="footer-widget-heading">
                        <h4>Platform Connect</h4>
                    </div>
                        <div class="social-icon d-flex align-items-center justify-content-start gap-3 mt-4">
                        

                        
                            <a href="https://www.instagram.com/p/C_BQAs-uwgE/" target="_blank" rel="noopener noreferrer">
                                <img loading="lazy" alt="Instagram" src="assets/images/insta-icon.svg">
                            </a>
                            
                           <img loading="lazy" alt="" src="assets/images/youtube-icon.svg">
                            <a href="https://x.com/pllohide" target="_blank"
                                    rel="noopener noreferrer">
                                    <img loading="lazy" alt="Twitter" src="assets/images/twitter-icon.svg">
                                </a>
                            
                            <a href="https://www.facebook.com/pllohide"
                                    target="_blank" rel="noopener noreferrer"><img loading="lazy" alt="Facebook" src="assets/images/fb-icon.svg">
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
                    <div class="col-md-12">
                        <div class="copyright-text text-center text-white">
                            <p>@ Copyright PlloHide. All Rights Reserved</p>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <!-- footer credit end -->
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>