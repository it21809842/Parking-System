<!DOCTYPE html>
<html lang="en">

<head>
    <title>Booking</title>
    <?php include_once('./components/header.php');?>
</head>

<body id="booking">
    <!-- include navigation -->
    <?php $page = ""; ?>
    <?php include_once('./components/navigation.php');?>

    <!-- pre validations -->
    <?php
    $floor = $slot = "";
    if(array_key_exists('floor', $_GET) && array_key_exists('slot', $_GET)){
        $floor = $_GET['floor'];
        $slot = $_GET['slot'];
        if(empty($floor) || empty($slot)){
            header('Location:./check_availability.php');
        }
    } else {
        header('Location:./check_availability.php');
    }
    $floor_slot = "";
    $sql = "SELECT * FROM slots WHERE id='$slot'";
    $result = $__conn->query($sql);
    if ($result->num_rows == 0) {
        header('Location:./check_availability.php');
    } else {
        $row = $result->fetch_assoc();
        $floor_slot = "Floor No " . $row['floor_id'] . " - Slot No " . $row['slot_number'];
        echo '<input type="hidden" id="floor" value="'.$row['floor_id'].'">';
        echo '<input type="hidden" id="slot" value="'.$row['id'].'">';
    }
    ?>

    <!-- section 1 -->
    <section id="section-1">
        <div class="form-wrap">
            <div class="title">BOOK A SLOT</div>
            <div class="form-item-wrap marg-b">
                <label>Floor & Slot</label><br>
                <input type="text" class="inp-text" placeholder="Floor No 1 - Slot No 1" autocomplete="new-email"
                    disabled value="<?php echo $floor_slot; ?>">
                <div id="floor-e" class="error"></div>
            </div>
            <div class="form-item-wrap marg-b">
                <label class="form-label req">Vehical Type (Cost per
                    hour)</label>
                <select onchange="setCost()" class="inp-text" id="v_type">
                    <?php
                        $sql = "SELECT * FROM vehical_types";
                        $result = $__conn->query($sql);
                        while($row = $result->fetch_assoc()) {
                        ?>
                    <option value="<?php echo $row['id'] . "-" . $row['cost']?>">
                        <?php echo $row['type'] ." &nbsp; - &nbsp; Rs " .$row['cost'] . ".00"?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-item-wrap marg-b">
                <label for="exampleDataList" class="form-label req">Vehical Plate No</label>
                <input type="text" class="inp-text" id="v_no" placeholder="XX-XXXX / XXX-XXXX" autocomplete="new-email">
                <div id="plate-e" class="error"></div>
            </div>
            <div class="form-item-wrap marg-b">
                <label for="exampleDataList" class="form-label req">Book Until (Date)</label><br>
                <input type="date" class="inp-text" id="date" placeholder="Slot" onblur="calculate_value()"
                    autocomplete="new-email">
                <div id="date-e" class="error"></div>
            </div>
            <div class="form-item-wrap marg-b">
                <label for="exampleDataList" class="form-label req">Book Until (Time)</label><br>
                <input type="time" class="inp-text" id="time" placeholder="Slot" onblur="calculate_value()"
                    autocomplete="new-email">
                <div id="time-e" class="error"></div>
            </div>
            <div class="form-item-wrap marg-b">
                <label for="exampleDataList" class="form-label">Amount (Auto Genarated
                    Value)</label>
                <input type="text" class="inp-text" id="price" placeholder="Rs 0.00" autocomplete="new-email" disabled>
            </div>
            <div class="form-item-wrap">
                <!-- <button onclick="user_login()" class="btn btn-common w-100">Proceed to payment</button> -->
                <button onclick="payment()" class="btn btn-common w100">Proceed to payment</button>
            </div>

        </div>
        </div>
        </div>

        </div>
        </div>
    </section>

    <!-- footer -->
    <?php include_once('./components/footer.php');?>


    <!-- scripts -->
    <script>
    var ps = 0;
    var bday = "";
    var vehical_cost = 0;

    function setCost() {
        let vehicalType = document.getElementById('v_type').value;
        vehical_cost = vehicalType.substring(2, vehicalType.length)
        calculate_value()
    }

    function calculate_value() {
        let date = document.getElementById('date').value;
        let time = document.getElementById('time').value;
        <?php
        $sql = 'SELECT DATE_FORMAT(CURTIME(), "%k:%i") as time , DATE_FORMAT(CURDATE(), "%Y/%m/%d") as date';
        $result = $__conn->query($sql);
        $d = "";
        $d2 = "";
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $d = $row['date'] . " " . $row['time'];
            $d2 = $row['date'] . " " . $row['time'] . ':00';
        }
        ?>
        bday = "<?php echo $d2; ?>";
        var diff = Math.abs(new Date('<?php echo $d; ?>') - new Date(date + " " + time));
        var minutes = Math.floor((diff / 1000) / 60);
        console.log(minutes);
        console.log(vehical_cost);
        var price = Math.round((minutes / 60) * vehical_cost);
        if (Number.isNaN(price)) {
            document.getElementById('price').value = "Rs 0.00";
        } else {
            ps = price;
            document.getElementById('price').value = "Rs " + price + ".00";
        }
    }

    function payment() {
        let floor = document.getElementById("floor").value;
        let slot = document.getElementById("slot").value;
        let date = document.getElementById('date').value;
        let time = document.getElementById('time').value;
        let vehicalNo = document.getElementById('v_no').value;
        let vehicalType = document.getElementById('v_type').value;
        if (vehicalNo === "") {
            document.getElementById('plate-e').innerHTML = 'Vehical Number Required!';
            return;
        }
        document.getElementById('plate-e').innerHTML = '';
        if (!(v_no_pattern.test(vehicalNo))) {
            document.getElementById('plate-e').innerHTML = 'Invalid Vehical Number!';
            return;
        }
        document.getElementById('plate-e').innerHTML = '';
        if (date === "") {
            document.getElementById('date-e').innerHTML = 'Date Required!';
            return;
        }
        document.getElementById('date-e').innerHTML = '';
        if (time === "") {
            document.getElementById('time-e').innerHTML = 'Time Required!';
            return;
        }
        document.getElementById('time-e').innerHTML = '';

        var form = document.createElement("form");
        form.setAttribute("method", "post");
        form.setAttribute("action", "./payment.php");

        form.onformdata = (e) => {
            let data = e.formData;
            data.append('floor', floor);
            data.append('slot', slot);
            data.append('bday', bday);
            data.append('rday', date + " " + time + ":00");
            data.append('price', ps);
            data.append('v_type', vehicalType.substring(0, 1));
            data.append('v_no', vehicalNo);
            data.append('payment', 'true');
        };

        document.body.appendChild(form);
        form.submit();
        document.body.removeChild(form);

    }

    setCost();
    </script>
</body>

</html>