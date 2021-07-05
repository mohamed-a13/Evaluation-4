<div class="container carousel1"><!--***CONTAINER START***-->

  <div class="row"><!--***ROW START***-->

    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel"><!--***CAROUSEL START***-->

      <div class="carousel-indicators">
      
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
  
      </div>
      <!--En cliquant sur une image, le client si il possède un compte sera amené sur la page pour réserver ou sinon sur la page de connexion-->
      <div class="carousel-inner">
        <div class="carousel-item active">
          <a href="<?php if(!isset($_SESSION["client"])) {
            echo "connexion.php";
            } else {
            echo "reservez.php";
            } ?>" name="image"><img src="img/tometjerry.jpg" class="d-block w-100" alt="Affiche de Tom et Jerry"></a>
          <div class="carousel-caption d-none d-md-block">
            <h5>Tom et Jerry</h5>
          </div>
        </div>

        <div class="carousel-item">
          <a href="<?php if(!isset($_SESSION["client"])) {
            echo "connexion.php";
            } else {
            echo "reservez.php";
            } ?>"><img src="img/tempete.jpg" class="d-block w-100" alt="Affiche de tempête de boulettes géantes"></a>
          <div class="carousel-caption d-none d-md-block">
            <h5>Tempête de boulettes géantes</h5>
          </div>
        </div>

        <div class="carousel-item">
          <a href="<?php if(!isset($_SESSION["client"])) {
          echo "connexion.php";
          } else {
          echo "reservez.php";
          } ?>"><img src="img/monstres.jpg" class="d-block w-100" alt="Affiche de monstres et compagnies"></a>
          <div class="carousel-caption d-none d-md-block">
            <h5>Monstres et compagnies</h5>
          </div>
        </div>

      </div>

      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Precedent</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Suivant</span>
      </button>

    </div><!--***CAROUSEL END***-->

  </div><!--***ROW END***-->

</div><!--***CONTAINER END***-->

