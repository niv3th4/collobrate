<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>CollabRate</title>
    <link rel="shortcut icon" href="images/favicon.ico">
    <link href="style.css" rel="stylesheet">
    <link href="css/jquery.bxslider.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <!--[if lt IE 9]>
            <link rel="stylesheet" type="text/css" href="css/ie9.css" />
         <script src="js/html5shiv.js"></script>
    <![endif]-->

</head>
<body>

    <div id="pageloader"></div>
    <!-- Learn And Share -->
    <div class="section">
        <section class="learnsection box">
            <div class="land-header box">
                <!-- Slider top -->
                <div class="topslider">
                    <div id="sharediv">
                        <div id="tab1">
                            <div class="main_container">
                                <div class="social-share clearfix">
                                    <p>Share on :</p>
                                    <a href="javascript:void(0)" class="close-share"></a>
                                    <ul>
                                        <li><a href="#"><span class="message"></span></a>
                                        </li>
                                        <li><a href="#"><span class="fb"></span></a>
                                        </li>
                                        <li><a href="#"><span class="gplus"></span></a>
                                        </li>
                                        <li><a href="#"><span class="twit"></span></a>
                                        </li>
                                        <li><a href="#"><span class="pintrest"></span></a>
                                        </li>
                                        <li><a href="#"><span class="linkedin"></span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div id="tab2">
                            <div class="main_container">
                                <div class="sharesection">
                                    <p class="feedback-head">Feed Back Form:</p>
                                    <a href="javascript:void(0)" class="close-share"></a>
                                    <table class="sharesectiontable">
                                        <tr>
                                            <td class="td1">
                                                <input type="text" value="" name="" placeholder="First Name">
                                            </td>
                                            <td class="td2">
                                                <select id="top-cntry">
                                                    <option value="0" selected="selected" data-imagesrc="images/country-flags/india-mini.png">India</option>
                                                    <option value="1" data-imagesrc="images/country-flags/austria-mini.png">Austria</option>
                                                    <option value="2" data-imagesrc="images/country-flags/france-mini.png">France</option>
                                                    <option value="3" data-imagesrc="images/country-flags/germany-mini.png">Germany</option>
                                                    <option value="4" data-imagesrc="images/country-flags/hungry-mini.png">Hungry</option>
                                                    <option value="5" data-imagesrc="images/country-flags/jamaica-mini.png">Jamaica</option>
                                                    <option value="6" data-imagesrc="images/country-flags/The-Czech-mini.png">The Czech Republic</option>
                                                </select>
                                                <input type="text" name="" class="mobilenum" placeholder="Mobile No." pattern="[0-9]{0,10}" title="Should be numbers" >
                                            </td>
                                            <td rowspan="2" class="td3">
                                                <div class="relative">
                                                    <span class="txt-count">(<span id="rem_count">500</span>/500 characters left)</span>
                                                    <textarea cols="" rows="" placeholder="Type your message here..."   maxlength="500" class="add-topic"></textarea>
                                                </div>
                                            </td>
                                            <td rowspan="2" class="td4">
                                                <div class="submit-btn">
                                                    <button class="sub-btn">Submit</button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text" value="" name="" placeholder="Last Name">
                                            </td>
                                            <td class="td1">
                                                <input type="email" value="" name="" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" placeholder="Email ID">
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <ul class="shareeditsec share tabpages">
                        <li class=""><a href="#tab1" class="tab tooltip" title="Share"><span class="shareicon"></span></a>
                        </li>
                        <li class=""><a href="#tab2" class="tab tooltip" title="Feedback"><span class="editicon"></span></a>
                        </li>
                    </ul>
                </div>
                <!-- Header -->
                <div class="clearfix">
                    <div class="logo"><a href="javascript:void(0)"><img class="f-left" src="images/landing-page/logo.png" alt="Home"></a>
                    </div>
                </div>
            </div>
            <div class="learnsectionbg2"></div>
            <div class="">
                <div class="sitewidth">
                    <div class="meetlearninner">
                        <h1>Meet.Learn.Share.</h1>
                        <p>Presenting a new way of learning... where you can meet with people, 
                            learn and do much more. Come join us...</p>
                    </div>
                    <div class="signuplogin">
                        <a href="javascript:void(0)" id="assign-link">Request for Signup</a>
                        <?php
                        echo $this->Html->link('Login', array(
                            'controller' => 'app_users',
                            'action' => 'login'
                        ));
                        ?>
                        <!--<a href="javascript:void(0)" id="dialog-link">Login</a>-->
                    </div>

                    <!--signup dialog-->
                    <div id="assign-dialog" class="signup">
                        <div class="pop-wind clearfix">
                            <a class="close-link" href="javascript:void(0);">
                                <span class="icon-cross"></span></a>
                            <div class="signup-content">
                                <p class="signup-heading">Request for Sign up</p>
                                <p class="signup-subhd">Please fill in the details and we will get back to you shortly!!</p>
                                <form action="" method="post">
                                    <table class="signup-form">
                                        <tr>
                                            <td>
                                                <p class="sign-txt">First Name</p>
                                                <div class="sign-txtbx">
                                                    <input type="text" name="firstname" placeholder="" required tabindex="1">
                                                    <span class="required"></span>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="sign-txt">Last Name</p>
                                                <div class="sign-txtbx">
                                                    <input type="text" name="lastname" placeholder="" required tabindex="1">
                                                    <span class="required"></span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p class="sign-txt">Email</p>
                                                <div class="sign-txtbx">
                                                    <input type="email" tabindex="1" name="email" placeholder="" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required>
                                                    <span class="required"></span>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="sign-txt">Mobile No.</p>
                                                <div class="sign-txtbx">
                                                    <input type="text" name="mobile" tabindex="1" placeholder="" pattern="[0-9]{0,10}" title="Should be 10 Numbers" required>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <p class="sign-txt">Institution Name</p>
                                                <div class="sign-txtbx">
                                                    <input type="text" name="" tabindex="1" placeholder="" required class=" long-txtbx">
                                                    <span class="required"></span>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                    <div class="form-btn clearfix">
                                        <div class="instrc">
                                            <img src="images/landing/star.png" alt="req">
                                            <p class="instr-txt">represents mandatory fields</p>
                                        </div>
                                        <div class="submit-btn">
                                            <input type="submit" class="sub-btn" value="Submit">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php  echo $this->fetch('login'); ?>
                    <div class="clear"></div>
                    <div class="mainnav clearfix">
                        <ul>
                            <li><a href="#whatis" class="first">What’s Collabrate?</a>
                            </li>
                            <li><a href="#howitworks" class="second">How it works? </a>
                            </li>
                            <li><a href="#features" class="third">Features</a>
                            </li>
                            <li><a href="#whatnext" class="fourth">Whats next?</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="section">
        <section class="whatis box" id="whatis">
            <div class="sitewidth">
                <div class="left">
                    <h1>This is just dummy text which explains about </h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In a tellus quis nisi suscipit pellentesque eu eget orci. Ut auctor lorem ac nisi luctus, eu porttitor velit sodales. Etiam turpis tellus, mollis vitae mauris vel, consectetur ornare sem. </p>
                    <p>Fusce fringilla aliquam justo non placerat. Vestibulum vel magna quis turpis condimentum varius nec vel tortor. Donec sagittis commodo. </p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In a tellus quis nisi suscipit pellentesque eu eget orci. Ut auctor lorem ac nisi luctus, eu porttitor velit sodales. Etiam turpis tellus, mollis vitae mauris vel, consectetur ornare sem. </p>
                </div>
            </div>
        </section>
    </div>
    <!-- About Info -->
    <div class="section">
        <section class="aboutinfosection box" id="howitworks">
            <div class="sitewidth">
                <div class="about-detailsec">
                    <h1>This is just dummy text which explains ’How it works’</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In a tellus quis nisi suscipit pellentesque eu eget orci. Ut auctor lorem ac nisi luctus, eu porttitor velit sodales. Etiam turpis tellus, mollis vitae mauris vel, consectetur ornare sem. Fusce fringilla aliquam justo non placerat. Vestibulum vel magna quis turpis condimentum varius nec vel tortor. Donec sagittis commodo. </p>
                </div>
                <div class="clearfix ">
                    <!-- Meet -->
                    <div class="meet">
                        <p><img src="images/landing-page/meet-image.png" alt=""></p>
                        <p class="info-title">Meet.</p>
                    </div>
                    <!-- Learn -->
                    <div class="learn">
                        <p><img src="images/landing-page/learn-image.png" alt=""></p>
                        <p class="info-title">Learn.</p>
                    </div>
                    <!-- Share -->
                    <div class="share-land">
                        <p><img src="images/landing-page/share-image.png" alt=""></p>
                        <p class="info-title">Share.</p>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- Share Thoughts -->
    <div class="section">
        <section class="sharethoughtssec box" id="features">
            <div class="sitewidth">
                <div class="sharethoughtinner">
                    <ul class="share-slider">
                        <li>
                            <div class="shareleft">
                                <h2>Ask your doubts, Share your thoughts</h2>
                                <ul class="listitems slider-acc" >
                                    <li><a href="javascript:void(0)" rel="images/landing-page/screen1.png">Ask a question</a>
                                        <div class="show-test">Ask a question<br>
                                            Ask a question<br>
                                            Ask a question</div>
                                    </li>
                                    <li><a href="javascript:void(0)" rel="images/landing-page/screen2.png">Conduct a poll</a>
                                        <div class="show-test">Conduct a poll<br>
                                            Conduct a poll<br>
                                            Conduct a poll<br>
                                            Conduct a poll</div>
                                    </li>
                                    <li><a href="javascript:void(0)" rel="images/landing-page/screen3.png">Create a note</a>
                                        <div class="show-test">Create a note<br>
                                            Create a note<br>
                                            Create a note<br>
                                            Create a note</div>
                                    </li>
                                    <li><a href="javascript:void(0)" rel="images/landing-page/screen4.png">Praise your friends by giving points</a>
                                        <div class="show-test">Praise your friends by giving points<br>
                                            Praise your friends by giving points<br>
                                            Praise your friends by giving points</div>
                                    </li>
                                </ul>
                            </div>
                            <div class="sharergt clearfix">
                                <a href="images/landing-page/screen1.png" class="enlar-txt"  rel="prettyPhoto[pp_gal]">Enlarge Image</a>

                                <div class="screenimg">
                                    <img src="images/landing-page/screen1.png" width="397" height="224"  alt=""/>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="shareleft">
                                <h2>Ask your doubts, Share your thoughts</h2>
                                <ul class="listitems slider-acc" >
                                    <li><a href="javascript:void(0)" rel="images/landing-page/screen1.png">Ask a question</a>
                                        <div class="show-test">Ask a question<br>
                                            Ask a question<br>
                                            Ask a question</div>
                                    </li>
                                    <li><a href="javascript:void(0)" rel="images/landing-page/screen2.png">Conduct a poll</a>
                                        <div class="show-test">Conduct a poll<br>
                                            Conduct a poll<br>
                                            Conduct a poll<br>
                                            Conduct a poll</div>
                                    </li>
                                    <li><a href="javascript:void(0)" rel="images/landing-page/screen3.png">Create a note</a>
                                        <div class="show-test">Create a note<br>
                                            Create a note<br>
                                            Create a note<br>
                                            Create a note</div>
                                    </li>
                                    <li><a href="javascript:void(0)" rel="images/landing-page/screen4.png">Praise your friends by giving points</a>
                                        <div class="show-test">Praise your friends by giving points<br>
                                            Praise your friends by giving points<br>
                                            Praise your friends by giving points</div>
                                    </li>
                                </ul>
                            </div>
                            <div class="sharergt clearfix">
                                <a href="images/landing-page/screen1.png" class="enlar-txt"  rel="prettyPhoto[pp_gal]">Enlarge Image</a>

                                <div class="screenimg">
                                    <img src="images/landing-page/screen1.png" width="397" height="224"  alt=""/>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="shareleft">
                                <h2>Ask your doubts, Share your thoughts</h2>
                                <ul class="listitems slider-acc" >
                                    <li><a href="javascript:void(0)" rel="images/landing-page/screen1.png">Ask a question</a>
                                        <div class="show-test">Ask a question<br>
                                            Ask a question<br>
                                            Ask a question</div>
                                    </li>
                                    <li><a href="javascript:void(0)" rel="images/landing-page/screen2.png">Conduct a poll</a>
                                        <div class="show-test">Conduct a poll<br>
                                            Conduct a poll<br>
                                            Conduct a poll<br>
                                            Conduct a poll</div>
                                    </li>
                                    <li><a href="javascript:void(0)" rel="images/landing-page/screen3.png">Create a note</a>
                                        <div class="show-test">Create a note<br>
                                            Create a note<br>
                                            Create a note<br>
                                            Create a note</div>
                                    </li>
                                    <li><a href="javascript:void(0)" rel="images/landing-page/screen4.png">Praise your friends by giving points</a>
                                        <div class="show-test">Praise your friends by giving points<br>
                                            Praise your friends by giving points<br>
                                            Praise your friends by giving points</div>
                                    </li>
                                </ul>
                            </div>
                            <div class="sharergt clearfix">
                                <a href="images/landing-page/screen1.png" rel="prettyPhoto[pp_gal]" class="enlar-txt">Enlarge Image</a>

                                <div class="screenimg">
                                    <img src="images/landing-page/screen1.png" width="397" height="224"  alt=""/>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
    </div>
    <div class="section">
        <section class="pyoopilongosec" id="whatnext">
            <div class="sitewidth">
                <p>We understand that you need to be connected on the go...
                    That’s why we are working to provide you access so that you never
                    miss an opputunity to  connect while on the move</p>
                <div class="comingsoon">
                    <p>Coming soon on...</p>
                    <ul class="clearfix">
                        <li><img src="images/landing-page/gplay.png" alt=""></li>
                        <li><img src="images/landing-page/appstore.png" alt=""></li>
                    </ul>
                </div>
            </div>
        </section>
        <!--Footer -->
        <section class="footersection clearfix">
            <div class="sitewidth clearfix">
                <div class="clearfix footerbtm">
                    <div class="coprgts">
                        <p>Copyright 2017</p>
                    </div>
                    <div class="footerlinks">
                        <div class="social clearfix">
                            <ul>
                                <li><a href="#" class="fb">facebook</a>
                                </li>
                                <li><a href="#" class="linkedin">Linkedin</a>
                                </li>
                                <li><a href="#"class="twitter">twitter</a>
                                </li>
                                <li><a href="#" class="gplus">googleplus</a>
                                </li>
                                <li><a href="#" class="youtube">youtube</a>
                                </li>
                            </ul>
                        </div>
                        <ul>
                            <li><a href="#">About us</a>
                            </li>
                            <li><a href="#">Team</a>
                            </li>
                            <li><a href="#">FAQ’s</a>
                            </li>
                            <li><a href="#">Blog</a>
                            </li>
                            <li><a href="#">Contact</a>
                            </li>
                            <li><a href="#">Privacy</a>
                            </li>
                            <li><a href="#">Terms & conditions</a>
                            </li>
                        </ul>
                    </div>
                    <div class="hiring">
                        <a href="#">We’re Hiring!!!</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <?php
    echo $this->Html->script('jquery-1.8.2.min');
    ?>
    <!--<script src="js/jquery-1.8.2.min.js"></script>-->
    <script src="js/jquery-ui-1.10.3.custom.js"></script>
    <script type='text/javascript' src='js/jquery.bxslider.min.js'></script>
    <script>
        //LAnding page slider
        $('.share-slider').bxSlider({
            moveSlides: 1,
            infiniteLoop: true,
            auto: false,
        });
    </script>
    <script type='text/javascript' src='js/jquery.prettyPhoto.js'></script>
    <script>
        //Pretty Photo Gallery in contact images & videos
        $("a[rel^='prettyPhoto']").prettyPhoto();
    </script>
    <script type='text/javascript' src='js/jquery.autosize.min.js'></script>
    <script type='text/javascript' src='js/jquery.slimscroll.min.js'></script>
    <script type='text/javascript' src='js/tooltip.min.js'></script>
    <script type='text/javascript' src='js/chosen.jquery.min.js'></script>
    <script type='text/javascript' src='js/jquery.mousewheel.min.js'></script>
    <script type='text/javascript' src='js/vertical.slider.standard.js'></script>
    <script type='text/javascript' src='js/jquery.ddslick.min.js'></script>
    <script>
        $('#top-cntry').ddslick({
            onSelected: function(selectedData) {
                //callback function: do something with selectedData;
            }
        });
    </script>
    <script src="js/jquery.singlePageNav.min.js"></script>
    <script src="js/core.js"></script>
    <script>

        // Prevent console.log from generating errors in IE for the purposes of the demo
        if (!window.console)
            console = {log: function() {
                }};

        // The actual plugin
        $('.mainnav').singlePageNav({
            offset: $('.mainnav').outerHeight(),
            filter: ':not(.external)',
            updateHash: true,
            beforeStart: function() {
                console.log('begin scrolling');
            },
            onComplete: function() {
                console.log('done scrolling');
            }
        });

    </script>
    <?php
    echo $this->Js->writeBuffer();
    ?>
</body>
</html>