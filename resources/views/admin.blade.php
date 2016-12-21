<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link media="all" rel="stylesheet" href="{{url('/')}}/web-apps/css/main.css">
    <title>nugree - Super Admin</title>
    <link rel="icon" type="image/png" href="{{url('/')}}/web-apps/images/favicon-192x192.png" sizes="192x192">
    <link rel="icon" type="image/png" href="{{url('/')}}/web-apps/images/favicon-160x160.png" sizes="160x160">
    <link rel="icon" type="image/png" href="{{url('/')}}/web-apps/images/favicon-96x96.png" sizes="96x96">
    <link rel="icon" type="image/png" href="{{url('/')}}/web-apps/images/favicon-16x16.png" sizes="16x16">
    <link rel="icon" type="image/png" href="{{url('/')}}/web-apps/images/favicon-32x32.png" sizes="32x32">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,400i,600,700" rel="stylesheet">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script type="text/javascript">window.jQuery || document.write('<script src="{{url('/')}}/web-apps/js/jquery-1.11.2.min.js" ><\/script>')</script>
    <script src="https://use.fontawesome.com/fbabf169f3.js"></script>
</head>
<body class="loading-page sideBar-active">
<!--<div class="page-loader">
    <div class="page-loader-holder">
        <img src="images/loader.gif" alt="Property42 loading">
    </div>
