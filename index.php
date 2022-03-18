<!DOCTYPE html>
<head>

  <script src="https://kit.fontawesome.com/ebd9ab1bdb.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php error_reporting(0); ?>
    <div class="main_content_area">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
          <a class="navbar-brand" href="index.html"><div class="image"><img src="images/deventer.png"  class="img-fluid"></div></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                  <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="saved.php">Opgeslagen recepten</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="help.php">Help</a>
                </li>
              </ul>

              <!-- Button trigger modal -->
              <button style='display: flex;' type="button" class="btn" data-bs-toggle="modal" data-bs-target="#LoginModal">
                <?php
                session_start();
                if ($_SESSION["loggedin"]) {
                  echo '<p class="mx-3 my-auto">' . $_SESSION["username"] . '</p><i class="fa-solid fa-circle-user"></i>';
                } else {
                  echo '</p><i class="fa-solid fa-circle-user"></i>';
                }

                ?>
              </button>

              <!-- Modal -->
              <div class="modal fade" id="LoginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="loginModalLabel">Login</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body"> 
                      <?php 
                      session_start();
                      if ($_SESSION["loggedin"]) {
                        echo "<button onclick='window.location.href=\"logout.php\"' class='btn btn-danger'>Logout</button>";
                      } else {
                        echo "<button onclick='window.location.href=\"login.php\"' class='btn btn-danger'>Login</button>";
                        echo "<button onclick='window.location.href=\"register.php\"' class='btn btn-danger'>Register</button>";
                      }
                      ?>
                      </div>
                  </div>
                </div>
              </div>
          </div>
        </div>
      </nav>
      <div class="image_wrapper">
            <img src="images/restaurant.jpg" class="img-fluid">
      </div> 
      <div class="nieuwbutton"><button type="button" class="btn btn-danger"><i class="fa-solid fa-bookmark"></i> Opslaan</button></div>
      <div class="recipe_wrapper">
        <?php
          $api_url = 'https://aventus-173155.aventusfactory.nl/select_random_recipe.php';
		  $data = json_decode( file_get_contents($api_url), true);
		  
		  $gerecht = $data[0]['name'];
		  $recept = $data[0]['description'];
		  $ingredient = $data[0]['ingredients'];
		  $portie = $data[0]['portions'];
		  $foto_url = $data[0]['foto_url'];
		  $exploded_arr = explode (',', $ingredient, -1);
            echo '<h1 class="centered">Gerecht: '. $gerecht .'</h1>
            <div class="row">
              <div class="col-3">
                <img src="' . $foto_url . '" class="img-fluid">
              </div>
              <div class="col-9">
                <p class="fw-bold">Ingrediënten: <br>';
				foreach($exploded_arr as $exploded_arr) {
					echo $exploded_arr . '<br>';
				}
				echo '</p>
                <p class="fw-bold">Porties: ' . $portie . '</p>
                <p class="fw-bold">Recept: <br> ' . $recept . '</p>
              </div>
      </div>';
      ?>
      <div class="buttonrefresh"><button type="button" onClick="window.location.reload()" class="btn btn-danger"><i class="fa-solid fa-arrow-rotate-right"></i> Nieuw recept</button></div>
      <div class="footer py-2">
          <p>Telefoon: 06-12345678</p>
          <p>Email: placeholder@gmail.com</p>
          <p>Website: Website</p>
        </div> 
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>