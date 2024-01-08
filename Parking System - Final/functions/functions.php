<?php 
include_once("./database_config.php");

// start session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// log out function 
if(array_key_exists("logout", $_GET)){
    session_destroy();
    header("location: ../index.php");
}

// user login function
if(array_key_exists("user_login",$_POST)){
    $_email = $_POST["email"];
    $enc_password = $_POST["password"];
    $sql = "SELECT * FROM users WHERE email='$_email'";
    $result = $__conn->query($sql);
    $data = "";
    if ($result->num_rows == 0) {
        $data = [ 'code' => 'c1' ]; // unregisterd email
    } else{
        $sql = "SELECT * FROM users WHERE email='$_email' AND password='$enc_password'";
        $result = $__conn->query($sql);
        if ($result->num_rows == 0) {
            $data = [ 'code' => 'c2' ]; // incorrect password
        } else {
            $row = $result->fetch_assoc();
            $_SESSION['ses_user_id'] = $row['id'];
            $_SESSION['ses_full_name'] = $row['first_name'] . ' ' . $row['last_name'];
            $_SESSION['ses_email'] = $row['email'];
            $_SESSION['ses_role'] = $row['user_role'];
            $data = [ 'code' => 'c3', 'role' => $row['user_role'], 'name' => $row['first_name']];  // success
        }
    }  
    header('Content-type: application/json');
    echo json_encode( $data );
}

// user register function
if(array_key_exists("user_register",$_POST)){
    $_fname = $_POST["fname"];
    $_lname = $_POST["lname"];
    $_uname = $_POST["uname"];
    $_email = $_POST["email"];
    $_mobile = $_POST["mobile"];
    $_password = $_POST["password"];
    
    $sql = "SELECT * FROM users WHERE email='$_email'";
    $result = $__conn->query($sql);
    if ($result->num_rows >= 1) {
        $data = [ 'code' => 'c1' ]; // registerd email
    } else {
        $sql = "SELECT * FROM users WHERE user_name='$_uname'";
        $result = $__conn->query($sql);
        if ($result->num_rows >= 1) {
            $data = [ 'code' => 'c2' ]; // registerd username
        } else {
            $sql = "INSERT INTO users VALUES(NULL,'$_fname','$_lname','$_uname','$_email','$_password','$_mobile',2,1)";
            if ($__conn->query($sql) === TRUE) {
                $sql = "SELECT * FROM users WHERE email='$_email'";
                $result = $__conn->query($sql);
                if ($result->num_rows == 0) {
                    $data = [ 'code' => 'c3' ]; // unexpected system error
                } else {
                    $row = $result->fetch_assoc();
                    $_SESSION['ses_user_id'] = $row['id'];
                    $_SESSION['ses_full_name'] = $row['first_name'] . ' ' . $row['last_name'];
                    $_SESSION['ses_email'] = $row['email'];
                    $_SESSION['ses_role'] = $row['user_role'];
                    $data = [ 'code' => 'c4', 'role' => $row['user_role'], 'name' => $row['first_name']];  // success
                }
            } else {
                $data = [ 'code' => 'c3' ]; // unexpected system error
            }
        }  
    }  
    header('Content-type: application/json');
    echo json_encode( $data );
}
// user register function
if(array_key_exists("user_update",$_POST)){
    $_fname = $_POST["fname"];
    $_lname = $_POST["lname"];
    $_uname = $_POST["uname"];
    $_opassword = $_POST["opassword"];
    $_mobile = $_POST["mobile"];
    $_npassword = $_POST["npassword"];
    $_email = $_SESSION['ses_email'];
    
    $sql = "SELECT * FROM users WHERE email='$_email' AND password='$_opassword'";
    $result = $__conn->query($sql);
    if ($result->num_rows == 0) {
        $data = [ 'code' => 'c1' ]; // invalid old password
    } else {
        $sql = "SELECT * FROM users WHERE user_name='$_uname' AND NOT email='$_email'";
        $result = $__conn->query($sql);
        if ($result->num_rows >= 1) {
            $data = [ 'code' => 'c2' ]; // registerd username
        } else {
            $sql = "UPDATE users SET first_name='$_fname', last_name='$_lname',user_name='$_uname',password='$_npassword',mobile='$_mobile' WHERE email='$_email'";
            if ($__conn->query($sql) === TRUE) {
                $sql = "SELECT * FROM users WHERE email='$_email'";
                $result = $__conn->query($sql);
                if ($result->num_rows == 0) {
                    $data = [ 'code' => 'c3' ]; // unexpected system error
                } else {
                    $row = $result->fetch_assoc();
                    $_SESSION['ses_user_id'] = $row['id'];
                    $_SESSION['ses_full_name'] = $row['first_name'] . ' ' . $row['last_name'];
                    $_SESSION['ses_email'] = $row['email'];
                    $_SESSION['ses_role'] = $row['user_role'];
                    $data = [ 'code' => 'c4', 'role' => $row['user_role'], 'name' => $row['first_name']];  // success
                }
            } else {
                $data = [ 'code' => 'c3' ]; // unexpected system error
            }
        }  
    }  
    header('Content-type: application/json');
    echo json_encode( $data );
}

