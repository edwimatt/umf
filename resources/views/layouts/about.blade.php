
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from theme.nileforest.com/html/mazel-v3.1/01_mazel_multiprapose/pricing.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 23 May 2019 03:42:33 GMT -->
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <title>Understanding My Facility - About App </title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="nileforest">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->

    <!-- Favicone Icon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('uiassets/img/')}}ic_logo.png">
    <link rel="icon" type="image/png" href="{{ asset('uiassets/img/')}}ic_logo.png">
    <link rel="apple-touch-icon" href="{{ asset('uiassets/img/')}}ic_logo.png">
    <!-- CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="{{ asset('uiassets/css')}}/style.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('uiassets/css')}}/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.theme.min.css">
    <script src="//js.stripe.com/v3/"></script>
    <style>
        .pac-container {
            z-index: 10000 !important;
        }
        .aboutBox > p {
            font-size: 13px ;
        }
        .privacy-policy-special {
            background:   #ededed ;
            line-height: 20px ;
        }
    </style>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-157073787-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-157073787-1');
    </script>


</head><body style=" background:   #ededed ;">
<section class="section">
    <div class="container">
        <div class="text-left">
            <h2 class="section-heading mb-4"><?php echo $site_contents->title ?></h2>
            <div class="aboutBox">
                <?php echo $site_contents->content ?>
            </div>
        </div>
    </div>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>