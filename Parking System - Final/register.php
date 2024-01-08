<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register</title>
    <?php include_once('./components/header.php');?>
</head>

<body id="login">

    <!-- user validation -->
    <?php 
    if(array_key_exists('ses_role',$_SESSION)){
            header('location:./index.php');
    }
    ?>

    <!-- include navigation -->
    <?php include_once('./components/navigation.php');?>

    <!-- section 1 -->
    <section id="section-1">
        <div class="form-wrap">
            <div class="title mb-3">REGISTER</div>
            <div class="form-item-wrap">
                <input type="text" class="inp-text" id="fname" placeholder="First Name" autocomplete="new-password">
                <div id="fname-e" class="error"></div>
            </div>
            <div class="form-item-wrap">
                <input type="text" class="inp-text" id="lname" placeholder="Last Name" autocomplete="new-password">
                <div id="lname-e" class="error"></div>
            </div>
            <div class="form-item-wrap">
                <input type="text" class="inp-text" id="uname" placeholder="User Name" autocomplete="new-password">
                <div id="uname-e" class="error"></div>
            </div>
            <div class="form-item-wrap">
                <input type="text" class="inp-text" id="email" placeholder="Email Address" autocomplete="new-password">
                <div id="email-e" class="error"></div>
            </div>
            <div class="form-item-wrap">
                <input type="text" class="inp-text" id="mobile" placeholder="Phone Number" autocomplete="new-password">
                <div id="mobile-e" class="error"></div>
            </div>
            <div class="form-item-wrap">
                <input type="password" class="inp-text" id="password" placeholder="Password"
                    autocomplete="new-password">
                <div id="psw-e" class="error"></div>
            </div>
            <div class="form-item-wrap">
                <input type="password" class="inp-text" id="cpassword" placeholder="Confirm Password"
                    autocomplete="new-password">
                <div id="cpsw-e" class="error"></div>
            </div>
            <div class="marg-b">
                <input class="inp-text" type="checkbox" value="" id="confirm">
                <label for="confirm">
                    Agree to Terms & Conditions
                </label>
            </div>
            <div class="marg-b">
                <button onclick="user_register()" class="btn btn-common w100">Register</button>
            </div>
            <div class="">
                <label>
                    Already have an account? <a href="./login.php">Click here </a>
                </label>
            </div>
        </div>
    </section>

    <!-- footer -->
    <?php include_once('./components/footer.php');?>

    <!-- scripts -->
    <script>
    function clear_input() {
        document.getElementById('fname-e').innerHTML = '';
        document.getElementById('lname-e').innerHTML = '';
        document.getElementById('uname-e').innerHTML = '';
        document.getElementById('email-e').innerHTML = '';
        document.getElementById('mobile-e').innerHTML = '';
        document.getElementById('psw-e').innerHTML = '';
        document.getElementById('cpsw-e').innerHTML = '';
    }

    function user_register() {
        let fname = document.getElementById("fname").value;
        let lname = document.getElementById("lname").value;
        let uname = document.getElementById("uname").value;
        let email = document.getElementById("email").value;
        let mobile = document.getElementById("mobile").value;
        let password = document.getElementById("password").value;
        let cpassword = document.getElementById("cpassword").value;
        let confirm = document.getElementById("confirm");
        let enc_pass = md5(password);

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
        if (email === "") {
            document.getElementById('email-e').innerHTML = 'Email Address Required!';
            return;
        }
        document.getElementById('email-e').innerHTML = '';
        if (!(email_pattern.test(email))) {
            document.getElementById('email-e').innerHTML = 'Invalid Email Address!';
            return;
        }
        document.getElementById('email-e').innerHTML = '';
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
        if (password === "") {
            document.getElementById('psw-e').innerHTML = 'Password Required!';
            return;
        }
        document.getElementById('psw-e').innerHTML = '';
        if (cpassword === "") {
            document.getElementById('cpsw-e').innerHTML = 'Confirm Password Required!';
            return;
        }
        document.getElementById('cpsw-e').innerHTML = '';
        if (cpassword !== password) {
            document.getElementById('cpsw-e').innerHTML = 'Passwords Don\'t Match!';
            return;
        }
        document.getElementById('cpsw-e').innerHTML = '';
        if (!confirm.checked) {
            alert('You have to agree to our terms and conditions to register in this site.');
            return;
        }

        let data = new FormData();
        data.append('fname', fname);
        data.append('lname', lname);
        data.append('uname', uname);
        data.append('email', email);
        data.append('mobile', mobile);
        data.append('password', enc_pass);
        data.append('user_register', 'true');

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let x = JSON.parse(xhttp.responseText);
                if (x.code === "c1") {
                    clear_input()
                    document.getElementById('email-e').innerHTML = 'Email Address Exists!';
                } else if (x.code === "c2") {
                    clear_input()
                    document.getElementById('uname-e').innerHTML = 'User Name Exists!';
                } else if (x.code === "c3") {
                    clear_input()
                    alert(
                        "Some unexpected error occured in the database. Try again!"
                    );
                } else if (x.code === "c4") {
                    clear_input()
                    window.location = "./dashboard1.php";
                }
            }
        };
        xhttp.open("POST", "./functions/functions.php", true);
        xhttp.send(data);
    }
    </script>
</body>

</html>