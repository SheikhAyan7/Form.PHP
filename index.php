<?php
include("./include/connection.php");
if (isset($_POST["sub"])) {

    $studentname = mysqli_real_escape_string($conn, $_POST['studentname']);
    $fathername = mysqli_real_escape_string($conn, $_POST['fathername']);
    $studentemail = mysqli_real_escape_string($conn, $_POST['studentemail']);
    $studentcnic = mysqli_real_escape_string($conn, $_POST['studentcnic']);
    $studentmobile = mysqli_real_escape_string($conn, $_POST['studentmobile']);
    $studentpic = $_FILES['studentpic']['name'];
    $exe = strtolower(pathinfo($studentpic, PATHINFO_EXTENSION));
    $arr = array("png", "jpg", "jpeg");
    if (in_array($exe, $arr)) {

        if (empty($studentname) || empty($fathername) || empty($studentemail) || empty($studentcnic) || empty($studentmobile) || empty($studentpic)) {
            $msg = "Please Fill Out All The Fields";
        } else {
            $filename=time().rand(10000,90000).".".$exe;
            $sql = "INSERT INTO `student`(`studentname`,`fathername`,`studentemail`,`studentcnic`,`studentmobile`,`studentpic`)VALUES('$studentname','$fathername','$studentemail','$studentcnic','$studentmobile','$filename')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                move_uploaded_file($_FILES['studentpic']['tmp_name'],"./SingleIMG/".$filename);
                $msg = "THANK YOU:Your Form Has Been Inserted";
            } else {
                $msg = "SORRY:Your Form Has Been Not Inserted";
            }
        }

    } else {
        $msg = "Your img is Not Right";
    }


}
?>
<!doctype html>
<html lang="en">

<head>
    <title>StudentForm</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
    <div class="container">
        <?php
        if (!empty($msg)) {
            ?>
            <div class="alert text-center bg-dark text-white">
                <h1>
                    <?php echo $msg; ?>
                </h1>
            </div>
            <?php
        }
        ?>
        <form method="post" enctype="multipart/form-data" class="mt-4">
            <div class="mb-3 row">
                <label class="col-3 col-form-label">Student Name</label>
                <div class="col-8">
                    <input type="text" required class="form-control" name="studentname" placeholder="Student Name">
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-3 col-form-label">Father Name</label>
                <div class="col-8">
                    <input type="text" required class="form-control" name="fathername" placeholder="Father Name">
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-3 col-form-label">Student Email</label>
                <div class="col-8">
                    <input type="email" required class="form-control" name="studentemail" placeholder="student Email">
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-3 col-form-label">Student CNIC</label>
                <div class="col-8">
                    <input type="number" required class="form-control" name="studentcnic" placeholder="student CNIC">
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-3 col-form-label">Student Mobile</label>
                <div class="col-8">
                    <input type="number" required class="form-control" name="studentmobile"
                        placeholder="Student Mobile">
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-3 col-form-label">Student Picture</label>
                <div class="col-8">
                    <input type="file" required class="form-control" name="studentpic" placeholder="Student Mobile">
                </div>
            </div>

            <div class="mb-3 row">
                <div class="offset-sm-4 col-sm-8">
                    <input type="submit" name="sub" value="submit" class="btn btn-primary" />
                </div>
            </div>
        </form>
    </div>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
        </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
        </script>
</body>

</html>