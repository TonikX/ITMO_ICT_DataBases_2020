<!DOCTYPE html>

<html>

<head>
    <title>Mariia Kuznitsyna</title>
</head>

<body>
    <a href="index.php">
        < Назад </a> <br />
        <h1>Экипажи</h1>
        <?php
        include 'requests.php';
        include 'utils.php';

        $table_names = array('crew', 'license', 'worker', 'flight');
        $delete_key = 'id_crew';
        $add_fields = array(
            'id_crew' => array(
                'name' => 'ID экипажа',
                'type' => 'number'
            ),
            'commander' => array(
                'name' => 'Командир',
                'type' => 'text'
            ),
            'second_pilot' => array(
                'name' => 'Второй пилот',
                'type' => 'text'
            ),
            'navigator' => array(
                'name' => 'Штурман',
                'type' => 'text'
            ),
            'stewards' => array(
                'name' => 'Стюарды/Стюардессы',
                'type' => 'text'
            ),
        );

        init_add($add_fields, 'crew');
        init_delete($delete_key, $table_names);

        $table = get_crews();

        echo print_table($table, $delete_key);

        echo print_add_form($add_fields)

        ?>
</body>

</html>