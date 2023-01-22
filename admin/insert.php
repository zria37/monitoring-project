<?php
//insert.php
if (isset($_POST["nama"])) {
    include '../koneksi.php';
    $subject = mysqli_real_escape_string($connect, $_POST["nama"]);
    $comment = mysqli_real_escape_string($connect, $_POST["todolist"]);
    $query = "
 INSERT INTO comments(no_user, todolist)
 VALUES ('$subject', '$comment')
 ";
    mysqli_query($koneksi, $query);
}
