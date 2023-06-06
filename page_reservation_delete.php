<?php
$license = $_GET['license'];
include "include\session.php";
include "include\dbConnect.php";
# 예약 기록 삭제
$sql = "delete from reservation where licenseplateno=:license";
$sql = $conn->prepare($sql);
$sql->bindParam(':license', $license);
$sql->execute();
exit;
?>