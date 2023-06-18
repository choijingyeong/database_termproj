<?php
$license = $_GET['license'];
include "include\session.php";
include "include\dbConnect.php";

$today = date("y/m/d");
$start = $_GET['start'];
$end = $_GET['end'];
$cno = $_SESSION['ses_usercno'];
# 반납하기
# step1) prev에 넣기 (carmodel에서 결제정보 가져와서)
$sql = "
INSERT INTO PREVIOUSRENTAL (LICENSEPLATENO, DATERENTED, DATERETURNED, PAYMENT, CNO)
SELECT rc.LICENSEPLATENO, rc.DATERENTED, TO_DATE('$today', 'yyyy-mm-dd'), cm.RENTRATEPERDAY * (rc.returndate - rc.daterented), rc.cno
FROM carmodel cm
JOIN rentcar rc ON cm.MODELNAME = rc.MODELNAME
WHERE rc.licenseplateno = '$license' and rc.returndate = '$end' and rc.daterented = '$start'
";
$sql = $conn->prepare($sql);
$sql->execute();

# step2) rentcar에서 대여정보들 null로 업데이트 - 즉 대여내역삭제
$sql = "update rentcar set daterented=null, returndate=null, cno=null WHERE licenseplateno = '$license' and returndate = '$end' and daterented = '$start'";
$sql = $conn->prepare($sql);
$sql->execute();

# 결과 화면 리로드
echo ("<SCRIPT>location.href='page_rent.php?';</SCRIPT>");
exit;
?>