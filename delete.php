<?php include "./includes/connection.php";

if (isset($_GET["delete_id"])) {
    $delId = $_GET["delete_id"];

    $del_query = "DELETE FROM `curd_operation` WHERE ID=$delId";

    $result = mysqli_query($conn, $del_query);

    if ($result) {
        echo "<script> alert('deleted Successfully')</script>";
        echo "<script> window.open('display.php', '_self')</script>";
    } else {
        die("Unable to delete" . mysqli_error($conn));
    }
}
