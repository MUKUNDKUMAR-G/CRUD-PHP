<?php include "./includes/connection.php";
include "./includes/header.php"; ?>


<main>
    <h1 style='color : green; font-weight:bolder; text-align:center;'>Displaying the Data from DataBase</h1></br>
    <section style="height:10vh">
        <?php
        $select_query = "SELECT * FROM `curd_operation`";
        $result = mysqli_query($conn, $select_query);
        if (mysqli_num_rows($result) === 0) {
            echo "<h3 class='no_records'>No records Found</h3>";
        } else {
            echo "
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>USERNAME</th>
                            <th>PHONE NO</th>
                            <th>EMAIL</th>
                            <th>PLACE</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>

                    <tbody>";
            $i = 1;
            while ($rows = mysqli_fetch_assoc($result)) {
                $id = $rows["ID"];
                $username = $rows["USERNAME"];
                $phoneNo = $rows["PHONE NO"];
                $email = $rows["EMAIL"];
                $place = $rows["PLACE"];
                echo "  <tr>
                            <td>$i</td>
                            <td>$username</td>
                            <td>$phoneNo</td>
                            <td>$email</td>
                            <td>$place</td>
                            <td>
                            <div class='action_container'>
                                <a href='update.php?update_id=$id'>Update</a>
                                |
                                <a href='delete.php?delete_id=$id'>Delete</a>
                            </div>
                        </tr>";
                $i++;
            }
            echo "        
                </tbody>
                </table>";
        }
        ?>
    </section>
</main>
</body>

</html>