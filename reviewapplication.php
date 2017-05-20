<?php
    require_once("support.php");

    $body = "";

    if (isset($_POST["returnButton"])) {
        header("Location:main.php");
        exit();
    }

    // superglobals are not accessible in heredoc
    $scriptName = "confirmationreview.php";
    $body = <<<EOBODY
        <form action="$scriptName" method="post">
            <strong>Email associated with application: </strong><input type="text" name="email"/><br /> <br />
            <strong>Password associated with application: </strong><input type="password" name="password"/><br /><br />
            <input type="submit" name="submitButton" id="submitButton" value="Submit Data"/><br /><br />
            <input type="submit" name="returnButton" id="returnButton" value="Return to main menu">
        </form>		
EOBODY;

    echo generatePage($body);

?>
