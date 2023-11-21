<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

if (isset($_GET['country'])){
    $country = "%" . filter_input(INPUT_GET, "country", FILTER_SANITIZE_STRING) . "%"; 

    if (isset($_GET['lookup']) && $_GET['lookup'] === 'cities') {
      $stmt = $conn->prepare("SELECT cities.name, cities.district, cities.population
                              FROM cities
                              JOIN countries ON cities.country_code = countries.code
                              WHERE countries.name LIKE :country");
    }else{
      $stmt = $conn->prepare("SELECT * FROM countries WHERE name LIKE :country");
    }
  }

$stmt->bindParam(':country', $country, PDO::PARAM_STR);
$stmt->execute(); 

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<table>
  <thead>
  <?php if (isset($_GET['lookup']) && $_GET['lookup'] === 'cities'): ?>
      <tr>
        <th>Name</th>
        <th>District</th>
        <th>Population</th>
      </tr>
  <?php else: ?>  
      <tr>
        <th>Name</th>
        <th>Continent</th>
        <th>Independence</th>
        <th>Head of State</th>
      </tr>
    <?php endif; ?>
  </thead>
  <tbody>
    <?php foreach ($results as $row): ?>
      <tr>
        <?php if (isset($_GET['lookup']) && $_GET['lookup'] === 'cities'): ?>  
          <td><?= $row['name']; ?></td>
          <td><?= $row['district']; ?></td>
          <td><?= $row['population']; ?></td>
        <?php else: ?> 
          <td><?= $row['name']; ?></td>
          <td><?= $row['continent']; ?></td>
          <td><?= $row['independence_year']; ?></td>
          <td><?= $row['head_of_state']; ?></td> 
        <?php endif; ?>      
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>