<?php
include '../model/Product.php';
include '../model/Wip.php';
include '../config/auth.php';
include '../config/supervisor.php';

$product = new Product();
$wip = new WIP();
$results = $product->productReport($_POST['id'], $_POST['start'],$_POST['end']);
$wips = $wip->wipReport($_POST['start'],$_POST['end']);
$productionRate = $product->ProductionRate($_POST['id'], $_POST['start'],$_POST['end']);
$WIPRate = $product->WIPRate($_POST['id'], $_POST['start'], $_POST['end']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Stirling Company - Raw Material Master</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <div class="p-5 bg-primary text-white text-center">
        <h1>The Stirling Company</h1>
        <p>Production Information System</p>
    </div>
    <?php include('../navigation/index.php') ?>
    <div class="container mt-5">

        <?php if (isset($_GET['message'])) {
            if ($_GET['message'] == "add-success") {
        ?>
                <div class="alert alert-success" role="alert">
                    Data succesfully added.
                </div>
            <?php } elseif ($_GET['message'] == "edit-success") { ?>
                <div class="alert alert-success" role="alert">
                    Data succesfully edited.
                </div>

            <?php } elseif ($_GET['message'] == "delete-success") { ?>
                <div class="alert alert-success" role="alert">
                    Data succesfully deleted.
                </div>

        <?php }
        } ?>
        <div class="row mb-5">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Production Rate</h5>
                            <span><?= $productionRate ?>Product</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total Production/WIP</h5>
                            <span><?= $WIPRate ?></span>
                        </div>
                    </div>
                </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <h5 class="card-title">WIP Report</h5>
                            </div>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Workstation</th> 
                                    <th scope="col">Date</th>
                                    <th scope="col">Qty</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($wips as $wip) { ?>
                                    <tr>
                                        <th scope="row"><?= $i ?></th>
                                        <td><?= $wip['origin'] ?></td>
                                        <td><?= $wip['log_date'] ?></td>
                                        <td><?= $wip['qty'] ?></td>
                                    </tr>
                                <?php $i++;
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <h5 class="card-title">Production Report</h5>
                            </div>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Qty</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($results as $result) { ?>
                                    <tr>
                                        <th scope="row"><?= $i ?></th>
                                        <td><?= $result['log_date'] ?></td>
                                        <td><?= $result['qty'] ?></td>
                                    </tr>
                                <?php $i++;
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-5 p-4 bg-dark text-white text-center">
        <p>&copy 2022 RYP x Ensyse Laboratory</p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>