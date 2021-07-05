<div class="container"><!--***CONTAINER START***-->

  <div class="row"><!--***ROW START***-->

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary"><!--***NAVBAR START***-->

      <div class="container-fluid">

        <a class="navbar-brand" href="index.php">Cinéstudi</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

          <ul class="navbar-nav me-auto mb-2 mb-lg-0">

            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="index.php">Accueil</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="#">Actuellement</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="#">Prochainement</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="#">Contact</a>
            </li>

           <!--***Ajout du lien réservations dans la barre du menu si le client posssède une ou plusieurs réservations***-->
           <li class='nav-item'>
              <?php 
                if(!empty($_SESSION["resa"])) {
                  echo "<a href='reservations.php' class='nav-link active'>Reservations</a>";
                }
              ?>
            </li>
            
            <!--***Ajout du lien Admin dans la barre du menu si le client posssède un compte***-->
            <li class='nav-item'>
              <?php 
                if(isset($_SESSION["client"])) {
                  if($_SESSION["client"]["role"] !== '[\"role_user\"]') {
                    echo "<a href='admin.php' class='nav-link active'>Admin</a>";
                  } 
                }
              ?>
            </li>

            <!--***Ajout du lien admin dans la barre du menu si l'administrateur est connecté***-->
            <li class='nav-item'>
              <?php 
                if(isset($_SESSION["client"])) {
                  echo "<a href='profil.php' class='nav-link active'>Profil</a>";
                }
              ?>
            </li>

            <!--***Si l'utilisateur est connecté, les le lien deconnxion s'affichera, et si il est déconnecté, les liens inscriptions et connexion s'afficheront***-->
            <li class="nav-item dropdown">
              <a class="nav-link active dropdown-toggle" href="profil.php" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="far fa-user"></i>
              </a>
          
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <?php if(!isset($_SESSION["client"]["id"])): ?>
                  <li><a class="dropdown-item" href="inscription.php">Inscription</a></li>
                  <li><a class="dropdown-item" href="connexion.php">Connexion</a></li>
                <?php else: ?>
                  <li><a class="dropdown-item" href="deconnexion.php">Déconnexion</a></li>
                <?php endif; ?>
              </ul>
        
            </li>

          </ul>

        </div>

      </div>

    </nav><!--***NAVBAR END***-->

  </div><!--***ROW END***-->

</div><!--***CONTAINER END***-->