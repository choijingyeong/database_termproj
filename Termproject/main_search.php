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

// 대여 기간과 차량 유형 가져오기
// $startDate = $_POST['start_date'];
// $endDate = $_POST['end_date'];
// $vehicleType = isset($_POST['vehicle_type']) ? $_POST['vehicle_type'] : '';
// POST 데이터 확인
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["search_button"])) {
    $startDate = $_POST["start_date"];
    $endDate = $_POST["end_date"];
    $vehicleTypes = $_POST["vehicle_type"];
    echo "{$startDate} ~ {$endDate}";
    // 예약 가능한 차량 조회를 위한 SQL 쿼리 생성
    // $query = "SELECT cm.carModel, cm.vehicleType, cm.price, cm.fuelType, cm.seatCapacity
    //         FROM Carmodel cm
    //         LEFT JOIN Reservation r ON cm.carModel = r.carModel
    //             AND (r.startDate not BETWEEN TO_DATE(:startDate, 'YYYY-MM-DD') AND TO_DATE(:endDate, 'YYYY-MM-DD')
    //             OR r.endDate not BETWEEN TO_DATE(:startDate, 'YYYY-MM-DD') AND TO_DATE(:endDate, 'YYYY-MM-DD'))
    //         WHERE (r.licensePlateNo IS NULL OR r.endDate < TO_DATE(:startDate, 'YYYY-MM-DD'))
    //             AND (";

    // $query = "SELECT DISTINCT rc.licenseplateno,cm.* FROM CarModel cm 
    // JOIN RentCar rc ON cm.modelName = rc.modelName 
    // LEFT JOIN Reservation r ON rc.licensePlateNo = r.licensePlateNo 
    // WHERE ( rc.dateRented IS NULL OR rc.returnDate IS NULL 
    // OR rc.returnDate < to_date('{$startDate}', 'yyyy-mm-dd') 
    // OR rc.dateRented > to_date('{$endDate}', 'yyyy-mm-dd'))
    // AND ( r.startDate IS NULL OR r.endDate IS NULL 
    // OR r.endDate < to_date('{$startDate}', 'yyyy-mm-dd')
    // OR r.startDate > to_date('{$endDate}', 'yyyy-mm-dd'))
    // order by rc.licenseplateno;";

    $query = "select DISTINCT rc.licenseplateno,cm.* from carmodel cm JOIN RentCar rc ON cm.modelName = rc.modelName LEFT JOIN Reservation r ON rc.licensePlateNo = r.licensePlateNo WHERE (
        rc.dateRented IS NULL OR
        rc.returnDate IS NULL OR
        rc.returnDate < to_date('{$startDate}', 'yyyy-mm-dd') OR
        rc.dateRented > to_date('{$endDate}', 'yyyy-mm-dd')
      )AND (
        r.startDate IS NULL OR
        r.endDate IS NULL OR
        r.startDate > to_date('{$endDate}', 'yyyy-mm-dd') OR
        r.endDate < to_date('{$startDate}', 'yyyy-mm-dd')
      )AND (";

    //   order by rc.licenseplateno";

    // AND (";
    // // 선택한 차량 타입에 따라 조건 추가
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
        echo $vehicleTypes[$i];
    }
    $query .= ")order by rc.licenseplateno";
    // $query .= ")order by rc.licenseplateno";
    // SQL 쿼리 실행
    $stmt = $conn->prepare($query);
    // $stmt->bindParam(":startDate", $startDate);
    // $stmt->bindParam(":endDate", $endDate);
    // for ($i = 0; $i < $typesCount; $i++) {
    //     if ($vehicleTypes[$i] !== "all") {
    //         $stmt->bindParam(":vehicleType" . $i, $vehicleTypes[$i]);
    //     }
    // }
    $stmt->execute();


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

                <form method="post" action="">
                    <input type="hidden" name="start_date" value="<?php echo $_POST['start_date']; ?>">
                    <input type="hidden" name="end_date" value="<?php echo $_POST['end_date']; ?>">

                    <input type="hidden" name="license_plate_no" value="<?= $row2[0] ?>">
                    <td align=center>
                        <button type="submit" name="reservation_button">
                            예약하기
                        </button>
                    </td>
                </form>


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
// 예약 버튼을 눌렀을 때 해당 고객이 이미 예약한 차량이 있는지 확인
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["reservation_button"])) {
    $selectedLicensePlateNo = $_POST["license_plate_no"]; // 선택한 차량의 라이선스 번호
    $customerID = $_SESSION["ses_usercno"]; // 현재 로그인된 고객의 ID
    $startDate = $_POST["start_date"];
    $endDate = $_POST["end_date"];

    echo "{$startDate} ~ {$endDate} <br>";
    // 이미 예약한 차량이 있는지 확인하는 SQL 쿼리
    $checkReservationQuery = "SELECT * FROM Reservation 
                        WHERE licensePlateNo = :licensePlateNo 
                        AND cno = {$customerID}
                        AND (startDate BETWEEN TO_DATE(:startDate, 'YYYY-MM-DD') AND TO_DATE(:endDate, 'YYYY-MM-DD')
                        OR endDate BETWEEN TO_DATE(:startDate, 'YYYY-MM-DD') AND TO_DATE(:endDate, 'YYYY-MM-DD')
                        OR (startDate <= TO_DATE(:startDate, 'YYYY-MM-DD') AND endDate >= TO_DATE(:endDate, 'YYYY-MM-DD')))
                        ";

    $checkReservationStmt = $conn->prepare($checkReservationQuery);
    $checkReservationStmt->bindParam(":licensePlateNo", $selectedLicensePlateNo);
    $checkReservationStmt->bindParam(":customerID", $customerID);
    $checkReservationStmt->bindParam(":startDate", $startDate);
    $checkReservationStmt->bindParam(":endDate", $endDate);
    $checkReservationStmt->execute();

    $rows = $checkReservationStmt->fetchAll();
    $rowCount_reservation = count($rows);

    // 이미 예약한 차량이 있는지 확인하는 SQL 쿼리 작성
    $query = "SELECT licensePlateNo
                FROM RentCar
                WHERE cno = {$customerID}
                AND (dateRented BETWEEN TO_DATE(:startDate, 'YYYY-MM-DD') AND TO_DATE(:endDate, 'YYYY-MM-DD')
                OR returnDate BETWEEN TO_DATE(:startDate, 'YYYY-MM-DD') AND TO_DATE(:endDate, 'YYYY-MM-DD')
                OR (dateRented <= TO_DATE(:startDate, 'YYYY-MM-DD') AND returnDate >= TO_DATE(:endDate, 'YYYY-MM-DD')))
                ";

    $checkRentcarStmt = $conn->prepare($query);
    $checkRentcarStmt->bindParam(":startDate", $startDate);
    $checkRentcarStmt->bindParam(":endDate", $endDate);
    $checkRentcarStmt->bindParam(":selectedLicensePlateNo", $selectedLicensePlateNo);
    $checkRentcarStmt->execute();

    $rows = $checkRentcarStmt->fetchAll();
    $rowCount_rentcar = count($rows);

    // 이미 예약한 차량이 있는 경우
    if ($rowCount_reservation > 0) {
        // 예약 불가능 메시지를 표시하거나 적절한 처리를 수행
        echo "이미 해당 기간에 예약한 차량이 있습니다.";
    } else if ($rowCount_rentcar > 0) {
        echo "이미 해당 기간에 대여하는 차량이 있습니다.";
    } else {
        // 예약 가능한 경우 예약을 처리하거나 적절한 처리를 수행
        echo "예약이 가능합니다.";
    }
}
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