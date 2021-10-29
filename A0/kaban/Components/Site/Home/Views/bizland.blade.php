@extends('KabanViews::site.bizMain')


@section('content')

    <!-- ======= Top Bar ======= -->
    <section id="topbar" class="d-flex align-items-center">
        <div class="container d-flex justify-content-center justify-content-md-between">
            <div class="contact-info d-flex align-items-center">
                <i class="bi bi-whatsapp d-flex align-items-center ms-4"><span>+44 7886105417 </span></i>
            </div>
            {{--        <div class="social-links d-none d-md-flex align-items-center">--}}
            {{--            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>--}}
            {{--            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>--}}
            {{--            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>--}}
            {{--            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></i></a>--}}
            {{--        </div>--}}
        </div>
    </section>

    <!-- ======= Header ======= -->
    <header id="header" class="d-flex align-items-center">
        <div class="container d-flex align-items-center justify-content-between">

        {{--            <h1 class="logo"><a href="index.html">Europost Express<span>.</span></a></h1>--}}
        <!-- Uncomment below if you prefer to use an image logo -->
            <a href="index.html" class="logo"><img src="./bizland/assets/img/our-clients/wpcargo-logo-email.png" alt=""></a>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
                    {{--                    <li><a class="nav-link scrollto" href="#forms" onclick="shippingQuote">Shipping Quote</a></li>--}}
                    <li><a class="nav-link scrollto" href='javascript:;' id="my-btn">Shipping Quote</a></li>

                    <li><a class="nav-link scrollto" href="#services">Services</a></li>
                    <li><a class="nav-link scrollto" href="#terms">Terms and Conditions</a></li>
                    <li><a class="nav-link scrollto" href="#prohibited">Our Policy</a></li>
                    <li><a class="nav-link scrollto" href="#about">About us</a></li>
                    <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->
    <div id="my-modal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <br>
            <iframe style="height: 85vh" src="https://old.bookingparcel.com?php8=1" frameborder="0"></iframe>
        </div>

    </div>
    <style>
        /* The Modal (background) */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0, 0, 0); /* Fallback color */
            background-color: rgba(0, 0, 0, 0.4); /* Black w/ opacity */
        }

        /* Modal Content/Box */
        .modal-content {
            background-color: #fefefe;
            margin: 1% auto; /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 85%; /* Could be more or less, depending on screen size */
            min-height: 85%;
        }

        /* The Close Button */
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
    <script>
        // Get the modal
        var modal = document.getElementById("my-modal");

        // Get the button that opens the modal
        var btn = document.getElementById("my-btn");


        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on the button, open the modal
        btn.onclick = function () {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function () {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

    <div class="shipment">

    </div>
    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center">
        <div class="container" data-aos="zoom-out" data-aos-delay="100">
            <h1>Welcome to <span>Europost  express</span></h1>
            <h2>Cargo and Courier Services </h2>
            <div class="d-flex">
            </div>
        </div>
    </section><!-- End Hero -->

    <main id="main">

        {{--        <section id="forms">--}}
        {{--            <div class="container" data-aos="fade-up">--}}
        {{--                @include('SiteHome::shippingQuote')--}}
        {{--            </div>--}}
        {{--        </section>--}}
        <section id="about" class="about section-bg">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>About</h2>
                    <h3>About Europost express <span>(UK)</span></h3>
                </div>

                <div class="row">
                    <div class="col-lg-12 pt-4 pt-lg-0 content d-flex flex-column justify-content-center"
                         data-aos="fade-up" data-aos-delay="100">
                        <p>
                            EuroPost Express (UK) Ltd. is a multi-disciplinary enterprise, which specializes in cargo
                            import and export as well as bulk courier import services (for distribute in local, national
                            , Europe and international), at competitive rates.
                        </p>
                        <p>
                            EuroPost Express Ltd. has established in 2004 in the UK providing extensive services for
                            both private and corporate clients. We are continually expanding our portfolio of services
                            and are rapidly increasing our share of the local market.
                        </p>
                        <p>
                            Our strategic alliance with multinational Major courier companies allows us to provide a
                            personalized, fast and efficient service that is tailor-made for individual and corporate
                            customers. This means that we can always fulfil customer satisfaction in terms of
                            reliability, efficiency and speed, by providing them with an existing network of connections
                            to anywhere in the UK or the rest of the world.
                        </p>
                        <p>
                            Our network links means that our customers benefit from the size, reach and flexibility of
                            an existing infrastructure. This is complemented by our ability to access full point to
                            point tracking on all shipments with signature on delivery.
                        </p>
                        <p>
                            In addition to providing logistic services to customers in the UK we also have global links
                            to other courier companies, which means we can fulfil the UK end of their operation.
                            EuroPost Express (UK) Ltd uses its association with them to provide a local and national
                            courier service for distribution of documents/parcels in the UK that have originated from
                            the overseas contacts.
                        </p>
                        <p>
                            We trust that our services will be beneficial to you and hope that we will be able to engage
                            in a business partnership.
                        </p>
                        <p>
                            Also we have currently have contract with warehouse bonded and Customs Clearing Services
                            company for Import From LHR , which has a direct Link to HM Customs and can arrange swift
                            and economical clearance of Airfreight Cargo and Courier Consignments from London Heathrow
                            airports. This facility enables us to improve the transit times for our international
                            clients and also ensures that our quality of service is maintained at all times.
                        </p>
                    </div>
                </div>

            </div>
        </section><!-- End About Section -->
    @include('SiteHome::prohibited')

        <!-- ======= Clients Section ======= -->
        <section id="clients" class="clients section-bg">
            <div class="container swiper-container our-clients">

                <div class=" swiper-wrapper">

                    <div class="swiper-slide">
                        <img src="./bizland/assets/img/our-clients/Aramex-Logo-Web.jpg" class="img-fluid" alt="Aramex">
                    </div>

                    <div class="swiper-slide">
                        <img src="./bizland/assets/img/our-clients/british.png" class="img-fluid" alt="">
                    </div>

                    <div class="swiper-slide">
                        <img src="./bizland/assets/img/our-clients/CitySprint-Logo.png" class="img-fluid"
                             alt="CitySprint">
                    </div>

                    <div class="swiper-slide">
                        <img src="./bizland/assets/img/our-clients/DHL-Logo-Web-200x200.png" class="img-fluid" alt="">
                    </div>

                    <div class="swiper-slide">
                        <img src="./bizland/assets/img/our-clients/download.png" class="img-fluid" alt="">
                    </div>

                    <div class="swiper-slide">
                        <img src="./bizland/assets/img/our-clients/DPD_logo.png" class="img-fluid" alt="">
                    </div>

                    <div class="swiper-slide">
                        <img src="./bizland/assets/img/our-clients/DX-Logo.jpg" class="img-fluid" alt="">
                    </div>

                    <div class="swiper-slide">
                        <img src="./bizland/assets/img/our-clients/emirates.png" class="img-fluid" alt="">
                    </div>

                    <div class="swiper-slide">
                        <img src="./bizland/assets/img/our-clients/FedEx-Logo.png" class="img-fluid" alt="">
                    </div>

                    <div class="swiper-slide">
                        <img src="./bizland/assets/img/our-clients/france.png" class="img-fluid" alt="">
                    </div>

                    <div class="swiper-slide">
                        <img src="./bizland/assets/img/our-clients/GLS-logo-web.jpg" class="img-fluid" alt="">
                    </div>

                    <div class="swiper-slide">
                        <img src="./bizland/assets/img/our-clients/oman.jpg" class="img-fluid" alt="">
                    </div>

                    <div class="swiper-slide">
                        <img src="./bizland/assets/img/our-clients/ParcelForce-Logo.jpg" class="img-fluid" alt="">
                    </div>

                    <div class="swiper-slide">
                        <img src="./bizland/assets/img/our-clients/pegasus.jpg" class="img-fluid" alt="">
                    </div>

                    <div class="swiper-slide">
                        <img src="./bizland/assets/img/our-clients/Royal-Mail-Logo.png" class="img-fluid" alt="">
                    </div>

                    <div class="swiper-slide">
                        <img src="./bizland/assets/img/our-clients/russia.png" class="img-fluid" alt="">
                    </div>

                    <div class="swiper-slide">
                        <img src="./bizland/assets/img/our-clients/Skynet-Logo.png" class="img-fluid" alt="">
                    </div>

                    <div class="swiper-slide">
                        <img src="./bizland/assets/img/our-clients/TNT-Logo-Web.png" class="img-fluid" alt="">
                    </div>

                    <div class="swiper-slide">
                        <img src="./bizland/assets/img/our-clients/Tuffnells-Logo.jpg" class="img-fluid" alt="">
                    </div>

                    <div class="swiper-slide">
                        <img src="./bizland/assets/img/our-clients/UK-Mail-Logo.png" class="img-fluid" alt="">
                    </div>

                    <div class="swiper-slide">
                        <img src="./bizland/assets/img/our-clients/UPS-logo-web.png" class="img-fluid" alt="">
                    </div>

                    {{--                    <div class="swiper-slide">--}}
                    {{--                        <img src="./bizland/assets/img/our-clients/wpcargo-logo-email.png" class="img-fluid" alt="">--}}
                    {{--                    </div>--}}

                    <div class="swiper-slide">
                        <img src="./bizland/assets/img/our-clients/Yodel-Logo.jpg" class="img-fluid" alt="">
                    </div>

                </div>

            </div>
        </section><!-- End Clients Section -->

        <!-- ======= Services Section ======= -->
        <section id="services" class="services">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2 style="font-size: 23px">Our Services</h2>
                    <p>International Import and Export Air Cargo Services</p>
                    <p>Door to Door Services (Local and International)</p>
                    <p>Airport to Door services</p>
                    <p>European countries Delivery by Road services</p>
                    <p>Personal Effects Import and Export </p>
                    <p>Import and Export Commercial and Personal effects customs Entry </p>
                </div>

                <!-- ======= Services Section ======= -->
            </div>

        </section><!-- End Services Section -->

        <section id="terms" class="services">
            <div class="container" data-aos="fade-up">
                <div class="section-title">
                    <h2 style="font-size: 23px;margin: 30px;">Terms & Conditions</h2>
                </div>

                <div class="row">
                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                        <div class="icon-box">
                            <h4><a href="">QUALIFIED ACCEPTANCE</a></h4>
                            <p>We reserve the right to reject your shipment after acceptance and prior to performance of
                                any part of the transportation services, when shipments might cause damage or delay to
                                other shipments, equipment or personnel. This will also apply if the transportation of
                                you shipment is prohibited by law or is in violation of any rules contained in waybill
                                or our tariffs.</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="zoom-in"
                         data-aos-delay="200">
                        <div class="icon-box">
                            <h4><a href="">INSURANCE</a></h4>
                            <p>To extend your protection beyond our liability, you may elect to purchase insurance by
                                designation on this air waybill and pay the premium. Such insurance is coverage is
                                governed by policy in force.</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0" data-aos="zoom-in"
                         data-aos-delay="300">
                        <div class="icon-box">
                            <h4><a href="">WARRANTIES</a></h4>
                            <p>We make no warranties, express or implied.</p>
                        </div>
                    </div>


                    <div class="col-lg-12 col-md-12 d-flex align-items-stretch mt-4" data-aos="zoom-in"
                         data-aos-delay="200">
                        <div class="icon-box">
                            <h4><a href="">LIMITATION OF LIABILITY</a></h4>
                            <p>Unless you declare a higher shipment valuation and pay the fee, our limit of liability is
                                the lower of the following: (1) Actual value (b) $25 per package when lost, damaged or
                                adversely affected. In any event we will not be liable for acts or omissions, including
                                but not limited to, inadequate packing, securing, marking or addressing, or for acts or
                                omissions of the receiver or any party having interest in the shipment. We also are not
                                liable if you or the receiver violates any terms of this agreement. We are also not
                                liable for loss, damage or delay caused by circumstances outside our control, including
                                but not limited to acts of God, perils of the air, weather conditions, acts of public
                                enemies, strikes, civil commotion or acts or omissions of public authorities such as
                                customs, police and quarantine officials who have actual or apparent authority.</p>
                            <p>The shipper agreed we are liable in any event for any special, incidental, consequential
                                damages including but not limited to loss of profits or loss of income, whether or not
                                we had knowledge that such damages might be incurred.</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4" data-aos="zoom-in"
                         data-aos-delay="100">
                        <div class="icon-box">
                            <h4><a href="">YOUR OBLIGATION</a></h4>
                            <p>If the carriage or your shipment by air involves an ultimate destination or stop in a
                                country other than the country of departure, the Warsaw convention, an international
                                treaty relating to international by air, may be applicable, which treaty would govern
                                and in most cases limit our liability to $25 per package unless you declare a higher
                                value for the carriage as described below.</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4" data-aos="zoom-in"
                         data-aos-delay="300">
                        <div class="icon-box">
                            <h4><a href="">HANDLING OF FRAGILE ITEM</a></h4>
                            <p>All though we try our best to handle and deliver FRAGILE items, but by all meanâ€™s it is
                                entirely on shipperâ€™s risk. We do not take any responsibility in case of Damage.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4" data-aos="zoom-in"
                         data-aos-delay="300">
                        <div class="icon-box">
                            <h4><a href="">DELAYED SHIPMENTS</a></h4>
                            <p>We shall make every reasonable efforts to deliver your shipment according to our normal
                                delivery schedules but these are not guaranteed and do not come from part of this
                                contract. We are not liable for any delays.</p></div>
                    </div>

                    <div class="col-lg-6 col-md-6 d-flex align-items-stretch mt-4" data-aos="zoom-in"
                         data-aos-delay="300">
                        <div class="icon-box">
                            <h4><a href="">RIGHT TO INSPECT</a></h4>
                            <p>We may at our opinion, open and inspect any shipment for any reason, including but not
                                limited to, verification of contents prior to or after acceptance of the shipment for
                                transportation.</p></div>
                    </div>
                    <div class="col-lg-6 col-md-6 d-flex align-items-stretch mt-4" data-aos="zoom-in"
                         data-aos-delay="300">
                        <div class="icon-box">
                            <h4><a href="">RESPONSIBILITIES FOR PAYMENT</a></h4>
                            <p>Even is different payment instructions are given, you will always be primarily
                                responsible for all charges, including transportation charges and all duties, customs
                                assessments, governmental penalties and fines, taxes, and our attorneys fees and legal
                                costs related to this shipment to you or warehousing it pending disposition.</p></div>
                    </div>

                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4" data-aos="zoom-in"
                         data-aos-delay="300">
                        <div class="icon-box">
                            <h4><a href="">CLAIMS FOR LOSS, DAMAGE OR DELAY</a></h4>
                            <p>All claims for reimbursement must be made in writing to us within specific time periods
                                after the date on which we accept shipments. As follows: (1) 30 days if it is a loss or
                                damage claim, (b) 30 days if an overcharge claim (c) 14 days if a claim for delay. If
                                the receiver has signed a delivery receipt without notation of damage or loss, we must
                                also be notified of the loss or damage or rally within 48 hours after delivery if the
                                shipment is perishable and in writing within 7 days if non-perishable. </p>
                            <p>If the receiver accepts your shipment without noticing any damage or loss on the delivery
                                record, we will assume that the shipment was delivered in good condition. The
                                container(s), packing material and contents must be available for inspection at the
                                receiverâ€™s location. We are not however, obligated to act on any claim until all
                                transportation charges have been paid; the claim amount may not be deducted from those
                                charges.</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4" data-aos="zoom-in"
                         data-aos-delay="300">
                        <div class="icon-box">
                            <h4><a href="">ITEMS NOT ACCEPTABLE FOR TRANSPORTATION</a></h4>
                            <p>We wonâ€™t accept certain items for carriage and other items may be accepted for carriage
                                only to limited destinations or under restricted conditions. We reserve the right to
                                reject packages based upon these limitations or reasons of safety and security.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4" data-aos="zoom-in"
                         data-aos-delay="300">
                        <div class="icon-box">
                            <h4><a href="">CUSTOM CLEARANCE</a></h4>
                            <p>By giving any shipment to us, you appoint us your agents solely for performance of
                                customs clearance and certify us as the consignee for the purpose of designating a
                                customs broker to perform customs clearance (unless you specify customs broker in front
                                of air waybill). In some circumstances, local authorities may require additional
                                documentation confirming our appointment. It is your responsibility to provide proper
                                documentation and confirmation where required. You are responsible for and warrant your
                                compliance with all applicable laws, rules and regulations including but not limited to
                                customs law, import and export laws and government regulation of any country to, from,
                                through or over which your shipment may be carried.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ======= Contact Section ======= -->
        <section id="contact" class="contact">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Contact</h2>
                    <h3><span>Contact Us</span></h3>
                    <p>Ut possimus qui ut temporibus culpa velit eveniet modi omnis est adipisci expedita at voluptas
                        atque vitae autem.</p>
                </div>

                <div class="row" data-aos="fade-up" data-aos-delay="100">
                    <div class="col-lg-6">
                        <div class="info-box mb-4">
                            <i class="bx bx-map"></i>
                            <h3>Our Address</h3>
                            <p>4 corringham Road,
                                Wembley,
                                Middex,
                                HA9 9QA</p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="info-box  mb-4">
                            <i class="bx bx-envelope"></i>
                            <h3>Email Us</h3>
                            <p>office@europostexpress.co.uk</p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="info-box  mb-4">
                            <i class="bx bx-phone-call"></i>
                            <h3>Call Us</h3>
                            <p>+44 7886105417</p>
                        </div>
                    </div>

                </div>

                <div class="row" data-aos="fade-up" data-aos-delay="100">
                    <div class="col-lg-12">
                        <form action="/contact" method="post" role="form" class="php-email-form">
                            @csrf
                            <div class="row">
                                <div class="col form-group ">
                                    <input type="text" name="name" class="form-control" id="name"
                                           placeholder="Your Name" required>
                                </div>
                                <div class="col form-group">
                                    <input type="email" class="form-control" name="email" id="email"
                                           placeholder="Your Email" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col">
                                    <input type="text" class="form-control" name="subject" id="subject"
                                           placeholder="Subject" required>
                                </div>
                                <div class="form-group col">
                                    <input type="text" class="form-control" name="phone" id="Phone"
                                           placeholder="Phone" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6"> {!! htmlFormSnippet() !!} </div>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="message" rows="5" placeholder="Message"
                                          required></textarea>
                            </div>
                            <div class="my-3">
                                <div class="loading">Loading</div>
                                <div class="error-message"></div>
                                <div class="sent-message">Your message has been sent. Thank you!</div>
                            </div>
                            <div class="text-center">
                                <button type="submit">Send Message</button>
                            </div>
                        </form>
                    </div>

                </div>

            </div>
        </section><!-- End Contact Section -->

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer">

        <div class="footer-top">
            <div class="container">
                <div class="row">

                    <div class="col-lg-3 col-md-6 footer-contact">
                        <h3>Europost express<span>.</span></h3>
                        <p>
                            4 corringham Road<br>
                            Wembley<br>
                            Middex<br>
                            HA9 9QA <br><br>
                            <strong>Phone:</strong>+44 7886105417<br>
                            <strong>Email:</strong>office@europostexpress.co.uk<br>
                        </p>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Our Services</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="#hero">Home</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#about">About us</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#services">Services</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#terms">Terms of service</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#prohibited">Our policy</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Our Social Networks</h4>
                        <div class="social-links mt-3">
                            <a href="#" class="wahtsapp"><i class="bx bxl-whatsapp"></i></a>
                            <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                            <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                            <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                            <a href="#" class="telegram"><i class="bx bxl-telegram"></i></a>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="container py-4">
            <div class="copyright">
                &copy; Copyright <strong><span>Europost Express</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
                Designed by <a href="https://www.linkedin.com/in/mehdihosseinpour/" target="_blank">Mehdi Hosseinpour</a>
            </div>
        </div>
    </footer><!-- End Footer -->

    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="./bizland/assets/vendor/aos/aos.js"></script>
    <script src="./bizland/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="./bizland/assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="./bizland/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="./bizland/assets/vendor/php-email-form/validate.js"></script>
    <script src="./bizland/assets/vendor/purecounter/purecounter.js"></script>
    <script src="./bizland/assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="./bizland/assets/vendor/waypoints/noframework.waypoints.js"></script>

    <!-- Template Main JS File -->
    <script src="./bizland/assets/js/main.js"></script>

@endsection
