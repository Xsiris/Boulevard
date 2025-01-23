<?php
/*
Template Name: About
*/

get_header('about');
?>

<body class="full-height">
        <div class="container-fluid about-slide-1">
            <div class="slide-fade-effect"></div>
            <header>
                <div class="row">
                    <div class="col-xs-6 masthead">
                        <a href="<?php echo GetAboutMastheadLinkDestination(); ?>" style="position:absolute; z-index:1;"><img class="img-responsive " src="<?php echo GetAboutMasthead(); ?>" alt="Boulevard" /></a>
                    </div>
                    <div class="col-xs-6 top-right-nav">
                        <a id="sideMenuButton" href="#sideMenu"> <img class="fr left-gutter" src="<?php echo GetAboutMenuButton(); ?>" alt="Open" /> </a>
                        <div class="fr hidden-xs">
                            <a id="request-proj-menu" href="#request-proj-menu" class="text-blvd-white-hover request-button-style link-with-icon text-dec-none cursor-pointer"> <span>Request Project</span>  <img src="<?php echo GetAboutRequestProjIcon(); ?>" alt="Open"/> </a>
                        </div>
                    </div>
                </div>
            </header>

            <div class="row"><!--fit-bottom-->
                <div class="col-xs-12">
                    <h1 class="center-slogan blvd-text main-header-style">Creative Promotional Products Agency</h1>
                </div>

                    <!--<div class="col-xs-12 col-md-6 col-md-offset-3 bottom">
                        <h2 class="center-text">Who we are & What that means to you: </h2>
                        <p>
                            The team at Boulevard comes from various backgrounds and the synergy created makes us who we are.
                            We are creative by nature, so your brand value and message will be understood.
                            We know how to crunch numbers, so your budgets will be met.
                            We work closely with best-in-class supplier partners, so your branded products will be produced professionally and on time.
                        </p>
                        <p>
                            Helping you share your stories and creating brand awareness through the use of promotional products is what we do best.
                        </p>
                        <p>
                            Did you know, 80% of people who receives a branded promotional item recall the message and service on the item? That's powerful and we understand that.
                            So we listen to you, to ensure the merchandise we make for you is consistent with your company's philosophy and value.
                        </p>
                    </div> -->


                    <div class="col-xs-12 col-md-6 col-md-offset-3 who-we-are">
                        <div class="who-we-are-background"></div>
                        <div>
                            <h2 class="center-text who-we-are-header">Who we are</h2>
                            <p class="blvd-text-dark wwa-p">
                                The team at Boulevard comes from various backgrounds and the synergy created makes us who we are.
                                We are creative by nature, so your brand value and message will be understood.
                                We know how to crunch numbers, so your budgets will be met.
                                We work closely with best-in-class supplier partners, so your branded products will be produced professionally and on time.
                            </p>
                            <p class="blvd-text-dark wwa-p">
                                Helping you share your stories and creating brand awareness through the use of promotional products is what we do best.
                            </p>
                            <p class="blvd-text-dark wwa-p">
                                Did you know, 80% of people who receives a branded promotional item recall the message and service on the item? That's powerful and we understand that.
                                So we listen to you, to ensure the merchandise we make for you is consistent with your company's philosophy and value.
                            </p>
                        </div>
                    </div>

            </div>
        </div>

        <div class="container-fluid slide-splitter-empty" id="downArrowPos">
            <div class="row">
                <div class="col-xs-12 ">
                </div>
            </div>
        </div>

        <div class="container-fluid what-we-do-height">
            <div class="row what-we-do-margin">
                <div class="col-xs-12 col-md-6 col-md-offset-3 bottom">
                    <h3 class="center-text blvd-text wwd-h3">What we do</h3>
<p class="wwd-p"><font color="white">We provide solutions using promotional products and apparels to address your marketing and communications needs.
                        Advertising and marketing, with the use of promotional products, created a lasting impression. We help you with your marketing efforts, from a single event to a complete line of merchandise, we do it fast, and we do it right. Your image is reflected by high quality products the we use.
                        We are committed to excellence, and we are determined to address your needs by understanding your desired objectives.</font>
                    </p>

                </div>
            </div>
        </div>

    <?php get_footer();?>
