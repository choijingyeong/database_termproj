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

<body>
    <font size=5 style="font-family: Pretendard Variable"><b> 다함께 차차 </font></b><br>
    <a href="/Termproject/page_login.php">로그인</a>
    <a href="/Termproject/page_register.php">회원가입</a>

    <?php
    // include "include\session.php";
    // include "include\dbConnect.php";
    
    // $sid = $_POST['sid'];
    // $sql = "SELECT LICENSEPLATENO, MODELNAME, DATERENTED, RETURNDATE, CNO
    //         from RENTCAR R"
    // $stmt = $conn->prepare($sql);
    // $stmt -> execute();
    // $row = $stmt->fetch(PDO::FETCH_BOTH);
    
    // echo "<div> 차량 번호는 : $row[0] 입니다 </div>";
    // echo "<br><div> MODELNAME은 : $row[1] 입니다. </div></br>";
    // echo "<br><div> DATERENTED은 : $row[2] 입니다. </div></br>";
    // echo "<br></br>";
    // echo "<form name='reserve_confirm' method='post' action='page_movie_reserve_confirm.php'>
    // <h3>예약하기 </h3>
    // <input type='number' id='TICKET' name='TICKET' value='1' min='1' max='10'>
    // <input type='hidden' id='SCHE' name = 'SCHE' value = $row[0] >
    // <input type='hidden' id='SID' name = 'SID' value = $row[3] >
    // <input type=submit value='submit'><input type=reset value='rewrite'>
    // </form>"
    
    // $carmodel = $_POST['MODELNAME'];
    // $licenseplateno =$_POST['LICENSEPLATENO'];
    
    // echo $_SESSION['ses_userid'];
    // $sql2 = "SELECT cno FROM customer where email = '{$_SESSION['ses_userid']}'";
    // $stmt2 = $conn->prepare($sql2);
    // $stmt2 -> execute();
    // $row = $stmt2->fetch(PDO::FETCH_BOTH);
    // $cid = $row[0];
    ?>


    <form action=ㅡmain.php?recordST="<?= 5 ?>" method=post>
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
</body>

</html>