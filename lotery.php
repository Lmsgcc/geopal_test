<?php 
class Lotery
{

    public function __construct()
    {
        date_default_timezone_set('UTC');
    }

    public function calc_next_date($date = null)
    {
        $date_from = new DateTime($date);
        $dates = [];
        $date_to = clone $date_from;
        $date_to->modify("next wednesday");
        $date_to = $date_to->setTime(20,0);
        $dates[] = $date_to->format('Y-m-d H:i:s');
        $date_to = clone $date_from;
        $date_to->modify("next saturday");
        $date_to = $date_to->setTime(20,0);
        $dates[] = $date_to->format('Y-m-d H:i:s');
        asort($dates);
        return $dates[array_keys($dates)[0]] ?? '';
    }

}


?>