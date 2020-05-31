<?php
$title = 'Куры';
include("../header.php");
?>

<section>
    <h3 style="margin-left: 30px; margin-top: 20px">Диеты</h3>
</section>

<section>
    <div class="container-fluid" style="margin-top: 30px">
        <div class="row">
            <div class="col-8">
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th scope="col">id_diet</th>
                        <th scope="col">Номер диеты</th>
                        <th scope="col">Описание диеты</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $dbuser = "postgres";
                    $dbpass = "02588522";
                    $host = "localhost";
                    $dbname = "lab_03";
                    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser, $dbpass);
                    $data = $pdo->query("SELECT * FROM diet ORDER BY id_diet");
                    while ($row = $data->fetch()) {
                        echo '<tr style="position: static">';
                        echo '<th scope="row" style="position: relative">' . $row["id_diet"];
                        echo '<a class="stretched-link" href="/tables/diet.php?id_diet=' . $row["id_diet"] . '">';
                        echo '</th>';
                        echo '<td>' . $row["diet_number"] . '</td>';
                        echo '<td>' . $row["diet_content"] . '</td>';
                        echo '</a>';
                        echo '</tr>';
                    }
                    ?>
                </table>
            </div>
            <div class="col-4">
                <?php
                $id_diet = 0;
                $diet_number = 0;
                $diet_content = 0;
                if (isset($_GET["add"])) {
                    $sql = "INSERT into diet (diet_number, diet_content) VALUES (?, ?)";
                    $pdo->prepare($sql)->execute([$_GET["diet_number"], $_GET["diet_content"]]);

                } elseif (isset($_GET["save"])) {
                    $sql = "UPDATE diet SET diet_number = ?, diet_content = ?  WHERE id_diet = ?";
                    $pdo->prepare($sql)->execute([$_GET["diet_number"], $_GET["diet_content"], $_GET["id_diet"]]);
                    header("Location: /tables/diet.php");
                } elseif (isset($_GET["delete"])) {
                    $sql = "DELETE FROM diet WHERE id_diet = ?";
                    $pdo->prepare($sql)->execute([ $_GET["id_diet"]]);
                    //header("Location: /tables/chicken.php");
                }elseif (isset($_GET["id_diet"])) {
                    $data = $pdo->query("SELECT * FROM diet WHERE diet.id_diet = {$_GET["id_diet"]}");
                    $row = $data->fetch();
                    $id_diet = $row['id_diet'];
                    $diet_number = $row['diet_number'];
                    $diet_content = $row['diet_content'];
                }
                ?>
                <form action="/tables/diet.php">
                    <input type="hidden" class="form-control" name="id_diet" value="<?php echo $id_diet ?>">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Номер диеты</label>
                        <input type="number" class="form-control" name="diet_number" value="<?php echo $diet_number ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Описание</label>
                        <input type="text" class="form-control" name="diet_content" value="<?php echo $diet_content ?>">
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
