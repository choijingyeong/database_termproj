<?php
$license = $_GET['license'];
include "include\session.php";
include "include\dbConnect.php";
$start = $_GET['start'];
$end = $_GET['end'];
# 예약 기록 삭제
$sql = "delete from reservation where licenseplateno='$license' and startdate='$start' and enddate='$end'";
$stmt = $conn->prepare($sql);
$stmt->execute();
echo ("<SCRIPT>location.href='page_reservation.php?';</SCRIPT>");
exit;
?>