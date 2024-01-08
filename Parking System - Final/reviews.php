<!DOCTYPE html>
<html lang="en">

<head>
    <title>Reviews</title>
    <?php include_once('./components/header.php');?>
</head>

<body id="review">
    <!-- include navigation -->
    <?php $page='reviews';?>
    <?php include_once('./components/navigation.php');?>

    <!-- pre validations -->
    <?php
    $sql = "SELECT count(*) AS count FROM site_visits WHERE date=CURDATE()";
    $result = $__conn->query($sql);
    $row = $result->fetch_assoc();
    if ($row['count'] > 0) {
        $sql = "UPDATE site_visits SET count=((SELECT count FROM site_visits WHERE date=CURDATE()) + 1) WHERE date=CURDATE()";
        $__conn->query($sql);
    } else {
        $sql = "INSERT INTO site_visits VALUES(NULL,CURDATE(),1)";
        $__conn->query($sql);
    }
    ?>

    <!-- section 1 -->
    <section id="section-1">
        <img src="./img/logow.png" class="logo">
        <div class="title"><span class="pri-text">A</span>uto<span class="pri-text">B</span>ooking.com
        </div>
        <div class="partial-wrap">
            <?php
            $sql = "SELECT a.title, a.description, a.rate, a.date, b.first_name, b.last_name FROM reviews a INNER JOIN users b ON a.user_id=b.id LIMIT 10";
            $result = $__conn->query($sql);
            while($row = $result->fetch_assoc()) {
            ?>
            <div class="partial">
                <div class="name"><?php echo $row['first_name'] . " " . $row['last_name'] . " - " . $row['date'];?>
                </div>
                <div class="title">
                    <?php echo $row['title'];?>
                </div>
                <div class="star-wrap">
                    <?php
                if($row['rate'] == 5){
                    echo '<i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                    class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>';
                } else if($row['rate'] == 4){
                    echo '<i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                    class="bi bi-star-fill"></i><i class="bi bi-star"></i>';
                } else if($row['rate'] == 3){
                    echo '<i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star"></i><i class="bi bi-star"></i>';
                } else if($row['rate'] == 2){
                    echo '<i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star"></i><i class="bi bi-star"></i><i class="bi bi-star"></i>';
                } else if($row['rate'] == 1){
                    echo '<i class="bi bi-star-fill"></i><i class="bi bi-star"></i><i class="bi bi-star"></i><i class="bi bi-star"></i><i class="bi bi-star"></i>';
                }
                ?>
                </div>
                <div class="text">
                    <?php echo $row['description'];?>
                </div>

            </div>
            <?php } ?>
            <?php if(array_key_exists('ses_user_id',$_SESSION)){?>
            <div class="partial new">
                <a href="./new_review.php" class="ud">
                    <div class="add">+</div>
                </a>
            </div>
            <?php } ?>

        </div>

    </section>

    <!-- footer -->
    <?php include_once('./components/footer.php');?>
</body>

</html>