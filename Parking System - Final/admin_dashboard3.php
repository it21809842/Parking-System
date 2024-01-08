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
                <table>
                    <tr>
                        <th>NO</th>
                        <th>Slot Id</th>
                        <th>Floor ID</th>
                        <th>Plate No</th>
                        <th>Vehical Type</th>
                        <th>Price</th>
                        <th>Booked at</th>
                        <th>Booked for</th>
                        <th>Action</th>
                    </tr>
                    <?php
                        $sql = "SELECT * FROM bookings WHERE booking_status=2";
                        $result = $__conn->query($sql);
                        $count = 1;
                        while($row = $result->fetch_assoc()) {
                        ?>
                    <tr>
                        <td><?php echo $count++;?></td>
                        <td><?php echo $row['slot_id'];?></td>
                        <td><?php echo $row['floor_id'];?></td>
                        <td><?php echo $row['plate_no'];?></td>
                        <td><?php echo $row['vehical_type'];?></td>
                        <td><?php echo $row['price'];?></td>
                        <td><?php echo $row['booked_date'];?></td>
                        <td><?php echo $row['release_date'];?></td>
                        <td><button class="btn-common ps" onclick="release(<?php echo $row['id'];?>)">release</button>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
        </div>

    </section>

    <!-- footer -->
    <?php include_once('./components/footer.php');?>

    <!-- scripts -->
    <script>
    function release(z) {

        let data = new FormData();
        data.append('id', z);
        data.append('release', 'true');

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let x = JSON.parse(xhttp.responseText);
                if (x.code === "c1") {
                    if (x.price > 0) {
                        if (confirm(
                                "You have use the time more than you booked in the system. You have to pay Rs." +
                                x.price +
                                ".00 to finish the payment.") == true) {
                            confirm_release(z, x.price)
                        }
                    } else {
                        confirm_release(z, 0)
                    }

                }
            }
        };
        xhttp.open("POST", "./functions/functions.php", true);
        xhttp.send(data);
    }

    function confirm_release(x, y) {
        let data = new FormData();
        data.append('id', x);
        data.append('fine', y);
        data.append('confirm_release', 'true');

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let x = JSON.parse(xhttp.responseText);
                if (x.code === "c1") {
                    alert(
                        "Some unexpected error occured in the database. Try again!"
                    );
                } else if (x.code === "c2") {
                    confirm("Release Complete!");
                    window.location = "./admin_dashboard3.php";
                }
            }
        };
        xhttp.open("POST", "./functions/functions.php", true);
        xhttp.send(data);
    }
    </script>
</body>

</html>