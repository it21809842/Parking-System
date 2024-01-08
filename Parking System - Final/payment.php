<!DOCTYPE html>
<html lang="en">

<head>
    <title>Payment</title>
    <?php include_once('./components/header.php');?>
</head>

<body id="booking">
    <!-- include navigation -->
    <?php $page = ""; ?>
    <?php include_once('./components/navigation.php');?>

    <!-- section 1 -->
    <section id="section-1">

        <div class="form-wrap">
            <div class="title">PAYMENT DETAILS</div>
            <div class="form-item-wrap">
                <label class="form-label mb-0 req">Card Holder's Name</label>
                <input type="text" class="form-control" id="cname" placeholder="S JOHN" autocomplete="new-email">
                <div id="name-e" class="error"></div>
            </div>
            <div class="form-item-wrap">
                <label for="exampleDataList" class="form-label mb-0 req">Card Number</label>
                <input type="text" class="form-control" id="card_no" placeholder="4323 2342 3525 5869"
                    autocomplete="new-email">
                <div id="number-e" class="error"></div>
            </div>
            <div class="form-item-wrap">
                <label for="exampleDataList" class="form-label mb-0 req">Expiry</label>
                <input type="text" class="form-control" id="expire" placeholder="MM/YY" autocomplete="new-email">
                <div id="exp-e" class="error"></div>
            </div>
            <div class="form-item-wrap">
                <label for="exampleDataList" class="form-label mb-0 req">CVC</label>
                <input type="text" class="form-control" id="cvc" placeholder="***" autocomplete="new-email">
                <div id="cvc-e" class="error"></div>
            </div>
            <div class="form-item-wrap">
                <!-- <button onclick="user_login()" class="btn btn-common w-100">Proceed to payment</button> -->
                <button onclick="confirm_payment()" class="btn btn-common w100">Confirm
                    Booking</button>
            </div>

        </div>
    </section>

    <!-- footer -->
    <?php include_once('./components/footer.php');?>

    <!-- scripts -->
    <script>
    function confirm_payment() {

        let cname = document.getElementById("cname").value;
        let card_no = document.getElementById("card_no").value;
        let expire = document.getElementById("expire").value;
        let cvc = document.getElementById("cvc").value;

        if (cname === "") {
            document.getElementById('name-e').innerHTML = 'Card Holder Name Required!';
            return;
        }
        document.getElementById('name-e').innerHTML = '';
        if (!(c_name_pattern.test(cname))) {
            document.getElementById('name-e').innerHTML = 'Invalid Card Holder Name!';
            return;
        }
        document.getElementById('name-e').innerHTML = '';
        if (card_no === "") {
            document.getElementById('number-e').innerHTML = 'Card Number Required!';
            return;
        }
        document.getElementById('number-e').innerHTML = '';
        if (!(card_pattern.test(card_no))) {
            document.getElementById('number-e').innerHTML = 'Invalid Card Number!';
            return;
        }
        document.getElementById('number-e').innerHTML = '';
        if (expire === "") {
            document.getElementById('exp-e').innerHTML = 'Expire Date Required!';
            return;
        }
        document.getElementById('exp-e').innerHTML = '';
        if (!(expire_pattern.test(expire))) {
            document.getElementById('exp-e').innerHTML = 'Invalid Expire Date!';
            return;
        }
        document.getElementById('exp-e').innerHTML = '';
        if (cvc === "") {
            document.getElementById('cvc-e').innerHTML = 'CVC Number Required!';
            return;
        }
        document.getElementById('cvc-e').innerHTML = '';
        if (!(cvc_pattern.test(cvc))) {
            document.getElementById('cvc-e').innerHTML = 'Invalid CVC Number!';
            return;
        }
        document.getElementById('cvc-e').innerHTML = '';

        if (confirm("You will be charge Rs " + <?php echo $_POST['price'];?> +
                ".00 for your booking. Confirm and Pay.") == true) {
            let data = new FormData();
            data.append('slot', "<?php echo $_POST['slot']; ?>");
            data.append('floor', "<?php echo $_POST['floor']; ?>");
            data.append('plate_no', "<?php echo $_POST['v_no']; ?>");
            data.append('vehical_type', "<?php echo $_POST['v_type']; ?>");
            data.append('price', "<?php echo $_POST['price']; ?>");
            data.append('bday', "<?php echo $_POST['bday']; ?>");
            data.append('rday', "<?php echo $_POST['rday']; ?>");
            data.append('confirm_payment', 'true');

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    let x = JSON.parse(xhttp.responseText);
                    if (x.code === "c1") {
                        alert(
                            "Some unexpected error occured in the database. Try again!"
                        );
                    } else if (x.code === "c2") {
                        confirm("Slot booked successfully!");
                        window.location = "./index.php";
                    }
                }
            };
            xhttp.open("POST", "./functions/functions.php", true);
            xhttp.send(data);

        }


    }
    </script>
</body>

</html>