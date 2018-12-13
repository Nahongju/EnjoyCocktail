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

  $sql = "UPDATE account_info SET pwd = :newpwd WHERE name LIKE :name AND id LIKE :id";

  $stmh = $pdo -> prepare($sql);

  if(isset($_REQUEST['NewPWD']) && isset($_REQUEST['ConfomPWD']) && $_REQUEST['NewPWD'] == $_REQUEST['ConfomPWD']) {
    $NEWPWD = $_REQUEST['NewPWD'];
  }

  else {
    ?>
    <script type="text/javascript">
      window.alert("비밀번호가 일치하지 않습니다.\n다시 입력해주세요");
      location.href = "#";      //SearchPW.php로 링크 걸어놓기
    </script>
    <?php
  }

  $stmh -> bindValue(':name', $_REQUEST['UserName'], PDO::PARAM_STR);
  $stmh -> bindValue(':id', $_REQUEST['UserID'], PDO::PARAM_STR);
  $stmh -> bindValue(':newpwd', $NEWPWD, PDO::PARAM_STR);
  $stmh -> execute();

  $pdo -> commit();
  ?>
  <script type="text/javascript">
    window.alert("비밀번호가 성공적으로 변경되었습니다.\r\n로그인 페이지로 이동합니다.");
    location.href = "http://localhost:8012/로그인 화면.html";    //나중에 링크 변경하기
  </script>
  <?php
} catch(Exception $Exception) {
  print "오류 :".$Exception->getMessage();
}?>
