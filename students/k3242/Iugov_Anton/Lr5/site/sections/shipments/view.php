<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <title>Exchange – Shipments</title>
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
                    <li class="breadcrumb-item active" aria-current="page">Shipments</li>
                </ol>
            </nav>
            <h1 class="display-6">Shipments</h1>
            <div class="container">
                <?php
                    session_start();
                    include '../../common.php';
                    $pdo = get_db();
                    $stmt = $pdo->query("SELECT * FROM commodities.\"Shipments\" ORDER BY \"Shipped_at\" ASC ");
                ?>
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="row">ID</th>
                        <th scope="col">Broker ID</th>
                        <th scope="col">Items</th>
                        <th scope="col">Subtotal</th>
                        <th scope="col" style="text-align: center;">Prepayment</th>
                        <th scope="col">Shipped at</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = $stmt->fetch()) { ?>
                            <tr>
                                <td><?=$row['ID']?></td>
                                <td><?=$row['Broker_ID']?></td>
                                <td><?=$row['Items']?></td>
                                <td><?=$row['Subtotal']?></td>
                                <td style="text-align: center;"><?php if ($row['Prepayment']) { echo "<svg width=\"2em\" height=\"2em\" viewBox=\"0 0 16 16\" class=\"bi bi-check\" fill=\"currentColor\" xmlns=\"http://www.w3.org/2000/svg\"> <path fill-rule=\"evenodd\" d=\"M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z\"/></svg>"; } ?></td>
                                <td><?=$row['Shipped_at']?></td>
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
            <div class="row">
                <div class="col-sm-6">
                    <h2>Add a new shipment.</h2>
                    <form action="/sections/shipments/add.php" method="post">
                        <div class="form-group">
                            <label>Broker ID</label>
                            <input name="Broker_ID" class="form-control" placeholder="Broker X">
                        </div>
                        <div class="form-group">
                            <label>Items</label>
                            <input name="Items" class="form-control" placeholder="Y">
                        </div>
                        <div class="form-group">
                            <label>Subtotal</label>
                            <input name="Subtotal" class="form-control" placeholder="YYYYY">
                        </div>
                        <div class="form-check">
                            <input value="Yes" name="Prepayment" type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Prepayment</label>
                        </div>
                        <div class="form-group">
                            <label>Shipped at</label>
                            <input type="date" name="Shipped_at" class="form-control" placeholder="MM-DD-YYYY HH-MM-SS">
                        </div>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>
                <div class="col-sm-6">
                <h2>Remove an existing shipment.</h2>
                <form action="/sections/shipments/delete.php" method="post">
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