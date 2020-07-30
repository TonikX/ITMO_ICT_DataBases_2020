<?php

function get_titles($table)
{
    $titles = array();

    if (count($table) > 0) {
        foreach ($table[0] as $key => $value) {
            if (is_string($key)) {
                array_push($titles, $key);
            }
        }
    }

    return $titles;
}

function print_titles($titles)
{
    $title_cells = '<th>№</th>';

    foreach ($titles as $title) {
        $title_cells .= "\n<th>$title<th>";
    }

    return "<tr>$title_cells<th></th></tr>";
}

function get_delete_cells($table, $delete_key)
{

    $cells = array();

    foreach ($table as $item) {
        $delete_value = $item[$delete_key];
        $cell = "
            <td>
                <form action='' method='post'>
                    <input type='hidden' name='$delete_key' value='$delete_value'>
                    <button type='submit' name='Delete'>Удалить</button>
                </form>
            </td>
        ";
        array_push($cells, $cell);
    }

    return $cells;
}

function print_cells($table, $titles, $delete_cells)
{
    $cells = '';

    foreach ($table as $row_index => $row_item) {
        $number = $row_index + 1;
        $row = "<tr>\n<td>$number</td>";

        foreach ($titles as $title) {
            $cell_value = $row_item[$title];

            if (is_bool($cell_value)) {
                $cell_value = $cell_value ? 'true' : 'false';
            }

            $row .= "<td>$cell_value<td>\n";
        }
        $row .= "$delete_cells[$row_index]</tr>";
        $cells .= "$row\n";
    }

    return "<tr>$cells</tr>";
}

function print_table($table, $delete_key)
{
    include 'styles.php';

    $titles_array = get_titles($table);
    $delete_cells = get_delete_cells($table, $delete_key);
    $titles = print_titles($titles_array);
    $cells = print_cells($table, $titles_array, $delete_cells);
    return "<table style='$table_style'>$titles\n$cells</table>";
}

function get_input_by_type($type, $key)
{
    include 'styles.php';

    switch ($type) {
        case 'text':
        case 'number':
            return " <input type='$type' id='$key' name='$key' style='$fit_parent'/>";
        case 'boolean':
            return "
                <select id='$key' name='$key'>
                    <option value='true'>Да</option>
                    <option value='false'>Нет</option>
                </select>
            ";
        default:
            return '';
    }
}

function print_add_form($fields_arr)
{
    include 'styles.php';

    $fields_to_render = '';

    foreach ($fields_arr as $field_key => $field) {
        $label = $field['name'];
        $type = $field['type'];
        $input = get_input_by_type($type, $field_key);

        $field = "
            <div style='$field_style'>
                <label for='$field_key'>$label</label>
                <br />
                $input
                <br />
            </div>
        ";
        $fields_to_render .= $field;
    }

    return "
        <h2>Добавить</h2>
        <form action='' method='post' style='$add_form_style'>
        $fields_to_render
        <button type='submit' name='Add' style='$fit_parent'>Добавить</button>
        </form>
    ";
}
