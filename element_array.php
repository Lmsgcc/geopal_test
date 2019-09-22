<?php 

function remove(array $values)
{
    $idx_to_remove = rand(0, sizeof($values));
    unset($values[$idx_to_remove]);
    return $values;
}


$total = 0;

$values = [];

for ($idx = 0; $idx < 500 ; ++$idx)
{
    $value = rand(1,500);
    $values[] = $value;
    $total += $value;
}
var_dump($values);
$value_removed = null;
$new_values = [];
echo "<br/>";
switch($_GET["method"])
{
    case 1:
        // this method uses the diference in values in the array to determine the missing value
        $new_values = remove($values);
        $new_values_total = 0;
        foreach($new_values as $v)
        {
            $new_values_total += $v;
        }
        $value_removed = $total - $new_values_total;
        break;
    case 2:
        // this method uses the existing functions to determine the the diference in values
        $new_values = remove($values);
        $diff = array_diff($values, $new_values);
        if(empty($diff))
        {
            die("not found");
        }
        $value_removed = array_values($diff)[0] ?? "";
        break;
    default:
        echo "Method not found";
}
echo "value removed - ".$value_removed;
echo "<br/>";
var_dump($new_values );


?>