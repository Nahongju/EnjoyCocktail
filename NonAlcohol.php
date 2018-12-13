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

  $sql = "SELECT Name, Picture FROM Info1 WHERE Alcohol LIKE :Alcohol";

  $stmh = $pdo -> prepare($sql);
  $stmh -> bindValue(':Alcohol', "Non-Alcohol", PDO::PARAM_STR);
  $stmh -> execute();

  $count = $stmh -> rowCount();

  while ($row = $stmh -> fetch(PDO::FETCH_ASSOC)) {
    $pictureArray[] = $row['Picture'];
    $nameArray[] = $row['Name'];
  }

  $x = 0;
  $y = 0;
  ?>

  <!DOCTYPE html>
  <html>
  <head>
  <title>칵테일: NonAlcohol</title>
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
  </style>
  </head>
  <body>

  <!--제목-->
  <div style="position:absolute;left:45px; margin-right:10px">
  <h1 style="font-size:300%;font-family: courier">NonAlcohol of Cocktail</h1>
  </div>


<!--칵테일 선택과 Go to main 버튼-->
  <div style="position:absolute;left:1370px;top:50px;width:150px">
  <img src="logo.png" width = 20px height=20px>
  <a class="main" href="http://1.247.212.109:8012/main.html" title="main으로 가려면 클릭하세요">Go to main</a>
  </div>

  <!--검색 창-->
  <div style="position:absolute;left:1250px;top:100px;width:250px">
  <input type="text">
  <input type="submit" value="Search">
  </div>

  <!--Best4 칵테일-->
  <div style="position:absolute;left:265px;top:190px">
  <h3>Best 4</h3>
  </div>

  <!--Best4 칵테일 사진-->
  <div style="position:absolute;left:265px;top:230px">
  <table border>
  <tr>
  	<td><img src="칵테일_사진4.png" width=250 height=280></td>
  	<td><img src="칵테일_사진4.png" width=250 height=280></td>
  	<td><img src="칵테일_사진4.png" width=250 height=280></td>
  	<td><img src="칵테일_사진4.png" width=250 height=280></td>
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
  <div style="position:absolute;left:10px;top:580px">
  <hr width="1500" noshade />
  </div>

  <!--무알코올 칵테일 사진-->
  <div style="position:absolute;left:265px;top:630px">
  <table border>
    <?php
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
            <td><a href="cocktailInformation.php?searchInfo=<?=htmlspecialchars($nameArray[$y])?>"><?=htmlspecialchars($nameArray[$y])?></a></td>

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
  </body>
  </html>

  <?php
}  catch (Exception $Exception) {
  print "오류 :".$Exception->getMessage();
}?>
