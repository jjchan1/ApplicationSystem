<?php

    class student {
        private $name = "Jonathan Chan";
        private $email = "jjchan1@gmail.com";
        private $class = "CMSC389P";

        public function __construct($name, $email, $class) {
            $this->name = $name;
            $this->email = $email;
            $this->class = $class;
        }

        public function __toString() {
            return "<b>Name:</b> ".$this->name.", <b>Email:</b> ".$this->email.", <b>Class:</b> ".$this->class;
        }

        public function getName() {
            return $this->name;
        }

        public function getEmail() {
            return $this->email;
        }

        public function getClass() {
            return $this->class;
        }

        public function printMessage() {
            echo "If you have any questions about our program, please contact the system administrator at <a href='mailto:jjchan1@gmail.com'> jjchan1@gmail.com </a>";
        }

        public function __destruct() {
            echo "";
        }
    }


if (isset($_POST["submitApplicationButton"])) {
        header("Location:submitapplication.php");
        exit();
    } elseif (isset($_POST["reviewApplicationButton"])) {
        header("Location:reviewapplication.php");
        exit();
    } elseif (isset($_POST["updateApplicationButton"])) {
        header("Location:updateapplication.php");
        exit();
    } elseif (isset($_POST["administrativeButton"])) {
        header("Location:administrative.php");
        exit();
    } else {
        $scriptName = $_SERVER["PHP_SELF"];
        $student = new student("Jonathan Chan", "jjchan1@gmail.com", "CMSC389P");

        echo "<img src='umdLogo.gif' alt='UMD Logo'/>";
        echo "<hr>";
        echo "<img src='testudo.jpg' alt='Testudo' align='left'/>";
        echo "<h1>Welcome to the UMCP <br />Application System</h1>";
        echo "<br /> <br />";
        echo "<form action='$scriptName' method='post'>";
            echo "<input type='submit' name='submitApplicationButton' id='submitApplicationButton' value='Submit Application' />";
            echo "<input type='submit' name='reviewApplicationButton' id='reviewApplicationButton' value='Review Application' />";
            echo "<input type='submit' name='updateApplicationButton' id='updateApplicationButton' value='Update Application' />";
            echo "<input type='submit' name='administrativeButton' id='administrativeButton' value='Administrative' /> <br /> <br />";
        echo "</form>";

        echo "<hr>";
        $student->printMessage();
    }
?>

