<?php include "./includes/connection.php";

if (isset($_GET["update_id"])) {
    $uid = $_GET["update_id"];

    $select_query = "SELECT * FROM `curd_operation` WHERE id=$uid";

    $result = mysqli_query($conn, $select_query);

    $rows = mysqli_fetch_assoc($result);

    $username = $rows["USERNAME"];
    $phoneNo = $rows["PHONE NO"];
    $email = $rows["EMAIL"];
    $place = $rows["PLACE"];


    //update 

    if (isset($_POST["Update"])) {
        $username = $_POST["username"];
        $phoneNo = $_POST["phoneNo"];
        $email = $_POST["email"];
        $place = $_POST["place"];

        $update_query = "UPDATE `curd_operation` SET `USERNAME`='$username',`PHONE NO`='$phoneNo',`EMAIL`='$email',`PLACE`='$place' WHERE id=$uid";

        $result = mysqli_query($conn, $update_query);

        if ($result) {
            echo "<script>alert('Updated Successfully')</script>";
            echo "<script>window.open('display.php','_self')</script>";
        } else {
            echo die("Failed to update" . mysqli_error($conn));
        }
    }
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <title>Update form</title>
</head>

<body>
    <main>
        <section>
            <div>
                <form action="" method="post">
                    <div>
                        <label for="username">Username<sup class="required"> *</sup>:</label>
                        <input type="text" name="username" id="username" autocomplete="off"
                            value=" <?php echo $username ?>" required />
                    </div>
                    <div>
                        <label for="phoneNo">Phone No<sup class="required"> *</sup>:</label>
                        <input type="text" name="phoneNo" id="phoneNo" autocomplete="off"
                            value=" <?php echo $phoneNo ?>" required />
                    </div>
                    <div>
                        <label for="email">Email<sup class="required"> *</sup>:</label>
                        <input type="email" name="email" id="email" autocomplete="off" value=" <?php echo $email ?>"
                            required />
                    </div>
                    <div>
                        <label for="place">Place:</label><br />
                        <textarea name="place" id="place" cols="30" rows="10" required><?php echo $place ?></textarea>
                    </div>

                    <div id="buttons">
                        <input type="submit" value="Update" name="Update" />
                        <a href="display.php" class="cancel-btn">Cancel</a>
                    </div>
                </form>
            </div>
        </section>
    </main>
</body>

</html>