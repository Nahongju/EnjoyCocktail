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

  $pdo->beginTransaction();
  $sql = "SELECT id FROM account_info WHERE name LIKE :name AND birthDay LIKE :birthDay AND email LIKE :email1 AND email2 LIKE :email2";

  $stmh = $pdo -> prepare($sql);

  if(isset($_REQUEST['Name'])) {
    $Name = $_REQUEST['Name'];
  }

  if(isset($_REQUEST['bday'])) {
    $birtDay = $_REQUEST['bday'];
  }

  if(isset($_REQUEST['frontemail'])) {
    $email1 = $_REQUEST['frontemail'];
  }

  if(isset($_REQUEST['emailBack']) && ($_REQUEST['emailBack'] == "naver.com" || $_REQUEST['emailBack'] == "daum.net" || $_REQUEST['emailBack'] == "gmail.com"
|| $_REQUEST['emailBack'] == "hanmail.net")) {
    $email2 = $_REQUEST['emailBack'];
  }

  $stmh -> bindValue(':name', $Name, PDO::PARAM_STR);
  $stmh -> bindValue(':birthDay', $birtDay, PDO::PARAM_INT);
  $stmh -> bindValue(':email1', $email1, PDO::PARAM_STR);
  $stmh -> bindValue(':email2', $email2, PDO::PARAM_STR);
  $stmh -> execute();

  $pdo -> commit();
  ?>

  <!DOCTYPE html>
  <html>
  <head>
  <title>칵테일: ID 찾기</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
  h1 {
      	text-align: center;
  	font-family: courier;
      	font-size: 500%;
  }

  table {
  	width: 580px;
  	height: 100px;
  	border: 1px solid #444444;
  	text-align : center;
  }
  </style>
  </head>
  <body>

  <!--제목-->
  <div style="position:absolute;left:730px;top:130px">
  <h2>ID 찾기</h2>
  </div>

  <h1>Cocktail</h1>

  <!--이름-->
  <div style="position:absolute;left:500px;top:220px">
  <p>고객님의 정보와 일치하는 아이디입니다.</p>
  </div>

  <div style="position:absolute;left:500px;top:280px">
  <table>
    <?php
    while ($row = $stmh -> fetch(PDO::FETCH_ASSOC)) {
      ?>
      <tr>
      	<td><?=htmlspecialchars($row['id'])?></td>
      </tr>
      <?php
    } ?>
  </table>
  </div>

  <div style="position:absolute;left:590px;top:430px">
  <input type="button" onClick="location.href='http://1.247.212.109:8012/PW%20%EC%B0%BE%EA%B8%B0.html'" value="PW찾기" style="width:380px;height:50px">
  </div>
  </body>
  </html>


  <?php
} catch(Exception $Exception) {
  print "오류 :".$Exception->getMessage();
}?>
