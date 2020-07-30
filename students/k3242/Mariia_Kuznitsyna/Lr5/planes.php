<!DOCTYPE html>

<html>

<head>
    <title>Mariia Kuznitsyna</title>
</head>

<body>
    <a href="index.php">
        < Назад </a> <br />
        <h1>Самолёты</h1>
        <?php
        include 'requests.php';
        include 'utils.php';

        $table_names = array('plane', 'company', 'worker', 'repair', 'flight');
        $delete_key = 'id_plane';
        $add_fields = array(
            'id_plane' => array(
                'name' => 'ID самолета',
                'type' => 'number'
            ),
            'type' => array(
                'name' => 'Тип',
                'type' => 'text'
            ),
            'number_of_seats' => array(
                'name' => 'Число мест',
                'type' => 'number'
            ),
            'speed' => array(
                'name' => 'Скорость полета',
                'type' => 'number'
            ),
            'airline' => array(
                'name' => 'Авиаперевозчик',
                'type' => 'text'
            ),
        );

        init_add($add_fields, 'plane');
        init_delete($delete_key, $table_names);

        $table = get_planes();

        echo print_table($table, $delete_key);

        echo print_add_form($add_fields)

        ?>
</body>

</html>