<?php 


$i = 0;
$j = 0;
$matriz = array();


for($i = 0; $i < 10; $i++) {
    for($j = 0; $j < 10; $j++) {
        if ($i == $j) {
            $matriz[$i][$j] = "x"; 
        } else {
            $matriz[$i][$j] = 0;
        }
    }
}

for($i = 0; $i < 10; $i++) {
    for($j = 0; $j < 10; $j++) {
        print $matriz[$i][$j];
    }
}
?>