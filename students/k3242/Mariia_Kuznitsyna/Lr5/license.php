<!DOCTYPE html>

<html>

<head>
    <title>Mariia Kuznitsyna</title>
</head>

<body>
    <a href="index.php">
        < Назад </a> <br />
        <h1>License</h1>
        <?php
        include 'requests.php';
        include 'utils.php';

        $table_names = array('license', 'voyage');
        $delete_key = 'id_license';
        $add_fields = array(
            'id_license' => array(
                'name' => 'ID лицензии',
                'type' => 'number'
            ),
            'id_crew' => array(
                'name' => 'ID экипажа',
                'type' => 'number'
            ),
            'license_existence' => array(
                'name' => 'Есть лицензия?', 'type' => 'boolean'
            )
        );

        init_add($add_fields, 'license');

        init_delete($delete_key, $table_names);

        $table = get_license();

        echo print_table($table, $delete_key);

        echo print_add_form($add_fields)

        ?>
</body>

</html>