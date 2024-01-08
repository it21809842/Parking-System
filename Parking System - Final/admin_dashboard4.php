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
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>User Name</th>
                        <th>Email Address</th>
                        <th>Mobile</th>
                    </tr>
                    <?php
                        $sql = "SELECT * FROM users WHERE user_role=2";
                        $result = $__conn->query($sql);
                        $count = 1;
                        while($row = $result->fetch_assoc()) {
                        ?>
                    <tr>
                        <td><?php echo $count++;?></td>
                        <td><?php echo $row['first_name'];?></td>
                        <td><?php echo $row['last_name'];?></td>
                        <td><?php echo $row['user_name'];?></td>
                        <td><?php echo $row['email'];?></td>
                        <td><?php echo $row['mobile'];?></td>
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