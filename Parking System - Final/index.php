<!DOCTYPE html>
<html lang="en">

<head>
    <title>Auto Booking</title>
    <?php include_once('./components/header.php');?>
</head>

<body id="home">
    <!-- include navigation -->
    <?php $page='home';?>
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
        <div class="desc">Our parking systems park cars vertically and horizontally with the help of conveyor
            technology. The user parks the vehicle on a platform that automatically stores it in a high-rack storage
            system. Thanks to these parking systems, the existing parking space can be used optimally: every car finds
            its perfect parking space.</div>
        <div class="btn-wrap">
            <a href="./check_availability.php" class="btn btn-common">Book Your Place Now</a>
        </div>
    </section>

    <!-- footer -->
    <?php include_once('./components/footer.php');?>
</body>

</html>