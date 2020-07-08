<!DOCTYPE html>

<html>

<head>
    <title>Mariia Kuznitsyna</title>
</head>

<body>
    <a href="index.php">
        < Назад</a> <br />
        <?php
        // variables
        echo '<h2>Variables</h2>';

        $bool = true;
        $int = 72 + 0xa;
        $float = 1.934;
        $str = 'Hello $float';
        $str2 = "Hello $float";

        echo "<p>
            boolean: $bool,</br>
            integer: $int,</br>
            float: $float,</br>
            string: $str,</br>
            string with variable: $str2,</br>
        </p>";

        // arrays
        echo '<h2>Arrays</h2>';

        $arr = array(1.234, 134 + 0xf, true);
        $map = array(
            'a' => 134 + 0xf,
            'b' => true,
            -100 => 1.234
        );


        echo "<p>" . var_dump($arr) . "</p>";

        // conditionals
        echo '<h2>Conditionals</h2>';

        if ($bool == true) {
            echo '<p>Bool is true</p>';
        }

        if ($int < 100) {
            echo 'int lesser than 100';
        } elseif ($int == 100) {
            echo 'int is equal to 100';
        } else {
            echo 'int greater than 100';
        }

        echo '</br>';

        $rand = random_int(0, 5);

        switch ($rand) {
            case 0:
                echo "switch 0";
                break;
            case 1:
                echo "switch 1";
                break;
            case 2:
                echo "switch 2";
                break;
            default:
                echo "switch default";
                break;
        }

        // loops
        echo '<h2>Loops</h2>';

        for ($i = 0, $length = count($arr); $i < $length; ++$i) {
            echo array_search($arr[$i], $map);
        }
        
        echo "</br>";

        foreach ($map as $key => $val) {
            echo "$key => $val, ";
        }

        echo "</br>";

        $counter = 0;
        while ($counter != 5) {
            $counter++;
            echo "$counter while</br> ";
        }

        echo '<br/>';

        unset($counter);

        $counter = 1;
        do {
            echo "$counter do while </br>";
            $counter++;
        } while ($counter <= 3);

        echo '<br/>';

        // functions
        echo '<h2>Functions</h2>';

        function show_what_masha_drinks($p1)
        {
            echo "Masha drinks $p1";
        }

        show_what_masha_drinks('beer');

        echo '<br/>';

        function give_beer_to_masha($glasses)
        {
            $sum = $glasses * 300;
            $resume = "Masha drinks $glasses glasses of beer which is $sum roubles";
            return array(
                "sum" => $sum,
                "resume" => $resume
            );
        }

        $todays_evening = give_beer_to_masha(5);

        echo $todays_evening["resume"];

        // sessions

        session_start();

        $_SESSION['name'] = 'Masha';
        $_SESSION['spent_for_beer'] = $todays_evening["sum"];



        ?>
</body>

</html>