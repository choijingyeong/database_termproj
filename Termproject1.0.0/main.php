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
    <center>
        <title>다함께 차차</title>
    </center>
</head>
<font size=5 style="font-family: Pretendard Variable"><b> 다함께 차차 </font></b><br>




</html>
<?php
// include "include\session.php";
include "include\dbConnect.php";
session_start();

$memberId = $_POST['memberId'];
$memberPw = $_POST['memberPw'];

// $status = $_POST['chk_info']; # 보기형식
// $start = $_POST['start'];
// $end = $_POST['end'];
// echo $start;
// echo $end;

$sql = "SELECT * FROM customer WHERE cno = '{$memberId}' AND passwd = '{$memberPw}'";
$stmt = $conn->prepare($sql);
$stmt->execute();

//$row = $stmt->fetch(PDO::FETCH_ASSOC);
// $cid = $row[0];

// echo $cid;
// echo $status;
// if ($status == "reserve") {
//     $status = "R";
// } else if ($status == "cancel") {
//     $status = "C";
// } else {
//     $status = "W";
// }
// echo $status;

//$row = $stmt->fetch(PDO::FETCH_BOTH);

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    if ($row != null) {
        $_SESSION['ses_usercno'] = $row["CNO"];
        $_SESSION['ses_userid'] = $row["NAME"];
        $_SESSION['ses_email'] = $row["EMAIL"];
        echo $_SESSION['ses_userid'] . '님 안녕하세요 ';
        echo $_SESSION['ses_email'] . '계정';
        echo '<br align="right"><a href="/Termproject/main_logout.php">로그아웃 하기</a>';
        // $cid = (int) $row["cno"]; // admin
        // if ($cid == 12) {
        //     echo '<br><a href="/movie_statistics.php"> 관람기록 보러가기 </a>';
        // }
        echo '<br><br><a href="/Termproject/page_reservation.php"> 예약 내역 </a>';

        echo '<br><br><a href="/Termproject/page_rent.php"> 대여 내역 </a>';

        echo '<br><br><a href="/Termproject/page_previous_rent.php"> 이전 대여 내역 </a>';

        echo '<br><br><a href="/Termproject/page_statistics.php"> 통계 </a>';
        break;
    }


}
if ($row == null) {
    echo '로그인 실패 아이디와 비밀번호가 일치하지 않습니다.';
    echo '<a href="/Termproject/page_login.php">로그인</a>';
}

// echo (var_dump($_POST));
//["memberId"]=> string(2) "A1" ["memberPw"]=> string(4) "1234" 

// // 대여 기간과 차량 유형 가져오기
// $startDate = $_POST['startdate'];
// $endDate = $_POST['enddate'];
// $vehicleType = isset($_POST['vehicle_type']) ? $_POST['vehicle_type'] : '';

// // 쿼리 생성
// $sql = "SELECT modelName, vehicleType, rentRatePerDay, fuel, numberOfSeats
//         FROM CarModel
//         WHERE (vehicleType = :vehicleType OR :vehicleType = '')
//         AND modelName IN (
//             SELECT modelName
//             FROM RentCar
//             WHERE (dateRented <= TO_DATE(:endDate, 'YYYY-MM-DD') AND returnDate >= TO_DATE(:startDate, 'YYYY-MM-DD'))
//             OR (dateRented >= TO_DATE(:startDate, 'YYYY-MM-DD') AND dateRented <= TO_DATE(:endDate, 'YYYY-MM-DD'))
//             OR (returnDate >= TO_DATE(:startDate, 'YYYY-MM-DD') AND returnDate <= TO_DATE(:endDate, 'YYYY-MM-DD'))
//         )";

// // 쿼리 바인딩
// $stmt = oci_parse($conn, $sql);
// oci_bind_by_name($stmt, ':vehicleType', $vehicleType);
// oci_bind_by_name($stmt, ':startDate', $startDate);
// oci_bind_by_name($stmt, ':endDate', $endDate);

// // 쿼리 실행
// $stmt->execute();

// $sql = "SELECT * from rentcar";
$sql = "select * from carmodeloptions";
$stmt = $conn->prepare($sql);
$stmt->execute();
// while ($row2 = $stmt->fetch(PDO::FETCH_BOTH)) {
//     echo "<div> $row2[0] $row2[1] $row2[2] $row2[3] $row2[4] $row2[5]</div>";
// }
?>
<form action="main_search.php" method="POST">
    <label for="start_date">Start Date:</label>
    <input type="date" id="start_date" name="start_date" required>

    <label for="end_date">End Date:</label>
    <input type="date" id="end_date" name="end_date" required>

    <label for="vehicle_type">Vehicle Type:</label>
    <input type="checkbox" id="electric" name="vehicle_type[]" value="전기차">
    <label for="electric">전기차</label>

    <input type="checkbox" id="compact" name="vehicle_type[]" value="소형">
    <label for="compact">소형</label>

    <input type="checkbox" id="sedan" name="vehicle_type[]" value="대형">
    <label for="sedan">대형</label>

    <input type="checkbox" id="suv" name="vehicle_type[]" value="SUV">
    <label for="suv">SUV</label>

    <input type="checkbox" id="van" name="vehicle_type[]" value="승합">
    <label for="van">승합</label>

    <input type="checkbox" id="all" name="vehicle_type[]" value="전체">
    <label for="all">전체</label>

    <button type="submit">검색하기</button>
</form>


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
                    <div>
                        <?= $row2[0] ?>
                    </div>
            </td>

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
                <button type="button" disabled>
                    예약하기
                </button>
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

<form action=main.php?recordST="<?= 5 ?>" method=post>
    <table>
        <tr>
            <td align=center>
                <select name=field>
                    <option value=name style="font-family: Pretendard Variable">이름</option>
                    <option value=title style="font-family: Pretendard Variable">제목</option>
                    <option value=content style="font-family: Pretendard Variable">내용</option>
                </select>
                <input type=text name=search size=15 style="font-family: Pretendard Variable">
                <input type=submit style="font-family: Pretendard Variable" value=검색>
            </td>
        </tr>
    </table>
    </center>
</form>