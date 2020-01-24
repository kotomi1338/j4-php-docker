<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>S-2 PHP</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
  <?php
  $server = "j4-php-docker_db_1";
  $database = "r01_j4_exp";
  $port_number = 5432;
  $user_id = "mk16186";
  $user_password = "mk16186";
  $connect = new PDO("pgsql:host = $server; dbname = $database; port = $port_number; user = $user_id; password = $user_password");

  $sql_text = "select * from company_36";
  $result = $connect->query($sql_text);

  print "<h3>データベース検索結果</h3>\n";
  print "<table boder=1 cellspacing=1 cellpadding=1>\n";
  print "<tr>";
  print "<th>企業コード</th>";
  print "<th>企業名</th>";
  print "<th>所在地</th>";
  print "<th>電話番号</th>";
  print "<th>従員数</th>";
  print "</tr>";
  $rs = $result->fetchall();
  foreach ($rs as $row) :
    print "<tr>";
    print '<td>' . $row['code'] . "</td>";
    print '<td>' . $row['name'] . "</td>";
    print '<td>' . $row['address'] . "</td>";
    print '<td>' . $row['phone'] . "</td>";
    print '<td>' . $row['labors'] . "</td>";
    print '</tr>';
  endforeach;
  print "</table>\n";

  ?>
</body>

</html>