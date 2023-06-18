<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <style>
        a {
            text-decoration: none;
        }
    </style>
    <title>통계 페이지</title>
    <script src="statistics.js"></script>
</head>
<?php
echo ('
<header>
    <nav id="navBar">
        <div class="navBarCon">
            <div class="navBarItem">
                <ul>
                    <a href="/Termproject/main_logined.php">
                        <li>홈으로</li>
                    </a>
                </ul>
            </div>
        </div>
    </nav>
</header>
');
?>

<body>

    <div class="container">
        <h2 class="text-center">통계 페이지</h2>

        <table class="table table-bordered text-center">
            <thead>
                <!-- 화면 -->
            </thead>
            <tbody>

                <!-- 통계화면을 보여주는 로직 작성 -->

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button class="btn btn-primary me-md-2" type="button" onclick="showContent(1)">통계1</button>
                    <button class="btn btn-primary me-md-2" type="button" onclick="showContent(2)">통계2</button>
                    <button class="btn btn-primary me-md-2" type="button" onclick="showContent(3)">통계3</button>
                </div>
                <div>
                    <br><br>
                </div>
                <div>
                    <div class="content-container" id="content-container"></div>
                </div>
                <script>
                    var index;
                    function showContent(index) {
                        var contentContainer = document.getElementById("content-container");
                        var url = ""; // 뷰의 PHP 파일 경로

                        if (index === 1) {
                            contentContainer.innerHTML = `
                                                <h3>차량번호별 예약 현황</h3>
                                                <div id="statictics-container">
                                                <p> 검색어를 입력! 대상 licenseplateno를 입력하면 그 차량번호의 정보가 나온다.. </p>
                                                <p>차량 번호가 66바5690인 렌터카의 예약 정보에 대해 
                                                    <br>렌트카 모델이름, 렌트 시작날짜, 끝 날짜, 렌트한 고객의 고객번호와 이름, 이메일 주소를 
                                                    <br>고객이름 순으로 정렬하여 출력하라. 이거 넣었습니다<br>지금데이터로는 22나2222로 검색하면 결과 O</p>

                                                <form class="row">
                                                    <div class="col-10">
                                                        <label for="searchWord" class="visually-hidden">Search Word</label>
                                                        <input type="text" class="form-control" id="searchWord" name="searchWord" placeholder="검색어 입력" value="<?= $_GET['searchWord'] ?? '' ?>">
                                                        <input type="hidden" class="form-control" id="name" name="name" value="<?= $_GET['name'] ?? '관리자' ?>">
                                                    </div>
                                                    <div class="col-auto text-end">
                                                        <button type="button" id="searchButton" class="btn btn-primary mb-3">검색</button>
                                                    </div>
                                                </form>
                                                <div id="results-container"></div>
                                            </div>`


                            // 서치버튼 떠있을때 엔터키 이벤트 핸들러 (그냥엔터치면 터져서 추가)
                            var searchButton = document.getElementById("searchButton");
                            if (searchButton !== null) {
                                function handleEnterKeyPress(event) {
                                    if (event.keyCode === 13) {
                                        event.preventDefault();
                                        document.getElementById("searchButton").click();
                                    }
                                }
                                var searchWordInput = document.getElementById("searchWord");
                                searchWordInput.addEventListener("keypress", handleEnterKeyPress);
                            }

                            searchButton.addEventListener("click", function () {
                                var resultContainer = document.getElementById("results-container");
                                var searchWord = document.getElementById("searchWord").value;
                                url = "statistics1.php?searchWord=" + searchWord;
                                if (url != '') {
                                    var xhr = new XMLHttpRequest();
                                    xhr.open("GET", url, true);
                                    xhr.onreadystatechange = function () {
                                        if (xhr.readyState === 4 && xhr.status === 200) {
                                            resultContainer.innerHTML = xhr.responseText;
                                        }
                                    };
                                    xhr.send();
                                }
                            })
                        } else if (index === 2) {
                            url = "statistics2.php";
                        } else if (index === 3) {
                            url = "statistics3.php";
                        }

                        // AJAX를 사용하여 PHP 파일을 비동기로 호출하여 결과를 가져옴
                        if (url != '') {
                            var xhr = new XMLHttpRequest();
                            xhr.open("GET", url, true);
                            xhr.onreadystatechange = function () {
                                if (xhr.readyState === 4 && xhr.status === 200) {
                                    contentContainer.innerHTML = xhr.responseText;
                                }
                            };
                            xhr.send();
                        }
                    }


                </script>


            </tbody>
        </table>
    </div>
</body>

</html>