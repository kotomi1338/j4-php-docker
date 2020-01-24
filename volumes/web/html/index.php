<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>S-2 PHP</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
  <form method="post" action="index.php">
    <h3>企業名部分一致検索</h3>
    キーワード:
    <input type="text" name="keyword">
    フィールド項目:
    <select name="item">
      <option value="code">企業コード</option>
      <option value="name">企業名</option>
      <option value="address">所在地</option>
      <option value="phone">電話番号</option>
      <option value="labors">従業員数</option>
    </select>
    ソート順:
    <select name="sort">
      <option value="asc">昇順</option>
      <option value="desc">降順</option>
    </select>
    <input type="submit" name="button" value="検索">
  </form>
  <br>

  <?php
  if (!empty($_POST['keyword'])) {
    $keyword = $_POST['keyword'];
    $keyword = trim($keyword, '\\0');
    $keyword = preg_replace("/( |　| |%|_|'|<|>)/", "", $keyword);
    $keyword = stripslashes($keyword);
    $sort = $_POST['sort'];
    $item = $_POST['item'];

    $server = "j4-php-docker_db_1";
    $database = "r01_j4_exp";
    $port_number = 5432;
    $user_id = "mk16186";
    $user_password = "mk16186";
    $connect = new PDO("pgsql:host = $server; dbname = $database; port = $port_number; user = $user_id; password = $user_password");

    $search_sql = "SELECT * FROM company_36 WHERE name LIKE '%" . $keyword . "%' ORDER BY " . $item . " " . $sort;
    $stmt = $connect->query($search_sql);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    require_once("Company.php");
    $company = [];
    foreach ($result as $row) {
      $company[] = new Company($row['code'], $row['name'], $row['address'], $row['phone'], $row['labors']);
    }

    $sort_word = $sort == "asc" ? "昇順" : "降順";
    switch ($item) {
      case "code":
        $item_word = "企業コード";
        break;
      case "name":
        $item_word = "企業名";
        break;
      case "address":
        $item_word = "所在地";
        break;
      case "phone":
        $item_word = "電話番号";
        break;
      case "labors":
        $item_word = "従業員数";
        break;
    }

    echo "検索キーワード: " . $keyword . "<br>";
    echo $item_word . "<br>";
    echo $sort_word . "<br>";
    echo "検索件数: " . htmlspecialchars(count($company), ENT_QUOTES, 'UTF-8') . "件\n<br>\n";

    if (count($company) != 0) {
      echo "<table>\n";
      echo "<tr>\n";
      echo "<th>企業コード</th>";
      echo "<th>企業名</th>";
      echo "<th>所在地</th>";
      echo "<th>電話番号</th>";
      echo "<th>従業員数</th>\n";
      echo "
    <tr>\n";
      foreach ($company as $row) {
        echo "
    <tr>\n";
        echo "<td>" . htmlspecialchars($row->get_code(), ENT_QUOTES, 'UTF-8') . "</td>\n";
        echo "<td>" . htmlspecialchars($row->get_name(), ENT_QUOTES, 'UTF-8') . "</td>\n";
        echo "<td>" . htmlspecialchars($row->get_address(), ENT_QUOTES, 'UTF-8') . "</td>\n";
        echo "<td>" . htmlspecialchars($row->get_phone(), ENT_QUOTES, 'UTF-8') . "</td>\n";
        echo "<td class=labors_right>" . htmlspecialchars(number_format($row->get_labors()), ENT_QUOTES, 'UTF-8') . "</td>\n";
        echo "</tr>\n";
      }
      echo "
  </table>\n";
    }
    echo "</table>\n";
  } else {
    echo "キーワードを入力してね！";
  }

  ?>
</body>

</html>