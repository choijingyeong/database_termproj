<?php
//자동차 license number
$license = $_GET['license'];

// 예약 확정 날짜
$today = date('Y-m-d');
include "include\session.php";
include "include\dbConnect.php";
$start = $_GET['start'];
$end = $_GET['end'];
$cno = $_SESSION['ses_usercno'];
# 예약 확정
// // 예약 버튼을 눌렀을 때 해당 고객이 이미 예약한 차량이 있는지 확인

// 이미 예약한 차량이 있는지 확인하는 SQL 쿼리
$checkReservationQuery = "SELECT * FROM Reservation 
                        WHERE cno = {$cno}
                        AND (startDate BETWEEN TO_DATE(:startDate, 'YYYY-MM-DD') AND TO_DATE(:endDate, 'YYYY-MM-DD')
                        OR endDate BETWEEN TO_DATE(:startDate, 'YYYY-MM-DD') AND TO_DATE(:endDate, 'YYYY-MM-DD')
                        OR (startDate <= TO_DATE(:startDate, 'YYYY-MM-DD') AND endDate >= TO_DATE(:endDate, 'YYYY-MM-DD')))
                        ";

$checkReservationStmt = $conn->prepare($checkReservationQuery);
$checkReservationStmt->bindParam(":licensePlateNo", $license);
$checkReservationStmt->bindParam(":startDate", $start);
$checkReservationStmt->bindParam(":endDate", $end);
$checkReservationStmt->execute();

$rows = $checkReservationStmt->fetchAll();
$rowCount_reservation = count($rows);

// 이미 대여한 차량이 있는지 확인하는 SQL 쿼리 작성
$query = "SELECT *
                FROM RentCar
                WHERE cno = {$cno}
                AND (dateRented BETWEEN TO_DATE(:startDate, 'YYYY-MM-DD') AND TO_DATE(:endDate, 'YYYY-MM-DD')
                OR returnDate BETWEEN TO_DATE(:startDate, 'YYYY-MM-DD') AND TO_DATE(:endDate, 'YYYY-MM-DD')
                OR (dateRented <= TO_DATE(:startDate, 'YYYY-MM-DD') AND returnDate >= TO_DATE(:endDate, 'YYYY-MM-DD')))
                ";

$checkRentcarStmt = $conn->prepare($query);
$checkRentcarStmt->bindParam(":startDate", $start);
$checkRentcarStmt->bindParam(":endDate", $end);
$checkRentcarStmt->execute();

$rows = $checkRentcarStmt->fetchAll();
$rowCount_rentcar = count($rows);

// 이미 예약한 차량이 있는 경우
if ($rowCount_reservation > 0) {
    // 예약 불가능 메시지를 표시하거나 적절한 처리를 수행
    echo "{$start} ~ {$end} <br>";
    echo "이미 해당 기간에 예약한 차량이 있습니다.";
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
} else if ($rowCount_rentcar > 0) {
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
    echo "{$start} ~ {$end} <br>";
    echo "이미 해당 기간에 대여하는 차량이 있습니다.";
} else {
    // 예약 가능한 경우 예약을 처리하거나 적절한 처리를 수행
    $sql = "INSERT INTO RESERVATION
        VALUES (:license, 
                TO_DATE(:dateRented, 'YYYY-MM-DD'), 
                TO_DATE(:today, 'YYYY-MM-DD'), 
                TO_DATE(:returnDate, 'YYYY-MM-DD'), 
                :cno)";

    // PDOStatement 객체 생성
    $reservationStmt = $conn->prepare($sql);

    // 매개변수 바인딩
    $reservationStmt->bindParam(":license", $license);
    $reservationStmt->bindParam(":today", $today);
    $reservationStmt->bindParam(":dateRented", $start);
    $reservationStmt->bindParam(":returnDate", $end);
    $reservationStmt->bindParam(":cno", $cno);

    // 쿼리 실행
    $reservationStmt->execute();
    // echo $sql;
    echo ("<SCRIPT>location.href='page_reservation.php?';</SCRIPT>");
    exit;
}


?>