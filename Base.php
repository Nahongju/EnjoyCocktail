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

  $sql = "SELECT Name, Picture, Base FROM Info1 WHERE Base LIKE :Base";

  $stmh = $pdo -> prepare($sql);
  $stmh -> bindValue(':Base', "GIN", PDO::PARAM_STR);
  $stmh -> execute();

  $stmh1 = $pdo -> prepare($sql);
  $stmh1 -> bindValue(':Base', "우리술", PDO::PARAM_STR);
  $stmh1 -> execute();

  $stmh2 = $pdo -> prepare($sql);
  $stmh2 -> bindValue(':Base', "BRANDY", PDO::PARAM_STR);
  $stmh2 -> execute();

  $stmh3 = $pdo -> prepare($sql);
  $stmh3 -> bindValue(':Base', "LIQUEUR", PDO::PARAM_STR);
  $stmh3 -> execute();

  $stmh4 = $pdo -> prepare($sql);
  $stmh4 -> bindValue(':Base', "RUM", PDO::PARAM_STR);
  $stmh4 -> execute();

  $stmh5 = $pdo -> prepare($sql);
  $stmh5 -> bindValue(':Base', "TEQUILA", PDO::PARAM_STR);
  $stmh5 -> execute();

  $stmh6 = $pdo -> prepare($sql);
  $stmh6 -> bindValue(':Base', "VODKA", PDO::PARAM_STR);
  $stmh6 -> execute();

  $stmh7 = $pdo -> prepare($sql);
  $stmh7 -> bindValue(':Base', "WHISKY", PDO::PARAM_STR);
  $stmh7 -> execute();

  $stmh8 = $pdo -> prepare($sql);
  $stmh8 -> bindValue(':Base', "WINE", PDO::PARAM_STR);
  $stmh8 -> execute();

  $count = $stmh -> rowCount();
  $Koreacount = $stmh1 -> rowCount();
  $BRANDYcount = $stmh2 -> rowCount();
  $LIquEURcount = $stmh3 -> rowCount();
  $RUMcount = $stmh4 -> rowCount();
  $TEQUILAcount = $stmh5 -> rowCount();
  $VODKAcount = $stmh6 -> rowCount();
  $WHISKYcount = $stmh7 -> rowCount();
  $WINEcount = $stmh8 -> rowCount();

  while ($row = $stmh -> fetch(PDO::FETCH_ASSOC)) {
    $pictureArray[] = $row['Picture'];
    $nameArray[] = $row['Name'];
    $Base[] = $row['Base'];
  }

  while ($row1 = $stmh1 -> fetch(PDO::FETCH_ASSOC)) {
    $KoreaPicture[] = $row1['Picture'];
    $KoreaName[] = $row1['Name'];
    $KoreaBase[] = $row1['Base'];
  }

  while ($row2 = $stmh2 -> fetch(PDO::FETCH_ASSOC)){
    $BRANDYPicture[] = $row2['Picture'];
    $BRANDYName[] = $row2['Name'];
    $BRANDYBase[] = $row2['Base'];
  }

  while ($row3 = $stmh3 -> fetch(PDO::FETCH_ASSOC)){
    $LIQUEURPicture[] = $row3['Picture'];
    $LIQUEURName[] = $row3['Name'];
    $LIQUEURBase[] = $row3['Base'];
  }

  while ($row4 = $stmh4 -> fetch(PDO::FETCH_ASSOC)){
    $RUMPicture[] = $row4['Picture'];
    $RUMName[] = $row4['Name'];
    $RUMBase[] = $row4['Base'];
  }

  while ($row5 = $stmh5 -> fetch(PDO::FETCH_ASSOC)){
    $TEQUILAPicture[] = $row5['Picture'];
    $TEQUILAName[] = $row5['Name'];
    $TEQUILABase[] = $row5['Base'];
  }

  while ($row6 = $stmh6 -> fetch(PDO::FETCH_ASSOC)){
    $VODKAPicture[] = $row6['Picture'];
    $VODKAName[] = $row6['Name'];
    $VODKABase[] = $row6['Base'];
  }

  while ($row7 = $stmh7 -> fetch(PDO::FETCH_ASSOC)){
    $WHISKYPicture[] = $row7['Picture'];
    $WHISKYName[] = $row7['Name'];
    $WHISKYBase[] = $row7['Base'];
  }

  while ($row8 = $stmh8 -> fetch(PDO::FETCH_ASSOC)){
    $WINEPicture[] = $row8['Picture'];
    $WINEName[] = $row8['Name'];
    $WINEBase[] = $row8['Base'];
  }

  $x = 0;
  $y = 0;
  ?>

  <!DOCTYPE html>
  <html>
  <head>
  <title>칵테일: Base</title>
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
  	text-decoration:none;
  }

  </style>
  </head>
  <body>

  <!--제목-->
  <div style="position:absolute;left:45px;margin-right:10px">
  <h1 style="font-size:300%;font-family: courier">Base of Cocktail</h1>
  </div>

  <!--Go to main-->
  <div style="position:absolute;left:1370px;top:50px;width:150px">
  <img src="logo.png" style="width:20px;height:20px">
  <a class="main" href="http://1.247.212.109:8012/main.html" title="main으로 가려면 클릭하세요">Go to main</a>
  </div>

  <!--검색창-->
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
  	<td><img src="칵테일_사진2.png" width=250 height=280></td>
  	<td><img src="칵테일_사진2.png" width=250 height=280></td>
  	<td><img src="칵테일_사진2.png" width=250 height=280></td>
  	<td><img src="칵테일_사진2.png" width=250 height=280></td>
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


  <!--GIN-->
  <div style="position:absolute;left:265px;top:630px">
  <h3>GIN</h3>
  </div>

  <!--more-->
  <div style="position:absolute;left:1250px;top:650px">
  <a class="main" title="GIN 칵테일을 더 보려면 클릭하세요" href="Base_Alcohol.php?BaseCocktail=<?=htmlspecialchars($Base[0])?>">more</a>
  </div>

  <!--GIN 칵테일-->
  <div style="position:absolute;left:265px;top:670px">
  <table border>
  <tr>
    <?php
    for ($i=0; $i < 4; $i++) {
      if ($x < $count) {
        ?>
        <td><img src="<?=htmlspecialchars($pictureArray[$x])?>" width=250 height=280></td>

        <?php
        $x = $x + 1;
      }
    } ?>
  </tr>

  <tr align=center>
    <?php
    for ($i=0; $i < 4; $i++) {
      if ($y < $count) {
        ?>
        <td><a href="cocktailInformation.php?searchInfo=<?=htmlspecialchars($nameArray[$y])?>"><?=htmlspecialchars($nameArray[$y])?></a></td>

        <?php
        $y = $y + 1;
      }
    } ?>
  </tr>
  </table>
  </div>

  <!--LIQUEUR-->
  <div style="position:absolute;left:265px;top:1010px">
  <h3>LIQUEUR</h3>
  </div>

  <!--more-->
  <div style="position:absolute;left:1250px;top:1030px">
  <a class="main" title="LIQUEUR 칵테일을 더 보려면 클릭하세요" href="Base_Alcohol.php?BaseCocktail=<?=htmlspecialchars($LIQUEURBase[0])?>">more</a>
  </div>

  <!--LIQUEUR 칵테일-->
  <div style="position:absolute;left:265px;top:1050px">
  <table border>
  <tr>
    <?php
    $x = 0;
    for ($i=0; $i < 4; $i++) {
      if ($x < $LIquEURcount) {
        ?>
        <td><img src="<?=htmlspecialchars($LIQUEURPicture[$x])?>" width=250 height=280></td>

        <?php
        $x = $x + 1;
      }
    } ?>
  </tr>

  <tr align=center>
    <?php
    $y = 0;

    for ($i=0; $i < 4; $i++) {
      if ($y < $LIquEURcount) {
        ?>
        <td><a href="cocktailInformation.php?searchInfo=<?=htmlspecialchars($LIQUEURName[$y])?>"><?=htmlspecialchars($LIQUEURName[$y])?></a></td>

        <?php
        $y = $y + 1;
      }
    } ?>
  </tr>
  </table>
  </div>

  <!--WHISKY-->
  <div style="position:absolute;left:265px;top:1390px">
  <h3>WHISKY</h3>
  </div>

  <!--more-->
  <div style="position:absolute;left:1250px;top:1410px">
  <a class="main" title="WHISKY 칵테일을 더 보려면 클릭하세요" href="Base_Alcohol.php?BaseCocktail=<?=htmlspecialchars($WHISKYBase[0])?>">more</a>
  </div>

  <!--WHISKY 칵테일-->
  <div style="position:absolute;left:265px;top:1430px">
  <table border>
  <tr>
    <?php
    $x = 0;

    for ($i=0; $i < 4; $i++) {
      if ($x < $WHISKYcount) {
        ?>
        <td><img src="<?=htmlspecialchars($WHISKYPicture[$x])?>" width=250 height=280></td>

        <?php
        $x = $x + 1;
      }
    } ?>
  </tr>

  <tr align=center>
    <?php
    $y = 0;

    for ($i=0; $i < 4; $i++) {
      if($y < $WHISKYcount) {
        ?>
        <td><a href="cocktailInformation.php?searchInfo=<?=htmlspecialchars($WHISKYName[$y])?>"><?=htmlspecialchars($WHISKYName[$y])?></a></td>

        <?php
        $y = $y + 1;
      }
    } ?>
  </tr>
  </table>
  </div>

  <!--BRANDY-->
  <div style="position:absolute;left:265px;top:1770px">
  <h3>BRANDY</h3>
  </div>

  <!--more-->
  <div style="position:absolute;left:1250px;top:1790px">
  <a class="main" title="BRANDY 칵테일을 더 보려면 클릭하세요" href="Base_Alcohol.php?BaseCocktail=<?=htmlspecialchars($BRANDYBase[0])?>">more</a>
  </div>

  <div style="position:absolute;left:265px;top:1820px">
  <table border>
    <tr>
      <?php
      $x = 0;

      for ($i=0; $i < 4; $i++) {
        if ($x < $BRANDYcount) {
          ?>
          <td><img src="<?=htmlspecialchars($BRANDYPicture[$x])?>" width=250 height=280></td>

          <?php
          $x = $x + 1;
        }
      } ?>
    </tr>

    <tr align=center>
      <?php
      $y = 0;

      for ($i=0; $i < 4; $i++) {
        if ($y < $BRANDYcount) {
          ?>
          <td><a href="cocktailInformation.php?searchInfo=<?=htmlspecialchars($BRANDYName[$y])?>"><?=htmlspecialchars($BRANDYName[$y])?></a></td>

          <?php
          $y = $y + 1;
        }
      } ?>
    </tr>
  </table>
  </div>


  <?php
  $x = 0;
  $y = 0; ?>
  <!--RUM-->
  <div style="position:absolute;left:265px;top:2160px">
  <h3>RUM</h3>
  </div>

  <!--more-->
  <div style="position:absolute;left:1250px;top:2180px">
  <a class="main" title="RUM 칵테일을 더 보려면 클릭하세요" href="Base_Alcohol.php?BaseCocktail=<?=htmlspecialchars($RUMBase[0])?>">more</a>
  </div>

  <div style="position:absolute;left:265px;top:2200px">
  <table border>
    <tr>
      <?php
      for ($i=0; $i < 4; $i++) {
        if ($x < $RUMcount) {
          ?>
          <td><img src="<?=htmlspecialchars($RUMPicture[$x])?>" width=250 height=280></td>

          <?php
          $x = $x + 1;
        }
      }?>
    </tr>

    <tr align=center>
      <?php
      for ($i=0; $i < 4; $i++) {
        if ($y < $RUMcount) {
          ?>
          <td><a href="cocktailInformation.php?searchInfo=<?=htmlspecialchars($RUMName[$y])?>"><?=htmlspecialchars($RUMName[$y])?></a></td>

          <?php
          $y = $y + 1;
        }
      } ?>
    </tr>
  </table>
  </div>


  <?php
  $x = 0;
  $y = 0; ?>
  <!--VODKA-->
  <div style="position:absolute;left:265px;top:2540px">
  <h3>VODKA</h3>
  </div>

  <!--more-->
  <div style="position:absolute;left:1250px;top:2560px">
  <a class="main" title="VODKA 칵테일을 더 보려면 클릭하세요" href="Base_Alcohol.php?BaseCocktail=<?=htmlspecialchars($VODKABase[0])?>">more</a>
  </div>

  <div style="position:absolute;left:265px;top:2580px">
  <table border>
    <tr>
      <?php
      for ($i=0; $i < 4; $i++) {
        if ($x < $VODKAcount) {
          ?>
          <td><img src="<?=htmlspecialchars($VODKAPicture[$x])?>" width=250 height=280></td>

          <?php
          $x = $x + 1;
        }
      } ?>
    </tr>

    <tr align=center>
      <?php
      for ($i=0; $i < 4; $i++) {
        if ($y < $VODKAcount) {
          ?>
          <td><a href="cocktailInformation.php?searchInfo=<?=htmlspecialchars($VODKAName[$y])?>"><?=htmlspecialchars($VODKAName[$y])?></a></td>

          <?php
          $y = $y + 1;
        }
      } ?>
    </tr>
  </table>
  </div>


  <?php
  $x = 0;
  $y = 0; ?>
  <!--TEQUILA-->
  <div style="position:absolute;left:265px;top:2920px">
  <h3>TEQUILA</h3>
  </div>

  <!--more-->
  <div style="position:absolute;left:1250px;top:2940px">
  <a class="main" title="TEQUILA 칵테일을 더 보려면 클릭하세요" href="Base_Alcohol.php?BaseCocktail=<?=htmlspecialchars($TEQUILABase[0])?>">more</a>
  </div>

  <div style="position:absolute;left:265px;top:2960px">
  <table border>
    <tr>
      <?php
      for ($i=0; $i < 4; $i++) {
        if ($x < $TEQUILAcount) {
          ?>
          <td><img src="<?=htmlspecialchars($TEQUILAPicture[$x])?>" width=250 height=280></td>

          <?php
          $x = $x + 1;
        }
      } ?>
    </tr>

    <tr align=center>
      <?php
      for ($i=0; $i < 4; $i++) {
        if ($y < $TEQUILAcount) {
          ?>
          <td><a href="cocktailInformation.php?searchInfo=<?=htmlspecialchars($TEQUILAName[$y])?>"><?=htmlspecialchars($TEQUILAName[$y])?></a></td>

          <?php
          $y = $y + 1;
        }
      } ?>
    </tr>
  </table>
  </div>


  <?php
  $x = 0;
  $y = 0; ?>
  <!--WINE-->
  <div style="position:absolute;left:265px;top:3300px">
  <h3>WINE</h3>
  </div>

  <!--more-->
  <div style="position:absolute;left:1250px;top:3320px">
  <a class="main" title="WINE 칵테일을 더 보려면 클릭하세요" href="Base_Alcohol.php?BaseCocktail=<?=htmlspecialchars($WINEBase[0])?>">more</a>
  </div>

  <div style="position:absolute;left:265px;top:3340px">
  <table border>
    <tr>
      <?php
      for ($i=0; $i < 4; $i++) {
        if ($x < $WINEcount) {
          ?>
          <td><img src="<?=htmlspecialchars($WINEPicture[$x])?>" width=250 height=280></td>

          <?php
          $x = $x + 1;
        }
      } ?>
    </tr>

    <tr align=center>
      <?php
      for ($i=0; $i < 4; $i++) {
        if ($y < $WINEcount) {
          ?>
          <td><a href="cocktailInformation.php?searchInfo=<?=htmlspecialchars($WINEName[$y])?>"><?=htmlspecialchars($WINEName[$y])?></a></td>

          <?php
          $y = $y + 1;
        }
      } ?>
    </tr>
  </table>
  </div>


  <?php
  $x = 0;
  $y = 0; ?>
  <!--우리술-->
  <div style="position:absolute;left:265px;top:3680px">
  <h3>우리술</h3>
  </div>

  <!--more-->
  <div style="position:absolute;left:1250px;top:3700px">
  <a class="main" title="우리술 칵테일을 더 보려면 클릭하세요" href="Base_Alcohol.php?BaseCocktail=<?=htmlspecialchars($KoreaBase[0])?>">more</a>
  </div>

  <div style="position:absolute;left:265px;top:3720px">
  <table border>
    <tr>
      <?php
      for ($i=0; $i < 4; $i++) {
        if ($x < $Koreacount) {
          ?>
            <td><img src="<?=htmlspecialchars($KoreaPicture[$x])?>" width=250 height=280></td>

          <?php
          $x = $x + 1;
        }
      } ?>
    </tr>

    <tr align=center>
      <?php
      for ($i=0; $i < 4; $i++) {
        if ($y < $Koreacount) {
          ?>
          <td><a href="cocktailInformation.php?searchInfo=<?=htmlspecialchars($KoreaName[$y])?>"><?=htmlspecialchars($KoreaName[$y])?></a></td>

          <?php
          $y = $y + 1;
        }
      } ?>
    </tr>

  </table>
  <br><br>
  </div>
  </body>
  </html>

  <?php
} catch(Exception $Exception){
  print "오류 :".$Exception.getMessage();
}?>
