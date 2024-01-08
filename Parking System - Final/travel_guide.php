<!DOCTYPE html>
<html lang="en">

<head>
    <title>Travel Guide</title>
    <?php include_once('./components/header.php');?>
</head>

<body id="guide">
    <!-- include navigation -->
    <?php $page='travel';?>
    <?php include_once('./components/navigation.php');?>

    <!-- section 1 -->
    <section id="section-1">
        <div class="title">You can Find Us From Here</div>
        <div class="partial">

            <div class="map-wrap">
                <div class="mapouter">
                    <div class="gmap_canvas"><iframe width="848" height="455" id="gmap_canvas"
                            src="https://maps.google.com/maps?q=Campbell%20Park%20Car%20Park&t=&z=19&ie=UTF8&iwloc=&output=embed"
                            frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a
                            href="https://www.embedgooglemap.net/blog/divi-discount-code-elegant-themes-coupon/"></a><br>
                        <style>
                        .mapouter {
                            position: relative;
                            text-align: right;
                            height: 455px;
                            width: 848px;
                        }
                        </style><a href="https://www.embedgooglemap.net">google maps widget html</a>
                        <style>
                        .gmap_canvas {
                            overflow: hidden;
                            background: none !important;
                            height: 455px;
                            width: 848px;
                        }
                        </style>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- footer -->
    <?php include_once('./components/footer.php');?>
</body>

</html>