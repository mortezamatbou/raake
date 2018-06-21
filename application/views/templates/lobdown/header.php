<!DOCTYPE html>

<html dir="rtl" lang="fa">
    <head>
        <title><?= $info['title']; ?></title>
        <meta charset="UTF-8">
        <meta name="description" content="<?= $info['description']; ?>" >
        <meta name="keywords" content="<?= $info['keywords']; ?>" >
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="theme-color" content="#000" />
        <meta name="author" content="it3du.ir" >
        <meta name="generator" content="it3du.ir" >
        <meta name="copyright" content="All Rights Reserved by it3du.ir">
        
        <!-- social meta tags Start -->
        <!-- OpenGarph meta tags -->
        
        <meta property="og:title" content="<?= $info['title']; ?>" >
        <meta property="og:image" itemprop="thumbnailUrl" content="<?= $info['thumbnail']; ?>" >
        <meta property="og:url" content="<?= $info['url']; ?>" >
        <meta property="og:description" content="<?= $info['description']; ?>" >
        <!-- twitter cards meta tags -->
        <meta name="twitter:card" content="summary">
        <meta name="twitter:url" content="<?= $info['url']; ?>">
        <meta name="twitter:title" content="<?= $info['title']; ?>" >
        <meta name="twitter:description" content="<?= $info['description']; ?>" >
        <meta name="twitter:image" content="<?= $info['thumbnail']; ?>" >
        <!-- google plus open garph meta tags -->
        <link rel="author" href="https://plus.google.com/115656842051421487339"/>
        <link rel="publisher" href="https://plus.google.com/102814766043413690407"/>
        <!-- social meta tags END -->
        <meta name="msvalidate.01" content="E383F1D85CE78DAB6EC037AACBAFE5DC" />
        <link href="/style/bootstrap-3.3.6/bootstrap-3.3.6.min.css" rel="stylesheet" type="text/css"/>
        <script src="/style/bootstrap-3.3.6/jquery-2.1.4.min.js" type="text/javascript"></script>
        <script src="/style/bootstrap-3.3.6/bootstrap-3.3.6.min.js" type="text/javascript"></script>
        <link href="/style/font-awesome-4.6.3/css/font-awesome.min.css" rel="stylesheet" type="text/css" >
        <link href="/style/highlight/prism/prism.css" rel="stylesheet" type="text/css"/>
        <script src="/style/highlight/prism/prism.js" data-default-language="markup"></script>
        <link href="/style/site/style.css" rel="stylesheet" type="text/css"/>
        <script src='https://www.google.com/recaptcha/api.js'></script>
    </head>
    <body>

        <div id="back-to-up">
            <a onclick="backToTop()"><i class="fa fa-arrow-up fa-3x"></i></a>
        </div>
        <script>
            function backToTop() {
                $('html, body').animate({
                    scrollTop: 0
                }, 2000);
            }
        </script>

        <div  id="bb" style="position: fixed; left: 0px; top: 0px;"></div>

        <header class="container col-lg-12 col-lg-push-0 col-md-12 col-md-push-0 col-sm-12 col-sm-push-0 col-xs-12 col-xs-push-0">
            <br><br>
            <h2>آموزش برنامه نویسی و طراحی وب</h2>
            <nav id="menu" class="container col-lg-12 col-lg-push-0 col-md-12 col-md-push-0 col-sm-12 col-sm-push-0 col-xs-12 col-xs-push-0">
                <a href="/">صفحه اصلی</a>
                <a href="/ads">تبلیغات</a>
            </nav>
        </header>
        
        <div class="clearfix"></div>
        <br>
        <div class="container ads">
            <div class="row">
                <div class="col-lg-10 col-lg-push-1 col-md-10 col-md-push-1 col-sm-10 col-sm-push-1 col-xs-12 col-xs-push-0">
                    <div class="box col-lg-6 col-md-12"><img class="img-responsive" src="/upload/ads/banner5.gif"></div>
                    <div class="box col-lg-6 col-md-12"><img class="img-responsive" src="/upload/ads/banner5.gif"></div>
                    <div class="box col-lg-4 col-md-4 col-sm-6"><img class="img-responsive" src="/upload/ads/banner1.gif"></div>
                    <div class="box col-lg-4 col-md-4 col-sm-6"><img class="img-responsive"  src="/upload/ads/banner3.gif"></div>
                    <div class="box col-lg-4 col-md-4 col-sm-6"><img class="img-responsive" src="/upload/ads/banner2.gif"></div>
                    <div class="clearfix"></div>
                    <br><br>
                </div>
            </div>
        </div>

        <script>
            function offsetCheck() {
                offset = $("#bb").offset();
                if (offset.top > 500) {
                    $("#back-to-up").fadeIn(1000);
                } else {
                    $("#back-to-up").fadeOut(1000);
                }
            }
            offsetCheck();
            $(window).on("scroll", function () {
                offsetCheck();
            });
        </script>
