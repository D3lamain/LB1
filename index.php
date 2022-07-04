<?php
$db = new PDO("mysql:host=127.0.0.1;dbname=shop", "root", "");
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        table, td, th {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>
<body>
<form action="" method="post">
    <input type="text" name="vendor">
    <input type="submit" value="find"><br>

</form>
<br>
<form action="" method="post">
    <input type="text" name="category">
    <input type="submit" value="find"><br>

</form>
<br>
<form action="" method="post">
    <input placeholder="Min:" type="text" name="min_price">
    <input placeholder="Max:" type="text" name="max_price">
    <input type="submit" value="find"><br>

</form>
<hr>
<?php


if (isset($_POST["vendor"])) {
    $statement = $db->prepare("SELECT items.name, price, quantity, quality FROM items inner join vendors on FID_Vender = ID_Vendors WHERE Vendors.name=?");
    $statement->execute([$_POST["vendor"]]);
    echo "<table>";
    echo " <tr>
 <th> name  </th>
 <th> price </th>
 <th> quantity </th>
 <th> quality </th>
</tr> ";
    while ($data = $statement->fetch()) {
        echo " <tr>
 <th> {$data['name']}  </th>
 <th> {$data['price']} </th>
 <th> {$data['quantity']} </th>
 <th> {$data['quality']} </th>
</tr> ";
    }
    echo "</table>";
}

if (isset($_POST["category"])) {
    $statement = $db->prepare("SELECT items.name, price, quantity, quality FROM items inner join Categories on FID_Category = ID_Categories WHERE Categories.name=?");
    $statement->execute([$_POST["category"]]);
    echo "<table>";
    echo " <tr>
 <th> name  </th>
 <th> price </th>
 <th> quantity </th>
 <th> quality </th>
</tr> ";
    while ($data = $statement->fetch()) {
        echo " <tr>
 <th> {$data['name']}  </th>
 <th> {$data['price']} </th>
 <th> {$data['quantity']} </th>
 <th> {$data['quality']} </th>
</tr> ";
    }
    echo "</table>";
}
if (isset($_POST["min_price"])) {
    $statement = $db->prepare("SELECT items.name, price, quantity, quality FROM items WHERE price between ? and ?");
    $statement->execute([$_POST["min_price"], $_POST["max_price"]]);
    echo "<table>";
    echo " <tr>
 <th> name  </th>
 <th> price </th>
 <th> quantity </th>
 <th> quality </th>
</tr> ";
    while ($data = $statement->fetch()) {
        echo " <tr>
 <th> {$data['name']}  </th>
 <th> {$data['price']} </th>
 <th> {$data['quantity']} </th>
 <th> {$data['quality']} </th>
</tr> ";
    }
    echo "</table>";
}
?>
</body>
</html>
