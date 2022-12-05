<?php
include_once("config.php");

if (!empty($_POST["id"])) {
    $id = $_POST['id'];
    $query = "select * from state where country_id=$id";
    $result = mysqli_query($conn, $query);
    if ($result) { ?>
        <option value="">Select State</option>
       <?php while ($row = mysqli_fetch_array($result)) { ?>
            <option value="<?php $row['state'] ?>"> <?php $row['state'] ?> </option>
       <?php }
    }
} elseif (!empty($_POST['sid'])) {
    $id = $_POST['sid'];
    $query1 = "select * from city where state_id=$id";
    $result1 = mysqli_query($conn, $query1);
    if ($result1) { ?>
    <option value="">Select city</option>
       <?php while ($row1 = mysqli_fetch_array($result1)) { ?>
            <option value="<?php $row1['city'] ?>"> <?php $row1['city']?> </option>
       <?php }
    }
}
?>