<?php include "./includes/connection.php";

$error_message = [
    'username' => '',
    'phoneNo' => '',
    'email' => '',
    'place' => ''
];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = ucwords(strtolower(htmlspecialchars($_POST["username"])));
    $phone_no = preg_replace('/[^0-9]/', '', htmlspecialchars($_POST["phoneNo"]));
    $email = htmlspecialchars($_POST["email"]);
    $place = ucfirst(strtolower(htmlspecialchars($_POST["place"])));

    if (empty($username)) {
        $error_message['username'] = "Username is required";
    } elseif (strlen($username) < 3 || strlen($username) > 20) {
        $error_message['username'] = "Username must be between 3 to 20 characters";
    }

    if (empty($phone_no)) {
        $error_message['phoneNo'] = "Phone No is required";
    } elseif (strlen($phone_no) != 10 || !is_numeric($phone_no)) {
        $error_message['phoneNo'] = "Phone No must be 10 digits";
    }

    if (empty($email)) {
        $error_messgae['email'] = "Email is require";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) || !preg_match('/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $email)) {
        $error_message['email'] = "Invalid Email";
    }

    if (empty($place)) {
        $error_message['place'] = "Place is required";
    } elseif (strlen($place) < 3 || strlen($place) > 50 || !preg_match('/[a-zA-Z0-9]/', $place)) {
        $error_message['place'] = "Place must be between 3 to 50 characters";
    }

    if (empty(array_filter($error_message))) {
        $check_query = "Select * from curd_operation where USERNAME = '$username' or EMAIL = '$email'";
        $check_query = mysqli_query($conn, $check_query);

        if (!$check_query) {
            echo "<script>alert('Error in checking data')</script>";
        }

        if (mysqli_num_rows($check_query) > 0) {
            $duplicate_found = "Username or Email already Exist";
        } else {
            $insert_query = "INSERT INTO `curd_operation`(`USERNAME`, `PHONE NO`, `EMAIL`, `PLACE`) VALUES ('$username','$phone_no','$email','$place')";
            $result = mysqli_query($conn, $insert_query);
            if (!$result) {
                die("Data failed to upload" . mysqli_error($conn));
            } else {
                echo "<script>alert('Data Submitted successfuly')</script>";
                echo "<script>window.open('index.php', '_self')</script>";
            }
        }

        if ($duplicate_found) {
            $temp_duplicate_found = $duplicate_found;
            unset($duplicate_found);
        }
    }
}
?>
<?php include "./includes/header.php"; ?>
<main>
    <section>
        <div>
            <form action="" method="post">
                <span class="error-message <?php echo !empty($temp_duplicate_found) ? 'visible' : '' ?>"
                    id="duplicateFound">
                    <?php if (isset($temp_duplicate_found)) echo $temp_duplicate_found ?></span>
                <div>
                    <label for="username">Username<sup class="required"> *</sup>:</label>
                    <input type="text" name="username" id="username" required onfocus="clearError('username-error')" />
                    <span class="error_message" <?php echo !empty($error_message['username']) ? 'visible' : '' ?>
                        id="username-error"> <?php echo $error_message['username']; ?> </span>
                </div>
                <div>
                    <label for="phoneNo">Phone No<sup class="required"> *</sup>:</label>
                    <input type="text" name="phoneNo" id="phoneNo" required onfocus="clearError('phoneNo-error')" />
                    <span class="error_message <?php echo !empty($error_message['phoneNo']) ? 'visible' : '' ?>"
                        id="phoneNo-error"> <?php echo $error_message['phoneNo']; ?> </span>
                </div>
                <div>
                    <label for="email">Email<sup class="required"> *</sup>:</label>
                    <input type="email" name="email" id="email" onfocus="clearError('email-error')" required />
                    <span class="error_message <?php echo !empty($error_message['email']) ? 'visible' : '' ?>"
                        id=" email-error"> <?php echo $error_message['email']; ?> </span>
                </div>
                <div>
                    <label for="place">Place:</label><br />
                    <textarea name="place" id="place" cols="40" rows="10" onfocus="clearError('place-error')"
                        required></textarea>
                    <span class="error_message <?php echo !empty($error_message['place']) ? 'visible' : '' ?>"
                        id=" place-error"> <?php echo $error_message['place']; ?> </span>
                </div>

                <div id="buttons">
                    <input type="submit" value="Submit" name="Submit" onclick="simulate()" />
                    <a href='display.php' id='deatils-btn'>
                        <div>
                            <p>Details</p>
                        </div>
                    </a>
                </div>
            </form>
        </div>
    </section>
</main>

<script>
    function clearError(id) {
        const errorElement = document.getElementById(id);
        errorElement.textContent = "";
        const duplicatedFound = document.getElementById('duplicateFound');
        if (duplicatedFound) {
            duplicatedFound.textContent = "";
        }

        if (errorElement) {
            errorElement.classList.remove('visible');
        }
    }
</script>
<?php include "./includes/footer.php"; ?>
</body>

</html>