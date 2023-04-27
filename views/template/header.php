<html>

<body class="bg-light">
  <header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
      <div class="container">
        <a class="navbar-brand" href="index.php">Accueil</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="index.php?page=search">Rechercher un client</a>
            </li>
            <?php if (isset($_SESSION) && $_SESSION['logged']) { ?>
              <li class="nav-item">
                <a class="nav-link" href="index.php?page=login&action=logout">Se déconnecter</a>
              </li>
            <?php } else { ?>
            <li class="nav-item"><a class="nav-link" href="index.php?page=login">Se connecter</a></li>
            <?php } ?>
          </ul>
        </div>
      </div>
    </nav>
  </header>
  <main>