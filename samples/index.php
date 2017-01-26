<!-- Welcome to PayU MEA SDK PHP -- >
<?php
if (PHP_SAPI == 'cli') {
    // If the index.php is called using console, we would try to host
    // the built in PHP Server
    if (version_compare(phpversion(), '5.4.0', '>=') === true) {
        //exec('php -S -t ' . __DIR__ . '/');
        $cmd = "php -S localhost:5500 -t " . __DIR__;
        $descriptors = array(
            0 => array("pipe", "r"),
            1 => STDOUT,
            2 => STDERR,
        );
        $process = proc_open($cmd, $descriptors, $pipes);
        if ($process === false) {
            fprintf(STDERR,
                "Unable to launch PHP's built-in web server.\n");
            exit(2);
        }
        fclose($pipes[0]);
        $exit = proc_close($process);
        exit($exit);
    } else {
        echo "You must be running PHP version less than 5.4. You would have to manually host the website on your local web server.\n";
        exit(2);
    }
} ?>
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="images/favicon.ico">

    <title>PayU MEA SDK API Samples</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <style>
        /* Header Links */
        .header-link {
            position: absolute;
            left: 7px;
            opacity: 0;

        }

        h2:hover .header-link,
        h3:hover .header-link,
        h4:hover .header-link,
        h5:hover .header-link,
        h6:hover .header-link {
            opacity: 1;
        }

        .list-group-item h5 {
            padding-left: 10px;
        }

        /* End Header Links */

        li.list-group-item:hover {
            background-color: #80AF14;
        }

        .jumbotron {
            background: #80AF14 url("https://www.paypalobjects.com/webstatic/developer/banners/Braintree_desktop_BG_2X.jpg") no-repeat top right;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }

        .jumbotron {
            margin-bottom: 0px;
            padding-bottom: 20px;
        }

        .jumbotron h2, .jumbotron p, h5 {
            font-family: Menlo, Monaco, Consolas, "Courier New", monospace;
        }

        .footer-links a {
            font-family: Menlo, Monaco, Consolas, "Courier New", monospace;
        }

        @media (max-width: 992px) {
            .jumbotron {
                background-color: #FFF;
            }

            .logo {
                position: relative;
            }

            #leftNavigation {
                visibility: hidden;
            }
        }

        @media (min-width: 992px) {
            .jumbotron {
                background-color: #FFF;
            }

            .footer-div a {
                text-decoration: none;
            }

            .img-div {
                position: fixed;
                margin-left: 0px;
                padding-left: 0px;
            }

            .logo {
                top: 80px;
            }
        }

        html {
            position: relative;
            min-height: 100%;
        }

        body {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            -webkit-font-smoothing: antialiased;
            /* Margin bottom by footer height */
            margin-bottom: 60px;
        }

        .footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            min-height: 60px;
            padding-top: 15px;
        }

        .footer-links, .footer-links li {
            display: inline-block;
            font-size: 110%;
            padding-left: 0px;
            padding-right: 0px;
        }

        .footer-links li {
            padding-top: 5px;
            padding-left: 5px;
        }

        .footer-links a {
            color: #80AF14;;
        }

        .fixed {
            position: fixed;
        }

        .nav a {
            font-weight: bold;
        }

    </style>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body data-spy="scroll" data-target="#leftNavigation" data-offset="15" class="scrollspy-example">
