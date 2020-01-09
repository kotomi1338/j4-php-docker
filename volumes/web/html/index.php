<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Hello PHP</title>
</head>

<body>
  <?php
    //DBシステムの接続情報設定
    $server = "j4-php-docker_db_1";
    $database = "r01_j4_exp";
    $port_number = 5432;
    $user_id = "mk16186";
    $user_password = "mk16186";
    //DBシステムとの接続
    $connect = new PDO("pgsql:host = $server; dbname = $database; port = $port_number; user = $user_id; password = $user_password");

    //SQL文の定義
    $sql_text = "select * from company_36";
    //DBの検索
    $result = $connect -> query($sql_text);
    //HTML表の作成
    print "<h3>データベース検索結果</h3>\n";
    print "<table boder=1 cellspacing=1 cellpadding=1>\n";
    print "<tr>";
    print "<th>企業コード</th>";
    print "<th>企業名</th>";
    print "<th>所在地</th>";
    print "<th>電話番号</th>";
    print "<th>従員数</th>";
    print "</tr>";
    $rs = $result -> fetchall();
    foreach ($rs as $row) :
        print "<tr>";
        print '<td>'.$row['code']."</td>";
        print '<td>'.$row['name']."</td>";
        print '<td>'.$row['address']."</td>";
        print '<td>'.$row['phone']."</td>";
        print '<td>'.$row['labors']."</td>";
        print '</tr>';
    endforeach;
    print "</table>\n";


  ?>

<style>
  table {
    border-collapse: collapse;
  }
  td {
    border: solid 1px;
    padding: 0.5em;
  }
</style>

</body>
</html>