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
        SELECT cm.vehicletype AS \"차종\", COUNT(*) AS \"대여건수\"
        FROM previousrental pr
        JOIN rentcar rc ON pr.licenseplateno = rc.licenseplateno
        JOIN carmodel cm ON rc.modelname = cm.modelname
        GROUP BY cm.vehicletype
    ");
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "<p>차종별 대여건수</p>";
    echo "<table>";
    echo "<tr><th>차종</th><th>대여건수</th></tr>";
    foreach ($results as $row) {
        echo "<tr>";
        echo "<td>" . $row['차종'] . "</td>";
        echo "<td>" . $row['대여건수'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} catch (PDOException $e) {
    echo("에러 내용: ".$e -> getMessage());
}
?>
