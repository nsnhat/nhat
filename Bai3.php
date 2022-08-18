<?php

function validate($request){
    $min = 1970;
    $test_date = '18/08/2022';
    $test_arr = explode('/', $test_date);

    $errors = [];

    foreach ($request as $key => $value) {
        $error = false;
        switch ($key) {
            case 'firstname':
                if (empty($value)) {
                    $error = true;

                }
                if ($error) {
                    $errors[$key] = 'Không được để trống';
                }
                break;
            case 'birth':

                if (empty($value)) {
                    $error = true;

                }
                    if (count($test_arr) != 3) {
                        $error = true;
                    }

                    if (checkdate($test_arr[0], $test_arr[1], $test_arr[2])){
                        if($test_arr[2] < $min){
                            $error = true;
                        }
                        $error = true;
                        }

                if ($error){
                    $errors[$key] = 'Không đúng định dạng yêu cầu';
                }
                break;
            case 'number':
                if (empty($value)) {
                    $error = true;
                }
                if (strlen($value) != 12){
                    $error = true;
                }
                if ($error){
                    $errors[$key] = 'Phải đủ 12 số';
                }
            case 'dropdown':
                if (empty($value)){
                    $error = true;
                }
                if ($error){
                    $errors[$key] = 'Vui lòng chọn học vấn của bạn';
                }
            default:
                break;
        }

    }
    return $errors;
}

$errors = [];

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $errors = validate($_POST);
}

?>



<form action="" method="post">
    <p>Họ tên: <input type="text" name="firstname" value="<?php if(isset($_POST['firstname'])) echo $_POST['firstname'];  ?>"> <?php if(isset($errors['firstname'])) echo $errors['firstname']; ?></p>
    <p>Ngày sinh : <input type="birth" name="birth" value="<?php if(isset($_POST['birth'])) echo $_POST['birth'];  ?>"> <?php if(isset($errors['birth'])) echo $errors['birth']; ?> </p>
    <p>Số cmnd: <input type="text" name="number" value="<?php if(isset($_POST['number'])) echo $_POST['number'];  ?>"> <?php if(isset($errors['number'])) echo $errors['number']; ?> </p>

    <select>
        <option value="select" selected="selected">    </option>
        <option value="c3">Trung học</option>
        <option value="caodang">Cao Đẳng</option>
        <option value="daihoc">Đại học</option>
        <option value="thacsi">Thạc Sĩ</option>
    </select>
    <button type="submit">Gửi</button>
</form>


