<?
include "include\session.php";
include "include\dbConnect.php";
$sql = "delete from reservation where licenseplateno = '{$license}'";
$stmt = $conn->prepare($sql);
$stmt->execute();
echo ("<SCRIPT>location.href='page_reservation.php?';</SCRIPT>");
exit;

?>