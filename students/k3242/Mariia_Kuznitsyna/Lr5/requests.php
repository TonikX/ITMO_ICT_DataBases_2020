<?php

function run_sql_request($request)
{
    include 'connect.php';

    return $pdo_database->query($request);
}

function select_from_db($request)
{
    return run_sql_request($request)->fetchAll();
}

function get_license()
{
    return select_from_db("
        SELECT id_license, id_crew, license_existence 
        FROM airport.license 
        WHERE id_license > ALL (SELECT age FROM airport.worker WHERE experience > 1)
        AND id_crew > 145
    ");
}

function get_workers()
{
    return select_from_db("
        SELECT worker.id_worker, worker.name_worker, worker.age, plane.id_plane, plane.airline 
        FROM airport.plane, airport.worker 
        WHERE worker.id_plane = plane.id_plane
        AND worker.education = 'Master degree' 
        AND (worker.id_worker < 3 OR worker.id_worker > 6)  
        ");
}

function get_crews()
{
    return select_from_db("
        SELECT crew.id_crew, upper(crew.commander) as commander, lower(crew.second_pilot) as second_pilot
        FROM airport.crew 
        WHERE crew.stewards <> 'Ninth F.F.'  
    ");
}

function get_planes()
{
    return select_from_db("
        SELECT plane.id_plane, plane.airline, CONCAT(plane.id_plane, ' ', plane.type) as plane
        FROM airport.plane 
        WHERE plane.id_plane > 1255  
    ");
}

function get_flights()
{
    return select_from_db("
        SELECT flight.id_flight, flight.id_transit, flight.distance 
        FROM airport.flight
        WHERE flight.id_flight
        BETWEEN 1004 
        AND 1300
        ORDER BY flight.id_flight 
    ");
}

function init_delete($key, $tables)
{
    include "config.php";
    include 'connect.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST["Delete"])) {
            foreach ($tables as $table) {
                $pdo_database->exec("DELETE FROM $dbname.$table WHERE $table.$key=$_POST[$key]");
            }

            header("Refresh:0");
        }
    }
}

function init_add($fields, $table_name)
{
    include "config.php";
    include 'connect.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST["Add"])) {
            $columns_arr = array();
            $values_arr = array();

            foreach ($fields as $key => $field) {
                array_push($columns_arr, $key);
                array_push($values_arr, "'$_POST[$key]'");
            }

            $columns = implode(',', $columns_arr);
            $values = implode(',', $values_arr);

            $pdo_database->exec("
                INSERT INTO $dbname.$table_name($columns)
                VALUES ($values)
            ");
        }
    }
}
