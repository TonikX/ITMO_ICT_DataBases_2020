<?php
$title = 'П - Д';
include("../header.php");
?>

<section>
    <h3 style="margin-left: 30px; margin-top: 20px">Связь пород и диет</h3>
</section>

<section>
    <div class="container-fluid" style="margin-top: 30px">
        <div class="row">
            <div class="col-8">
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">id_breed</th>
                        <th scope="col">id_diet</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $dbuser = "postgres";
                    $dbpass = "02588522";
                    $host = "localhost";
                    $dbname = "lab_03";
                    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser, $dbpass);
                    $data = $pdo->query("SELECT * FROM breed_diet ORDER BY id");
                    while ($row = $data->fetch()) {
                        echo '<tr style="position: static">';
                        echo '<th scope="row" style="position: relative">' . $row["id"];
                        echo '<a class="stretched-link" href="/tables/breed_diet.php?id=' . $row["id"] . '">';
                        echo '</th>';
                        echo '<td>' . $row["id_breed"] . '</td>';
                        echo '<td>' . $row["id_diet"] . '</td>';
                        echo '</a>';
                        echo '</tr>';
                    }
                    ?>
                </table>
            </div>
            <div class="col-4">
                <?php
                $id = 0;
                $id_breed = 0;
                $id_diet = 0;
                if (isset($_GET["add"])) {
                    $sql = "INSERT into breed_diet (id_breed, id_diet) VALUES (?, ?)";
                    $pdo->prepare($sql)->execute([$_GET["id_breed"], $_GET["id_diet"]]);
                    //header("Location: /tables/chicken.php");
                } elseif (isset($_GET["save"])) {
                    $sql = "UPDATE breed_diet SET id_breed = ?, id_diet = ?  WHERE id = ?";
                    $pdo->prepare($sql)->execute([$_GET["id_breed"], $_GET["id_diet"], $_GET["id"]]);
                    header("Location: /tables/breed_diet.php");
                } elseif (isset($_GET["delete"])) {
                    $sql = "DELETE FROM breed_diet WHERE id = ?";
                    $pdo->prepare($sql)->execute([ $_GET["id"]]);
                    //header("Location: /tables/chicken.php");
                }elseif (isset($_GET["id"])) {
                    $data = $pdo->query("SELECT * FROM breed_diet WHERE breed_diet.id = {$_GET["id"]}");
                    $row = $data->fetch();
                    $id = $row['id'];
                    $id_breed = $row['id_breed'];
                    $id_diet = $row['id_diet'];
                }
                ?>
                <form action="/tables/breed_diet.php">
                    <input type="hidden" class="form-control" name="id" value="<?php echo $id ?>">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Id породы</label>
                        <input type="number" class="form-control" name="id_breed" value="<?php echo $id_breed ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Id диеты</label>
                        <input type="text" class="form-control" name="id_diet" value="<?php echo $id_diet ?>">
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

