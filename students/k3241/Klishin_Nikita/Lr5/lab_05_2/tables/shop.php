<?php
$title = 'Куры';
include("../header.php");
?>

<section>
    <h3 style="margin-left: 30px; margin-top: 20px">Цеха</h3>
</section>

<section>
    <div class="container-fluid" style="margin-top: 30px">
        <div class="row">
            <div class="col-8">
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th scope="col">id_shop</th>
                        <th scope="col">Номер цеха</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $dbuser = "postgres";
                    $dbpass = "02588522";
                    $host = "localhost";
                    $dbname = "lab_03";
                    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser, $dbpass);
                    $data = $pdo->query("SELECT * FROM shop ORDER BY id_shop");
                    while ($row = $data->fetch()) {
                        echo '<tr style="position: static">';
                        echo '<th scope="row" style="position: relative">' . $row["id_shop"];
                        echo '<a class="stretched-link" href="/tables/shop.php?id_shop=' . $row["id_shop"] . '">';
                        echo '</th>';
                        echo '<td>' . $row["number_of_shop"] . '</td>';
                        echo '</a>';
                        echo '</tr>';
                    }
                    ?>
                </table>
            </div>
            <div class="col-4">
                <?php
                $d_shop = 0;
                $number_of_shop = 0;
                if (isset($_GET["add"])) {
                    $sql = "INSERT into shop (number_of_shop) VALUES (?)";
                    $pdo->prepare($sql)->execute([$_GET["number_of_shop"]]);
                    //header("Location: /tables/chicken.php");
                } elseif (isset($_GET["save"])) {
                    $sql = "UPDATE shop SET number_of_shop = ? WHERE id_shop = ?";
                    $pdo->prepare($sql)->execute([$_GET["number_of_shop"], $_GET["id_shop"]]);
                    header("Location: /tables/shop.php");
                } elseif (isset($_GET["delete"])) {
                    $sql = "DELETE FROM shop WHERE id_shop = ?";
                    $pdo->prepare($sql)->execute([ $_GET["id_shop"]]);
                    //header("Location: /tables/chicken.php");
                }elseif (isset($_GET["id_shop"])) {
                    $data = $pdo->query("SELECT * FROM shop WHERE shop.id_shop = {$_GET["id_shop"]}");
                    $row = $data->fetch();
                    $id_shop = $row['id_shop'];
                    $number_of_shop = $row['number_of_shop'];
                }
                ?>
                <form action="/tables/shop.php">
                    <input type="hidden" class="form-control" name="id_shop" value="<?php echo $id_shop ?>">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Номер цеха</label>
                        <input type="number" class="form-control" name="number_of_shop" value="<?php echo $number_of_shop ?>">
                    </div>
                    <button type="submit" name="save" class="btn btn-primary">Сохранить</button>
                    <button type="submit" name="add" class="btn btn-success">Добавить</button>
                    <button type="submit" name="delete" class="btn btn-danger">Удалить</button>
                </form>
            </div>
        </div>

    </div>
</section>

<?php include("../footer.php") ?>

