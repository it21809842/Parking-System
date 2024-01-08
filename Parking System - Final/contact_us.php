<!DOCTYPE html>
<html lang="en">

<head>
    <title>Auto Booking</title>
    <?php include_once('./components/header.php');?>
</head>

<body id="home" class="contact">
    <!-- include navigation -->
    <?php $page='contact';?>
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
        <div class="desc">We look forward to your message.
            You can reach us by phone or e-mail.</div>
        <div class="desc">Mobile No : 123912037</div>
        <div class="desc">Fax No : 023231-32121</div>
        <div class="desc">Email Address : autobooking@gmail.com</div>

    </section>

    <!-- footer -->
    <?php include_once('./components/footer.php');?>
</body>

</html>