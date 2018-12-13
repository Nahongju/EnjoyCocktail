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

  $sql = "SELECT Name, Picture, Type FROM Info1 WHERE Type LIKE :Usage";

  $stmh = $pdo -> prepare($sql);
  $stmh1 = $pdo -> prepare($sql);
  $stmh2 = $pdo -> prepare($sql);

  $stmh -> bindValue(':Usage', "After Dinner", PDO::PARAM_STR);
  $stmh1 -> bindValue(':Usage', "All Day Type", PDO::PARAM_STR);
  $stmh2 -> bindValue(':Usage', "Aperitif", PDO::PARAM_STR);

  $stmh -> execute();
  $stmh1 -> execute();
  $stmh2 -> execute();

  $count = $stmh -> rowCount();
  $count1 = $stmh1 -> rowCount();
  $count2 = $stmh2 -> rowCount();

  while ($row = $stmh -> fetch(PDO::FETCH_ASSOC)) {
    $AfterPictureArray[] = $row['Picture'];
    $AfterNameArray[] = $row['Name'];
    $AfterType[] = $row['Type'];
  }

  while ($row = $stmh1 -> fetch(PDO::FETCH_ASSOC)) {
    $AllPictureArray[] = $row['Picture'];
    $AllNameArray[] = $row['Name'];
    $AllType[] = $row['Type'];
  }

  while ($row = $stmh2 -> fetch(PDO::FETCH_ASSOC)) {
    $ApePictureArray[] = $row['Picture'];
    $ApeNameArray[] = $row['Name'];
    $ApeType[] = $row['Type'];
  }

  $x = 0;
  $y = 0;

  ?>
  <!DOCTYPE html>
  <html>
  <head>
  <title>칵테일: Usage</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">
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
  	text-decoration:none;
  }

  </style>
  </head>
  <body>

  <!--제목-->
  <div style="position:absolute;left:45px; margin-right:10px">
  <h1 style="font-size:300%;font-family:courier">Usage of Cocktail</h1>
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
  	<td><img src="칵테일_사진3.png" width=250 height=280></td>
  	<td><img src="칵테일_사진3.png" width=250 height=280></td>
  	<td><img src="칵테일_사진3.png" width=250 height=280></td>
  	<td><img src="칵테일_사진3.png" width=250 height=280></td>
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
  <div style="position:absolute;left:10px;top:605px">
  <hr width="1500" noshade />
  </div>


  <!--All Day Type Cocktail-->
  <div style="position:absolute;left:265px;top:643px">
  <h3><strong>All Day Type</strong></h3>
  </div>

  <!--All Day Type 설명-->
  <div style="position:absolute;left:390px;top:646px">
  <p>:식사와 상관없이 마시는 칵테일로 주스류가 들어간다</p>
  </div>

  <!--more-->
  <div style="position:absolute;left:1250px;top:663px">
  <a class="main" title="칵테일을 더 보려면 클릭하세요" href="Usage_Type.php?TypeName=<?=htmlspecialchars($AllType[0])?>">more</a>
  </div>

  <!--All Day Type 칵테일 사진-->
  <div style="position:absolute;left:265px;top:682px">
  <table border>
  <tr>
    <?php
    for ($i=0; $i < 4; $i++) {
      if ($x < 4) {
        ?>
        <td><img src="<?=htmlspecialchars($AllPictureArray[$x])?>" width=250 height=280></td>

        <?php
        $x = $x + 1;
      }
    } ?>
  </tr>

  <tr align=center>
    <?php
    for ($i=0; $i < 4; $i++) {
      if ($y < 4) {
        ?>
        <td><a href="cocktailInformation.php?searchInfo=<?=htmlspecialchars($AllNameArray[$y])?>" style="text-decoration:none"><?=htmlspecialchars($AllNameArray[$y])?></a></td>

        <?php
        $y = $y + 1;
      }
    } ?>
  </tr>
  </table>
  </div>

  <!--Aperitif-->
  <div style="position:absolute;left:265px;top:1010px">
  <h3><strong>Aperitif</strong><h3>
  </div>

  <!--more-->
  <div style="position:absolute;left:1250px;top:1030px">
  <a class="main" title="칵테일을 더 보려면 클릭하세요" href="Usage_Type.php?TypeName=<?=htmlspecialchars($ApeType[0])?>">more</a>
  </div>

  <!--Aperitif 설명-->
  <div style="position:absolute;left:350px;top:1013px">
  <p>:정찬 전 약간의 시간이 있을 때 마시는 칵테일로 Dry 하다</p>
  </div>

  <!--Aperitif 칵테일 사진-->
  <div style="position:absolute;left:265px;top:1050px">
  <table border>
  <tr>
    <?php
    $x = 0;
    $y = 0;

    for ($i=0; $i < 4; $i++) {
      if ($x < 4) {
        ?>
        <td><img src="<?=htmlspecialchars($ApePictureArray[$x])?>" width=250 height=280></td>

        <?php
        $x = $x + 1;
      }
    } ?>
  </tr>

  <tr align=center>
    <?php
    for ($i=0; $i < 4; $i++) {
      if ($y < 4) {
        ?>
        <td><a href="cocktailInformation.php?searchInfo=<?=htmlspecialchars($ApeNameArray[$y])?>" style="text-decoration:none"><?=htmlspecialchars($ApeNameArray[$y])?></a></td>

        <?php
        $y = $y + 1;
      }
    } ?>
  </table>
  </div>

  <!--After Dinner(Dessert) Cocktail-->
  <div style="position:absolute;left:265px;top:1390px">
  <h3><strong>After Dinner Cocktail</strong></h3>
  </div>

  <!--After Dinner(Dessert) Cocktail 설명-->
  <div style="position:absolute;left:455px;top:1393px">
  <p>:식후 주로 단 맛을 지닌 칵테일</p>
  </div>

  <!--more-->
  <div style="position:absolute;left:1250px;top:1410px">
  <a class="main" title="칵테일을 더 보려면 클릭하세요" href="Usage_Type.php?TypeName=<?=htmlspecialchars($AfterType[0])?>">more</a>
  </div>

  <!--After Dinner 칵테일 사진-->
  <div style="position:absolute;left:265px;top:1430px">
  <table border>
  <tr>
    <?php
    $x = 0;
    $y = 0;

    for ($i=0; $i < 4; $i++) {
      if ($x < 4) {
        ?>
        <td><img src="<?=htmlspecialchars($AfterPictureArray[$x])?>" width=250 height=280></td>

        <?php
        $x = $x + 1;
      }
    } ?>
  </tr>

  <tr align=center>
    <?php
    for ($i=0; $i < 4; $i++) {
      if ($y < 4) {
        ?>
        <td><a href="cocktailInformation.php?searchInfo=<?=htmlspecialchars($AfterNameArray[$y])?>" style="text-decoration:none"><?=htmlspecialchars($AfterNameArray[$y])?></a></td>

        <?php
        $y = $y + 1;
      }
    } ?>
  </table>
  <br><br>
  </div>
  </body>
  </html>

  <?php
} catch (Exception $Exception) {
  print "오류 : ".$Exception.getMessage();
}?>
