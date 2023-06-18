<?php
include "include\session.php";
include "include\dbConnect.php";
try {

    // 쿼리!
    $stmt = $conn->query("
        SELECT 
        P.LICENSEPLATENO AS \"차 번호\",
        C.NAME AS \"이름\",
        C.EMAIL AS \"이메일\", p.payment \"payment\",
        RANK() OVER (ORDER BY p.payment desc) AS \"RANK\"
        FROM PREVIOUSRENTAL P
        JOIN CUSTOMER C
        ON P.CNO = C.CNO
    ");
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "<h3>고객 총지불액 순위</h3>";
    echo "<p>--PreviousRental 테이블에서 LICENSEPLATENO과 Customer 테이블에서 NAME, EMAIL을 출력하고, 
    --PAYMENT에 대한 순위를 메겨라.</p>";
    ?>


    <br>

    <table border=0 width=580 style='table-layout:fixed;'>
        <tr height=25 bgcolor='#eef0f4'>
            <td width=100 align=center>
                <font size=2 style="font-family: Pretendard Variable">
                    <b>차량 번호</b>
                </font>
            </td>
            <td width=100 align=center>
                <font size=2 style="font-family: Pretendard Variable">
                    <b>이름</b>
                </font>
            </td>
            <td width=100 align=center>
                <font size=2 style="font-family: Pretendard Variable">
                    <b>이메일</b>
                </font>
            </td>
            <td width=100 align=center>
                <font size=2 style="font-family: Pretendard Variable">
                    <b>총지불액</b>
                </font>
            </td>
            <td width=100 align=center>
                <font size=2 style="font-family: Pretendard Variable">
                    <b>RANK</b>
                </font>
            </td>
        </tr>

        <?php
        foreach ($results as $row) {
            ?>
            <tr>
                <td align=center>
                    <font size=2 style=\"font-family: Pretendard Variable\">
                        <div>
                            <?= $row['차 번호'] ?>
                        </div>
                </td>
                <td align=center>
                    <font size=2 style=\"font-family: Pretendard Variable\">
                        <?= $row['이름'] ?>
                </td>
                <td align=center>
                    <font size=2 style=\"font-family: Pretendard Variable\">
                        <div>
                            <?= $row['이메일'] ?>
                        </div>
                </td>
                <td align=center>
                    <font size=2 style=\"font-family: Pretendard Variable\">
                        <div>
                            <?= $row['payment'] ?>
                        </div>
                </td>
                <td align=center>
                    <font size=2 style=\"font-family: Pretendard Variable\">
                        <div>
                            <?= $row['RANK'] ?>
                        </div>
                </td>
            </tr>
            <tr height=1>
                <td bgcolor='#ffeef7'>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>



    <?php
} catch (PDOException $e) {
    echo ("에러 내용: " . $e->getMessage());
}
?>