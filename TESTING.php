<?php

$firstname = $lastname = $birth = $number = "";
$error_firstname = $error_lastname = $error_birth = $error_number = "";
$test_date = '08/18/1970';
$test_arr = explode('/', $test_date);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["firstname"])) {
        echo $error_firstname = "Bắt buộc nhập";
    } else {
        $firstname = $_POST["firstname"];
        if (!preg_match("/^[a-zA-Z ]*$/", $firstname)) {
            $error_firstname = "Sai định dạng";
        } else {
            echo $firstname;
        }
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["lastname"])) {
        $error_lastname = "Bắt buộc nhập";
    } else {
        $firstname = $_POST["lastname"];
        if (!preg_match("/^[a-zA-Z ]*$/", $lastname)) {
            $error_lastname = "Sai định dạng";
        } else {
            echo $lastname;
        }

    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["birth"])) {
        $error_birth = "Bắt buộc nhập";
    } else {
        $birth = $_POST["birth"];
        if (count($test_arr) == 3) {
            if (checkdate($test_arr[0], $test_arr[1], 1970 < $test_arr[2])) {
                echo $birth;
            } else {
                $error_birth = "Sai định dạng";
            }
        }
    }

}
?>