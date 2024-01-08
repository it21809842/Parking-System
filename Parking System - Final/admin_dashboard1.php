<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Dashboard</title>
    <?php include_once('./components/header.php');?>
</head>

<body id="dashboard">
    <!-- include navigation -->
    <?php $page='dashboard';?>
    <?php include_once('./components/navigation.php');?>

    <!-- user validation -->
    <?php 
    if(array_key_exists('ses_role',$_SESSION)){
        if($_SESSION['ses_role'] != 1){
            header('location:./index.php');
        }
    } else {
        header('location:./index.php');
    }
    ?>

    <!-- section 1 -->
    <section id="section-1">
        <div class="menu-list">
            <div>
                <a href="./admin_dashboard1.php" class="btn-common">Dashboard</a>
                <a href="./admin_dashboard2.php" class="btn-common">Edit Profile</a>
                <a href="./admin_dashboard3.php" class="btn-common">Release Slot</a>
                <a href="./admin_dashboard4.php" class="btn-common">User Details</a>
                <a href="./admin_dashboard5.php" class="btn-common">Live View</a>
                <a href="./admin_dashboard6.php" class="btn-common">User Messages</a>
            </div>
        </div>
        <div class="pwrap">
            <div class="partial">
                <div>
                    <div class="greet">Welcome Admin</div>
                    <div class="card-wrap-p">
                        <div class="card-p">
                            <?php
                            $sql = "SELECT count(*) AS count FROM bookings WHERE DATE(booked_date) = DATE(CURRENT_DATE())";
                            $result = $__conn->query($sql);
                            $row = $result->fetch_assoc();
                            ?>
                            <div><span><?php echo $row['count'];?></span></div>
                            <div>Today Bookings</div>
                        </div>
                        <div class="card-p">
                            <?php
                            $sql = "SELECT (SELECT count(*) FROM slots)-(SELECT count(*) FROM bookings WHERE booking_status=2) AS count";
                            $result = $__conn->query($sql);
                            $row = $result->fetch_assoc();
                            ?>
                            <div><span><?php echo $row['count'];?></span></div>
                            <div>Free Slots</div>
                        </div>
                        <div class="card-p">
                            <?php
                            $sql = "SELECT (SELECT sum(price) FROM bookings WHERE DATE(checkout_date) = DATE(CURRENT_DATE())) + (SELECT sum(fine) FROM bookings WHERE DATE(checkout_date) = DATE(CURRENT_DATE())) as total";
                            $result = $__conn->query($sql);
                            $row = $result->fetch_assoc();
                            ?>
                            <div><span>Rs <?php echo $row['total'];?>.00</span></div>
                            <div>Today Income</div>
                        </div>
                        <div class="card-p">
                            <?php
                            $sql = "SELECT count FROM site_visits WHERE date=CURDATE()";
                            $result = $__conn->query($sql);
                            $row = $result->fetch_assoc();
                            ?>
                            <div><span><?php echo $row['count'];?></span></div>
                            <div>Today Site Visits</div>
                        </div>
                    </div>
                    <div class="card-wrap-p">
                        <div class="card-p">
                            <?php
                            $sql = "SELECT count(*) AS count FROM bookings";
                            $result = $__conn->query($sql);
                            $row = $result->fetch_assoc();
                            ?>
                            <div><span><?php echo $row['count'];?></span></div>
                            <div>Total Bookings</div>
                        </div>
                        <div class="card-p">
                            <?php
                            $sql = "SELECT count(*) AS count FROM slots";
                            $result = $__conn->query($sql);
                            $row = $result->fetch_assoc();
                            ?>
                            <div><span><?php echo $row['count'];?></span></div>
                            <div>All Slots</div>
                        </div>
                        <div class="card-p">
                            <?php
                            $sql = "SELECT (SELECT sum(price) FROM bookings WHERE booking_status=1) + (SELECT sum(fine) FROM bookings WHERE booking_status=1) as total";
                            $result = $__conn->query($sql);
                            $row = $result->fetch_assoc();
                            ?>
                            <div><span>Rs <?php echo $row['total'];?>.00</span></div>
                            <div>Total Income</div>
                        </div>
                        <div class="card-p">
                            <?php
                            $sql = "SELECT SUM(count) AS count FROM site_visits";
                            $result = $__conn->query($sql);
                            $row = $result->fetch_assoc();
                            ?>
                            <div><span><?php echo $row['count'];?></span></div>
                            <div>Total Site Visits</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <!-- footer -->
    <?php include_once('./components/footer.php');?>

</body>

</html>