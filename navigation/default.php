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
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Master Data
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="../product/">Product</a></li>
                        <li><a class="dropdown-item" href="../wip/">Work in Process</a></li>
                        <li><a class="dropdown-item" href="../raw-material/index.php">Raw Material</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Production
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="../production/arrival.php">Product Arrival</a></li>
                        <li><a class="dropdown-item" href="../production/departure.php">Product Departure</a></li>
                        <li><hr></li>
                        <li><a class="dropdown-item" href="../production/raw-material-arrival.php">Raw Material Arrival</a></li>
                        <li><a class="dropdown-item" href="../production/raw-material-departure.php">Raw Material Departure</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Report
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="../report/production-rate.php">Production Rate</a></li>
                        <li><a class="dropdown-item" href="../report/defect.php">Defect</a></li>
                        <li><hr></li>
                        <li><a class="dropdown-item" href="../report/accounting.php">Accounting</a></li>
                    </ul>
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