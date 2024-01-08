<!DOCTYPE html>
<html lang="en">

<head>
    <title>User Dashboard</title>
    <?php include_once('./components/header.php');?>
</head>

<body id="dashboard">
    <!-- include navigation -->
    <?php $page='dashboard';?>
    <?php include_once('./components/navigation.php');?>

    <!-- user validation -->
    <?php 
    if(array_key_exists('ses_role',$_SESSION)){
        if($_SESSION['ses_role'] != 2){
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
                <a href="./dashboard1.php" class="btn-common">Edit Profile</a>
                <a href="./dashboard2.php" class="btn-common">View Released</a>
                <a href="./dashboard3.php" class="btn-common">View Active</a>
                <a href="./dashboard4.php" class="btn-common">Contact Admin</a>
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
                    </tr>
                    <?php
                        $sql = "SELECT * FROM bookings WHERE booking_status=2 AND user_id=" . $_SESSION['ses_user_id'];
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
                    </tr>
                    <?php } ?>
                </table>
            </div>
        </div>

    </section>

    <!-- footer -->
    <?php include_once('./components/footer.php');?>


</body>

</html>