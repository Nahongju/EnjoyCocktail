<?php
$db_host = 'localhost';
$db_name = 'CocktailInfo';
$db_user = 'root';
$db_pass = 'tpdlrkzn1';
$db_type = 'mysql';

$dsn = "$db_type:host=$db_host;dbname=$db_name;charset=utf8";

try {
  $pdo = new PDO($dsn, $db_user, $db_pass);
  $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $pdo -> setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

  $sql = "SELECT Name, Picture FROM Info1 WHERE CNo >48";

  $stmh = $pdo -> prepare($sql);
  $stmh -> execute();

  $count = $stmh -> rowCount();
  ?>

  <!DOCTYPE html>
  <html>
  <head>
  <title>칵테일: ALL</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
  .main{
      color: black;
      text-decoration: none;
  }

  .main:hover {
      color: red;
      background-color: transparent;
      text-decoration: underline;
  }
  .main:active {
      color: yellow;
      background-color: transparent;
      text-decoration: underline;
  }

  a {
  	color: black;
  	text-decoration:none;
  }

  a:hover {
  	color: red;
  	background-color: transparent;
  	text-decoration: underline;
  }

  a:active {
  	color: yellow;
  	background-color: transparent;
  	text-decoration: underline;
  }

  .pagination {
  	display: inline-block;
  }

  .pagination a{
  	color: black;
  	float: left;
  	padding: 8px 16px;
  	text-dcoration: none;
  	transition: background-color .3s;
  	border: 1px solid #ddd;
  	margin: 0 4px;
  }

  .pagination a.active {
  	background-color: #333;
  	color: white;
  	border; 1px solid #333;
  }

  .pagination a:hover:not(.active) {background-color: #ddd;}

  </style>
  </head>
  <body>

  <!--제목-->
  <div style="position:absolute;left:45px;margin-right:10px">
  <h1 style="font-family: courier;font-size:300%">Cocktail of All</h1>
  </div>

  <!--칵테일 선택과 Go to main 버튼-->
  <div style="position:absolute;left:1370px;top:50px;width:150px">
  <img src="logo.png" width = 20px height=20px>
  <a class="main" href="http://1.247.212.109:8012/main.html" title="main으로 가려면 클릭하세요">Go to main</a>

  </div>

  <!--정렬 방식-->
  <div style="position:absolute;left:265px;top:540px">
  <img src="정렬방식.png" width=20px height=20px>
  </div>

  <div style="position:absolute;left:290px;top:539px">
  <select id="정렬" title="정렬방식">
  <option>정렬방식</option>
  <option value="01">
  베이스정렬
  </option>
  <option value="02">
  용도 정렬
  </option>
  <option value="03">
  무알코올 정렬
  </option>
  </select>
  </div>

  <!--검색 창-->
  <div style="position:absolute;left:1250px;top:100px;width:250px">
  <input type="text">
  <input type="submit" value="Search">
  </div>

  <!--Best4 칵테일-->
  <div style="position:absolute;left:265px;top:130px">
  <h3>Best 4</h3>
  </div>

  <!--Best4 칵테일 사진-->
  <div style="position:absolute;left:265px;top:170px">
  <table border>
  <tr>
  	<td><img src="칵테일_사진.png" width=250 height=280></td>
  	<td><img src="칵테일_사진.png" width=250 height=280></td>
  	<td><img src="칵테일_사진.png" width=250 height=280></td>
  	<td><img src="칵테일_사진.png" width=250 height=280></td>
  </tr>
  <tr align=center>
  	<td><a href="" style="text-decoration:none">칵테일</a></td>
  	<td><a href="" style="text-decoration:none">칵테일</a></td>
  	<td><a href="" style="text-decoration:none">칵테일</a></td>
  	<td><a href="" style="text-decoration:none">칵테일</a></td>
  </tr>
  </table>
  </div>

  <!--구분선-->
  <div style="position:absolute;left:10px;top:510px">
  <hr width="1500" noshade />
  </div>

  <!--칵테일 사진 테이블-->
  <div style="position:absolute;left:265px;top:570px;height:1400px">
  <table border="1">
    <?php
    while ($row = $stmh->fetch(PDO::FETCH_ASSOC)) {
      $pictureArray[] = $row['Picture'];
      $NameArray[] = $row['Name'];
    }

    $x = 0;
    $y = 0;

    for ($i=0; $i < ($count/4); $i++) {
      ?>

      <tr>
        <?php
        for ($a=0; $a < 4; $a++) {
          if ($x < $count) {
            ?>
            <td><img src="<?=htmlspecialchars($pictureArray[$x])?>" width=250 height=280></td>

            <?php
            $x = $x + 1;
          }
        }
         ?>
      </tr>

      <tr align=center>
        <?php
        for ($b=0; $b < 4; $b++) {
          if ($y < $count) {
            ?>
            <td><a href="cocktailInformation.php?searchInfo=<?=htmlspecialchars($NameArray[$y])?>"><?=htmlspecialchars($NameArray[$y])?></a></td>

            <?php
            $y = $y + 1;
          }
        } ?>
      </tr>

      <?php
    } ?>

  </table>
  <br><br>
  </div>

  <!--Pagination-->
  <div class="pagination" style="position:absolute;left:600px;top:950px">
  	<a href="#">&laquo;</a>
  	<a href="http://1.247.212.109:8012/All.html#">1</a>
  	<a href="http://1.247.212.109:8012/All_p2.html">2</a>
  	<a href="http://1.247.212.109:8012/All_p3.html#">3</a>
  	<a href="#" class="active">4</a>
  	<a href="#">&raquo;</a>
  </div>

  </body>
  </html>


  <?php
} catch(Exception $Exception) {
  print "오류 :".$Exception.getMessage();
}?>
