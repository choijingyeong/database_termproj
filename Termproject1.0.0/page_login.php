<!doctype html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>다함께 차차</title>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.0.min.js"></script>
    <script type="text/javascript" src="/js/mySignInForm.js"></script>
    <link rel="stylesheet" href="/css/mySignInForm.css" />
</head>

<body>
    <div id="wrap">
        <div id="container">
            <font size=5 style="font-family: Pretendard Variable"><b> 다함께 차차 </font></b><br>
            <form name="login" action="/Termproject/main.php" method="post" onsubmit="return checkSubmit()">
                <div class="line">
                    <p>아이디</p>
                    <div class="inputArea">
                        <input type="text" name="memberId" class="memberId" />
                    </div>
                </div>
                <div class="line">
                    <p>비밀번호</p>
                    <div class="inputArea">
                        <input type="password" name="memberPw" class="memberPw" />
                    </div>
                </div>
                <div class="line">
                    <input type="submit" value="로그인" class="submit" />
                </div>
            </form>
            <class="title"><a href="/Termproject/page_register.php">회원가입 하기</a></class=>
        </div>
    </div>
</body>

</html>