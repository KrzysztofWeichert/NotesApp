<?php 
declare(strict_types = 1);

ini_set('display_errors', '1');

function dumper($var)
{
    echo '<br><div style="display: inline-block; padding: 10px; border: 1px solid black; background: lightblue;"> 
    <pre>';
    print_r($var);
    echo '</pre></div><br>';
}
