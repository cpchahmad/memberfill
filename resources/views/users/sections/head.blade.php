<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Polished</title>
    <!-- <link rel="stylesheet" href="http://localhost:3000/css/bootstrap4/dist/css/bootstrap-custom.css?v=datetime"> -->
    <link rel="stylesheet" href="{{asset('demo/polished.min.css')}}">
    <!-- <link rel="stylesheet" href="polaris-navbar.css"> -->
    <link rel="stylesheet" href="{{asset('dist/iconic/css/open-iconic-bootstrap.min.css')}}">

    <link rel="icon" href="{{asset('assets/polished-logo-small.png')}}">

    <!--  Essential META Tags -->

    <meta property="og:title" content="Polished - Bootstrap 4 Admin Template">
    <meta property="og:description" content="100% Free & Open Source Bootstrap 4 Admin Template">
    <meta property="og:image" content="https://azamuddin.github.io/polished-template/assets/polished-banner-transparent.png">
    <meta property="og:url" content="https://azamuddin.github.io/polished-template">
    <meta name="twitter:card" content="summary_large_image">

    <!--  Non-Essential, But Recommended -->

    <meta property="og:site_name" content="Polished - Bootstrap 4 Admin Template">
    <meta name="twitter:image:alt" content="Polished Admin Template">


    <!--  Non-Essential, But Required for Analytics -->
    <meta name="twitter:site" content="@azamuddin91">

    <style>
        .grid-highlight {
            padding-top: 1rem;
            padding-bottom: 1rem;
            background-color: #5c6ac4;
            border: 1px solid #202e78;
            color: #fff;
        }

        hr {
            margin: 6rem 0;
        }

        hr+.display-3,
        hr+.display-2+.display-3 {
            margin-bottom: 2rem;
        }
    </style>
    <script type="text/javascript">
        document.documentElement.className = document.documentElement.className.replace('no-js', 'js') + (document.implementation.hasFeature("http://www.w3.org/TR/SVG11/feature#BasicStructure", "1.1") ? ' svg' : ' no-svg');
    </script>
    <!-- Facebook Pixel Code -->
    <script>
        !function (f, b, e, v, n, t, s) {
            if (f.fbq) return; n = f.fbq = function () {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n; n.push = n; n.loaded = !0; n.version = '2.0';
            n.queue = []; t = b.createElement(e); t.async = !0;
            t.src = v; s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '564839313686027');
        fbq('track', 'PageView');
    </script>
    <noscript>
        <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=564839313686027&ev=PageView&noscript=1"
        />
    </noscript>
    <!-- End Facebook Pixel Code -->

</head>
