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
  $pdo -> beginTransaction();

  $sql = "DELETE FROM Info1 WHERE Name = :Name";

  $stmh = $pdo -> prepare($sql);

  if (isset($_GET['DeleteName'])) {
    $DeleteName = $_GET['DeleteName'];
  }

  $stmh -> bindValue(':Name', $DeleteName, PDO::PARAM_STR);
  $stmh -> execute();

  $pdo -> commit();

  $count = $stmh -> rowCount();

  ?>
  <script type="text/javascript">
    window.alert("칵테일이 삭제되었습니다.");
    location.href="http://localhost:8012/managerCocktail.php";
  </script>
<?php
} catch (Exception $Exception) {
  $pdo -> rollBack();
  print "오류 :".$Exception->getMessage();
}?>
