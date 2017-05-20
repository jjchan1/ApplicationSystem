<?php
    $scriptName = $_SERVER["PHP_SELF"];
    $host = "localhost";
    $user = "dbuser";
    $dbpassword = "goodbyeWorld";
    $database = "applicationdb";
    $table = "applicants";
    $db = connectToDB($host, $user, $dbpassword, $database);

    $name = $_POST["name"];
    $email = $_POST["email"];
    $gpa = $_POST["gpa"];
    $year = $_POST["year"];
    $gender = $_POST["gender"];
    //$password = crypt($_POST["password"],$_POST["password"]);
    $password = crypt($_POST["password"],"salty");
    //$verifyPassword = crypt($_POST["verifyPassword"],$_POST["verifyPassword"]);
    $verifyPassword = crypt($_POST["verifyPassword"],"salty");


if ($password === $verifyPassword) {
        $sqlQuery = sprintf("update $table set name='%s', gpa=%s, year=%s, gender='%s', password='%s' where email='%s'",
            $name, $gpa, $year, $gender, $password, $email);
        $result = mysqli_query($db, $sqlQuery);

        if ($result) {
            echo "<h2>The entry has been updated in the database and the new values are:</h2>";
            echo "<form action='main.php' method='post'>";
                echo "<strong>Name: </strong>".$name."<br />";
                echo "<strong>Email: </strong>".$email."<br />";
                echo "<strong>Gpa: </strong>".$gpa."<br />";
                echo "<strong>Year: </strong>".$year."<br />";
                echo "<strong>Gender: </strong>".$gender."<br /><br />";
                echo "<input type='submit' name='returnButton' id='returnButton' value='Return to main menu'>";
            echo "</form>";
        } else {
            echo "Inserting records failed.".mysqli_error($db);
        }

        /* Closing */
        mysqli_close($db);
    } else {
        echo "<h2>Passwords do not match</h2>";
        echo "<form action='main.php' method='post'>";
            echo "<input type='submit' name='returnButton' id='returnButton' value='Return to main menu'>";
        echo "</form>";
    }


    function connectToDB($host, $user, $password, $database) {
        $db = mysqli_connect($host, $user, $password, $database);
        if (mysqli_connect_errno()) {
            echo "Connect failed.\n".mysqli_connect_error();
            exit();
        }
        return $db;
    }

?>