// view floor
if(array_key_exists('view_floor',$_POST)){
    $_id = $_POST['floor_id'];
    $sql = "SELECT * FROM slots WHERE floor_id=$_id";
    $result = $__conn->query($sql);
    while($row = $result->fetch_assoc()) {
        $sql2 = "SELECT booking_status as st FROM bookings WHERE slot_id=" . $row['id'];
        $result2 = $__conn->query($sql2);
        $style = "empty";
        $st = '1';
        if(mysqli_num_rows($result2) > 0){
            $row2 = $result2->fetch_assoc();
            $style = ($row2['st'] == 1) ? "empty" : "occupied";
            $st = $row2['st'];
            if($style == "occupied" && array_key_exists("ses_user_id", $_SESSION)){
                $user_id = $_SESSION['ses_user_id'];
                $sql3 = "SELECT id FROM bookings WHERE slot_id=" . $row['id'] . " AND user_id=$user_id";
                $result3 = $__conn->query($sql3);
                if(mysqli_num_rows($result3) == 1){
                    $style = "maintanence";
                    $st = 3;
                }
            }
        }
        echo '<div class="partial">
        <div onclick="book_slot('.$st.','.$_id.','.$row['id'].')" class="slot '.$style.'">'.$row['slot_number'].'
        </div>
        </div>';
    }
}

// confirm payment
if(array_key_exists('confirm_payment',$_POST)){
    $_slot = $_POST['slot'];
    $_floor = $_POST['floor'];
    $_user = $_SESSION['ses_user_id'];
    $_plate_no = $_POST['plate_no'];
    $_vehical_type = $_POST['vehical_type'];
    $_price = $_POST['price'];
    $_b_date = $_POST['bday'];
    $_r_date = $_POST['rday'];

    $data = "";

    $sql = "INSERT INTO bookings VALUES(NULL,'$_slot','$_floor','$_user','$_plate_no','$_vehical_type','$_price',2,'$_b_date','$_r_date',NULL,NULL)";
    if ($__conn->query($sql) === TRUE) {
        $data = [ 'code' => 'c2' ]; // success
    } else {
        $data = [ 'code' => 'c1' ]; // unexpected
    }
    header('Content-type: application/json');
    echo json_encode( $data );
}

// admin contact
if(array_key_exists('admin_contact',$_POST)){
    $_title = $_POST['title'];
    $_message = $_POST['message'];

    $data = "";

    $sql = "INSERT INTO admin_contacts VALUES(NULL,'$_title','$_message')";
    if ($__conn->query($sql) === TRUE) {
        $data = [ 'code' => 'c2' ]; // success
    } else {
        $data = [ 'code' => 'c1' ]; // unexpected
    }
    header('Content-type: application/json');
    echo json_encode( $data );
}

// release
if(array_key_exists('release',$_POST)){
    $_id = $_POST['id'];
    $data = "";
    
    $sql = "SELECT ROUND((SELECT TIMESTAMPDIFF(MINUTE, release_date, CURTIME()) AS time FROM bookings WHERE id='$_id') * (SELECT a.cost FROM vehical_types a INNER JOIN bookings b ON a.id=b.vehical_type WHERE b.id='$_id' ) / 60 ) as price ";
    $result = $__conn->query($sql);
    $row = $result->fetch_assoc();

    $data = [ 'code' => 'c1','price' => $row['price'] ]; // success

    header('Content-type: application/json');
    echo json_encode( $data );
}

// confirm_release
if(array_key_exists('confirm_release',$_POST)){
    $_id = $_POST['id'];
    $_fine = $_POST['fine'];
    $data = "";
    
    $sql = "UPDATE bookings SET booking_status=1, checkout_date=CURTIME(), fine='$_fine' WHERE id='$_id'";
    if ($__conn->query($sql) === TRUE) {
        $data = [ 'code' => 'c2' ]; // success
    } else {
        $data = [ 'code' => 'c1' ]; // unexpected
    }

    header('Content-type: application/json');
    echo json_encode( $data );
}

// add_review
if(array_key_exists('add_review',$_POST)){
    $_title = $_POST['title'];
    $_desc = $_POST['desc'];
    $_rate = $_POST['rate'];
    $_user_id = $_SESSION['ses_user_id'];
    $data = "";
    
    $sql = "SELECT * FROM reviews WHERE user_id='$_user_id'";
    $result = $__conn->query($sql);
    if(mysqli_num_rows($result) > 0){
        $sql = "UPDATE reviews SET title='$_title', description='$_desc', rate='$_rate', date=CURDATE() WHERE user_id='$_user_id'";
        if ($__conn->query($sql) === TRUE) {
            $data = [ 'code' => 'c2' ]; // success
        } else {
            $data = [ 'code' => 'c1' ]; // unexpected
        }
    } else {
        $sql = "INSERT INTO reviews VALUES(NULL, '$_user_id', '$_title', '$_desc','$_rate',CURDATE())";
        if ($__conn->query($sql) === TRUE) {
            $data = [ 'code' => 'c2' ]; // success
        } else {
            $data = [ 'code' => 'c1' ]; // unexpected
        }
    }
    header('Content-type: application/json');
    echo json_encode( $data );
}
?>