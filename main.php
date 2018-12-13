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

  $sql = "SELECT id FROM account_info WHERE id LIKE :id AND pwd LIKE :pw";

  $stmh = $pdo -> prepare($sql);

  if(isset($_REQUEST['InputID'])) {
    $id = $_REQUEST['InputID'];
  } else {
    $id = "customer";
  }

  if(isset($_REQUEST['InputPW'])) {
    $pw = $_REQUEST['InputPW'];
  } else {
    $pw = "customer";
  }

  $stmh -> bindValue(':id', $id, PDO::PARAM_STR);
  $stmh -> bindValue(':pw', $pw, PDO::PARAM_STR);
  $stmh -> execute();

  $pdo -> commit();

  $count = $stmh->rowCount();

  if ($count == 0) {
    ?>
    <script type="text/javascript">
      window.alert("아이디 또는 패스워드를 잘 못입렸했습니다.\n다시 입력해주세요");
      location.href="http://localhost:8012/로그인 화면.html";
    </script>
    <?php
  }

  else {

      while ($row = $stmh -> fetch(PDO::FETCH_ASSOC)) {
      ?>
          <!DOCTYPE html>
          <html>
          <head>
          <title>Main Page</title>
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <style>
          body{
          	background-color: #facee1;
          }

          a{
              color: #e61b44;
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
          ul {
              list-style-type: none;
              margin-left: 500px;
              margin-top: 10px;
              padding: 0;
              overflow: hidden;
              background-color: #834a6c;
              width: 70%;
          }

          li {
              float: center;
          }

          li a {
              display: block;
              color: white;
              text-align: center;
              padding: 50px;
              text-decoration: none;
          }

          li a:hover {
              background-color: #512e47;
              color: white;
          }
          /* Create three equal columns that floats next to each other */
          .column {
              float: center;
              width: 33.33%;
              padding: 15px;
          }
          /* Clear floats after the columns */
          .row:after {
              content: "";
              display: table;
              clear: both;
          }

          /* Responsive layout - makes the three columns stack on top of each other instead of next to each other */
          @media screen and (max-width:1000px) {
              .column {
                  width: 100%;
              }
          }
          </style>
          </head>

          <body>

          <!--Title-->
          <div class="row">
          	<form class="SearchForm1" action="searchcocktail.php" method="post">
          		<div class="column">
          			<div style="position:absolute;left:200px;top:45px">
          				<h1 style="font-size:300%;color:#23212c;font-family: courier">Cocktail</h1>
          				<p style="color:#e61b44"><strong>A Enjoying Cocktail</strong></p>
          				<br>

          	<!--Search-->
          				<input name="cocktailname" type="text">
          				<input type="submit" value="Search">
          			</div>
          		</div>
          	</form>

          <!--Menu-->
          	<div class="column">
          		<ul style="position:absolute;width:350px;">
            		<li><a href="http://1.228.101.76:8012/All.html">ALL</a></li>
            		<li><a href="http://1.228.101.76:8012/Base.html">BASE</a></li>
            		<li><a href="http://1.228.101.76:8012/Usage.html">USAGE</a></li>
            		<li><a href="http://1.228.101.76:8012/NonAlcohol.html">NON-ALCOHOL</a></li>
            		<li><a href="http://1.228.101.76:8012/Q&A.html">Q&A</a></li>
          		</ul>
          	</div>

          <!--LOGIN-->
          	<div style="position:absolute;left:1270px;top:20px">
              <?php
              if ($id == "customer") {
                ?>
                <a href="http://localhost:8012/로그인 화면.html">Login</a>
                <!-- <a href="http://1.228.101.76:8012/%EB%A1%9C%EA%B7%B8%EC%9D%B8%20%ED%99%94%EB%A9%B4.html">Login</a> -->
                <?php
              } else {
                ?>
                <a href="main.php">Logout</a>
                <div style="position:absolute;left:100px;top:-15px">
                  <p><?=htmlspecialchars($row['id'])?></p>
                  <!-- <input type="text" name="MainUserID" value="<?=htmlspecialchars($id)?>"> -->
                </div>
                <?php
              }?>
          	</div>


          <!--Recommand & Best-->
          	<div class="column">
          		<div class="div-block">
             		<div style="position:absolute;left:970px;top:90px">
             			<img src="logo.png" width=20px height=20px>
             		</div>
             		<div style="position:absolute;left:1000px;top:80px;width:300px">
             			<a title="칵테일을 추천받으려면 클릭하세요." href="http://1.228.101.76:8012/Recommended_1.html" style="text-decoration:underline;font-size:25px;font-weight:bold;color:#23212c">Recommended Cocktail</a>
             		</div>

             		<div style="position:absolute;left:970px;top:205px">
             			<img src="logo.png" width=20px height=20px>
             		</div>
             		<div style="position:absolute;left:1000px;top:175px;width:300px">
             			<h2 style="color:#23212c">Best List</h2>
             		</div>
             		<div style="position:absolute;left:1370px;top:220px">
             			<a href="http://1.228.101.76:8012/Best.html" style="text-decoration:underline">more</a>
             		</div>

             		<div style="position:absolute;left:970px;top:255px;width:300px">
             		<table Border="1px" style="width:150%;border:2px solid">
               		<tr>
                 		<td><img src="칵테일_사진.png" width=100% height=100%></td>
                 		<td><img src="칵테일_사진.png" width=100% height=100%></td>
               		</tr>
               		<tr>
                 		<td><img src="칵테일_사진.png" width=100% height=100%></td>
                 		<td><img src="칵테일_사진.png" width=100% height=100%></td>
               		</tr>
             		</table>
             		</div>
          		</div>
          	</div>
          </div>

          </body>
          </html>
          <?php
      }
  }
} catch (Exception $Exception) {
  print "오류 .".$Exception->getMessage();
}?>
