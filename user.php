<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</head>

<body>
    <?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mydb";

    $nameEdit = $imageEdit = null;

    $nameError = $imageError = null;

    $name = isset($_POST['name']) ? $_POST['name'] : null;
    $image = isset($_POST['image']) ? $_POST['image'] : null;

    $isShow = isset($_GET['isShow']) ? $_GET['isShow'] : null;
    $isUpdate = isset($_POST['isUpdate']) ? $_POST['isUpdate'] : null;
    $isCreate = isset($_POST['isCreate']) ? $_POST['isCreate'] : null;
    $isDelete = isset($_GET['isDelete']) ? $_GET['isDelete'] : null;

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        // Thêm
        if ($isCreate != null) {
            // Validate
            if ($name == null || strlen(trim($name)) < 3) {
                $nameError = 'Phải nhập từ 3 ký tự trở lên';
            } else {
                $nameError = null;
            }

            if ($image == null || strlen(trim($image)) < 3) {
                $imageError = 'Phải nhập từ 3 ký tự trở lên';
            } else if (filter_var($image, FILTER_VALIDATE_URL) == false) {
                $imageError = 'Đường dẫn không hợp lệ';
            } else {
                $imageError = null;
            }

            if ($nameError == null && $imageError == null) {
                $sql = "INSERT INTO user (name, image) VALUES ('$name', '$image')";
                if (!mysqli_query($conn, $sql)) {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            }
        }

        // Xóa
        if ($isDelete != null) {
            $sql = "DELETE FROM user WHERE id=$isDelete";

            if (!$conn->query($sql) === TRUE) {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            } else {
                header('Location: ' . 'user.php');
            }
        }

        // Sửa
        if ($isUpdate != null && $nameError != null && $imageError != null) {
            // Validate
            if ($name == null || strlen(trim($name)) < 3) {
                $nameError = 'Phải nhập từ 3 ký tự trở lên';
            } else {
                $nameError = null;
            }

            if ($image == null || strlen(trim($image)) < 3) {
                $imageError = 'Phải nhập từ 3 ký tự trở lên';
            } else if (filter_var($image, FILTER_VALIDATE_URL) == false) {
                $imageError = 'Đường dẫn không hợp lệ';
            } else {
                $imageError = null;
            }

            if ($nameError == null && $imageError == null) {
                $sql = "UPDATE user SET name='$name', image='$image' WHERE id='$isUpdate'";

                if (!$conn->query($sql) === TRUE) {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                } else {
                    header('Location: ' . 'user.php');
                }
            }
        }

        // Hiển thị lên form
        if (isset($_GET['isShow'])) {
            $sql = "SELECT * FROM user WHERE id = '$isShow'";
            $row = $conn->query($sql)->fetch_assoc();
            $nameEdit = $row['name'];
            $imageEdit = $row['image'];
        }
    }
    ?>
    <div class="container">
        <form class="my-3" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <label class="form-label">Tên</label>
                            <?php
                            if ($nameError) {
                                echo '<label class="form-label text-danger fw-bold">' . $nameError . '</label>';
                            }
                            ?>
                        </div>
                        <input type="text" class="form-control" name="name" placeholder="Nhập tên" value="<?= $nameEdit ?>">
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <label class="form-label">Ảnh</label>
                            <?php
                            if ($imageError) {
                                echo '<label class="form-label text-danger fw-bold">' . $imageError . '</label>';
                            }
                            ?>
                        </div>
                        <input type="text" class="form-control w-100" name="image" placeholder="Nhập tên ảnh" value="<?= $imageEdit ?>">
                    </div>
                </div>
            </div>
            <div class="row g-1">
                <div class="col-1">
                    <?php
                    if (!$isShow) {
                        echo '<button type="submit" class="btn btn-primary w-100" name="isCreate" value="isCreate">Thêm</button>';
                    } else {
                        echo '<button type="submit" class="btn btn-success w-100" name="isUpdate" value="<?= $isShow ?>">Sửa</button>';
                    }
                    ?>
                </div>
                <div class="col-1">
                    <a class="btn btn-danger w-100 <?= !$isShow ? 'd-none' : 'd-block' ?>" href="user.php">Hủy</a>
                </div>
            </div>
        </form>
        <table class="table table-bordered align-middle text-center">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Tên</th>
                    <th>Ảnh</th>
                    <th colspan="2">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $users = $conn->query("SELECT * FROM user");
                if ($users->num_rows > 0) {
                    while ($row = $users->fetch_assoc()) {
                ?>
                        <tr>
                            <td class="w-25"><?= $row['id'] ?></td>
                            <td class="w-25"><?= $row['name'] ?></td>
                            <td class="w-25">
                                <image width='100' src='<?= $row['image'] ?>' />
                            </td>
                            <td>
                                <a class="btn btn-success w-50" href="user.php?isShow=<?= $row['id'] ?>">Sửa</a>
                            </td>
                            <td>
                                <a class="btn btn-danger w-50" href="user.php?isDelete=<?= $row['id'] ?>">Xóa</a>
                            </td>
                        </tr>
                <?php
                    }
                } else {
                    echo '<tr><td colspan="4">Không có kết quả</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>

</body>

</html>