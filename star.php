<?php
    require_once('database.php');
    session_start();
    $iserr = 0;    
    
    // 세션 있는지 확인
    if(isset($_SESSION["login"])){
        if($_SESSION["login"] != 1){
            $_SESSION["err"] = "주의 : 세션이 만료되었습니다.";
            $iserr = 1;
            header("Location: index.php");    
        }
    }else{
        $_SESSION["err"] = "주의 : 세션이 만료되었습니다.";
        $iserr = 1;
        header("Location: index.php");
    }
  
    // 변수 세팅
    $phone = $_SESSION["phone"];
?>


<!DOCTYPE html>
<html lang="ko">
<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-111513614-3"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-111513614-3');
    </script>
    <script data-ad-client="ca-pub-7503255255011124" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>트리니티 헬퍼</title>
    <!-- include libraries -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body{
            background-color: #212529;
        }
        .wrapper{
            max-width: 576px;
            margin: 0 auto;
            color: white;
            font-family: 'Noto Sans KR', sans-serif;
            padding: 15px;
        }
        .noto-thin { font-weight: 100; }
        .noto-regular { font-weight: 400; }
        .noto-bold { font-weight: 700; }
        .noto-extra { font-weight: 900; }
        .my-card {
            min-height: 100px;
            background-color: white;
            border-radius: 10px;
            margin: 20px 0;
            padding: 15px;
        }
        .my-title{
            color: #212529;
            font-size: 16px;
        }
        .my-text{
            color: #212529;
            font-size: 12px;
        }
        .main-notice{
            color: gold;
            font-size: 12px;
            text-align: center;
        }
        ul,li{
            color: #212529;
            font-size: 14px;
        }
    </style>
</head>

<?php
    $q1 = "SELECT * FROM cuk_star WHERE phone = '$phone' and stat = 1";
    $res1 = $mysqli->query($q1);
    $row1 = mysqli_num_rows($res1);

    $ch1 = curl_init();
    $ch2 = curl_init();
    $ch3 = curl_init();
    $ch4 = curl_init();
    $ch5 = curl_init();

    $sbj_array = array();
    $clss_array = array();

    $mh = curl_multi_init();

    function get_data($subj, $clss){
        $url = "http://api.haenu.com/".$subj."/".$clss;
        $ch = curl_multi_init();                           //curl 초기화
        curl_setopt($ch, CURLOPT_URL, $url);               //URL 지정하기
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);    //요청 결과를 문자열로 반환
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);      //connection timeout 10초
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

?>

<body>
    <div class="wrapper">
        <h1 class="noto-extra" style="margin-top: 30px"><a href="mypage.php" style="text-decoration: none; color: white">트리니티 헬퍼</a></h1>
        <h4 class="noto-bold" style="line-height: 30px">즐겨찾기 관리 <span style="font-size: 16px">(<?=$_SESSION["phone"]?> | <a href="logout.php">로그아웃</a>)</span></h4>
        <div class="login" style="margin: 20px 0 40px 0">
            <div class="my-card notice">
                <p class="my-title noto-extra">즐겨찾기 (<?=$row1?>)</p>
                <?php
                    $curl_urls = array();
                    if($row1 == 0){
                        echo "<p class=\"my-text\">내역이 없습니다.</p>";
                    }else{
                        $cnt = 0;
                        while($data1 = mysqli_fetch_array($res1, MYSQLI_ASSOC)){
                            $cnt++;
                            $temp_cnt = $cnt - 1;
                            $num = $data1["num"];
                            $subj = $data1["subj"];
                            $class = $data1["class"];
                            $url = "http://api.haenu.com/".$subj."/".$class;
                            $curl_urls[$temp_cnt] = $url;
                            echo "<p class=\"my-text\">$cnt. $res (<a href=\"star_delete.php?num=$num\">취소</a>)</p>";
                        }

                        $ch = curl_multi_init();                           //curl 초기화
                        curl_setopt($ch, CURLOPT_URL, $url);               //URL 지정하기
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);    //요청 결과를 문자열로 반환
                        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);      //connection timeout 10초       
                        $result = curl_exec($ch);
                        curl_close($ch);                
                    }
                ?>
            </div>
        </div>
    </div>
</body>
</html>