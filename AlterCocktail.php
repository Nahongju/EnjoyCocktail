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

  $sql = "SELECT * FROM Info1 WHERE Name LIKE :Name";

  $stmh = $pdo -> prepare($sql);

  if (isset($_GET['AlterName'])) {
    $Name = $_GET['AlterName'];
  }

  $stmh -> bindValue(':Name', $Name, PDO::PARAM_STR);
  $stmh -> execute();

  $pdo -> commit();

  $count = $stmh -> rowCount();
  ?>

  <!DOCTYPE html>
  <html>
  <head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cocktail수정 Page</title>
  <script type="text/javascript">
      function ImgChange(){
      	var img1 = document.getElementById("Cockimg");
      	img1.src =
      }
  </script>
  <style>
  .WrapperDiv{
    position: relative;
    width: 100%;
    height: 100%;
  }
  .conDiv{
    display: inline-block;
    position:absolute;
  }
  table{
      border-collapse: collapse;
      font-size:12px;
  }

  tr{
      border: 1px solid black;
  }

  td{
      text-align: center;
  }

  a{
      color: black;
      text-decoration: none;
  }

  a:hover {
      color: red;
      background-color: transparent;
      text-decoration: underline;
  }
  a:active {
      color: yellow;
      background-color: transparent;
      text-decoration: underline;
  }

  * {
      box-sizing: border-box;
  }

  </style>
  </head>
  <body>
    <form name=recipeform method="POST" action="addAltercocktail.php">
      <div class="WrapperDiv">
      <!--LOGIN & Go to main button-->
        <div class="conDiv" style="left:1370px;top:20px;width:200px">
          <img src="logo.png" width = 15px height=15px>
          <a href="http://1.247.212.109:8012/관리자_main.html" title="main으로 가려면 클릭하세요">Go to main</a>
        </div>

      <!--Cocktail 수정-->
        <div class="conDiv" style="left:410px;top:65px;width:220px;height:250px">
      	  <img class="cockimg" src="logo.png" style="height:70%">
        </div>

        <div class="conDiv" style="left:430px;top:280px;width:200px">
          <input type="file" id="Cockimgname" name="cocktialFile" accept=".png, .jpg, .jpeg">
        </div>

        <?php
        while ($row = $stmh -> fetch(PDO::FETCH_ASSOC)) {
          ?>
          <div class="conDiv" style="left:650px;top:40px;width:200px">
            <h4>Cocktail 이름</h4>
          </div>

          <div class="conDiv" style="left:650px;top:90px">
            <input name="cocktailname" type="text" value="<?=htmlspecialchars($row['Name'])?>" required>
          </div>

          <div class="conDiv" style="left:650px;top:104px;width:200px">
        <!--추가할 메뉴 체크-->
            <h4>* Alcohol or Non-Alcohol</h4>
            <input type="radio" name="alcohol" checked="checked" value="Alcohol">Alcohol
            <input type="radio" name="alcohol" value="Non-Alcohol">Non-Alcohol
          </div>

          <div class="conDiv" style="left:900px;top:104px;width:400px">
            <h4>* Usage</h4>
            <input type="radio" name="usage" value="Aperitif">Aperitif
            <input type="radio" name="usage" value="All Day Type">All Day Type
            <br>
            <input type="radio" name="usage" value="After Dinner">After Dinner
            <input type="radio" name="usage" value="No Usage">No Usage
          </div>

          <div class="conDiv" style="left:650px;top:200px;width:500px">
            <h4>* Base</h4>
            <input type="checkbox" name="base[]" value="GIN">GIN
            <input type="checkbox" name="base[]" value="LIQUEUR">LIQUEUR
            <input type="checkbox" name="base[]" value="WHISKY">WHISKY
            <input type="checkbox" name="base[]" value="BRANDY">BRANDY
            <input type="checkbox" name="base[]" value="RUM">RUM
            <br>
            <input type="checkbox" name="base[]" value="VODKA">VODKA
            <input type="checkbox" name="base[]" value="TEQUILA">TEQUILA
            <input type="checkbox" name="base[]" value="WINE">WINE
            <input type="checkbox" name="base[]" value="우리술">우리술
            <input type="checkbox" name="base[]" value="No Base">No Base
          </div>

          <div class="conDiv" style="left:410px; top:330px;width:200px">
            <h4>Cocktail 도수</h4>
          </div>

          <div class="conDiv" style="left:410px;top:386px">
            <textarea name="cocktailAlcohol" style="width:200px;height:30px"><?=htmlspecialchars($row['Dosu'])?></textarea>
          </div>

          <div class="conDiv" style="left:410px;top:430px;width:200px">
            <h4>Cocktail 레시피</h4>
          </div>

          <div class="conDiv" style="left:410px;top:486px">
            <textarea name="cocktailrecipe" style="width:750px;height:200px"><?=htmlspecialchars($row['Recipe'])?></textarea>
          </div>

          <div class="conDiv" style="left:410px;top:700px;width:200px">
            <h4>Cocktail 설명:</h4>
          </div>
          <div class="conDiv" style="left:410px;top:755px">
            <textarea name="cocktailexplanation" style="width:750px;height:250px"><?=htmlspecialchars($row['Context'])?></textarea>
          <br><br>
          </div>
          <?php
        } ?>

        <div class="conDiv" style="left:940px;top:1020px;width:300px">
          <input type="submit"  value="수정하기" style="padding:5px 81px">
      <!--
          <input type="submit" onClick="location.href='http://1.247.212.109:8012/관리자_main.html'" value="등록하기" style="padding:5px 81px">
      -->
          <br><br>
        </div>
      </div>
    </form>
  </body>
  </html>

  <?php
} catch(Exception $Exception) {
  print "오류 : ".$Exception->getMessage();
}?>
