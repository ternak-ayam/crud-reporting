<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="../home/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="../workstation/raw-material-arrival.php">Raw Material Arrival</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="../workstation/wip-arrival.php">WIP Arrival</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="../workstation/wip-finished.php">WIP Finished</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="../workstation/product-finished.php">Product Finished</a>
                </li>

            </ul>
            <?php if ($_SESSION['status'] == "login") { ?>
                <span class="me-4">Hello, Welcome Handszer Corporate!</span>
                <a href="../auth/process.php?action=logout" class="btn btn-outline-danger">Logout</a>
            <?php } else { ?>
                <a href="../auth/index.php" class="btn btn-outline-danger">Login</a>
            <?php } ?>
        </div>
    </div>
</nav>