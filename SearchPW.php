<?php
$db_host = 'localhost';
$db_name = 'myService';
$db_user = 'root';
$db_pass = 'tpdlrkzn1';
$db_type = 'mysql';

$dsn = "$db_type:host=$db_host;dbname=$db_name;charset=utf8";

try {
  $pdo = new PDO($dsn, $db_user, $db_pass);
  $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $pdo -> setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  $pdo -> beginTransaction();

  $sql = "SELECT pwd FROM account_info WHERE name LIKE :name AND id LIKE :id";

  $stmh = $pdo -> prepare($sql);

  if (isset($_REQUEST['username'])) {
    $name = $_REQUEST['username'];
  }

  if (isset($_REQUEST['userId'])) {
    $id = $_REQUEST['userId'];
  }

  $stmh -> bindValue(':name', $name, PDO::PARAM_STR);
  $stmh -> bindValue(':id', $id, PDO::PARAM_STR);
  $stmh -> execute();

  $pdo -> commit();
  ?>

  <!DOCTYPE html>
  <html>
  <head>
  <title>칵테일: PW 변경</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
  	h1 {
      		text-align: center;
  		font-family: courier;
      		font-size: 500%;
  	}

  </style>
  </head>
  <body>

  <!--제목-->
  <div style="position:absolute;left:730px;top:130px">
  <h2>PW 변경</h2>
  </div>

  <h1>Cocktail</h1>

  <form name="AlterPW1" action="AlterPW.php" method="post">
    <!--정보-->
    <input type="hidden" name="UserName" value="<?=htmlspecialchars($name)?>">
    <input type="hidden" name="UserID" value="<?=htmlspecialchars($id)?>">

    <!--새 비밀번호-->
    <div style="position:absolute;left:463px;top:220px">
    <p>새 비밀번호</p>
    </div>

    <div style="position:absolute;left:590px;top:220px">
    <input type="text" name="NewPWD" style="width:375px;height:50px">
    </div>

    <!--새 비밀번호 확인-->
    <div style="position:absolute;left:450px;top:300px">
    <p>비밀번호 확인</p>
    </div>

    <div style="position:absolute;left:590px;top:300px">
    <input type="text" name="ConfomPWD" style="width:375px;height:50px">
    </div>


    <div style="position:absolute;left:590px;top:400px">
    <input type="submit" value="PW 변경" style="width:375px;height:50px">
    </div>
  </form>

  </body>
  </html>

  <?php
} catch(Exception $Exception) {
  print "오류 :".$Exception->getMessage();
}?>
