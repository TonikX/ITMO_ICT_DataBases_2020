<?php
$title = 'П-Д';
include("../header.php");
?>

<section>
    <h3 style="margin-left: 30px; margin-top: 20px">Связь работников и клеток</h3>
</section>

<section>
    <div class="container-fluid" style="margin-top: 30px">
        <div class="row">
            <div class="col-8">
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">id_cell</th>
                        <th scope="col">id_worker</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $dbuser = "postgres";
                    $dbpass = "02588522";
                    $host = "localhost";
                    $dbname = "lab_03";
                    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser, $dbpass);
                    $data = $pdo->query("SELECT * FROM worker_cell ORDER BY id");
                    while ($row = $data->fetch()) {
                        echo '<tr style="position: static">';
                        echo '<th scope="row" style="position: relative">' . $row["id"];
                        echo '<a class="stretched-link" href="/tables/worker_cell.php?id=' . $row["id"] . '">';
                        echo '</th>';
                        echo '<td>' . $row["id_cell"] . '</td>';
                        echo '<td>' . $row["id_worker"] . '</td>';
                        echo '</a>';
                        echo '</tr>';
                    }
                    ?>
                </table>
            </div>
            <div class="col-4">
                <?php
                $id = 0;
                $id_cell = 0;
                $id_worker = 0;
                if (isset($_GET["add"])) {
                    $sql = "INSERT into worker_cell (id_cell, id_worker) VALUES (?, ?)";
                    $pdo->prepare($sql)->execute([$_GET["id_cell"], $_GET["id_worker"]]);
                    //header("Location: /tables/chicken.php");
                } elseif (isset($_GET["save"])) {
                    $sql = "UPDATE worker_cell SET id_cell = ?, id_worker = ?  WHERE id = ?";
                    $pdo->prepare($sql)->execute([$_GET["id_cell"], $_GET["id_worker"], $_GET["id"]]);
                    header("Location: /tables/cell_worker.php");
                } elseif (isset($_GET["delete"])) {
                    $sql = "DELETE FROM worker_cell WHERE id = ?";
                    $pdo->prepare($sql)->execute([ $_GET["id"]]);
                    //header("Location: /tables/chicken.php");
                }elseif (isset($_GET["id"])) {
                    $data = $pdo->query("SELECT * FROM worker_cell WHERE worker_cell.id = {$_GET["id"]}");
                    $row = $data->fetch();
                    $id = $row['id'];
                    $id_cell = $row['id_cell'];
                    $id_worker = $row['id_worker'];
                }
                ?>
                <form action="/tables/worker_cell.php">
                    <input type="hidden" class="form-control" name="id" value="<?php echo $id ?>">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Id клетки</label>
                        <input type="number" class="form-control" name="id_cell" value="<?php echo $id_cell ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Id работника</label>
                        <input type="text" class="form-control" name="id_worker" value="<?php echo $id_worker ?>">
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

