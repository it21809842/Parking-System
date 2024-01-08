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


        <div class="partial-wrap x">
            <?php
            $sql = "SELECT * FROM floors";
            $result = $__conn->query($sql);
            while($row = $result->fetch_assoc()) {
                $sql2 = "SELECT (SELECT count(*) FROM slots WHERE floor_id=".$row['id'].")-(SELECT count(*) FROM bookings WHERE floor_id=".$row['id']." AND booking_status=2) AS count";
                $result2 = $__conn->query($sql2);
                $row2 = $result2->fetch_assoc();
            ?>
            <div class="partial">
                <div onclick="view_floor(<?php echo $row['id'];?>)" id="card<?php echo $row['id'];?>" class="card">
                    <span><?php echo $row2['count'];?></span>
                    <div><?php echo $row['name'];?></div>
                </div>
            </div>
            <?php } ?>
        </div>
        <div id="_slot_wrap">
        </div>



    </section>

    <!-- footer -->
    <?php include_once('./components/footer.php');?>

    <!-- scripts -->
    <script>
    function view_floor(y) {
        let data = new FormData();
        data.append('floor_id', y);
        data.append('view_floor', 'true');

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let x = xhttp.responseText;
                document.getElementById('_slot_wrap').innerHTML = x;
                for (var i = 1; i < 6; i++) {
                    document.getElementById('card' + i).setAttribute("class", "card");
                }
                document.getElementById('card' + y).setAttribute("class", "card active");
            }
        };
        xhttp.open("POST", "./functions/functions.php", true);
        xhttp.send(data);

    }

    view_floor(1);
    </script>
</body>

</html>