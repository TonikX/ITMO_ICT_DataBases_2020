<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <title>Exchange – Products</title>
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
                    <li class="breadcrumb-item active" aria-current="page">Products</li>
                </ol>
            </nav>
            <h1 class="display-6">Products</h1>
            <?php
                session_start();
                include '../../common.php';
                $pdo = get_db();
                $stmt = $pdo->query("SELECT * FROM commodities.\"Products\" ORDER BY \"ID\" ASC ");
            ?>
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">Unit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = $stmt->fetch()) { ?>
                        <tr>
                            <td><?=$row['ID']?></td>
                            <td><?=$row['Title']?></td>
                            <td><?=$row['Unit']?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?php
            if (isset($_SESSION['error'])) {
                echo "<div class=\"alert alert-danger\" role=\"alert\">";
                echo $_SESSION['error'];
                echo "</div>";
                unset($_SESSION['error']);
            }
            ?>
            <div class="row" style="margin-bottom: 20px;">
                <div class="col">
                    <h2>Add a new product.</h2>
                    <form action="/sections/products/add.php" method="post">
                        <div class="form-group">
                            <label>Title</label>
                            <input name="title" class="form-control" placeholder="Product X">
                        </div>
                        <div class="form-group">
                            <label>Units</label>
                            <input name="units" class="form-control" placeholder="pcs">
                        </div>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>
                <div class="col">
                <h2>Remove an existing product.</h2>
                <form action="/sections/products/delete.php" method="post">
                    <div class="form-group">
                        <label>ID</label>
                        <input name="product_id" class="form-control" placeholder="X">
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