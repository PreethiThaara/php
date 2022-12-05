<?php
include_once("config.php");
include_once("response.php");
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- jquery cdn -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <title>Dropdown</title>
</head>

<body>
    <div class="container col-md-4">
        <div class="form-group py-2">

            <label for="country"> Country</label>
            <select class="form-select" id="country">
                <option value=""> Select Country</option>
                <?php

                $query = "select * from country";
                // $query = mysqli_query($con, $qr);
                $result = $con->query($query);
                if ($result->num_rows > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {

                ?>
                        <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                <?php
                    }
                }

                ?>

            </select>
        </div>
        <div class="form-group py-2">
            <label for="country"> State</label>
            <select class="form-select" id="state">
                <option value="">select State</option>

            </select>
        </div>
        <div class="form-group py-2 ">
            <label for="country"> City</label>
            <select class="form-select" id="city">
                <option value="">select City</option>
            </select>
        </div>
    </div>


    <div class="container">
        <div class="row">
            <div class="col-md-12 pt-4">
                <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-1190033123418031" crossorigin="anonymous"></script>
                <!-- live_demo_page -->
                <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-1190033123418031" data-ad-slot="5335471635" data-ad-format="auto" data-full-width-responsive="true"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            $("#country").on('change', function() {
                var countryid = $(this).val();

                $.ajax({
                    method: "POST",
                    url: "response.php",
                    data: {
                        id: countryid
                    },
                    datatype: "html",
                    success: function(data) {
                        $("#state").html(data);
                        $("#city").html('<option value="">Select city</option');

                    }
                });
            });
            $("#state").on('change', function() {
                var stateid = $(this).val();
                $.ajax({
                    method: "POST",
                    url: "response.php",
                    data: {
                        sid: stateid
                    },
                    datatype: "html",
                    success: function(data) {
                        $("#city").html(data);

                    }

                });
            });
        });
    </script>

</body>

</html>