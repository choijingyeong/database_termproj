<?php

include "include\dbConnect.php";
include "include\session.php";
$sql = "SELECT rc.Licenseplateno, cm.modelName, rc.daterented, rc.returndate, cm.rentrateperday *(rc.returndate-rc.daterented)
FROM rentcar rc
JOIN carmodel cm ON rc.modelName = cm.modelName
WHERE rc.cno = '{$_SESSION['ses_usercno']}'";
$stmt = $conn->prepare($sql);
$stmt->execute();
?>
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
<font size=5 style="font-family: Pretendard Variable"><b> 다함께 차차 - 대여 내역 </font></b><br>
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
<table border=0 width=580 style='table-layout:fixed;'>
    <tr height=25 bgcolor='#eef0f4'>
        <td width=100 align=center>
            <font size=2 style="font-family: Pretendard Variable">
                <b>모델 이름</b>
            </font>
        </td>
        <td width=100 align=center>
            <font size=2 style="font-family: Pretendard Variable">
                <b>차 번호판</b>
            </font>
        </td>
        <td width=100 align=center>
            <font size=2 style="font-family: Pretendard Variable">
                <b>대여 시작 날짜</b>
            </font>
        </td>
        <td width=100 align=center>
            <font size=2 style="font-family: Pretendard Variable">
                <b>반납 및 결제 날짜</b>
            </font>
        </td>
        <td width=100 align=center>
            <font size=2 style="font-family: Pretendard Variable">
                <b>결제 예정 금액</b>
            </font>
        </td>
        <td width=150 align=center>
            <font size=2><b>결제하기</b></font>
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
                        <?= $row2[1] ?>
                    </div>
            </td>

            <td align=center>
                <font size=2 style=\"font-family: Pretendard Variable\">
                    <?= $row2[0] ?>
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

            <td align="center">
                <a href="page_rent_delete.php?license=<?= $row2[0] ?>&start=<?= $row2[1] ?>&end=<?= $row2[2] ?>">
                    [결제하기]
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

</html>