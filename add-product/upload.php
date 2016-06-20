<?php
$data = substr($_POST['imgData'],22);
$data = base64_decode($data);
$img_name = md5(time().rand()).'.jpg';
$fileName = 'upload/'.$img_name;
$result = file_put_contents($fileName, $data);
echo json_encode($fileName);