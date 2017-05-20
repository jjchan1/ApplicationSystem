<?php
    require_once("support.php");

    $body = "";

    if (isset($_POST["returnButton"])) {
        header("Location:main.php");
        exit();
    }

    // superglobals are not accessible in heredoc
    $scriptName = "confirmationsubmit.php";
    $body = <<<EOBODY
        <form action="$scriptName" method="post">
            <strong>Name: </strong><input type="text" name="name"/><br /> <br />
            <strong>Email: </strong><input type="email" name="email"/><br /> <br />
            <strong>GPA: </strong><input type="text" name="gpa"/><br /> <br />
            <strong>Year: </strong><input type="radio" name="year" value=10 />10 &nbsp; <input type="radio" name="year" value=11 />11 &nbsp; <input type="radio" name="year" value=12 />12<br /><br />
            <strong>Gender: </strong><input type="radio" name="gender" value="M"/>M &nbsp; <input type="radio" name="gender" value="F"/>F<br /><br />
            <strong>Password: </strong><input type="password" name="password"/><br /><br />
            <strong>Verify Password: </strong><input type="password" name="verifyPassword"/><br /><br />
            <input type="submit" name="submitButton" id="submitButton" value="Submit Data"/><br /><br />
            <input type="submit" name="returnButton" id="returnButton" value="Return to main menu">
        </form>		
EOBODY;

    echo generatePage($body);

?>
