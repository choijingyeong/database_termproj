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

$sql = "SELECT * FROM customer WHERE cno = '{$memberId}' AND passwd = '{$memberPw}'";
$stmt = $conn->prepare($sql);
$stmt->execute();


while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    if ($row != null) {
        $_SESSION['ses_usercno'] = $row["CNO"];
        $_SESSION['ses_username'] = $row["NAME"];
        $_SESSION['ses_email'] = $row["EMAIL"];
        $_SESSION['ses_userpasswd'] = $row["PASSWD"];
        echo $_SESSION['ses_username'] . '님 안녕하세요 ';
        echo $_SESSION['ses_email'] . '계정';
        echo '<br align="right"><a href="/Termproject/main_logout.php">로그아웃 하기</a>';

        echo '<br><br><a href="/Termproject/page_reservation.php"> 예약 내역 </a>';

        echo '<br><br><a href="/Termproject/page_rent.php"> 대여 내역 </a>';

        echo '<br><br><a href="/Termproject/page_previous_rent.php"> 이전 대여 내역 </a>';
        // if ($_SESSION['ses_usercno'] == 'mgr') {
        //     echo '<br><br><a href="/Termproject/page_statistics.php"> 통계 </a>';
        // }
        echo '<br><br><a href="/Termproject/page_statistics.php"> 통계 </a>';
        break;
    }


}
if ($row == null) {
    echo '로그인 실패! 아이디와 비밀번호가 일치하지 않습니다.';
    echo '<br><a href="/Termproject/page_login.php">다시 로그인</a>';
}

$sql = "select * from carmodeloptions";
$stmt = $conn->prepare($sql);
$stmt->execute();
?>
<script>
    // start_date 값이 변경될 때마다 end_date의 최소 날짜를 설정하는 함수
    function updateEndDateMin() {
        var start_date = document.getElementById('start_date').value;
        document.getElementById('end_date').min = start_date;
    }
</script>
<form align='center's name="research" action="main_search.php" method="POST">
    <label for="start_date">Start Date:</label>
    <input type="date" id="start_date" name="start_date" required onchange="updateEndDateMin()"
        min="<?php echo date('Y-m-d'); ?>">

    <label for="end_date">End Date:</label>
    <input type="date" id="end_date" name="end_date" required>
    <br>
    <label for="vehicle_type">Vehicle Type:</label>
    <input type="checkbox" id="electric" name="vehicle_type[]" value="전기">
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

    <button type="submit" class="btn btn-primary mb-3" name="search_button">검색하기</button>
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