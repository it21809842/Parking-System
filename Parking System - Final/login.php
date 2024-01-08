<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
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
            <div class="title">LOGIN</div>
            <div class="form-item-wrap">
                <input type="text" class="inp-text" id="email" placeholder="Email Address" autocomplete="new-email">
                <div id="email-e" class="error"></div>
            </div>
            <div class="form-item-wrap">
                <input type="password" class="inp-text" id="password" placeholder="Password"
                    autocomplete="new-password">
                <div id="password-e" class="error"></div>
            </div>
            <div class="marg-b">
                <input class="inp-text" type="checkbox" id="remember" checked>
                <label for="remember">
                    Remember Me
                </label>
            </div>
            <div class="marg-b">
                <button onclick="user_login()" class="btn btn-common w100">Log In</button>
            </div>
            <div>
                <label>
                    Forgot your password? <a href="">Click here </a>
                </label>
            </div>
            <div>
                <label>
                    Don't you have an account? <a href="./register.php">Click here </a>
                </label>
            </div>
        </div>
    </section>

    <!-- footer -->
    <?php include_once('./components/footer.php');?>


    <!-- scripts -->
    <script>
    function user_login() {

        let email = document.getElementById("email").value;
        let password = document.getElementById("password").value;
        let enc_pass = md5(password);

        if (email === "") {
            document.getElementById('email-e').innerHTML = 'Email Address Required!';
            return;
        }
        document.getElementById('email-e').innerHTML = "";
        if (!(email_pattern.test(email))) {
            document.getElementById('email-e').innerHTML = 'Invalid Email Address!';
            return;
        }
        document.getElementById('email-e').innerHTML = "";
        if (password === "") {
            document.getElementById('password-e').innerHTML = 'Password Required!';
            return;
        }
        document.getElementById('password-e').innerHTML = "";

        let data = new FormData();
        data.append('email', email);
        data.append('password', enc_pass);
        data.append('user_login', 'true');

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let x = JSON.parse(xhttp.responseText);
                if (x.code === "c1") {
                    document.getElementById('password-e').innerHTML = "";
                    document.getElementById('email-e').innerHTML = "";
                    document.getElementById('email-e').innerHTML = 'Unregisterd Email Address!';
                } else if (x.code === "c2") {
                    document.getElementById('password-e').innerHTML = "";
                    document.getElementById('email-e').innerHTML = "";
                    document.getElementById('password-e').innerHTML = 'Invalid Password!';
                } else if (x.code === "c3") {
                    document.getElementById('password-e').innerHTML = "";
                    document.getElementById('email-e').innerHTML = "";
                    if (x.role == 1) {
                        window.location = "./admin_dashboard1.php";
                    } else if (x.role == 2) {
                        window.location = "./dashboard1.php";
                    }
                }
            }
        };
        xhttp.open("POST", "./functions/functions.php", true);
        xhttp.send(data);
    }
    </script>
</body>

</html>