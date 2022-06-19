<?php
include '../model/Wip.php';
include '../config/auth.php';
include '../config/supervisor.php';

$db = new WIP();
$bom = $db->getWIPDetail($_GET['id']);
$material = $db->getMaterial($bom['raw_material_id']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Handszer Corporation - Add BPM </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <div class="p-5 bg-danger text-white text-center">
        <h1>Handszer Corporation</h1>
        <p>Production Handsbox Information system</p>
    </div>
    <?php include('../navigation/index.php') ?>
    <div class="container mt-5">
        <div class="row">

            <?php if (isset($_GET['message'])) {
                if ($_GET['message'] == "success") {
            ?>
                    <div class="alert alert-success" role="alert">
                        Data succesfully changed.
                    </div>
            <?php }
            } ?>

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit Material for BOM</h5>
                        <form action="process.php?action=edit-bom" method="POST">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Material</label>
                                <input type="text" name="material" class="form-control" value="<?=$material['name']?>" readonly>
                                <div id="emailHelp" class="form-text">Input the product name.</div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Quantity</label>
                                <input type="text" name="qty" class="form-control" value="<?=$bom['qty']?>">
                                <input type="hidden" name="id" value="<?=$_GET['id']?>" class="form-control">
                                <input type="hidden" name="wip_id" value="<?=$_GET['wip']?>" class="form-control">
                                <div id="emailHelp" class="form-text">Input the quantitiy of material.</div>
                            </div>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div class="mt-5 p-4 bg-secondary text-white text-center">
    <p>&copy Handszer Corporate</p>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>