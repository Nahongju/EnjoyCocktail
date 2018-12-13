<?php
$db_host = 'localhost';   //호스트명
$db_user = 'root';        //사용자명
$db_pass = 'tpdlrkzn1';   //패스워드
$db_name = 'myService';   //데이터베이스명
$db_type = 'mysql';       //데이터베이스 종류

$dsn = "$db_type:host=$db_host;dbname=$db_name;charset=utf8";

try {
  $pdo = new PDO($dsn, $db_user, $db_pass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

  $pdo->beginTransaction();
  $sql = "INSERT INTO account_info (id, pwd, name, sex, birthDay, email, email2) VALUES (:id, :pwd, :username, :sex, :birthDay, :email, :email2)";

  $stmh = $pdo->prepare($sql);
  $stmh->bindValue(':id', $_POST['id'], PDO::PARAM_STR);
  $stmh->bindValue(':pwd', $_POST['pwd'], PDO::PARAM_STR);
  $stmh->bindValue(':username', $_POST['username'], PDO::PARAM_STR);
  $stmh->bindValue(':sex', $_POST['Sex'], PDO::PARAM_STR);
  $stmh->bindValue(':birthDay', $_POST['birthday'], PDO::PARAM_INT);
  $stmh->bindValue(':email', $_POST['emailid'], PDO::PARAM_STR);
  // $stmh->bindValue(':email1', $_POST[''], PDO::PARAM_STR);
  $stmh->bindValue(':email2', $_POST['emailb'], PDO::PARAM_STR);
  $stmh->execute();
  $pdo->commit();

  // print "데이터를 ".$stmh->rowCount()."건 입력했습니다.<br>";
?>
  <script type="text/javascript">
    window.alert("data가 입력되었습니다.\n로그인 화면으로 넘어갑니다.");
    location.href = "http://1.247.212.109:8012/로그인%20화면.html";
  </script>

<!-- <?php
  $sql="SELECT * FROM account_info";
  $stmh = $pdo->query($sql);

  ?>

  <table width="450" border="1" cellspacing="0" cellpadding="8">
    <tbody>
      <tr>
        <th>아이디</th>
        <th>비밀번호</th>
        <th>이름</th>
        <th>성별</th>
        <th>생년월일</th>
        <th>이메일</th>
        <!-- <th>@</th> -->
        <!-- <th>이메일호스트</th>
      </tr>
      <?php
      while($row = $stmh->fetch(PDO::FETCH_ASSOC)){
        ?>

        <tr>
          <td align="center"><?=htmlspecialchars($row['id'])?></td>
          <td align="center"><?=htmlspecialchars($row['pwd'])?></td>
          <td align="center"><?=htmlspecialchars($row['name'])?></td>
          <td align="center"><?=htmlspecialchars($row['sex'])?></td>
          <td align="center"><?=htmlspecialchars($row['birthDay'])?></td>
          <td align="center"><?=htmlspecialchars($row['email'])?></td>
          <!-- <td align="center"><?=htmlspecialchars($row['email1'])?></td> -->
          <!-- <td align="center"><?=htmlspecialchars($row['email2'])?></td>
        </tr>

        <?php
      }
  //     ?> -->
  <!-- //   </tbody> -->
  <!-- // </table> -->
  <?php


} catch(PDOException $Exception){
  $pdo->rollBack();
?>

<script type="text/javascript">
  window.alert("동일한 id가 존재합니다.\n회원가입 페이지로 이동합니다.");
  location.href="http://1.247.212.109:8012/회원가입 화면.html";
</script>
  // print "오류 ".$Exception->getMessage();
  <?php
}
?>