</div>-->
<div id="wrapper">
    <header id="header">
        <a class="sideBar-opener"><span></span></a>

        <div class="right-header">
            <a href="{{URL::to('logout')}}" class="logout"><span class="icon-login"></span></a>
            <ul class="alerts">
                <li>
                    <a href="#"><span class="icon-message"></span></a>
                    <span class="count">9</span>
                </li>
                <li>
                    <a href="#"><span class="icon-email-alerts"></span></a>
                    <span class="count">99</span>
                </li>
            </ul>
            <a class="searchOpener-Mobile"><span class="icon-search"></span></a>

            <form class="searchByID">
                <input type="search" placeholder="Search by ID">
                <button type="submit"><span class="icon-search"></span></button>
            </form>
        </div>
        <div class="logo"><a href="{{URL::to('')}}"><img width="477" height="150" alt="nugree.com"
                                                         src="{{url('/')}}/web-apps/images/logo.png"></a></div>
    </header>
    <main id="main" role="main">
        <aside id="sidebar-dashboard">
            <div class="profile-picture">
                <div class="image-holder"><img src="{{url('/')}}/web-apps/images/user-noimage.png"
                                               alt="user image is broken"></div>
                <div class="name">
                    <strong class="name-tag">Muhammad Waqas</strong>
                </div>
            </div>
            <form class="search-side-links">
                <input type="search" placeholder="Search Links">
                <button type="submit"><span class="icon-search"></span></button>
            </form>
            <div class="scroll-able">
                <ul class="sideBar-links">
                    <li><a href="#"><span class="icon-home2"></span>DASHBOARD</a></li>
                    <li @if(isset($response['data']['linkStatus']) && ($response['data']['linkStatus']) == 'active') class="active" @endif>
                        <a href="{{URL::to('get/active/property')}}"><span class="icon-list"></span>LISTING<span
                                    class="total-tag"></span></a></li>
                    <li @if(isset($response['data']['linkStatus']) && ($response['data']['linkStatus']) == 'agent') class="active" @endif>
                        <a href="{{URL::to('get/active/agent')}}"><span class="icon-real-state-seller"></span>Agents<span class="total-tag"></span></a></li>
                    <li @if(isset($response['data']['linkStatus']) && ($response['data']['linkStatus']) == 'cityListing') class="active" @endif>
                        <a href="{{URL::to('cities/listing')}}"><span class="icon-d-building"></span>Cities</a>
                    </li>
                    <li @if(isset($response['data']['linkStatus']) && ($response['data']['linkStatus']) == 'locationListing') class="active" @endif>
                        <a href="{{URL::to('location/listing')}}"><span class="icon-holding-hands-in-a-circle"></span>Locations
                        </a></li>
                    <li @if(isset($response['data']['linkStatus']) && ($response['data']['linkStatus']) == 'bannerListing') class="active" @endif>
                        <a href="{{URL::to('banners/listing')}}"><span class="icon-prize-banner"></span>Banners
                        </a></li>
                    <li @if(isset($response['data']['linkStatus']) && ($response['data']['linkStatus']) == 'projectListing') class="active" @endif>
                        <a href="{{URL::to('project/listing')}}"><span
                                    class="icon-architect-with-building-project"></span>Projects</a></li>
                    <li @if(isset($response['data']['linkStatus']) && ($response['data']['linkStatus']) == 'newsListing') class="active" @endif>
                        <a href="{{URL::to('news/listing')}}"><span class="icon-folded-newspaper"></span>News
                            listing</a></li>
                    <li @if(isset($response['data']['linkStatus']) && ($response['data']['linkStatus']) == 'features') class="active" @endif>
                        <a href="{{URL::to('features')}}"><i class="fa fa-plus" aria-hidden="true"></i>
                            Add Features</a></li>
                    <li @if(isset($response['data']['linkStatus']) && ($response['data']['linkStatus']) == 'features') class="active" @endif>
                        <a href="{{URL::to('meta-listing')}}"><i class="fa fa-tags" aria-hidden="true"></i>Meta Listing</a></li>
                </ul>
            </div>
        </aside>
        <div id="page-holder">

            @yield('content')

        </div>
    </main>
    <!--<a href="#feedback" class="feedBack lightbox">Feedback</a>-->
    <div class="popup-holder">
        <div id="feedback" class="lightbox generic-lightbox">
            <span class="lighbox-heading">Feedback</span>

            <form class="inquiry-email-form">
                <div class="field-holder">
                    <label for="feedback-name">Name</label>

                    <div class="input-holder"><input type="text" id="feedback-name"></div>
                </div>
                <div class="field-holder">
                    <label for="feedback-email">Email</label>

                    <div class="input-holder"><input type="email" id="feedback-email"></div>
                </div>
                <div class="field-holder">
                    <label for="feedback-phone">phone</label>

                    <div class="input-holder"><input type="tel" id="feedback-phone"></div>
                </div>
                <div class="field-holder">
                    <label for="feedback-subject">subject</label>

                    <div class="input-holder"><input type="text" id="feedback-subject"></div>
                </div>
                <div class="field-holder">
                    <label for="feedback-message">message</label>

                    <div class="input-holder">
                        <textarea id="feedback-message"></textarea>

                        <p>By submitting this form I agree to <a href="#terms-of-user" class="termsOfUse lightbox">Terms
                                of Use</a></p>
                    </div>
                </div>
                <button type="submit">SEND</button>
            </form>
        </div>
        <div id="terms-of-user" class="lightbox generic-lightbox text-left">
            <span class="lighbox-heading">Privacy <span>Policy</span></span>

            <p>This Privacy policy is subject to the terms of the Site Policy (User agreement) of property42.pk. This
                policy is effective from the date and time a user registers with property42.pk by filling up the
                Registration form and accepting the terms and conditions laid out in the Site Policy.</p>

            <p>In order to provide a personalized browsing experience, property42.pk may collect personal information
                from you. Additionally our website may require you to complete a registration form or seek some
                information from you. When you let us have your preferences, we will be able to deliver or allow you to
                access the most relevant information that meets your end.</p>

            <p>To extend this personalized experience property42.pk may track the IP address of a user's computer and
                save certain information on your system in the form of cookies. A user has the option of accepting or
                declining the cookies of this website by changing the settings of your browser.</p>

            <p>The personal information provided by the users to property42.pk will not be provided to third parties
                without previous consent of the user concerned. Information of a general nature may however be revealed
                to external parties</p>

            <p>Every effort will be made to keep the information provided by users in a safe manner, the information
                will be displayed on the website will be done so only after obtaining consent from the users. Any user
                browsing the site generally is not required to disclose his identity or provide any information about
                him/her, it is only at the time of registration you will be required to furnish the details in the
                registration form</p>

            <p>A full user always has the option of not providing the information which is not mandatory. You are solely
                responsible for maintaining confidentiality of the User password and user identification and all
                activities and transmission performed by the User through his user identification and shall be solely
                responsible for carrying out any online or off-line transaction involving credit cards / debit cards or
                such other forms of instruments or documents for making such transactions.</p>

            <p>You agree that PROPERTY42.PK may use personal information about you to improve its marketing and
                promotional efforts, to analyze site usage, improve the Site's content and product offerings, and
                customize the Site's content, layout, and services. These uses improve the Site and better tailor it to
                meet your needs, so as to provide you with a smooth, efficient, safe and customized experience while
                using the Site.</p>

            <p>You agree that PROPERTY42.PK may use your personal information to contact you and deliver information to
                you that, in some cases, are targeted to your interests, such as targeted banner advertisements,
                administrative notices, product offerings, and communications relevant to your use of the Site. By
                accepting the User Agreement and Privacy Policy, you expressly agree to receive this information. If you
                do not wish to receive these communications, we encourage you to opt out of the receipt of certain
                communications in your profile. You may make changes to your profile at any time. It is the belief of
                PROPERTY42.PK that privacy of a person can be best guaranteed by working in conjunction with the Law
                enforcement authorities.</p>

            <p>We may collect your personal data when you use this Site or our services. The term "use" includes:</p>

            <p>(a) Uploading your Content;</p>

            <p>(b) Making submissions/posts in user forums;</p>

            <p>(c) Undertaking transactions on or via this Site;</p>

            <p>(d) Accessing or browsing the Site;</p>

            <p>(e) Communicating with us via email or signing up for newsletters</p>

            <p>(f) Completing online forms</p>

            <p>(g) Calling us or sending us an enquiry (including via one of the online property portal websites).</p>

            <p>We may also collect your personal data from publicly available information such as information on third
                party websites, from our business partners who have your consent to pass it on or who are authorized by
                you to authenticate or identify you to us or enable you to sign in to our Site using their
                credentials</p>

            <p>We may also collect your personal data when we monitor and record email and telephone communications with
                you or between you and others who are using our systems or those of our agents acting on our behalf.</p>

            <p>We may collect all or some of the following personal data from or about you:</p>

            <p>(a) Your name and title and gender and date of birth;</p>

            <p>(b) Your company name or affiliation;</p>

            <p>(c) Your contact information including phone/mobile number/fax and email address;</p>

            <p>(d) Other demographic information including your home or other addresses and postcode;</p>

            <p>(e) Your communication and purchase preferences and interests;</p>

            <p>(f) Where you have submitted/posted your Content, your submissions and posts;</p>

            <p>(g) Where you have registered with us, your user name and password.</p>
        </div>
    </div>
</div>

<script src="{{url('/')}}/web-apps/js/placeholder.js" type="text/javascript" defer></script>
 <script src="{{url('/')}}/web-apps/js/lightBox.js" type="text/javascript" defer></script>
<script src="{{url('/')}}/web-apps/js/jquery.carousel.js" type="text/javascript" defer></script>
<script src="{{url('/')}}/web-apps/js/jquery-main.js" type="text/javascript" defer></script>
<script src="{{url('/')}}/assets/js/env.js" type="text/javascript"></script>
<script src="{{url('/')}}/web-apps/js/property_detail.js" type="text/javascript"></script>
<script src="{{url('/')}}/web-apps/js/select2-min.js" type="text/javascript"></script>
</body>
</html>
