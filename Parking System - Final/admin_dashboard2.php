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

    <!-- pre validations -->
    <?php
     $_email = $_SESSION['ses_email'];
    
     $sql = "SELECT * FROM users WHERE email='$_email'";
     $result = $__conn->query($sql);
     $row = $result->fetch_assoc();
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
                <div class="form-wrap">
                    <div class="title">EDIT PROFILE</div>
                    <div class="form-item-wrap">
                        <input type="text" class="inp-text" id="fname" placeholder="First Name"
                            autocomplete="new-password" value="<?php echo $row['first_name'];?>">
                        <div id="fname-e" class="error"></div>
                    </div>
                    <div class="form-item-wrap">
                        <input type="text" class="inp-text" id="lname" placeholder="Last Name"
                            autocomplete="new-password" value="<?php echo $row['last_name'];?>">
                        <div id="lname-e" class="error"></div>
                    </div>
                    <div class="form-item-wrap">
                        <input type="text" class="inp-text" id="uname" placeholder="User Name"
                            autocomplete="new-password" value="<?php echo $row['user_name'];?>">
                        <div id="uname-e" class="error"></div>
                    </div>
                    <div class="form-item-wrap">
                        <input type="text" class="inp-text" id="mobile" placeholder="Phone Number"
                            autocomplete="new-password" value="<?php echo $row['mobile'];?>">
                        <div id="mobile-e" class="error"></div>
                    </div>
                    <div class="form-item-wrap">
                        <input type="password" class="inp-text" id="opassword" placeholder="Old Password"
                            autocomplete="new-password">
                        <div id="opsw-e" class="error"></div>
                    </div>
                    <div class="form-item-wrap">
                        <input type="password" class="inp-text" id="npassword" placeholder="New Password"
                            autocomplete="new-password">
                        <div id="npsw-e" class="error"></div>
                    </div>
                    <div class="form-item-wrap">
                        <input type="password" class="inp-text" id="cpassword" placeholder="Confirm Password"
                            autocomplete="new-password">
                        <div id="cpsw-e" class="error"></div>
                    </div>
                    <div class="marg-b">
                        <button onclick="user_update()" class="btn btn-common w100">Update</button>
                    </div>

                </div>
            </div>
        </div>

    </section>

    <!-- footer -->
    <?php include_once('./components/footer.php');?>

    <!-- scripts -->
    <script>
    function user_update() {

        let fname = document.getElementById("fname").value;
        let lname = document.getElementById("lname").value;
        let uname = document.getElementById("uname").value;
        let mobile = document.getElementById("mobile").value;
        let opassword = document.getElementById("opassword").value;
        let npassword = document.getElementById("npassword").value;
        let cpassword = document.getElementById("cpassword").value;
        let enc_passn = md5(npassword);
        let enc_passo = md5(opassword);

        if (fname === "") {
            document.getElementById('fname-e').innerHTML = 'First Name Required!';
            return;
        }
        document.getElementById('fname-e').innerHTML = '';
        if (!(name_pattern.test(fname))) {
            document.getElementById('fname-e').innerHTML = 'Invalid First Name!';
            return;
        }
        document.getElementById('fname-e').innerHTML = '';
        if (lname === "") {
            document.getElementById('lname-e').innerHTML = 'Last Name Required!';
            return;
        }
        document.getElementById('lname-e').innerHTML = '';
        if (!(name_pattern.test(lname))) {
            document.getElementById('lname-e').innerHTML = 'Invalid Last Name!';
            return;
        }
        document.getElementById('lname-e').innerHTML = '';
        if (uname === "") {
            document.getElementById('uname-e').innerHTML = 'User Name Required!';
            return;
        }
        document.getElementById('uname-e').innerHTML = '';
        if (!(uname_pattern.test(uname))) {
            document.getElementById('uname-e').innerHTML = 'Invalid User Name!';
            return;
        }
        document.getElementById('uname-e').innerHTML = '';
        if (mobile === "") {
            document.getElementById('mobile-e').innerHTML = 'Mobile Number Required!';
            return;
        }
        document.getElementById('mobile-e').innerHTML = '';
        if (!(mobile_pattern.test(mobile))) {
            document.getElementById('mobile-e').innerHTML = 'Invalid Mobile Number!';
            return;
        }
        document.getElementById('mobile-e').innerHTML = '';
        if (opassword === "") {
            document.getElementById('opsw-e').innerHTML = 'Old Password Required!';
            return;
        }
        document.getElementById('opsw-e').innerHTML = '';
        if (npassword === "") {
            document.getElementById('npsw-e').innerHTML = 'New Password Required!';
            return;
        }
        document.getElementById('npsw-e').innerHTML = '';
        if (cpassword === "") {
            document.getElementById('cpsw-e').innerHTML = 'Confirm Password Required!';
            return;
        }
        document.getElementById('cpsw-e').innerHTML = '';
        if (cpassword !== npassword) {
            document.getElementById('cpsw-e').innerHTML = 'Passwords Don\'t Match!';
            return;
        }
        document.getElementById('cpsw-e').innerHTML = '';

        let data = new FormData();
        data.append('fname', fname);
        data.append('lname', lname);
        data.append('uname', uname);
        data.append('mobile', mobile);
        data.append('opassword', enc_passo);
        data.append('npassword', enc_passn);
        data.append('user_update', 'true');

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let x = JSON.parse(xhttp.responseText);
                if (x.code === "c1") {
                    document.getElementById('opsw-e').innerHTML = 'Invalid Old Password!';
                } else if (x.code === "c2") {
                    document.getElementById('uname-e').innerHTML = 'Username Exists!';
                } else if (x.code === "c3") {
                    alert(
                        "Some unexpected error occured in the database. Try again!"
                    );
                } else if (x.code === "c4") {
                    confirm("User Data Updated!");
                    window.location = "./admin_dashboard2.php";
                }
            }
        };
        xhttp.open("POST", "./functions/functions.php", true);
        xhttp.send(data);
    }
    </script>
</body>

</html>