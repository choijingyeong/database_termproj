<?php
include "include\session.php";
include "include\dbConnect.php";
try {

    // 쿼리!
    $stmt = $conn->query("
        SELECT cm.vehicletype AS \"차종\", COUNT(*) AS \"대여건수\"
        FROM previousrental pr
        JOIN rentcar rc ON pr.licenseplateno = rc.licenseplateno
        JOIN carmodel cm ON rc.modelname = cm.modelname
        GROUP BY cm.vehicletype
    ");
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    ?>

    <h3>차종별 대여건수 통계</h3>
    <br>

    <table border=0 width=580 style='table-layout:fixed;'>
        <tr height=25 bgcolor='#eef0f4'>
            <td width=100 align=center>
                <font size=2 style="font-family: Pretendard Variable">
                    <b>차종</b>
                </font>
            </td>
            <td width=100 align=center>
                <font size=2 style="font-family: Pretendard Variable">
                    <b>대여건수</b>
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
                            <?= $row['차종'] ?>
                        </div>
                </td>
                <td align=center>
                    <font size=2 style=\"font-family: Pretendard Variable\">
                        <?= $row['대여건수'] ?>
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