<?php
require_once("../../config/db.php");
session_start();
if (isset($_POST['sbm']) && !empty($_POST['search'])) {
    $search = $_POST['search'];
    $sql = "SELECT * FROM categroy  WHERE name LIKE '%$search%'";
    $query = mysqli_query($connect, $sql);
    $total_prd = mysqli_num_rows($query);
} else {
    $sql = "SELECT * FROM categroy";
    $query = mysqli_query($connect, $sql);
}
if (isset($_POST['all_prd'])) {
    unset($_POST['sbm']);
}
if (!isset($_SESSION['user'])) {
    header('location:../dangnhap.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liên Hệ</title>
    <link rel="stylesheet" type="text/css" href="../css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,500;0,900;1,700&display=swap" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" type="text/css" href="../../css/admin.css">
</head>

<body>
    <!-- header-start -->
    <?php include '../header.php' ?>
    <!-- header-end -->

    <!-- Main-start -->
    <main class="container">
        <div class="card-body">
            <?php
            if (isset($total_prd)) {
                if ($total_prd !== 0) {
                    echo "<p class='text-success'>Tìm thấy $total_prd sản phẩm</p>";
                } else {
                    echo "<p class='text-danger'> Không tìm thấy sản phẩm nào! </p>";
                }
            }
            ?>
            <table class="table table-hover table-bordered">
                <thead style="background-color: #272c4a;">
                    <tr>
                        <th>STT</th>
                        <th>Họ và tên</th>
                        <th>Số điện thoại</th>
                        <th>Email</th>
                        <th>Sản phẩm quan tâm</th>
                        <th>Ghi chú</th>
                        <th>Ngày gửi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * from contact, categroy where contact.product = categroy.id_cate";

                    $result = executeResult($sql);

                    $index = 1;
                    foreach ($result as $item) {
                        echo '
                        <tr>
                            <td>' . $index++ . '</th>
                            <td>' . $item['fullname'] . '</td>
                            <td>' . $item['phoneNumber'] . '</td>
                            <td>' . $item['email'] . '</td>
                            <td>' . $item['name'] . '</td>
                            <td>' . $item['note'] . '</td>
                            <td>' . $item['created_at'] . '</td>
                        </tr>
                        ';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>
</body>