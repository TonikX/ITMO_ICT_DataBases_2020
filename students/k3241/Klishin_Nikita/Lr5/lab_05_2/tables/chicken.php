<?php
$title = 'Куры';
include("../header.php");
?>

    <section>
        <div class="container-fluid" style="margin-top: 30px">
            <div class="row">
                <div class="col-8">
                    <h3 style="float: left; margin-left: 30px;">Куры</h3>
                    <div class="dropdown" style="float: right; margin-bottom: 14px">
                        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Сортировать
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="/tables/chicken.php?sort=9">ID +</a>
                            <a class="dropdown-item" href="/tables/chicken.php?sort=10">ID -</a>
                            <a class="dropdown-item" href="/tables/chicken.php?sort=1">Вес +</a>
                            <a class="dropdown-item" href="/tables/chicken.php?sort=2">Вес -</a>
                            <a class="dropdown-item" href="/tables/chicken.php?sort=3">Производительность +</a>
                            <a class="dropdown-item" href="/tables/chicken.php?sort=4">Производительность -</a>
                            <a class="dropdown-item" href="/tables/chicken.php?sort=5">Порода +</a>
                            <a class="dropdown-item" href="/tables/chicken.php?sort=6">Порода -</a>
                            <a class="dropdown-item" href="/tables/chicken.php?sort=7">Клетка +</a>
                            <a class="dropdown-item" href="/tables/chicken.php?sort=8">Клетка -</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-8">
                    <table class="table table-bordered table-hover table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">Вес</th>
                            <th scope="col">Производительность</th>
                            <th scope="col">Порода</th>
                            <th scope="col">Клетка</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $dbuser = "postgres";
                        $dbpass = "02588522";
                        $host = "localhost";
                        $dbname = "lab_03";
                        $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser, $dbpass);
                        $sql = "SELECT * FROM chicken";
                        if (isset($_GET["sort"])) {
                            switch ($_GET["sort"]) {
                                case 1:
                                    $sql .= " ORDER BY chicken_weight";
                                    break;
                                case 2:
                                    $sql .= " ORDER BY -chicken_weight";
                                    break;
                                case 3:
                                    $sql .= " ORDER BY number_of_eggs";
                                    break;
                                case 4:
                                    $sql .= " ORDER BY -number_of_eggs";
                                    break;
                                case 5:
                                    $sql .= " ORDER BY breed";
                                    break;
                                case 6:
                                    $sql .= " ORDER BY -breed";
                                    break;
                                case 7:
                                    $sql .= " ORDER BY cell";
                                    break;
                                case 8:
                                    $sql .= " ORDER BY -cell";
                                    break;
                                case 9:
                                    $sql .= " ORDER BY id_chicken";
                                    break;
                                case 10:
                                    $sql .= " ORDER BY -id_chicken";
                                    break;
                                default:
                                    break;
                            }
                        }
                        $data = $pdo->query($sql);
                        while ($row = $data->fetch()) {
                            echo '<tr style="position: static">';
                            echo '<th scope="row" style="position: relative">' . $row["id_chicken"];
                            echo '<a class="stretched-link" href="/tables/chicken.php?id_chicken=' . $row["id_chicken"] . '">';
                            echo '</th>';
                            echo '<td>' . $row["chicken_weight"] . '</td>';
                            echo '<td> ' . $row["number_of_eggs"] . '</td>';
                            echo '<td> <a href="/tables/breed.php?id_breed=' . $row["breed"] . '">' . $row["breed"] . '</a> </td>';
                            echo '<td>' . $row["cell"] . '</td>';
                            echo '</a>';
                            echo '</tr>';
                        }
                        ?>
                    </table>
                </div>
                <div class="col-4">
                    <?php
                    $id_chicken = 0;
                    $weight = 0;
                    $power = 0;
                    $cell = 0;
                    if (isset($_GET["add"])) {
                        $sql = "INSERT into chicken (chicken_weight, number_of_eggs, cell) VALUES (?, ?, ?)";
                        $pdo->prepare($sql)->execute([$_GET["chicken_weight"], $_GET["power"], $_GET["cell"]]);
                        //header("Location: /tables/chicken.php");
                    } elseif (isset($_GET["save"])) {
                        $sql = "UPDATE chicken SET chicken_weight = ?, number_of_eggs = ?, cell = ? WHERE id_chicken = ?";
                        $pdo->prepare($sql)->execute([$_GET["chicken_weight"], $_GET["power"], $_GET["cell"], $_GET["id_chicken"]]);
                        header("Location: /tables/chicken.php");
                    } elseif (isset($_GET["delete"])) {
                        $sql = "DELETE FROM chicken WHERE id_chicken = ?";
                        $pdo->prepare($sql)->execute([ $_GET["id_chicken"]]);
                        //header("Location: /tables/chicken.php");
                    }elseif (isset($_GET["id_chicken"])) {
                        $data = $pdo->query("SELECT * FROM chicken WHERE chicken.id_chicken = {$_GET["id_chicken"]}");
                        $row = $data->fetch();
                        $id_chicken = $row['id_chicken'];
                        $weight = $row['chicken_weight'];
                        $power = $row['number_of_eggs'];
                        $cell = $row['cell'];
                    }
                    ?>
                    <form action="/tables/chicken.php">
                        <input type="hidden" class="form-control" name="id_chicken" value="<?php echo $id_chicken ?>">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Вес</label>
                            <input type="number" class="form-control" name="chicken_weight"
                                   value="<?php echo $weight ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Производительность</label>
                            <input type="number" class="form-control" name="power" value="<?php echo $power ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Клетка</label>
                            <input type="number" class="form-control" name="cell" value="<?php echo $cell ?>">
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