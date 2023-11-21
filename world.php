<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';



$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$stmt = $conn->prepare("SELECT * FROM countries WHERE name LIKE :country");

$country = $_GET['country'];
$country = "%" . filter_input(INPUT_GET, "country", FILTER_SANITIZE_STRING) . "%"; 

$stmt->bindParam(':country', $country, PDO::PARAM_STR);
$stmt->execute(); 

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<table>
  <thead>
    <tr>
      <th>Name</th>
      <th>Continent</th>
      <th>Independence</th>
      <th>Head of State</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($results as $row): ?>
    <tr>
      <td><?= $row['name']; ?></td>
      <td><?= $row['continent']; ?></td>
      <td><?= $row['independence_year']; ?></td>
      <td><?= $row['head_of_state']; ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>