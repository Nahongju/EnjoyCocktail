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

  if(isset($_GET['BaseCocktail'])){
    $BaseCocktail = $_GET['BaseCocktail'];
  }

  $stmh -> bindValue(':Base', $BaseCocktail, PDO::PARAM_STR);
  $stmh -> execute();
  $count = $stmh->rowCount();

  while ($row = $stmh -> fetch(PDO::FETCH_ASSOC)) {
    $pictureArray[] = $row['Picture'];
    $nameArray[] = $row['Name'];
    $Base[] = $row['Base'];
  }
  ?>

  <!DOCTYPE html>
  <html>
  <head>
  <!-- <title>칵테일: BRANDY</title> -->
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
  <div style="position:absolute;left:60px;margin-right:10px">
  <h1 style="font-size:300%;font-family: courier">Base of Cocktail</h1>
  </div>

  <div style="position:absolute;left:540px;top:-15px;margin-right:10px">
  <h1 style="font-size:400%;color:Orange;font-family: courier"><?=htmlspecialchars($Base[0])?></h1>
  </div>

  <!--Go to Base-->
  <div style="position:absolute;left:1370px;top:50px;width:150px">
  <img src="logo.png" style="width:20px;height:20px">
  <a class="main" href="http://1.247.212.109:8012/Base.html" title="Base로 가려면 클릭하세요">Go to Base</a>
  </div>

  <!--검색창-->
  <div style="position:absolute;left:265px;top:180px">
  <input type="text">
  <input type="submit" value="Search">
  </div>

  <!--칵테일-->
  <?php
  $x = 0;
  $y = 0; ?>

  <div style="position:absolute;left:265px;top:230px">
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
} catch(Exception $Exception){
  print "오류 :".$Exception.getMessage();
}
?>
