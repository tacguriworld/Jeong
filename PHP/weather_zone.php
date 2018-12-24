<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>select zone</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
    <div class="container">
      <form action="weather.php" method="post">
        <p class="text-info">동네 예보 : </p>
        <select class="form-control" name="zone">
          <optgroup label="deagu">
            <option value="2723000000">북구</option>
            <option value="2726000000" selected="selected">수성구</option>
            <option value="2711000000">중구</option>
          </optgroup>
          <optgroup label="seoul">
            <option value="1168000000">강남구</option>
            <option value="1130500000">강북구</option>
          </optgroup>
        </select>
        <p class="text-info">선택할 날짜</p>
        <select class="form-control" name="when">
          <option value="0">오늘</option>
          <option value="1">내일</option>
          <option value="2">모레</option>
        </select>
        <p class="text-info">1주일 예보 : </p>
        <select class="form-control" name="where">
          <option value="143">경북지역</option>
          <option value="108" selected="selected">전국</option>
        </select>
        <input type="submit" name="입력">
      </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- 모든 컴파일된 플러그인을 포함합니다 (아래), 원하지 않는다면 필요한 각각의 파일을 포함하세요 -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
