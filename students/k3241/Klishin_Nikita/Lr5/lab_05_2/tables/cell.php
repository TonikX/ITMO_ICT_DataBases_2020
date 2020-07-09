<?php
$title = 'Клетки';
include("../header.php");
?>

<section>
    <h3 style="margin-left: 30px; margin-top: 20px">Клетки</h3>
</section>

<section>
    <div class="container-fluid" style="margin-top: 30px">
        <div class="row">
            <div class="col-8">
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th scope="col">id_cell</th>
                        <th scope="col">Цех</th>
                        <th scope="col">Номер ряда</th>
                        <th scope="col">Номер в ряду</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $dbuser = "postgres";
                    $dbpass = "02588522";
                    $host = "localhost";
                    $dbname = "lab_03";
                    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser, $dbpass);
                    $data = $pdo->query("SELECT * FROM cell ORDER BY id_cell");
                    while ($row = $data->fetch()) {
                        echo '<tr style="position: static">';
                        echo '<th scope="row" style="position: relative">' . $row["id_cell"];
                        echo '<a class="stretched-link" href="/tables/cell.php?id_cell=' . $row["id_cell"] . '">';
                        echo '</th>';
                        echo '<td>' . $row["shop"] . '</td>';
                        echo '<td>' . $row["row_number"] . '</td>';
                        echo '<td>' . $row["number_in_row"] . '</td>';
                        echo '</a>';
                        echo '</tr>';
                    }
                    ?>
                </table>
            </div>
            <div class="col-4">
                <?php
                $id_cell = 0;
                $shop = 0;
                $row_number = 0;
                $number_in_row = 0;
                if (isset($_GET["add"])) {
                    $sql = "INSERT into cell (shop, row_number, number_in_row) VALUES (?, ?, ?)";
                    $pdo->prepare($sql)->execute([$_GET["shop"], $_GET["row_number"], $_GET["number_in_row"]]);
                    //header("Location: /tables/chicken.php");
                } elseif (isset($_GET["save"])) {
                    $sql = "UPDATE cell SET shop = ?, row_number = ?, number_in_row = ?  WHERE id_cell = ?";
                    $pdo->prepare($sql)->execute([$_GET["shop"], $_GET["row_number"], $_GET["number_in_row"], $_GET["id_cell"]]);
                    header("Location: /tables/cell.php");
                } elseif (isset($_GET["delete"])) {
                    $sql = "DELETE FROM cell WHERE id_cell = ?";
                    $pdo->prepare($sql)->execute([ $_GET["id_cell"]]);
                    //header("Location: /tables/chicken.php");
                }elseif (isset($_GET["id_cell"])) {
                    $data = $pdo->query("SELECT * FROM cell WHERE cell.id_cell = {$_GET["id_cell"]}");
                    $row = $data->fetch();
                    $id_cell = $row['id_cell'];
                    $shop = $row['shop'];
                    $row_number = $row['row_number'];
                    $number_in_row = $row['number_in_row'];
                }
                ?>
                <form action="/tables/cell.php">
                    <input type="hidden" class="form-control" name="id_cell" value="<?php echo $id_cell ?>">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Цех</label>
                        <input type="number" class="form-control" name="shop" value="<?php echo $shop ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Номер ряда</label>
                        <input type="number" class="form-control" name="row_number" value="<?php echo $row_number ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Номер в ряду</label>
                        <input type="number" class="form-control" name="number_in_row" value="<?php echo $number_in_row ?>">
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
