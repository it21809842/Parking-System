<!DOCTYPE html>
<html lang="en">

<head>
    <title>Service</title>
    <?php include_once('./components/header.php');?>
</head>

<body id="service">
    <!-- include navigation -->
    <?php $page='service';?>
    <?php include_once('./components/navigation.php');?>

    <!-- pre validations -->
    <?php
    $sql = "SELECT count(*) AS count FROM site_visits WHERE date=CURDATE()";
    $result = $__conn->query($sql);
    $row = $result->fetch_assoc();
    if ($row['count'] > 0) {
        $sql = "UPDATE site_visits SET count=((SELECT count FROM site_visits WHERE date=CURDATE()) + 1) WHERE date=CURDATE()";
        $__conn->query($sql);
    } else {
        $sql = "INSERT INTO site_visits VALUES(NULL,CURDATE(),1)";
        $__conn->query($sql);
    }
    ?>

    <!-- section 1 -->
    <section id="section-1">
        <img src="./img/logow.png" class="logo">
        <div class="title"><span class="pri-text">A</span>uto<span class="pri-text">B</span>ooking.com
        </div>
        <div class="sub">
            Quicker & Easier
        </div>
        <div class="desc">As your needs change over time, Auto Booking.com can also support the expansion of your
            facility, or the transition to new technologies. Auto Booking.com Industries has a strong track record for
            delivering lift and lifting table enhancements or modernizations whilst clients continue to run their
            day-to-day business.</div>
        <div class="btn-wrap">
            <a href="./check_availability.php" class="btn btn-common">Book Your Place Now</a>
        </div>
        <div class="sub">
            Manage Your History
        </div>
        <div class="desc">Parking spaces are very important to cities. A city must have enough parking spaces to provide
            its residents and their visitors with a place to park their cars. Since cars are the main factor in
            transportation, a city must meet the needs of the drivers.</div>
        <div class="btn-wrap">
            <a href="./dashboard1.php" class="btn btn-common">Go to dashboard</a>
        </div>
        <div class="sub">
            Support 24/7
        </div>
        <div class="desc">As your needs change over time, Auto Booking.com can also support the expansion of your
            facility, or the transition to new technologies.</div>
        <div class="btn-wrap">
            <a href="./dashboard4.php" class="btn btn-common">Contact Us</a>
        </div>


    </section>

    <!-- footer -->
    <?php include_once('./components/footer.php');?>
</body>

</html>