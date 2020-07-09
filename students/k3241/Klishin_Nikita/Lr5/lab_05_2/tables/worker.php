<?php
$title = 'Работники';
include("../header.php");
?>

<section>
    <h3 style="margin-left: 30px; margin-top: 20px">Работники</h3>
</section>

<section>
    <div class="container-fluid" style="margin-top: 30px">
        <div class="row">
            <div class="col-8">
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th scope="col">id_worker</th>
                        <th scope="col">ФИО</th>
                        <th scope="col">Паспорт</th>
                        <th scope="col">Зарплата</th>
                        <th scope="col">Дата рождения</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $dbuser = "postgres";
                    $dbpass = "02588522";
                    $host = "localhost";
                    $dbname = "lab_03";
                    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser, $dbpass);
                    $data = $pdo->query("SELECT * FROM worker ORDER BY id_worker");
                    while ($row = $data->fetch()) {
                        echo '<tr style="position: static">';
                        echo '<th scope="row" style="position: relative">' . $row["id_worker"];
                        echo '<a class="stretched-link" href="/tables/worker.php?id_worker=' . $row["id_worker"] . '">';
                        echo '</th>';
                        echo '<td>' . $row["fio"] . '</td>';
                        echo '<td>' . $row["passport"] . '</td>';
                        echo '<td>' . $row["salary"] . '</td>';
                        echo '<td>' . $row["birth_date"] . '</td>';
                        echo '</a>';
                        echo '</tr>';
                    }
                    ?>
                </table>
            </div>
            <div class="col-4">
                <?php
                $id_worker = 0;
                $fio = 0;
                $passport = 0;
                $salary = 0;
                $birth_date = 0;
                if (isset($_GET["add"])) {
                    $sql = "INSERT into worker (fio, passport, salary, birth_date) VALUES (?, ?, ?, ?)";
                    $pdo->prepare($sql)->execute([$_GET["fio"], $_GET["passport"],  $_GET["salary"], $_GET["birth_date"]]);
                    //header("Location: /tables/chicken.php");
                } elseif (isset($_GET["save"])) {
                    $sql = "UPDATE worker SET fio = ?, passport = ?, salary = ?, birth_date = ? WHERE id_worker = ?";
                    $pdo->prepare($sql)->execute([$_GET["fio"], $_GET["passport"], $_GET["salary"], $_GET["birth_date"], $_GET["id_worker"]]);
                    header("Location: /tables/worker.php");
                } elseif (isset($_GET["delete"])) {
                    $sql = "DELETE FROM worker WHERE id_worker = ?";
                    $pdo->prepare($sql)->execute([ $_GET["id_worker"]]);
                    //header("Location: /tables/chicken.php");
                }elseif (isset($_GET["id_worker"])) {
                    $data = $pdo->query("SELECT * FROM worker WHERE worker.id_worker = {$_GET["id_worker"]}");
                    $row = $data->fetch();
                    $id_worker = $row['id_worker'];
                    $fio = $row['fio'];
                    $passport = $row['passport'];
                    $salary = $row['salary'];
                    $birth_date = $row['birth_date'];
                }
                ?>
                <form action="/tables/worker.php">
                    <input type="hidden" class="form-control" name="id_worker" value="<?php echo $id_worker ?>">
                    <div class="form-group">
                        <label for="exampleInputEmail1">ФИО</label>
                        <input type="text" class="form-control" name="fio" value="<?php echo $fio ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Паспорт</label>
                        <input type="text" class="form-control" name="passport" value="<?php echo $passport ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Зарплата</label>
                        <input type="number" class="form-control" name="salary" value="<?php echo $salary ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Дата рождения</label>
                        <input type="date" class="form-control" name=birth_date value="<?php echo $birth_date ?>">
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
