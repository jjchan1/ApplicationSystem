<?php

    $scriptName = $_SERVER["PHP_SELF"];
    $host = "localhost";
    $user = "dbuser";
    $dbpassword = "goodbyeWorld";
    $database = "applicationdb";
    $table = "applicants";
    $db = connectToDB($host, $user, $dbpassword, $database);

    $results = [];

    $fields = $_POST["fields"];
    $fieldsquery = implode(",",$_POST["fields"]);
    $condition = $_POST["condition"];
    $sort = $_POST["sort"];

    if ($condition === "") {
        $sqlQuery = sprintf("select %s from %s order by %s", $fieldsquery, $table, $sort);
    } else {
        $sqlQuery = sprintf("select %s from %s where %s order by %s", $fieldsquery, $table, $condition, $sort);
    }

    $result = mysqli_query($db, $sqlQuery);

    echo "<h1>Applications</h1>";
    if ($result) {
        $numberOfRows = mysqli_num_rows($result);
        if ($numberOfRows == 0) {
            $body = "<h2>No entries exists in the table</h2>";
        } else {
            while ($recordArray = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                array_push($results, $recordArray);
            }

            displayTable($fields, $results);
        }
        mysqli_free_result($result);
    }  else {
        echo "Retrieving records failed".mysqli_error($db);
    }

    /* Closing */
    mysqli_close($db);

    echo "<form action='main.php' method='post'>";
        echo "<input type='submit' name='returnButton' id='returnButton' value='Return to main menu'>";
    echo "</form>";

    function displayTable($fields, $results) {
        echo "<table border=1>";
            echo "<thead>";
                echo "<tr>";
                for ($i = 0; $i < sizeof($fields); $i++) {
                    echo "<td><strong>$fields[$i]</strong></td>";
                }
                echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
                for ($i = 0; $i < sizeof($results); $i++) {
                    echo "<tr>";
                    foreach ($results[$i] as $value) {
                        echo "<td>$value</td>";
                    }
                    echo "</tr>";
                }
            echo "</tbody>";
        echo "</table> <br />";
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