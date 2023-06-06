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
            echo "<table>";
            echo "<tr><th>차종</th><th>대여 시작일</th><th>대여 종료일</th><th>고객번호</th><th>고객명</th><th>이메일</th></tr>";
            foreach ($results as $row) {
                echo "<tr>";
                echo "<td>" . $row['MODELNAME'] . "</td>";
                echo "<td>" . $row['STARTDATE'] . "</td>";
                echo "<td>" . $row['ENDDATE'] . "</td>";
                echo "<td>" . $row['CNO'] . "</td>";
                echo "<td>" . $row['NAME'] . "</td>";
                echo "<td>" . $row['EMAIL'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        }

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

} else if ($_GET['searchWord'] = ''){
    echo "검색어를 입력하세요";
}
?>

