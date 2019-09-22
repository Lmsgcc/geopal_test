<?php 

/**
 * Added two columns 
 * - promotion_id - to associate the designs to a promotion
 * - access_count - to keep a record 
 * 
 */

function redirect()
{
    $model = new CoreModel();

    if( empty($_GET["promotion_id"])){
        die("Promotion not found");
    }

    $promotion_id = filter_var($_GET["promotion_id"], FILTER_SANITIZE_NUMBER_INT);

    $query = "SELECT design_id, design_name, split_percent FROM designs WHERE promotion_id = $promotion_id";

    $designs = $model->GetArray($query);

    $calculation_array = [];
    $calculation = 0;
    foreach($designs as $value)
    {
        $end = $calculation + $value["split_percent"];
        $calculation_array[$calculation."-".$end] = $value;
        $calculation = $end;
    }

    // calculating the probability
    $prob = rand(1,100);

    $to_redirect = array_filter($calculation_array,function($key) use($prob)
    {
        $values = explode("-", $key);
        if (empty($values)) {
            return false;
        }
        if($prob >= ++$values[0] && $prob <= $values[1])
        {
            return true;
        }
        return false;
    }, ARRAY_FILTER_USE_KEY);

    $values = array_values($to_redirect)[0] ?? [];
    if(empty($values))
    {
        die("Design not found");
    }

    $query = "UPDATE designs SET access_count = access_count +1 where design_id = ".$values["design_id"];

    $model->execute($query);
    return $values["design_name"];
}

/**
 * Simulate 1000
 * 
 */
if (!empty($_GET["simulate"]))
{
    for($idx = 0; $idx < $_GET["simulate"]; ++$idx)
    {
        redirect();
    }
    $model = new CoreModel();
    $query = "select * from designs where promotion_id = ".filter_var($_GET["promotion_id"], FILTER_SANITIZE_NUMBER_INT);
    var_dump($model->GetArray($query));
    die;
}
$design = redirect();

require_once "designs/".$design.".php";


 

?>