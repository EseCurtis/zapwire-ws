<?php
    global $app;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zapwire</title>

    <link rel="stylesheet" href="<?=$app->url('src')?>/assets/libs/cera-font/cera-font.css">
    <link rel="stylesheet" href="<?=$app->url('src')?>/assets/libs/font-awesome-v5/all.css">
    <link rel="stylesheet" href="<?=$app->url('src')?>/assets/landing/styles.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300;400;500;600;900&display=swap" rel="stylesheet">
        
    <script src="<?=$app->url('src')?>/assets/landing/particles.min.js"></script>
</head>
<body>
    <div class="particled" id="particles-1"></div>
    <div class="particled" id="particles-2"></div>
    <header class="app__header">
        <div class="nav-bar">
            <div class="nav-bar__left">
                <h2>Zapwire.ws</h2>
            </div>

            <nav class="nav-bar__center">
                <svg onclick="nav.close()" class="close-icon" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
                <a href="#">Home</a>
                <a href="#">Documentation</a>
            </nav>

            <div class="nav-bar__right">
                <button class="btn btn-1"> Get Started </button>
            </div>
            <svg onclick="nav.open()" class="menu-icon" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
              </svg>
        </div>
        <div class="hero">
            
            <div class="hero-art">
                <img src="<?=$app->url('src')?>/assets/landing/images/logo-scribble.png" alt="" height="100%">
            </div>
            <div class="hero-description">
                <h1>Easy <i>Socketing</i> in few lines of code, Both on
                Server and client.</h1>
                <p>We at Zapwire know the stress of building a websocket server from scratch to build something minimal, Don't you worry anymore we got you covered.</p>
            </div>
        </div>
    </header>

    <!-- <div class="section">
        <div class="section-header heading">
            <h2><span class="pop"># </span>What is Zapwire?</h2>
        </div>
        <div class="section-row">
            <p>Zapwire is basically a SAAS product built over a PHP and Node Javascript network which enables and gives you websocketing superpower which can be implemented both on client side and server side.</p>
            <p>With its socket server being based on the latest Node Javascript it is in no doubt 70% efficient and in terms of speed and security topnotch.</p>
            <p>As we all know the world is evolving and since the era of web 2.0 began users tend to adapt fast to web applicaions which serves them on real time, and for something as little as a live support system we would'nt find it relevant to create a socket server from scratch and then pay extra for hosting this socket server mostly Node Javascript. </p>
            <p>But now Zapwire algorithm allows you create channels, set authorization for your channel and set specific headers and many more settings which would be available at your dashboard as soon as you login.</p>
            <p>So why don't you sitback and watch Zapwire handle the socket thingy for you!</p>
        </div>
    </div> -->

    <div class="section">
        <div class="section-row cards">

            <div class="card">
                <div class="card-icon">
                <i class="fas fa-bolt"></i>
                            </div>
                <div class="card-text">
                    <h3>Speed</h3>
                    <p>Zapwire speed is topnotch and always current and intact so you don't have to worry about accountability</p>
                </div>
            </div>

            <div class="card">
                <div class="card-icon">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
                </div>
                <div class="card-text">
                    <h3>Reliability</h3>
                    <p>By the use of secure channeling system, we ensure you the best and reliable socketing for your project.</p>
                </div>
            </div>

            <div class="card">
                <div class="card-icon">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>                </div>
                <div class="card-text">
                    <h3>Optimization</h3>
                    <p>Zapwire's syntax is short, optimal and to the point, which in turn makes your codebase optimized</p>
                </div>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="section-header">
            <h2><span class="pop"># </span>Basic Syntax example</h2>
        </div>
        <div class="section-row">
            <div class="section-image">
                <img src="<?=$app->url('src')?>/assets/landing/images/code-example.png" alt="" srcset="" style="width: 100%">
            </div>
        </div>
    </div>

    <!-- <div class="section">
        <div class="section-header heading">
            <h2><span class="pop"># </span>FAQ's</h2>
        </div>
        <div class="section-row">
            <div>
                <b>- Can someone steal my channel for personal use?</b>
                <p>No, Since Zapwire wiring requests are 2FA equipped it is impossible to have someone using your personal channel</p>
            </div>

            <div>
                <b>- Is Zapwire going to be free forever?</b>
                <p>For you, yes it will be, since zapwire is a startup, we aim to give the pioneers the best experience, So as we develop together the new intake of users would have to pay for premium features</p>
            </div>

            <div>
                <b>- What's with all the scribbles?</b>
                <p> The scribbles? they signify this is mainly for new developers who might still be regared as babies who still scribble in the tech space, dont worry you will become great some day just keep doing what you're doing, and Continue using Zapwire!</p>
            </div>
        </div>
    </div> -->

    <footer class="footer">
        <div class="cards">
            <div class="item">
                <h4>Documentation</h4>
                <a>Introduction</p>
                <p>Usage</p>
                <p>Installation</p>
            </div><div class="item">
                <h4>Community</h4>
                <a>Introduction</p>
                <p>Usage</p>
                <p>Installation</p>
            </div><div class="item">
                <h4>Other</h4>
                <a>Introduction</p>
                <p>Usage</p>
                <p>Installation</p>
            </div>
        </div>
        <center>&copy; 2022 - <span id="this-date"></span>  Zapwire | Webpage Page Designed By Ese Curtis</center>
    </footer>
</body>
<script src="<?=$app->url('src')?>/assets/landing/app.js"></script>
</html>