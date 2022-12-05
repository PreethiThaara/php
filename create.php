<?php 
include "config.php ";
include "response.php ";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<?php 
if(!isset($_GET['eid'])){ ?>
    
<form role="form" method="post">
   name <input type="text" name="name"/></br>

   country <select id ="country">
    <option value =""> select country</option>
    <?php
    $qry = "select * from country";
    $result = mysqli_query($conn,$qry);
    while($row=mysqli_fetch_array($result)) {?>

    <option value ="<?php echo $row['id'] ?>"> <?php echo $row['name'] ?></option>
    <?php } ?>
   </select></br>

   state <select id = "state">
   <option value =""> select state</option>
     </select></br>

   city <select id = "city">
   <option value =""> select city</option>
     </select></br>

   phone <input type="number" name="pincode"/></br>
    <button type="submit" name="submit">submit</button>
</form>
 <?php } ?>

<?php
if(isset($_POST['submit'])){
$name = $_POST['name'];
$country = $_POST['country'];
$state = $_POST['state'];
$pincode = $_POST['pincode'];

$qry =" INSERT INTO crudphp( name,country,state,pincode) VALUES ('$name','$country','$state','$pincode')";
$result = mysqli_query($conn,$qry);
if($result)
{
    echo "sucess";
}else{
    echo"error";
}}
error_reporting(E_ALL ^ E_WARNING); ?>



<table>
        <thead>
    <tr>
        <td>name</td>
        <td>country</td>
        <td>state</td>
        <td>city</td>
        <td>phone</td>
        <td>delete</td>
        <td>edit</td>
    </tr>
</thead>
<tbody>
<?php
include"config.php";
$qry="select * from crudphp";
$result =mysqli_query($conn,$qry);
while($row = mysqli_fetch_array($result)){ ?>
   <tr>
    <td><?php echo $row['name'] ?></td>
    <td> <?php echo $row['country']?></td>
    <td> <?php echo $row['state']?></td>
    <td> <?php echo $row['pincode']?></td>
 <td> <a href= "create.php?eid=<?php echo $row['id']?>">edit</a> </td>
 <td><a href="create.php?did=<?php echo $row['id']?>">delete</a></td>
    </tr>
    <?php }?>
    <?php
if(isset($_GET['did'])){
$id1=$_GET['did'];
    $qry1="delete from crudphp where id=$id1 ";
    $result1 =mysqli_query($conn,$qry1);
if($result1){
    echo"sucess";
}
else{
    echo"error";
}
}
 ?>

 <?php
 if(isset($_GET['eid'])){
    $ide=$_GET['eid'];
    $qry2=" select * from crudphp where id =$ide";
    $result2 = mysqli_query($conn, $qry2); 
    while($row1= mysqli_fetch_array($result2)){ 
     $country = $row1['country'];
     ?>

    <form method = post>
         <input type = "text" name="name" value ="<?php  echo $row1['name']  ?>" /></br>
         
         country <select id ="country">
    <option name="country" value ="<?php  echo $row1['country']  ?>"> <?php  echo $row1['country']  ?></option>
    <?php
    $qry = "select * from country where name != '$country'";
    $result = mysqli_query($conn,$qry);
    while($row=mysqli_fetch_array($result)) {?>
    <option value ="<?php echo $row['id'] ?>"> <?php echo $row['name'] ?></option>
    <?php } ?>

   </select></br>

   state <select id = "state">
   <option name="state" value ="<?php  echo $row1['state']  ?>"> <?php  echo $row1['state']  ?></option>
     </select></br>

   city <select id = "city">
   <option name="city" value ="<?php  echo $row1['city']  ?>"> <?php  echo $row1['city']  ?>/option>
     </select></br>
         
         <input type = "text" name="pincode" value ="<?php  echo $row1['pincode']  ?>" /></br>
         <button type= "submit" name = "update" >update</button>         </form>

    <?php }} ?>
    <?php
    if(isset($_POST['update'])){
$name = $_POST['name'];
$country = $_POST['country'];
$state = $_POST['state'];
$pincode = $_POST['pincode'];
$ide = $_GET['eid'];
$qry =" update crudphp set name ='$name' , country = '$country' , state= '$state' , pincode = '$pincode' where id=$ide";
$result = mysqli_query($conn,$qry);
if($result)
{
header("location:create.php");
}else{
    echo"error";
}}
?>
</tbody>
</table>

<script>
        $(document).ready(function() {
            $("#country").on('change', function() {
                var countryid = $(this).val();
                console.log(countryid);
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
