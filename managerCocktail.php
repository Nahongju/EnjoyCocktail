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

  $sql = "SELECT * FROM Info1";

  $stmh = $pdo -> prepare($sql);
  $stmh -> execute();

  $count = $stmh->rowCount();
  ?>
  <!DOCTYPE html>
  <html>
  <head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8">
  <title>관리자 칵테일</title>
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
     color: black;
     text-decoration:none;
  }

  a:hover {
     color: red;
     background-color: transparent;
     text-decoration:underline;
  }

  a:active {
     color: yellow;
     background-color: transparent;
     text-decoration: underline;
  }

  .pagination {
      display: inline-block;
  }

  .pagination a {
      color: black;
      float: left;
      padding: 8px 16px;
      text-decoration: none;
      transition: background-color .3s;
      border: 1px solid #ddd;
      margin: 0 4px;
  }

  .pagination a.active {
      background-color: #333;
      color: white;
      border: 1px solid #333;
  }

  .pagination a:hover:not(.active) {background-color: #ddd;}

  </style>
  </head>
  <body>

  <!--제목-->
  <div style="position:absolute;left:45px;margin-right:10px">
  <h1 style="font-family: courier;font-size:300%">Cocktail List</h1>
  </div>

  <!--칵테일 선택과 Go to main 버튼-->
  <div style="position:absolute;left:1370px;top:50px">
  <img src="logo.png" width = 20px height=20px>
  <a class="main" href="http://1.247.212.109:8012/main.html" title="main으로 가려면 클릭하세요">Go to main</a>

  </div>

<form name="CocktailList1" action="searchcocktailmanager.php" method="post">
  <!--검색 창-->
  <div style="position:absolute;left:1250px;top:100px">
  <input type="text" name="cocktailname">
  <input type="submit" value="Search">
  </div>
</form>

  <!--Best4 칵테일 사진-->
  <div style="position:absolute;left:450px;top:170px">
  <table border>
    <?php
    while ($row = $stmh -> fetch(PDO::FETCH_ASSOC)) {
      ?>
      <tr align=center>
        <td><img src="<?=htmlspecialchars($row['Picture'])?>" width = 30 height = 30></td>
        <td><?=htmlspecialchars($row['Name'])?></td>
        <td width=130><?=htmlspecialchars($row['Alcohol'])?></td>
        <td><?=htmlspecialchars($row['Base'])?></td>
        <td width=130><?=htmlspecialchars($row['Type'])?></td>
        <td width = 100><a href="AlterCocktail.php?AlterName=<?=htmlspecialchars($row['Name'])?>">[수정]</a></td>
        <td width = 100><a href="ManagerDeleteCocktail.php?DeleteName=<?=htmlspecialchars($row['Name'])?>">[삭제]</a></td>
      </tr>
      <?php
    } ?>
  <!-- <tr>
     <td><img src="칵테일_사진.png" width=250 height=280></td>
     <td><img src="칵테일_사진.png" width=250 height=280></td>
     <td><img src="칵테일_사진.png" width=250 height=280></td>
     <td><img src="칵테일_사진.png" width=250 height=280></td>
  </tr>
  <tr align=center>
     <td><a href="" style="text-decoration:none">칵테일</a></td>
     <td><a href="" style="text-decoration:none">칵테일</a></td>
     <td><a href="" style="text-decoration:none">칵테일</a></td>
     <td><a href="" style="text-decoration:none">칵테일</a></td>
  </tr> -->
  </table>
  </div>

  </body>
  </html>

  <?php
} catch (Exception $Exception) {
  print "오류 :".$Exception->getMessage();
}?>
