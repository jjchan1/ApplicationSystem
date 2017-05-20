<?php
    if ($_POST["password"] == $_POST["verifyPassword"]) {
        $host = "localhost";
        $user = "dbuser";
        $dbpassword = "goodbyeWorld";
        $database = "applicationdb";
        $table = "applicants";
        $db = connectToDB($host, $user, $dbpassword, $database);

        $name = trim($_POST["name"]);
        $email = trim($_POST["email"]);
        $gpa = trim($_POST["gpa"]);
        $year = $_POST["year"];
        $gender = $_POST["gender"];
        //$password = crypt(trim($_POST["password"]),trim($_POST["password"]));
        $password = crypt(trim($_POST["password"]),"salty");
        $sqlQuery = sprintf("insert into $table (name, email, gpa, year, gender, password) values
        ('%s', '%s', %s, %s, '%s', '%s')", $name, $email, $gpa, $year, $gender, $password);
        $result = mysqli_query($db, $sqlQuery);

        if ($result) {
            print "<h2>The following entry has been added to the database</h2>";
            print "<strong>Name: </strong>".$name."<br />";
            print "<strong>Email: </strong>".$email."<br />";
            print "<strong>Gpa: </strong>".$gpa."<br />";
            print "<strong>Year: </strong>".$year."<br />";
            print "<strong>Gender: </strong>".$gender."<br /><br />";
        } else {
            print "Inserting records failed.".mysqli_error($db);
        }

        /* Closing */
        mysqli_close($db);
    } else {
        print "<h2>Passwords not matched.  No submission.</h2>";
    }

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