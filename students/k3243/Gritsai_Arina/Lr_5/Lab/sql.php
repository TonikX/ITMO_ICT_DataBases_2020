<?php
    
    $db = pg_connect("host=localhost port=5433 dbname=lr_3 user=postgres password=343");

    $st1 = 'Все посетители, чьи фамилии начинаются на «М», в алфавитном порядке, отсортированные по именам: ';
     $query1 = "select surname from public.client where surname like 'M%' order by name";
     
     $result1 = pg_query($db, $query1);
     $result1 = pg_fetch_assoc($result1);
     echo $st1;
     echo '</br>' . $result1["surname"];

    $st2 = 'Вычисление средней ЗП сотрудников гостиницы';
     $query2 = "select avg(wage) from public.employees";
     
     $result2 = pg_query($db, $query2);
     $result2 = pg_fetch_assoc($result2);
     echo '</br>' . '</br>' . $st2;
     echo '</br>' . $result2["avg"];
    
    $st3 = 'Клиенты, проживавшие в номере 11, с 1 апреля 2020 года:';
     $query3 = "select registration.set_date, client.name, client.surname from public.registration inner join client on registration.fki_pass_id=client.passport_id where registration.set_date >= '2020-04-01' and registration.fki_serial_num=11";
 
     $result3 = pg_query($db, $query3);
     $result3 = pg_fetch_assoc($result3);
     echo '</br>' . '</br>' . $st3;
     echo '</br>' . $result3["surname"];
    
    $st4 = 'Сотрудники, проводившие уборки в понедельник';
     $query4 = "select employees.surname_emp from public.employees join public.cleaning_schedule on cleaning_schedule.fki_pers_num=employees.personnel_num where cleaning_schedule.week_day='Monday'";
     
     $result4 = pg_query($db, $query4);
     $result4 = pg_fetch_assoc($result4);
     echo '</br>' . '</br>' . $st4;
     echo '</br>' . $result4["surname_emp"];
    
    $st5 = 'Количество постояльцев гостиницы в 56 номере с 1 апреля по 30 мая 2020 года:';
     $query5 = "select count(fki_pass_id) from public.registration where set_date between '2020-04-01' and '2020-05-30' and registration.fki_serial_num=56";
 
     $result5 = pg_query($db, $query5);
     $result5 = pg_fetch_assoc($result5);
     echo '</br>' . '</br>' . $st5;
     echo '</br>' . $result5["count"];
    
    pg_close($db);
    
?>
<table>
  <thead>
<style type="text/css">

    body{
        margin-left: 20%;
        margin-right: 20%;
    }
</style>
</table>
