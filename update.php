<?php
    require_once("support.php");

    if (isset($_POST["returnButton"])) {
        header("Location:main.php");
        exit();
    }

    $scriptName = $_SERVER["PHP_SELF"];
    $host = "localhost";
    $user = "dbuser";
    $dbpassword = "goodbyeWorld";
    $database = "applicationdb";
    $table = "applicants";
    $db = connectToDB($host, $user, $dbpassword, $database);
    $email = $_POST["email"];

    $sqlQuery = sprintf("select * from %s where email='%s'", $table, $email);
    $result = mysqli_query($db, $sqlQuery);

    if ($result) {
        $numberOfRows = mysqli_num_rows($result);
        if ($numberOfRows == 0) {
            print "<h2>No entries exists in the table</h2>";
        } else {
            while ($recordArray = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $name = $recordArray['name'];
                $gpa = $recordArray['gpa'];
                $year = $recordArray['year'];
                $gender = $recordArray['gender'];
                $password = $_POST["password"];
                $accountPassword = $recordArray['password'];

                $checked10 = $year == 10 ? 'checked="checked"' : '';
                $checked11 = $year == 11 ? 'checked="checked"' : '';
                $checked12 = $year == 12 ? 'checked="checked"' : '';

                $checkedM = $gender == "M" ? 'checked="checked"' : '';
                $checkedF = $gender == "F" ? 'checked="checked"' : '';


                if (crypt($password, $accountPassword) !== $accountPassword) {
                    print "<h2>No entry exists in the database for the specified email and password</h2>";
                    echo "<form action='main.php' method='post'>";
                        echo "<input type='submit' name='returnButton' id='returnButton' value='Return to main menu'>";
                    echo "</form>";
                } else {
                    echo "<form action='confirmationupdate.php' method='post'>";
                        echo "<strong>Name: </strong><input type='text' name='name' value='$name'/><br /> <br />";
                        echo "<strong>Email: </strong><input type='email' name='email' value='$email'/><br /> <br />";
                        echo "<strong>GPA: </strong><input type='text' name='gpa' value='$gpa'/><br /> <br />";
                        echo "<strong>Year: </strong><input type='radio' name='year' value=10 $checked10 />10 &nbsp; <input type='radio' name='year' value=11 $checked11 />11 &nbsp; <input type='radio' name='year' value=12 $checked12 />12<br /><br />";
                        echo "<strong>Gender: </strong><input type='radio' name='gender' value='M' $checkedM />M &nbsp; <input type='radio' name='gender' value='F' $checkedF />F<br /><br />";
                        echo "<strong>Password: </strong><input type='password' name='password' value=$password /><br /><br />";
                        echo "<strong>Verify Password: </strong><input type='password' name='verifyPassword' value=$password /><br /><br />";
                        echo "<input type='submit' name='submitButton1' id='submitButton1' value='Submit Data'/><br /><br />";
                        echo "<input type='submit' name='returnButton' id='returnButton' value='Return to main menu'>";
                    echo "</form>";
                }
            }
        }
        mysqli_free_result($result);
    }  else {
        print "Retrieving records failed.".mysqli_error($db);
    }
    /* Closing */
    mysqli_close($db);


    function connectToDB($host, $user, $password, $database) {
        $db = mysqli_connect($host, $user, $password, $database);
        if (mysqli_connect_errno()) {
            echo "Connect failed.\n".mysqli_connect_error();
            exit();
        }
        return $db;
    }

?>
