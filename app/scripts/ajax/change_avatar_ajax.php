<?php
require_once '../../model/Model.php';
if (isset($_POST["image"])) {
    $data = $_POST["image"];

    $image_array_1 = explode(";", $data);

    $image_array_2 = explode(",", $image_array_1[1]);

    $data = base64_decode($image_array_2[1]);

    $imageName = time() . '.png';

    $imagePath = 'http://localhost/your-view/public/img/avatars/'.$imageName;

    file_put_contents('../../../public/img/avatars/'.$imageName, $data);

    $model = new Model();

    $model->update('user', ['id' => $_SESSION['id']], ['avatar_src' => $imagePath]);

    echo $imagePath;
}