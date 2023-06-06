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
<font size=5 style="font-family: Pretendard Variable"><b> 다함께 차차 </font></b><br>

</html>

<?php
include "include\session.php";
include "include\dbConnect.php";
// 대여 기간과 차량 유형 가져오기
$startDate = $_POST['start_date'];
$endDate = $_POST['end_date'];
$vehicleType = isset($_POST['vehicle_type']) ? $_POST['vehicle_type'] : '';
echo "{$startDate}";
echo "{$endDate}";

$sql = "SELECT modelName, vehicleType, rentRatePerDay, fuel, numberOfSeats
        FROM CarModel
        WHERE (vehicleType = :vehicleType OR :vehicleType = '')
        AND modelName IN (
            SELECT modelName
            FROM RentCar
            WHERE (dateRented <= TO_DATE(:endDate, 'YYYY-MM-DD') AND returnDate >= TO_DATE(:startDate, 'YYYY-MM-DD'))
            OR (dateRented >= TO_DATE(:startDate, 'YYYY-MM-DD') AND dateRented <= TO_DATE(:endDate, 'YYYY-MM-DD'))
            OR (returnDate >= TO_DATE(:startDate, 'YYYY-MM-DD') AND returnDate <= TO_DATE(:endDate, 'YYYY-MM-DD'))
        ";
$stmt = $conn->prepare($sql);
$stmt->execute();

?>
<table border=0 width=580 style='table-layout:fixed;'>
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
</table>
<?php
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo ($row[0]);

}
?>