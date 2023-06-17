<br><br>
<?php
$tns = "
	(DESCRIPTION=
		(ADDRESS_LIST=
			(ADDRESS=(PROTOCOL=TCP)(HOST=localhost)(PORT=1521))
		)
		(CONNECT_DATA=
			(SERVICE_NAME=XE)
		)
	)
";
$url = "oci:dbname=".$tns.";charset=utf8";
$username = 'c##tp';
$password = 'iscp5481';
$searchWord = $_GET['searchWord'] ?? '';

if (!isset($_GET['searchWord'])){
    echo "검색해주세요!";
}
else if(isset($_GET['searchWord']) or $_GET['searchWord'] != ''){
    try {
        $conn = new PDO($url, $username, $password);

        $stmt = $conn->prepare("
            SELECT RC.MODELNAME, R.STARTDATE, R.ENDDATE, C.CNO, C.NAME, C.EMAIL
            FROM RENTCAR RC
            JOIN RESERVATION R ON RC.LICENSEPLATENO = R.LICENSEPLATENO
            JOIN CUSTOMER C ON R.CNO = C.CNO
            WHERE RC.LICENSEPLATENO = :searchWord
            ORDER BY C.NAME
        ");
        $stmt->bindParam(':searchWord', $searchWord);
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($results)){
            echo "이 차량번호에 대한 예약건 없음..";
        } else {
?>

<table border=0 width=580 style='table-layout:fixed;'>
    <tr height=25 bgcolor='#eef0f4'>
        <td width=100 align=center>
            <font size=2 style="font-family: Pretendard Variable">
                <b>차종</b>
            </font>
        </td>
        <td width=100 align=center>
            <font size=2 style="font-family: Pretendard Variable">
                <b>대여시작일</b>
            </font>
        </td>
        <td width=100 align=center>
            <font size=2 style="font-family: Pretendard Variable">
                <b>대여종료일</b>
            </font>
        </td>
        <td width=100 align=center>
            <font size=2 style="font-family: Pretendard Variable">
                <b>고객번호</b>
            </font>
        </td>
        <td width=100 align=center>
            <font size=2 style="font-family: Pretendard Variable">
                <b>고객명</b>
            </font>
        </td>
        <td width=100 align=center>
            <font size=2 style="font-family: Pretendard Variable">
                <b>이메일</b>
            </font>
        </td>
    </tr>

    <?php
    foreach ($results as $row){
    ?>
        <tr>
            <td align=center>
                <font size=2 style=\"font-family: Pretendard Variable\">
                    <div>
                        <?= $row['MODELNAME'] ?>
                    </div>
            </td>
            <td align=center>
                <font size=2 style=\"font-family: Pretendard Variable\">
                    <?= $row['STARTDATE'] ?>
            </td>
            <td align=center>
                <font size=2 style=\"font-family: Pretendard Variable\">
                    <?= $row['ENDDATE'] ?>
                </font>
                </a>
            </td>
            <td align=center>
                <font size=2 style=\"font-family: Pretendard Variable\">
                    <?= $row['CNO'] ?>
                </font>
            </td>
            <td align=center>
                <font size=2 style=\"font-family: Pretendard Variable\">
                    <?= $row['NAME'] ?>
                </font>
            </td>
            <td align=center>
                <font size=2 style=\"font-family: Pretendard Variable\">
                    <?= $row['EMAIL'] ?>
                </font>
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
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else if ($_GET['searchWord'] = ''){
    echo "검색어를 입력하세요";
}
?>