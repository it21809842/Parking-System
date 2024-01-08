<div class="navigation-1">
    <div class="partial">
        <img src="./img/logo.png" class="logo">
    </div>
    <div class="partial">
        <div class="title"><span class="pri-text">A</span>uto<span class="pri-text">B</span>ooking.com</div>
    </div>
    <div class="partial">
        <img src="./img/logo-2.png" class="logo-2">
    </div>
</div>
<nav class="navigation-2">
    <div class="partial">
        <a class="link <?php if($page=='home'){echo 'active';}?>" href="./index.php">Home</a>
        <a class="link <?php if($page=='about'){echo 'active';}?>" href="./about.php">About Us</a>
        <a class="link <?php if($page=='travel'){echo 'active';}?>" href="./travel_guide.php">Travel Guide</a>
        <a class="link <?php if($page=='service'){echo 'active';}?>" href="./service.php">Service</a>
        <a class="link <?php if($page=='reviews'){echo 'active';}?>" href="./reviews.php">Feedback</a>
        <a class="link <?php if($page=='contact'){echo 'active';}?>" href="./contact_us.php">Contact Us</a>
    </div>
    <div class="partial">
        <?php 
        if(array_key_exists('ses_email', $_SESSION)){
            $dashboard = "";
            if($page=='dashboard'){$dashboard = 'active';}
            if($_SESSION['ses_role'] == 1){
                echo '<a class="link '.$dashboard.'" href="./admin_dashboard1.php">'. $_SESSION['ses_full_name'].'</a>';
            } else {
                echo '<a class="link '.$dashboard.'" href="./dashboard1.php">'. $_SESSION['ses_full_name'].'</a>';
            }
            echo '<a class="link" href="./functions/functions.php?logout=true">Logout</a>';
        } else {
            echo '<a class="link" href="./login.php">Login</a>';
            echo '<a class="link" href="./register.php">Register</a>';
        }
        ?>
    </div>

</nav>