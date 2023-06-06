<?php
// $tns = "(DESCRIPTION=
//     (ADDRESS_LIST= (ADDRESS=(PROTOCOL=TCP)(HOST=cnusdlab.synology.me)
//         (PORT=1521)))
//     (CONNECT_DATA= (SERVICE_NAME=XE)))";
// $dsn = "oci:dbname=".$tns.";charset=utf8";
// $username = 'd202004187'; $pw = '1234';
$tns = "(DESCRIPTION=
    (ADDRESS_LIST= (ADDRESS=(PROTOCOL=TCP)(HOST=localhost)
        (PORT=1521)))
    (CONNECT_DATA= (SERVICE_NAME=XE)))";
$dsn = "oci:dbname=" . $tns . ";charset=utf8";
$username = 'c##tp';
$pw = 'iscp5481';

$conn = new PDO($dsn, $username, $pw);

// // 쿼리를 담은 PDOStatement 객체 생성
// $stmt = $conn->prepare("SELECT cno,passwd FROM customer");

// // PDOStatement 객체가 가진 쿼리의 파라메터에 변수 값을 바인드
// // $stmt -> bindValue(":name", "나연")
// // PDOStatement 객체가 가진 쿼리를 실행
// $stmt->execute();

// // PDOStatement 객체가 실행한 쿼리의 결과값 가져오기
// $row = $stmt->fetch();

// echo "<pre>";
// print_r($row);
// echo "</pre>";
// // $statement = $conn->query("SELECT modelname FROM rentcar");
// // $row = $statement->fetch(PDO::FETCH_ASSOC);
// // echo htmlentities($row['modelname']);
?>