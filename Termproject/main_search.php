<html>

<head>
    <style>
        @font-face {
            font-family: 'Pretendard Variable';
            font-weight: 45 920;
            font-style: normal;
            font-display: swap;
            src: local('Pretendard Variable'), url('./images/PretendardVariable.woff2') format('woff2-variations');
        }
    </style>
    <title>다함께 차차</title>
</head>
<font size=5 style="font-family: Pretendard Variable"><b> 다함께 차차 </font></b><br>

</html>
<?php

echo ('
<header>
    <nav id="navBar">
        <div class="navBarCon">
            <div class="navBarItem">
                <ul>
                    <a href="/Termproject/main_logined.php">
                        <li>홈으로</li>
                    </a>
                </ul>
            </div>
        </div>
    </nav>
</header>
');
?>
<?php
include "include\session.php";
include "include\dbConnect.php";
echo $_SESSION['ses_username'] . '님 안녕하세요 ';
echo $_SESSION['ses_email'] . '계정';
echo "<br>";
// POST 데이터 확인
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["search_button"])) {
    $startDate = $_POST["start_date"];
    $endDate = $_POST["end_date"];
    $vehicleTypes = $_POST["vehicle_type"];
    echo "{$startDate} ~ {$endDate} ";

    $query = "select DISTINCT rc.licenseplateno,cm.* from carmodel cm 
        JOIN RentCar rc ON cm.modelName = rc.modelName 
        LEFT JOIN Reservation r ON rc.licensePlateNo = r.licensePlateNo WHERE (
        rc.dateRented IS NULL OR
        rc.returnDate IS NULL OR
        rc.returnDate < to_date(:startDate, 'yyyy-mm-dd') OR
        rc.dateRented > to_date(:endDate, 'yyyy-mm-dd')
        )AND (
        r.startDate IS NULL OR
        r.endDate IS NULL OR
        r.startDate > to_date(:endDate, 'yyyy-mm-dd') OR
        r.endDate < to_date(:startDate, 'yyyy-mm-dd')
        )AND (";

    $typesCount = count($vehicleTypes);
    for ($i = 0; $i < $typesCount; $i++) {

        if ($i > 0) {
            $query .= " OR ";
        }
        if ($vehicleTypes[$i] === "전체") {
            $query .= "1 = 1"; // 모든 차량 타입 선택 시 조건 없음
        } else {
            $query .= "cm.vehicleType = '{$vehicleTypes[$i]}'";
        }
        echo "{$vehicleTypes[$i]} 예약 가능 차량";
    }
    $query .= ")order by rc.licenseplateno";
    // $query .= ")order by rc.licenseplateno";
    // SQL 쿼리 실행
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":startDate", $startDate);
    $stmt->bindParam(":endDate", $endDate);
    // $stmt->bindParam(":startDate", $startDate);
    // $stmt->bindParam(":endDate", $endDate);
    // for ($i = 0; $i < $typesCount; $i++) {
    //     if ($vehicleTypes[$i] !== "all") {
    //         $stmt->bindParam(":vehicleType" . $i, $vehicleTypes[$i]);
    //     }
    // }
    $stmt->execute();
    echo $query;

    ?>

    <table border=0 width=580 align='center' style='table-layout:fixed;'>
        <tr height=25 bgcolor='#eef0f4'>
            <td width=200 align=center>
                <font size=2 style="font-family: Pretendard Variable">
                    <b>차 모델</b>
                </font>
            </td>
            <td width=50 align=center>
                <font size=2 style="font-family: Pretendard Variable">
                    <b>차종</b>
                </font>
            </td>
            <td width=100 align=center>
                <font size=2 style="font-family: Pretendard Variable">
                    <b>하루당 가격</b>
                </font>
            </td>
            <td width=100 align=center>
                <font size=2 style="font-family: Pretendard Variable">
                    <b>연료</b>
                </font>
            </td>
            <td width=100 align=center>
                <font size=2 style="font-family: Pretendard Variable">
                    <b>좌석 수</b>
                </font>
            </td>
            <td width=150 align=center>
                <font size=2><b>예약</b></font>
            </td>
        </tr>

        <?php
        while ($row2 = $stmt->fetch(PDO::FETCH_BOTH)) {
            ?>
            <!-- echo (" -->
            <tr>
                <td align=center>
                    <font size=2 style=\"font-family: Pretendard Variable\">
                        <?= $row2[1] ?>
                </td>

                <td align=center>
                    <font size=2 style=\"font-family: Pretendard Variable\">
                        <?= $row2[2] ?>
                    </font>
                    </a>
                </td>

                <td align=center>
                    <font size=2 style=\"font-family: Pretendard Variable\">
                        <?= $row2[3] ?>
                    </font>
                </td>

                <td align=center>
                    <font size=2 style=\"font-family: Pretendard Variable\">
                        <?= $row2[4] ?>
                    </font>
                </td>
                <td align=center>
                    <font size=2 style=\"font-family: Pretendard Variable\">
                        <div>
                            <?= $row2[5] ?>
                        </div>
                </td>
                <td align="center">
                    <a href="main_reservation.php?license=<?= $row2[0] ?>&start=<?= $startDate ?>&end=<?= $endDate ?>">
                        [예약하기]
                    </a>
                </td>



            </tr>
            <tr height=1>
                <td bgcolor='#ffeef7'>
                </td>
            </tr>
            <!-- "); -->
            <?php
        }

        ?>
    </table>

    <?php
    // Oracle DB 접속 종료
}
// // 예약 버튼을 눌렀을 때 해당 고객이 이미 예약한 차량이 있는지 확인
// if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["reservation_button"])) {
//     $selectedLicensePlateNo = $_POST["license_plate_no"]; // 선택한 차량의 라이선스 번호
//     $customerID = $_SESSION["ses_usercno"]; // 현재 로그인된 고객의 ID
//     $startDate = $_POST["start_date"];
//     $endDate = $_POST["end_date"];

//     echo "{$startDate} ~ {$endDate} <br>";
//     // 이미 예약한 차량이 있는지 확인하는 SQL 쿼리
//     $checkReservationQuery = "SELECT * FROM Reservation 
//                         WHERE licensePlateNo = :licensePlateNo 
//                         AND cno = {$customerID}
//                         AND (startDate BETWEEN TO_DATE(:startDate, 'YYYY-MM-DD') AND TO_DATE(:endDate, 'YYYY-MM-DD')
//                         OR endDate BETWEEN TO_DATE(:startDate, 'YYYY-MM-DD') AND TO_DATE(:endDate, 'YYYY-MM-DD')
//                         OR (startDate <= TO_DATE(:startDate, 'YYYY-MM-DD') AND endDate >= TO_DATE(:endDate, 'YYYY-MM-DD')))
//                         ";

//     $checkReservationStmt = $conn->prepare($checkReservationQuery);
//     $checkReservationStmt->bindParam(":licensePlateNo", $selectedLicensePlateNo);
//     $checkReservationStmt->bindParam(":customerID", $customerID);
//     $checkReservationStmt->bindParam(":startDate", $startDate);
//     $checkReservationStmt->bindParam(":endDate", $endDate);
//     $checkReservationStmt->execute();

//     $rows = $checkReservationStmt->fetchAll();
//     $rowCount_reservation = count($rows);

//     // 이미 예약한 차량이 있는지 확인하는 SQL 쿼리 작성
//     $query = "SELECT licensePlateNo
//                 FROM RentCar
//                 WHERE cno = {$customerID}
//                 AND (dateRented BETWEEN TO_DATE(:startDate, 'YYYY-MM-DD') AND TO_DATE(:endDate, 'YYYY-MM-DD')
//                 OR returnDate BETWEEN TO_DATE(:startDate, 'YYYY-MM-DD') AND TO_DATE(:endDate, 'YYYY-MM-DD')
//                 OR (dateRented <= TO_DATE(:startDate, 'YYYY-MM-DD') AND returnDate >= TO_DATE(:endDate, 'YYYY-MM-DD')))
//                 ";

//     $checkRentcarStmt = $conn->prepare($query);
//     $checkRentcarStmt->bindParam(":startDate", $startDate);
//     $checkRentcarStmt->bindParam(":endDate", $endDate);
//     $checkRentcarStmt->bindParam(":selectedLicensePlateNo", $selectedLicensePlateNo);
//     $checkRentcarStmt->execute();

//     $rows = $checkRentcarStmt->fetchAll();
//     $rowCount_rentcar = count($rows);

//     // 이미 예약한 차량이 있는 경우
//     if ($rowCount_reservation > 0) {
//         // 예약 불가능 메시지를 표시하거나 적절한 처리를 수행
//         echo "이미 해당 기간에 예약한 차량이 있습니다.";
//     } else if ($rowCount_rentcar > 0) {
//         echo "이미 해당 기간에 대여하는 차량이 있습니다.";
//     } else {
//         // 예약 가능한 경우 예약을 처리하거나 적절한 처리를 수행
//         echo "예약이 가능합니다.";
//         $today = date('Y-m-d');
//         $cno = $_SESSION['ses_usercno'];
//         $sql = "INSERT INTO RESERVATION (licensePlateNo, dateReserved, dateRented, returnDate, cno)
//         VALUES (:license, 
//                 TO_DATE(:dateRented, 'YYYY-MM-DD'), 
//                 TO_DATE(:today, 'YYYY-MM-DD'), 
//                 TO_DATE(:returnDate, 'YYYY-MM-DD'), 
//                 :cno)";

//         // PDOStatement 객체 생성
//         $reservationStmt = $conn->prepare($sql);

//         // 매개변수 바인딩
//         $reservationStmt->bindParam(":license", $license);
//         $reservationStmt->bindParam(":today", $today);
//         $reservationStmt->bindParam(":dateRented", $startDate);
//         $reservationStmt->bindParam(":returnDate", $endDate);
//         $reservationStmt->bindParam(":cno", $cno);
//         // 쿼리 실행
//         $reservationStmt->execute();
//         $stmt = $conn->prepare($sql);
//         $stmt->execute();
//         echo ("<SCRIPT>location.href='page_reservation.php?';</SCRIPT>");
//         exit;
//     }
// }
?>

<!-- 
<table border=0 width=580 style='table-layout:fixed;'>
    <tr height=25 bgcolor='#eef0f4'>
        <td width=200 align=center>
            <font size=2 style="font-family: Pretendard Variable">
                <b>차 모델</b>
            </font>
        </td>
        <td width=50 align=center>
            <font size=2 style="font-family: Pretendard Variable">
                <b>차종</b>
            </font>
        </td>
        <td width=100 align=center>
            <font size=2 style="font-family: Pretendard Variable">
                <b>하루당 가격</b>
            </font>
        </td>
        <td width=100 align=center>
            <font size=2 style="font-family: Pretendard Variable">
                <b>연료</b>
            </font>
        </td>
        <td width=100 align=center>
            <font size=2 style="font-family: Pretendard Variable">
                <b>좌석 수</b>
            </font>
        </td>
        <td width=150 align=center>
            <font size=2><b>예약하기</b></font>
        </td>
    </tr> -->