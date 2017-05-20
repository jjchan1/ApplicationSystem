<?php

    if (isset($_POST["returnButton"])) {
        header("Location:main.php");
        exit();
    }

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

                if (crypt($password, $accountPassword) === $accountPassword) {
                    print "<h2>Application found in the database with the following values: </h2>";
                    print "<strong>Name: </strong>".$name."<br />";
                    print "<strong>Email: </strong>".$email."<br />";
                    print "<strong>Gpa: </strong>".$gpa."<br />";
                    print "<strong>Year: </strong>".$year."<br />";
                    print "<strong>Gender: </strong>".$gender."<br /><br />";
                } else {
                    print "<h2>No entry exists in the database for the specified email and password</h2>";
                }
            }
        }
        mysqli_free_result($result);
    }  else {
        print "Retrieving records failed.".mysqli_error($db);
    }
    /* Closing */
    mysqli_close($db);

    echo "<form action='main.php' method='post'>";
        echo "<input type=submit name='returnButton' id='returnButton' value='Return to main menu'>";
    echo "</form>";

    function connectToDB($host, $user, $password, $database) {
        $db = mysqli_connect($host, $user, $password, $database);
        if (mysqli_connect_errno()) {
            echo "Connect failed.\n".mysqli_connect_error();
            exit();
        }
        return $db;
    }
?>