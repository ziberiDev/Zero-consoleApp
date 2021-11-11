<?php
require_once './vendor/autoload.php';


$fast = new \App\Model\Fast(1, '2021-10-11 10:22:00', date('Y-m-d H:m:s'));

/*try {*/

$diff = $fast->end->diff($fast->start);

/*var_dump($diff->format('Y-m-d H:i:s'));*/
echo $diff->format('%Y %m months %d  %h  %i  %s ');
/*} catch (\Exception $e) {
    echo $e->getMessage();
}*/

