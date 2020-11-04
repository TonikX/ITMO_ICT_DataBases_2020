<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <title>Exchange – Batches</title>
        <style>
            h1 {
                margin: 40px;
            }
        </style>
    </head>
    <body>
		<div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home.html">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Batches</li>
                </ol>
            </nav>
            <h1 class="display-6">Batches</h1>
            <div class="container">
                <?php
                    session_start();
                    include '../../common.php';
                    $pdo = get_db();
                    $stmt = $pdo->query("SELECT * FROM commodities.\"Batches\" ORDER BY \"ID\" ASC ");
                ?>
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="row">ID</th>
                        <th scope="col">Manufacturer_ID</th>
                        <th scope="col">Product_ID</th>
                        <th scope="col">Shipment_ID</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Produced_at</th>
                        <th scope="col">Expires_at</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = $stmt->fetch()) { ?>
                            <tr>
                                <td><b><?=$row['ID']?></b></td>
                                <td><?=$row['Manufacturer_ID']?></td>
                                <td><?=$row['Product_ID']?></td>
                                <td><?=$row['Shipment_ID']?></td>
                                <td><?=$row['Price']?></td>
                                <td><?=$row['Quantity']?></td>
                                <td><?=$row['Produced_at']?></td>
                                <td><?=$row['Expires_at']?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <?php
            if (isset($_SESSION['error'])) {
                echo "<div class=\"alert alert-danger\" role=\"alert\">";
                echo $_SESSION['error'];
                echo "</div>";
                unset($_SESSION['error']);
            }
            ?>
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-sm-6">
                    <h2>Add a new batch.</h2>
                    <form action="/sections/batches/add.php" method="post">
                        <div class="form-group">
                            <label>Manufacturer_ID</label>
                            <input name="Manufacturer_ID" class="form-control" placeholder="Manufacturer X">
                        </div>
                        <div class="form-group">
                            <label>Product_ID</label>
                            <input name="Product_ID" class="form-control" placeholder="Product Y">
                        </div>
                        <div class="form-group">
                            <label>Shipment_ID</label>
                            <input name="Shipment_ID" class="form-control" placeholder="Shipment Z">
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input name="Price" class="form-control" placeholder="XXX">
                        </div>
                        <div class="form-group">
                            <label>Quantity</label>
                            <input name="Quantity" class="form-control" placeholder="YYYY">
                        </div>
                        <div class="form-group">
                            <label>Produced_at</label>
                            <input type="date" name="Produced_at" class="form-control" placeholder="MM-DD-YYYY HH-MM-SS">
                        </div>
                        <div class="form-group">
                            <label>Expires_at</label>
                            <input type="date" name="Expires_at" class="form-control" placeholder="MM-DD-YYYY HH-MM-SS">
                        </div>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>
                <div class="col-sm-6">
                <h2>Remove an existing batch.</h2>
                <form action="/sections/batches/delete.php" method="post">
                    <div class="form-group">
                        <label>ID</label>
                        <input name="id" class="form-control" placeholder="X">
                    </div>
                    <button type="submit" class="btn btn-primary">Remove</button>
                </form>
                </div>
            </div>

            
		</div>
		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    </body>
</html>