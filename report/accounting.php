<?php
include '../model/Product.php';
include '../model/RawMaterial.php';
include '../config/auth.php';
include '../config/supervisor.php';

$material = new RawMaterial();
$product = new Product();
$materials = $material->rawMaterialValues();
$material_value = $material->totalRawMaterialValues();
$products = $product->productValues();
$product_value = $product->totalProductValues();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Stirling Company - Accounting Report</title>
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
                        <h5 class="card-title">Defect in WS 1 </h5>
                        <h1 class="text-mute">IDR <?=$product_value?></h1>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Defect in WS 2 </h5>
                        <span><?= $product_value ?> Product</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <h5 class="card-title">Product Report</h5>
                            </div>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Qty</th>
                                    <th scope="col">Cost of Goods Sold</th>
                                    <th scope="col">Selling Price</th>
                                    <th scope="col">Total COGS</th>
                                    <th scope="col">Total Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($products as $product) { ?>
                                    <tr>
                                        <th scope="row"><?= $i ?></th>                                        ....
                                        <td><?= $product['name'] ?></td>  
                                        <td><?= $product['qty'] ?></td>  
                                        <td><?= $product['cogs'] ?></td>  
                                        <td><?= $product['selling_price'] ?></td>  
                                        <td><?= $product['total'] ?></td>  
                                        <td><?= $product['margin'] ?></td>  
                                    </tr>
                                <?php $i++;
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <h5 class="card-title">Inventory Report</h5>
                            </div>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Qty</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($materials as $material) { ?>
                                    <tr>
                                        <td><?= $material['name'] ?></td>  
                                        <td><?= $material['qty'] ?></td> 
                                        <td><?= $material['price'] ?></td>  
                                        <td><?= $material['total'] ?></td> 
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