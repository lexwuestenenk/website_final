<?php
   
  function preprint_r( $arr ) {
    echo '<pre>'; 
    print_r( $arr );
    echo '</pre>'; 
  }  

  
  //verdindingsvariabelen database 
$host = 'localhost';
$db = 'aventus-173155_database';
$user = 'aventus-173155_lexwuestenenk';
$pass = 'muF8wHntc&3z8xkB';
$charset = 'utf8mb4';
  
  
  //connection string en PDO settings
  $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
  $options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
  ];
  
  
  //verbinding maken met database
  try {
    $pdo = new PDO($dsn, $user, $pass, $options);
  } catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
  }   

$stmt2 = $pdo->query ("SELECT * FROM restaurant ORDER BY RAND() LIMIT 1;");

	  
$restaurants = [];
while( $row = $stmt2->fetch() ) {
	$restaurants[] = ['id' => $row['Restaurant_ID'],
					  'name' => $row['Naam']
					 ];
}
    
$stmt = $pdo->query ("SELECT * FROM recept WHERE `RESTAURANT_Restaurant_ID` LIKE {$restaurants[0]['id']} ORDER BY RAND() LIMIT 1");

$recipes = [];
while( $row = $stmt->fetch() ) {
    $recipes[] = ['recipe_id' => $row['Recept_ID'],
                      'name' => $row['Naam'],
                      'description' => $row['Omschrijving'],
                      'ingredients' => $row['Ingredienten'],
                      'portions' => $row['Personen'],
                      'cooking_time' => $row['Bereidingstijd'],
                      'restaurant_id' => $row['RESTAURANT_Restaurant_ID'],
				  	  'foto_url' => $row['Foto']
                     ];
}

      header( 'Content-type: application/json');
      echo json_encode( $recipes );

?> 