<!-- Main component for a primary marketing message or call to action -->
<div class="jumbotron">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 pull-left img-div">
                <img src="https://static.payu.co.za/sites/all/themes/regionwithwalletNew/public/images/global/payu@2x.png"
                     class="logo img-responsive"/>
            </div>
            <div class="col-md-9 pull-right">
                <h2>// SOAP API Samples</h2>

                <p>These examples are created to experiment with the PayU-PHP-SDK capabilities. Each examples
                    are designed to demonstrate the default use-cases in each segment.</p>
                <br/>
                <div class="footer-div">
                    <ul class="footer-links">
                        <li>
                            <a href="http://github.com/netcraft-devops/payu-sdk-php/" target="_blank"><i
                                        class="fa fa-github"></i>
                                PayU PHP SDK</a></li>
                        <li>
                            <a href="http://help.payu.co.za/display/developers" target="_blank"><i
                                        class="fa fa-book"></i> SOAP API Reference</a>
                        </li>
                        <li>
                            <a href="http://github.com/netcraft-devops/payu-sdk-php/issues" target="_blank"><i
                                        class="fa fa-exclamation-triangle"></i> Report Issues </a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 ">
            <div class="row-fluid fixed col-md-3" id="leftNavigation" role="navigation">
                <ul class="nav nav-pills nav-stacked">
                    <li><a href="#payments">Payments</a></li>
                    <li><a href="#authorization">Authorization and Capture</a></li>
                    <li><a href="#sale">Sale</a></li>
                </ul>

            </div>
        </div>
        <div class="col-md-9 samples">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 id="payments" class="panel-title"><a
                                href="https://developer.paypal.com/webapps/developer/docs/api/#payments"
                                target="_blank">Payments</a></h3>
                </div>
                <!-- List group -->
                <ul class="list-group">
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-8"><h5>Payments using credit card information</h5></div>
                            <div class="col-md-4">
                                <a href="payments/create-payment.php" class="btn btn-primary pull-left execute"> Try It
                                    <i
                                            class="fa fa-play-circle-o"></i></a>
                                <a href="docs/payments/create-payment.html" class="btn btn-default pull-right">Source <i
                                            class="fa fa-file-code-o"></i></a>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-8">
                                <h5>Payments using saved credit card
                                    <small>(using Authorization Token)</small>
                                </h5>
                            </div>
                            <div class="col-md-4">
                                <a href="payments/CreatePaymentUsingSavedCard.php"
                                   class="btn btn-primary pull-left execute">
                                    Try It <i class="fa fa-play-circle-o"></i></a>
                                <a href="doc/payments/CreatePaymentUsingSavedCard.html"
                                   class="btn btn-default pull-right">Source <i
                                            class="fa fa-file-code-o"></i></a>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-8"><h5>Get payment details</h5></div>
                            <div class="col-md-4">
                                <a href="payments/GetPayment.php" class="btn btn-primary pull-left execute"> Try It <i
                                            class="fa fa-play-circle-o"></i></a>
                                <a href="doc/payments/GetPayment.html" class="btn btn-default pull-right">Source <i
                                            class="fa fa-file-code-o"></i></a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 id="authorization" class="panel-title"><a
                                href="https://developer.paypal.com/webapps/developer/docs/api/#authorizations"
                                target="_blank">Authorization and capture</a></h3>
                </div>
                <!-- List group -->
                <ul class="list-group">
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-8"><h5>Authorize Payment</h5></div>
                            <div class="col-md-4">
                                <a href="payments/AuthorizePayment.php" class="btn btn-primary pull-left execute"> Try
                                    It
                                    <i
                                            class="fa fa-play-circle-o"></i></a>
                                <a href="doc/payments/AuthorizePayment.html" class="btn btn-default pull-right">Source
                                    <i
                                            class="fa fa-file-code-o"></i></a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <h6>Step II: Execute after Success
                                    <small>(required step after user approval)</small>
                                </h6>
                            </div>
                            <div class="col-md-4">
                                <a
                                        href="doc/payments/ExecutePayment.html"
                                        class="btn btn-default pull-right">Part II : Source <i
                                            class="fa fa-file-code-o"></i></a>

                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-8"><h5>Get details of an authorized payment</h5></div>
                            <div class="col-md-4">
                                <a href="payments/GetAuthorization.php" class="btn btn-primary pull-left execute"> Try
                                    It
                                    <i
                                            class="fa fa-play-circle-o"></i></a>
                                <a href="doc/payments/GetAuthorization.html" class="btn btn-default pull-right">Source
                                    <i
                                            class="fa fa-file-code-o"></i></a>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-8"><h5>Capture an authorized payment</h5></div>
                            <div class="col-md-4">
                                <a href="payments/AuthorizationCapture.php" class="btn btn-primary pull-left execute">
                                    Try It <i
                                            class="fa fa-play-circle-o"></i></a>
                                <a href="doc/payments/AuthorizationCapture.html" class="btn btn-default pull-right">Source
                                    <i
                                            class="fa fa-file-code-o"></i></a>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-8"><h5>Get details of a captured payment</h5></div>
                            <div class="col-md-4">
                                <a href="payments/GetCapture.php" class="btn btn-primary pull-left execute"> Try It <i
                                            class="fa fa-play-circle-o"></i></a>
                                <a href="doc/payments/GetCapture.html" class="btn btn-default pull-right">Source <i
                                            class="fa fa-file-code-o"></i></a>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-8"><h5>Void an authorized payment</h5></div>
                            <div class="col-md-4">
                                <a href="payments/VoidAuthorization.php" class="btn btn-primary pull-left execute"> Try
                                    It
                                    <i
                                            class="fa fa-play-circle-o"></i></a>
                                <a href="doc/payments/VoidAuthorization.html" class="btn btn-default pull-right">Source
                                    <i
                                            class="fa fa-file-code-o"></i></a>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-8"><h5>Refund captured payment</h5></div>
                            <div class="col-md-4">
                                <a href="payments/RefundCapture.php" class="btn btn-primary pull-left execute"> Try It
                                    <i
                                            class="fa fa-play-circle-o"></i></a>
                                <a href="doc/payments/RefundCapture.html" class="btn btn-default pull-right">Source <i
                                            class="fa fa-file-code-o"></i></a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 id="sale" class="panel-title"><a
                                href="https://developer.paypal.com/webapps/developer/docs/api/#sale-transactions"
                                target="_blank">Sale</a></h3>
                </div>
                <!-- List group -->
                <ul class="list-group">
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-8"><h5>Get Sale details</h5></div>
                            <div class="col-md-4">
                                <a href="sale/GetSale.php" class="btn btn-primary pull-left execute"> Try It <i
                                            class="fa fa-play-circle-o"></i></a>
                                <a href="doc/sale/GetSale.html" class="btn btn-default pull-right">Source <i
                                            class="fa fa-file-code-o"></i></a>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-8"><h5>Refund a Sale</h5></div>
                            <div class="col-md-4">
                                <a href="sale/RefundSale.php" class="btn btn-primary pull-left execute"> Try It <i
                                            class="fa fa-play-circle-o"></i></a>
                                <a href="doc/sale/RefundSale.html" class="btn btn-default pull-right">Source <i
                                            class="fa fa-file-code-o"></i></a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- /container -->
