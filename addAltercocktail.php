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
  $pdo -> setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
  $pdo -> beginTransaction();

  $sql = "UPDATE Info1 SET Picture=:Picture, Alcohol=:Alcohol, Type=:Type, Base=:Base, Dosu=:Dosu, Recipe=:Recipe, Context=:Context WHERE Name LIKE :getName";

  $stmh = $pdo -> prepare($sql);

  $stmh->bindValue(':getName', $_GET['cocktailname']);

  if(isset($_GET["alcohol"]) && ($_GET["alcohol"] == "Alcohol" || $_GET["alcohol"] = "Non-Alcohol")){
      $stmh->bindValue(':Alcohol', $_GET['alcohol'], PDO::PARAM_STR);
  }

  if(isset($_GET["usage"]) && ($_GET['usage'] == "Aperitif" || $_GET['usage'] == 'All Day Type' || $_GET['usage'] == 'After Dinner' || $_GET['usage'] == 'No Usage')){
    $stmh->bindValue(':Type', $_GET['usage'], PDO::PARAM_STR);
  }

  if(isset($_GET["base"])){
    $base = implode(", ", $_GET["base"]);
    $stmh->bindValue(':Base', $base, PDO::PARAM_STR);
  }

  $stmh->bindValue(':Recipe', $_GET['cocktailrecipe'], PDO::PARAM_STR);
  $stmh->bindValue(':Context', $_GET['cocktailexplanation'], PDO::PARAM_STR);
  $stmh->bindValue(':Picture', $_GET['cocktialFile'], PDO::PARAM_STR);
  $stmh->bindValue(':Dosu', $_GET['cocktailAlcohol'], PDO::PARAM_STR);
  $stmh -> execute();
  $pdo -> commit();
  $count = $stmh->rowCount();
  print $count;
  ?>
  <script type="text/javascript">
    window.alert("Cocktail이 성공적으로 수정되었습니다.");
    location.href = "http://localhost:8012/managerCocktail.php";
  </script>
  <?php
} catch(Exception $Exception) {
  print "오류 :".$Exception -> getMessage();
}?>
