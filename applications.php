<?php

    $scriptName = $_SERVER["PHP_SELF"];

    if (isset($_POST["returnButton"])) {
        header("Location:main.php");
        exit();
    }

    echo "<h1>Applications</h1>";
    echo "<form action='confirmationapplications.php' method='post'>";
        echo "<strong>Select fields to display</strong><br />";
        echo "<select name='fields[]' multiple='multiple' size='5'>";
            echo "<option value='Name'> name</option>";
            echo "<option value='Email'> email</option>";
            echo "<option value='Gpa'> gpa</option>";
            echo "<option value='Year'> year</option>";
            echo "<option value='Gender'> gender</option>";
        echo "</select>";
        echo "<br /><br />";
        echo "<strong>Select field to sort applications</strong>";
            echo "<select name='sort'>";
            echo "<option value='name'> name</option>";
            echo "<option value='email'> email</option>";
            echo "<option value='gpa'> gpa</option>";
            echo "<option value='year'> year</option>";
            echo "<option value='gender'> gender</option>";
        echo "</select>";
        echo "<br /><br />";
        echo "<strong>Filter Condition</strong>";
        echo "<input type='text' name='condition' id='condition'>";
        echo "<br /><br />";
        echo "<input type='submit' name='displayButton' id='displayButton' value='Display Applications'><br /><br />";
        echo "<input type='submit' name='returnButton' id='returnButton' value='Return to main menu'>";
    echo "</form>";
?>