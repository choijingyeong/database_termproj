<?php

    include "include\dbConnect.php";
    include "include\session.php";
    $sql = "SELECT Licenseplateno, daterented, returndate, cno
            FROM rentcar where cno ='{$_SESSION['ses_usercno']}'";
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

    <table border=0 width=580 style='table-layout:fixed;'>
        <tr height=25 bgcolor='#eef0f4'>
            <td width=200 align=center>
                <font size=2 style="font-family: Pretendard Variable">
                    <b>차 번호판</b>
                </font>
            </td>
            <td width=50 align=center>
                <font size=2 style="font-family: Pretendard Variable">
                    <b>대여 시작 날짜</b>
                </font>
            </td>
            <td width=100 align=center>
                <font size=2 style="font-family: Pretendard Variable">
                    <b>반납날짜</b>
                </font>
            </td>
            <td width=100 align=center>
                <font size=2 style="font-family: Pretendard Variable">
                    <b>cno</b>
                </font>
            </td>
            <td width=150 align=center>
                <font size=2><b>대여 취소</b></font>
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

                <td align="center">
                    <a href="page_rent_delete.php?license=<?= $row2[0] ?>&start=<?=$row2[1]?>&end=<?=$row2[2]?>">
                        [대여 취소]
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
