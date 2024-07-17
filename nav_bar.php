<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #6c63ff ; ">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">ENSET</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <?php if(isset($_SESSION['userID'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Se déconnecter</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="signup.php">S'inscrire</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Se connecter</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>