<?php
$db_host = 'localhost';
$db_user = 'root';
$db_pass = 'tpdlrkzn1';
$db_name = 'CocktailInfo';
$db_type = 'mysql';

$dsn = "$db_type:host=$db_host;dbname=$db_name;charset=utf8";

try {
  $pdo = new PDo($dsn, $db_user, $db_pass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

  $pdo->beginTransaction();
  $sql = "INSERT INTO Info1 (Name, Alcohol, Type, Base, Recipe, Context, Picture, Dosu, CNo) VALUES (:name, :alcohol, :type, :base, :recipe, :context, :picture, :dosu, :cno)";
  $sql1 = "SELECT CNo FROM Info1";

  $stmh = $pdo->prepare($sql);
  $stmh1 = $pdo -> prepare($sql1);
  $stmh1 -> execute();

  while ($row = $stmh1 -> fetch(PDO::FETCH_ASSOC)) {
    $CocktailCount[] = $row['CNo'];
  }

  $count1 = $stmh1 -> rowCount();

  $cno = $count1 + 1;

  $stmh->bindValue(':name', $_REQUEST['cocktailname'], PDO::PARAM_STR);
  if(isset($_GET["alcohol"]) && ($_GET["alcohol"] == "Alcohol" || $_GET["alcohol"] = "Non-Alcohol")){
      $stmh->bindValue(':alcohol', $_GET['alcohol'], PDO::PARAM_STR);
  }

  if(isset($_GET["usage"]) && ($_GET['usage'] == "Aperitif" || $_GET['usage'] == 'All Day Type' || $_GET['usage'] == 'After Dinner' || $_GET['usage'] == 'No Usage')){
    $stmh->bindValue(':type', $_GET['usage'], PDO::PARAM_STR);
  }

  if(isset($_GET["base"])){
    $base = implode(", ", $_GET["base"]);
    $stmh->bindValue(':base', $base, PDO::PARAM_STR);
  }

  $stmh->bindValue(':recipe', $_GET["cocktailrecipe"], PDO::PARAM_STR);
  $stmh->bindValue(':context', $_GET["cocktailexplanation"], PDO::PARAM_STR);
  $stmh->bindValue(':picture', $_GET['cocktialFile'], PDO::PARAM_STR);
  $stmh->bindValue(':dosu', $_GET['cocktailAlcohol'], PDO::PARAM_STR);
  $stmh->bindValue(':cno', $cno, PDO::PARAM_INT);
  $stmh->execute();
  $pdo->commit();
  ?>
  <!-- <script type="text/javascript">
    window.alert("데이터를 입력했습니다.");
    location.href="http://localhost:8012/managerCocktail.php";
  </script> -->
  <?php
  print "데이터를 ".$stmh->rowCount()."건 입력했습니다.<br>";
}

catch(PDOException $Exception){
  $pdo->rollBack();

  print "오류 :".$Exception->getMessage();
  print "이미 Cocktail이 저장되어있습니다.";
}
?>
