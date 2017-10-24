<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>title</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
    <?
    echo "<meta charset='utf-8'>";
    $time=date("YmdHi");
    $where = $_POST['where'];
    $when = $_POST['when'];
    //함수 선언

    $ch = curl_init();
    $url = 'http://newsky2.kma.go.kr/service/SecndSrtpdFrcstInfoService2/ForecastVersionCheck';
    $queryParams = '?' . urlencode('ServiceKey') . '=cGGoi4ZeQk7lY%2BjFO5IpSSM3WDR57GubwxDnVGqgsyROCnaYT9l0nO0FCrRudLrbWiASSkQGXTu%2BYIlZsX3UMg%3D%3D'; /*Service Key*/
    $queryParams .= '&' . urlencode('ServiceKey') . '=' . urlencode('TEST_SERVICE_KEY');
    $queryParams .= '&' . urlencode('ftype') . '=' . urlencode('ODAM'); /*파일구분 -ODAM: 동네예보실황 -VSRT: 동네예보초단기 -SHRT: 동네예보단기*/
    $queryParams .= '&' . urlencode('basedatetime') . '=' . $time; /*각각의 base_time 로 검색 참고자료 참조*/

    curl_setopt($ch, CURLOPT_URL, $url . $queryParams);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
    $response = curl_exec($ch);
    curl_close($ch);

    //var_dump($response); //실 운용시 삭제.

    echo "현재 시각 : ".date('Y-m-d H:i',time());


    for ($re=0; $re<5 ; $re++) {
      echo "<br>";
    }

    echo $_POST['zone']."<br>";
    echo $_POST['where']."<br>";
    echo $when;


    for ($re=0; $re<5 ; $re++) {
      echo "<br>";
    }



    //동네예보
    $url = "http://www.kma.go.kr/wid/queryDFSRSS.jsp?zone=".$_POST['zone']; //단기예보
    $respon = file_get_contents($url);
    $object = simplexml_load_string($respon);
    $channel = $object->channel;

    foreach($channel->item as $value) {
    	$title = $value->title;
    	$des= $value->description;
    	$link = $value->link;
    }
    $data=$des->body->data;
    echo $value->category."의 동네예보"."<br>";
    echo "발표시각 : ";
    echo date("Y-m-d H:i",strtotime($des->header->tm))."<br>";
    //echo $des->header->tm;
    echo "<table class='table-striped table-hover' style='width:90%'  align='center'>";
    // for문 중간에 if문을 넣어서 $data[$re]->day==$when 이 true면 출력, 아니면 진행

        echo "<tr align='center'>";
        for ($re=0; $re <19 ; $re++) {
          if ($data[$re]->day==$when) {
            echo "<td>";
      			switch ($data[$re]->day) {
      				case '0':
      					echo "오늘";
      					break;
      				case '1':
      					echo "내일";
      					break;
      				case '2':
      					echo "모레";
      					break;
      				}
      			echo " ".$data[$re]->hour."시";
      			echo "</td>";
          }
        }
    		echo "</tr>";

    		echo "<tr align='center'>";
        for ($re=0; $re <19 ; $re++) {
          if ($data[$re]->day==$when) {
            echo "<td>";
      			echo "예상 기온 : ".$data[$re]->temp."도";
      			echo "</td>";
          }
        }
    		echo "</tr>";

    		echo "<tr align='center'>";
        //$data[$re]->day==$when
        for ($re=0; $re <19 ; $re++) {
          if ($data[$re]->day==$when) {
            echo "<td>";
      			echo $data[$re]->hour."시의 하늘 상태 : ".$data[$re]->wfKor;
      			echo "</td>";
          }
        }
    		echo "</tr>";

    echo "</table>";


    $url = "http://www.kma.go.kr/weather/forecast/mid-term-rss3.jsp?stnId=".$where; //중기예보
    $respon = file_get_contents($url);
    $object = simplexml_load_string($respon);
    $channel = $object->channel;

    foreach($channel->item as $value1) {
    	$title = $value1->title;
    	$des= $value1->description;
    	$link = $value1->link;
    }
    for ($re=0; $re<5 ; $re++) {
      echo "<br>";
    }

    echo $des->header->title;
    echo "<br>";
    echo $channel->pubDate;
    echo "<br>";
    echo $title;
    echo "<br>";
    echo "예보 정보";
    echo "<br>";
    echo $des->header->wf;

    ?>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
      <!-- 모든 컴파일된 플러그인을 포함합니다 (아래), 원하지 않는다면 필요한 각각의 파일을 포함하세요 -->
      <script src="js/bootstrap.min.js"></script>
  </body>
</html>
