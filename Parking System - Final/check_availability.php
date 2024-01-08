<!DOCTYPE html>
<html lang="en">

<head>
    <title>Check Availability</title>
    <?php include_once('./components/header.php');?>
</head>

<body id="check_availability">
    <!-- include navigation -->
    <?php $page = ""; ?>
    <?php include_once('./components/navigation.php');?>

    <!-- section 1 -->
    <section id="section-1">
        <div class="title-wrap">
            <div class="title">Available parking slots</div>
        </div>
        <div class="partial-wrap">
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

    function book_slot(state, floor, slot) {
        <?php 
        if(array_key_exists('ses_user_id',$_SESSION)){
            echo 'var user = true;';
        } else {
            echo 'var user = false;';
        }
        ?>
        if (state == 2) {
            alert(
                "You can't book this slot because another user has already booked this slot. Please choose another one."
            );
            // Swal.fire({
            //     icon: 'warning',
            //     title: 'Slot Unavailable',
            //     text: "You can't book this slot because another user has already booked this slot. Please choose another one."
            // })
        } else if (state == 1) {
            if (confirm("Do you want to book this parking slot for your vehical?") == true) {
                if (user) {
                    window.location = "./booking.php?floor=" + floor + "&slot=" + slot;
                } else {
                    if (confirm(
                            "You have to log in to your account before booking a slot. Do you want to go the login page?"
                        ) == true) {
                        window.location = "./login.php";
                    }
                }
            } else {
                text = "You canceled!";
            }
        } else if (state == 3) {
            alert(
                "This slot is booked by you. If you want to book another slot you have choose another location."
            );
        }
    }
    view_floor(1);
    </script>
</body>

</html>