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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
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
        <!--            ######################################EDIT##################################################-->
        <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> Edit Data </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form action="update.php" method="POST">

                        <div class="modal-body">

                            <input type="hidden" name="update" id="update">

                            <div class="form-group">
                                <label> Full Name </label>
                                <input type="text" name="fullName" id="fullName" class="form-control"
                                       placeholder="Enter Full Name">
                            </div>

                            <div class="form-group">
                                <label> Birth </label>
                                <input type="date" name="birth" id="birth" class="form-control"
                                       placeholder="Enter Birth">
                            </div>

                            <div class="form-group">
                                <label> Course </label>
                                <input type="text" name="identity" id="identity" class="form-control"
                                       placeholder="Enter Identity number">
                            </div>

                            <div class="form-group">
                                <label> Image </label>
                                <input type="file" name="image" id="image" class="form-control"
                                       placeholder="Select your image">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" name="updatedata" class="btn btn-primary">Update Data</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <!--            #########################################################################-->


        <table class="table">
            <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Birth</th>
                <th scope="col">Identity</th>
                <th scope="col">Certificate</th>
                <th scope="col">Image</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>

             </thead>

<!--            ###################################DELETE######################################-->
            <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="e xampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"> Delete Data </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <form action="delete.php" method="POST">

                            <div class="modal-body">

                                <input type="hidden" name="delete" id="delete">

                                <h4> Do you want to Delete this Data ??</h4>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"> NO </button>
                                <button type="submit" name="deletedata" class="btn btn-primary"> Yes !! Delete it. </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>


            <!--            #########################################################################-->
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
                    <td>
                        <button type="button" class="btn btn-success editbtn"> Edit </button>
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger deletebtn""> Delete </button>
                    </td>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>

<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function () {
        $('.editbtn').on('click', function () {

            $('#editmodal').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function () {
                return $(this).text();
            }).get();

            console.log(data);

            $('#update').val(data[0]);
            $('#fullName').val(data[1]);
            $('#birth').val(data[2]);
            $('#identity').val(data[3]);
            $('#certificate').val(data[4]);
            $('#image').val(data[5]);
        });
    });
</script>
</body>
</html>