<hr/>
<footer class="footer">
    <div class="container">
        <div class="footer-div">
            <ul class="footer-links">
                <li>
                    <a href="http://github.com/netcraft-devops/payu-sdk-php/" target="_blank"><i
                                class="fa fa-github"></i>
                        PayU PHP SDK</a></li>
                <li>
                    <a href="https://help.payu.co.za/developers" target="_blank"><i
                                class="fa fa-book"></i> SOAP API Reference</a>
                </li>
                <li>
                    <a href="http://github.com/netcraft-devops/payu-sdk-php/issues" target="_blank"><i
                                class="fa fa-exclamation-triangle"></i> Report Issues </a>
                </li>
            </ul>
        </div>
    </div>
</footer>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.2.0/js/scrollspy.min.js"></script>
<script src="http://crypto-js.googlecode.com/svn/tags/3.1.2/build/rollups/md5.js"></script>

<script>
    $(document).ready(function () {
        if (window.location.href.indexOf("paypal.github.io") >= 0) {
            $(".execute").hide();
        }
    });
    $(function () {
        return $(".samples h5, h6").each(function (i, el) {
            var $el, icon, id;
            $el = $(el);
            id = CryptoJS.MD5(($el.html())).toString();
            //id = $el.attr('id');
            icon = '<i class="fa fa-link"></i>';
            if (id) {
                $el.parent().parent().parent().attr('id', id);
                return $el.prepend($("<a />").addClass("header-link").attr('title', "Anchor Link for this Sample").attr("href", "#" + id).html(icon));
            }
        });
    });
</script>
</body>
</html>