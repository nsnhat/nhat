<html lang="en">
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
    Search Form
</h1>
<h2 class="text-center"> Nhập thông tin </h2>
<div class="container">
    <div class="col-1" style="background-color: red">
        <div class="wrapper">
            <!-- Sidebar -->
            <nav id="sidebar">
                <div class="sidebar-header">
                    <h3>Menu</h3>
                </div>

                <ul class="list-unstyled components">
                    <p> </p>
                    <li class="active">
                        <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false"
                           class="dropdown-toggle">Home</a>
                        <ul class="collapse list-unstyled" id="homeSubmenu">
                            <li>
                                <a href="#">Bai 4</a>
                            </li>
                            <li>
                                <a href="#">Bai 5</a>
                            </li>
                        </ul>
                    </li>
            </nav>
        </div>
    </div>
    <div class="col-11" style="background-color: aquamarine">
        <form method="POST">
            <div class="form-group">
                Search: <input title="searchfield" required type="text" name="term"/>
                <input type="submit" name="submit" value="Submit"/>
            </div>
        </form>


        <table class="table">
            <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Birth</th>
                <th scope="col">Identity</th>
                <th scope="col">Certificate</th>
                <th scope="col">Image</th>
            </tr>

            </thead>

            <tbody>
            <?php
            if (isset($_POST["submit"]) && !empty($_POST["submit"])) {
                $user_name = "root";
                $pass = "";
                $host = "localhost";
                $dbname = "bai4";
                $conn = new mysqli($host, $user_name, $pass, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                echo "Connected successfully";
                $term = mysqli_real_escape_string($conn, $_REQUEST["term"]); //chắc chắn rằng $conn isset
                $sql = "SELECT * FROM user_info WHERE fullName LIKE '%" . $term . "%'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php echo $row['fullName']; ?></td>
                            <td><?php echo $row['birth']; ?></td>
                            <td><?php echo $row['identity']; ?></td>
                            <td><?php
                                switch ($row['certificate']) {
                                    case 'c3':
                                        echo 'Trung học';
                                        break;
                                    case 'caodang':
                                        echo 'Cao Đẳng';
                                        break;
                                    case 'daihoc':
                                        echo 'Đại Học';
                                        break;
                                    case 'thacsi':
                                        echo 'Thạc sĩ';
                                        break;
                                    default:
                                        break;
                                }
                                ?></td>
                            <td><img style="width: 100px;height: 100px;" src="<?php echo $row['images'] ?>"</td>
                        </tr>
                        <?php
                    }
                }
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
</div>

</body>
</html>