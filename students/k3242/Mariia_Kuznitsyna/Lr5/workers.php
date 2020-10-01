<!DOCTYPE html>

<html>

<head>
    <title>Mariia Kuznitsyna</title>
</head>

<body>
    <a href="index.php">
        < Назад </a> <br />
        <h1>Работники</h1>
        <?php
        include 'requests.php';
        include 'utils.php';

        $table_names = array('worker');
        $delete_key = 'id_worker';
        $add_fields = array(
            'id_worker' => array(
                'name' => 'ID работника',
                'type' => 'number'
            ),
            'id_crew' => array(
                'name' => 'ID экипажа',
                'type' => 'number'
            ),
            'id_plane' => array(
                'name' => 'ID самолета',
                'type' => 'number'
            ),
            'name_company' => array(
                'name' => 'Компания',
                'type' => 'text'
            ),
            'name_worker' => array(
                'name' => 'ФИО',
                'type' => 'text'
            ),
            'education' => array(
                'name' => 'Образование',
                'type' => 'text'
            ),
            'contacts_worker' => array(
                'name' => 'Контакты',
                'type' => 'text'
            ),
            'age' => array(
                'name' => 'Возраст',
                'type' => 'number'
            ),
            'experience' => array(
                'name' => 'Опыт',
                'type' => 'number'
            ),
            'passport' => array(
                'name' => 'Пасспорт',
                'type' => 'number'
            )
        );

        init_add($add_fields, 'worker');

        init_delete($delete_key, $table_names);

        $table = get_workers();

        echo print_table($table, $delete_key);

        echo print_add_form($add_fields)

        ?>
</body>

</html>