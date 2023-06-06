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
try {
    $conn = new PDO($url, $username, $password);

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
    echo "<p>--PreviousRental 테이블에서 LICENSEPLATENO과 Customer 테이블에서 NAME, EMAIL을 출력하고, 
    --PAYMENT에 대한 순위를 메겨라.</p>";
    echo "<table>";
    echo "<tr><th>차 번호</th><th>이름</th><th>이메일</th><th>payment</th><th>RANK</th></tr>";
    foreach ($results as $row) {
        echo "<tr>";
        echo "<td>" . $row['차 번호'] . "</td>";
        echo "<td>" . $row['이름'] . "</td>";
        echo "<td>" . $row['이메일'] . "</td>";
        echo "<td>" . $row['payment'] . "</td>";
        echo "<td>" . $row['RANK'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} catch (PDOException $e) {
    echo("에러 내용: ".$e -> getMessage());
}
?>
