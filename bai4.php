<!DOCTYPE html>
<head>
    <title>Bootstrap Form</title>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href=
    "https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <script src=
            "https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
    </script>
    <script src=
            "https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js">
    </script>
    <script src=
            "https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js">
    </script>
</head>
<body>
<h1 class="text-success text-center">
    Validate Form
</h1>
<h2 class="text-center"> Nhập thông tin </h2>
<div class="container">


    <?php

    function validate($request)
    {
        $test_date = '18/08/2022';
        $test_arr = explode('/', $test_date);

        $errors = [];

        foreach ($request as $key => $value) {
            switch ($key) {
                case 'name':
                    if (empty($value)) {

                        $errors[$key] = 'Không được để trống';
                    } else {

                    }
                    break;
                case 'birth':
//                var_dump($value);
//                echo $value;
                    $s = substr($value, 0, 4);
                    if ($s < 1970) {

                        $errors[$key] = 'Không đúng năm sinh';
                    } else if (empty($value)) {

                        $errors[$key] = 'Không đúng định dạng yêu cầu';
                    } else if (count($test_arr) != 3) {

                        $errors[$key] = 'Không đúng định dạng yêu cầu';
                    } else {

                    }
                    break;
                case 'number':
                    if (empty($value)) {

                        $errors[$key] = 'Phải đủ 12 số';
                    } else if (strlen($value) != 12) {

                        $errors[$key] = 'Phải đủ 12 số';
                    } else {

                    }
                    break;
                case 'dropdown':

                    $arr = ["c3", "caodang", "daihoc", "thacsi"];
                    if (!in_array($value, $arr)) {
                        $errors[$key] = 'Cần chọn 1 trong 4 học vấn';
                    } else {

                    }

//                    echo "1";
                    break;
                default:
                    break;
            }

        }
        return $errors;
    }

    $errors = [];

    // Check dieu kien validate va luu vao DB
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Kiem tra xem co loi hay khong
        $errors = validate($_POST);
        // Neu khong co loi thi tien hanh luu vao DB
        if (!$errors) {
            // connect DB
            $user_name = "root";
            $pass = "";
            $host = "localhost";
            $dbname = "bai4";
            $conn = new mysqli($host, $user_name, $pass, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            echo "Connected successfully";

            $fullName = $_POST['name'];
            $birth = $_POST['birth'];
            $identity = $_POST['number'];
            $certificate = $_POST['dropdown'];

            $sql = "INSERT INTO user_info (fullName, birth, identity, certificate)
                         VALUES ('{$fullName}','{$birth}','{$identity}','{$certificate}' )";

            if (isset($_POST['submit'])) {

                $image = $_FILES['image']['name'];
                var_dump($_FILES);
                $target = "photo/" . basename($image);
                $sql = "INSERT INTO user_info (fullName, birth, identity, certificate, images)
                         VALUES ('{$fullName}','{$birth}','{$identity}','{$certificate}','{$target}' )";
                mysqli_query($conn, $sql);
                if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                } else {
                    echo '<script> alert("Đã upload thất bại!");</script>';

                }

            }

            if ($conn->query($sql) === TRUE) {
                echo "Thanh Cong";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $conn->close();


        }

    }
    ?>

    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label class="control-label" for="name"><span class="text-danger">*</span> Họ Tên:</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Nhập họ tên"
                   value="<?php if (isset($_POST['name'])) echo $_POST['name']; ?>">

            <p class="text-danger"> <?php if (isset($errors['name'])) echo $errors['name']; ?> </p>
        </div>

        <div class="form-group">
            <label class="control-label" for="birth"><span class="text-danger">*</span> Ngày
                sinh:</label>

            <input type="date" name="birth" class="form-control" id="birth"
                   value="<?php if (isset($_POST['birth'])) echo $_POST['birth']; ?>">

            <p class="text-danger"> <?php if (isset($errors['birth'])) echo $errors['birth']; ?> </p>
        </div>

        <div class="form-group">
            <label class="control-label " for="number"><span class="text-danger">*</span> Số CMND:</label>

            <input type="text" name="number" class="form-control" id="number"
                   value="<?php if (isset($_POST['number'])) echo $_POST['number']; ?>">

            <p class="text-danger"> <?php if (isset($errors['number'])) echo $errors['number']; ?> </p>
        </div>

        <div class="form-group">
            <label class="control-label " for="dropdown"><span class="text-danger">*</span> Học vấn:</label>
            <select name="dropdown" class="form-control">
                <option value="select" selected="selected"></option>
                <option value="c3">Trung học</option>
                <option value="caodang">Cao Đẳng</option>
                <option value="daihoc">Đại học</option>
                <option value="thacsi">Thạc Sĩ</option>
            </select>
        </div>
        <p class="text-danger"> <?php if (isset($errors['dropdown'])) echo $errors['dropdown']; ?> </p>

        <div class="form-group">
            <label class="control-label " for="image"><span class="text-danger">*</span> Hình ảnh:</label>
            <input type="file" name="image" id="upload">
        </div>
        <button type="submit" name="submit"
                class="btn bg-success">
            Gửi
        </button>
</div>
</form>
</div>

</body>
</html>