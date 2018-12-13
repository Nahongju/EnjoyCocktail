<?php
$db_host = "localhost";
$db_name = "CocktailInfo";
$db_pass = "tpdlrkzn1";
$db_type = "mysql";
$db_user = "root";

$dsn = "$db_type:host=$db_host;dbname=$db_name;charset=utf8";

try {
  $pdo = new PDO($dsn, $db_user, $db_pass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

  $pdo->beginTransaction();

  $sql = "SELECT * FROM Info1 WHERE Name LIKE :Name";

  $stmh = $pdo->prepare($sql);

  if(isset($_GET['searchInfo'])){
    $searchInfo = $_GET['searchInfo'];
  }

  $stmh -> bindValue(':Name', $searchInfo, PDO::PARAM_STR);
  $stmh -> execute();

  $count = $stmh -> rowCount();

  while($row = $stmh->fetch(PDO::FETCH_ASSOC)) {
    ?>
    <!DOCTYPE html>
    <html>
      <head>
        <meta charset="utf-8">
        <title>Cocktail Search</title>
      </head>
      <body>
        <div style="position:absolute;left:450px;top:50px">
        <h1>Cocktail 상세정보</h1>
        </div>

        <div style="position:absolute;left:1150px;top:85px">
          <img src="logo.png" width=20 height=20>
          <a href="http://1.247.212.109:8012/Review_list.html" style="text-decoration:none">Review</a>
        </div>

        <div style="position:absolute;left:500px;top:150px">
          <img src="<?=htmlspecialchars($row['Picture'])?>", width=400 height=400>
        </div>

        <div style="position:absolute;left:955px;top:150px">
        <FONT SIZE=7><?=htmlspecialchars($row['Name'])?></FONT><br>
        <h3><?=htmlspecialchars($row['Base'])?> Cocktail</h3>
        </div>

        <div style="position:absolute;left:958px;top:250px;width:187px">
        <h4><?=htmlspecialchars($row['Recipe'])?></h4>
        </div>

        <div style="position:absolute;left:955px;top:485.5px">
        <img src="logo.png" width="20px" height="20px">
        </div>

        <div style="position:absolute;left:980px;top:463px">
          <h4><?=htmlspecialchars($row['Dosu'])?></h4>
        </div>

        <div style="position:absolute;left:450px;top:600px;width:700px">
          <h3><?=htmlspecialchars($row['Context'])?></h3>
        </div>
      </body>
    </html>

  <?php
  }

} catch(Exception $Exception){
  print "요류 :".$Exception.getMessage();
}?>
