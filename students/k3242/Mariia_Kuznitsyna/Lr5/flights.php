<!DOCTYPE html>

<html>

<head>
    <title>Mariia Kuznitsyna</title>
</head>

<body>
    <a href="index.php"> < Назад </a> 
    <br />
    <h1>Рейсы</h1>
        <?php
        include 'requests.php';
        include 'utils.php';

        $table_names = array('flight', 'voyage');
        $delete_key = 'id_flight';
        $add_fields = array(
            'id_flight' => array(
                'name' => 'ID рейса',
                'type' => 'number'
            ),
            'departure_point' => array(
                'name' => 'Пункт вылета',
                'type' => 'text'
            ),
            'arrival_point' => array(
                'name' => 'Пункт назначения',
                'type' => 'text'
            ),
            'id_transit' => array(
                'name' => 'ID транзита',
                'type' => 'number'
            ),
            'distance' => array(
                'name' => 'Расстояние до пункта назначения',
                'type' => 'text'
            ),
        );

        init_add($add_fields, 'flight');
        init_delete($delete_key, $table_names);

        $table = get_flights();

        echo print_table($table, $delete_key);

        echo print_add_form($add_fields)

        ?>
</body>

</html>