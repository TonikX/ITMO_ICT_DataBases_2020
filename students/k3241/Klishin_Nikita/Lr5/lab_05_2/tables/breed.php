<?php
$title = 'Куры';
include("../header.php");
?>

<section>
    <h3 style="margin-left: 30px; margin-top: 20px">Породы</h3>
</section>

<section>
    <div class="container-fluid" style="margin-top: 30px">
        <div class="row">
            <div class="col-8">
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th scope="col">id_breed</th>
                        <th scope="col">Название</th>
                        <th scope="col">Производительность</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $dbuser = "postgres";
                    $dbpass = "02588522";
                    $host = "localhost";
                    $dbname = "lab_03";
                    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser, $dbpass);
                    $data = $pdo->query("SELECT * FROM breed ORDER BY id_breed");
                    while ($row = $data->fetch()) {
                        echo '<tr style="position: static">';
                        echo '<th scope="row" style="position: relative">' . $row["id_breed"];
                        echo '<a class="stretched-link" href="/tables/breed.php?id_breed=' . $row["id_breed"] . '">';
                        echo '</th>';
                        echo '<td>' . $row["breed_title"] . '</td>';
                        echo '<td>' . $row["performance"] . '</td>';
                        echo '</a>';
                        echo '</tr>';
                    }
                    ?>
                </table>
            </div>
            <div class="col-4">
                <?php
                $id_breed = 0;
                $breed_title = 0;
                $performance = 0;
                if (isset($_GET["add"])) {
                    $sql = "INSERT into breed (breed_title, performance) VALUES (?, ?)";
                    $pdo->prepare($sql)->execute([$_GET["breed_title"], $_GET["performance"]]);
                    //header("Location: /tables/chicken.php");
                } elseif (isset($_GET["save"])) {
                    $sql = "UPDATE breed SET breed_title = ?, performance = ?  WHERE id_breed = ?";
                    $pdo->prepare($sql)->execute([$_GET["breed_title"], $_GET["performance"], $_GET["id_breed"]]);
                    header("Location: /tables/breed.php");
                } elseif (isset($_GET["delete"])) {
                    $sql = "DELETE FROM breed WHERE id_breed = ?";
                    $pdo->prepare($sql)->execute([ $_GET["id_breed"]]);
                    //header("Location: /tables/chicken.php");
                }elseif (isset($_GET["id_breed"])) {
                    $data = $pdo->query("SELECT * FROM breed WHERE breed.id_breed = {$_GET["id_breed"]}");
                    $row = $data->fetch();
                    $id_breed = $row['id_breed'];
                    $breed_title = $row['breed_title'];
                    $performance = $row['performance'];
                }
                ?>
                <form action="/tables/breed.php">
                    <input type="hidden" class="form-control" name="id_breed" value="<?php echo $id_breed ?>">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Название породы</label>
                        <input type="text" class="form-control" name="breed_title" value="<?php echo $breed_title ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Производительность</label>
                        <input type="number" class="form-control" name="performance" value="<?php echo $performance ?>">
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
