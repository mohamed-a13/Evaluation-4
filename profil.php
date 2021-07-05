<?php

  session_start();

  $title = "Profil";

  include_once "includes/header.php";

  include_once "includes/nav.php"; 

?>

<div class="container mb-5">

  <div class="row d-flex justify-content-center">
  
    <div class="col-md-10  pt-5">
    
      <div class="row z-depth-3">
      
        <div class="col-sm-4 bg-primary rounded-left">
        
          <div class="card-block text-center text-white">

          
            <i class="fas fa-users fa-7x mt-5"></i>
            <h2><?php if(isset($_SESSION["client"]["nom"])) {echo $_SESSION['client']['nom'] . " " . $_SESSION['client']['prenom'];}; ?></h2>
            <a href="reservez.php" class="btn btn-light mb-5">Réservez</a>
          
          </div>
        
        </div>

        <div class="col-sm-8 bg-white rounded-right">
        
          <h3 class="mt-3 text-center text-primary">Reservations</h3>
          <hr class="bg-primary text_center">
          <div class="row">
          
            <div class="col-12">
            
              <p class="font-weight-bold"><?= $_SESSION["client"]["mail"] ?></p>
              <?php
                if(!empty($_SESSION["resa"]["idResa"])) {
                  echo "<a href='reservations.php'>Consultez mes reservations</a>";
                } else {
                  echo "Vous n'avez aucune réservations";
                }
              ?>

            </div>

          </div>

          

        </div>
      </div>
    
    </div>
  
  </div>

</div>

<?php

  include_once "includes/footer.php";

?>