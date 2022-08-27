<?php

function validate($request)
{
    $test_date = '18/08/2022';
    $test_arr = explode('/', $test_date);

    $errors = [];

    foreach ($request as $key => $value) {
        switch ($key) {
            case 'firstname':
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
                    $errors[$key] = 'Can Chon 1 trong 4 hoc van';

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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = validate($_POST);
}

?>


<form action="" method="post">
    <p>Họ tên: <input type="text" name="firstname"
                      value="<?php if (isset($_POST['firstname'])) echo $_POST['firstname']; ?>"> <?php if (isset($errors['firstname'])) echo $errors['firstname']; ?>
    </p>
    <p>Ngày sinh : <input type="date" name="birth"
                          value="<?php if (isset($_POST['birth'])) echo $_POST['birth']; ?>"> <?php if (isset($errors['birth'])) echo $errors['birth']; ?>
    </p>
    <p>Số cmnd: <input type="text" name="number"
                       value="<?php if (isset($_POST['number'])) echo $_POST['number']; ?>"> <?php if (isset($errors['number'])) echo $errors['number']; ?>
    </p>
    <p>
        <select name="dropdown">
            <option value="select" selected="selected"></option>
            <option value="c3">Trung học</option>
            <option value="caodang">Cao Đẳng</option>
            <option value="daihoc">Đại học</option>
            <option value="thacsi">Thạc Sĩ</option>
        </select>
        <?php if (isset($errors['dropdown'])) echo $errors['dropdown']; ?>
    </p>
    <button type="submit">Gửi</button>
</form>