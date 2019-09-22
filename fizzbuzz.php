<?php 

$output = [];
for ($idx = 1; $idx <= 100; ++$idx)
{
    if($idx % 3 == 0 && $idx % 5 == 0)
    {
        $output[] = "FizzBuzz";
        continue;
    }
    if ($idx % 3 == 0)
    {
        $output[] = "Fizz";
        continue;
    }
    if($idx % 5 == 0)
    {
        $output[] = "Buzz";
        continue;
    }
    $output[] = $idx;
}

echo implode("<br/>", $output);


?>