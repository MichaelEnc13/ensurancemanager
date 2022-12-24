<?php

date_default_timezone_set('America/Santo_Domingo');
if (file_exists("autoload.php")) :
    include "autoload.php";
elseif (file_exists("../api/model/autoload.php")) :
    include "../api/model/autoload.php";
elseif (file_exists("api/model/autoload.php")) :
    include "api/model/autoload.php";
endif;

if (session_status() != 2) session_start();


class CalDate
{

    public static  function in30Days()
    {
        $currentMonth = date("m");
        $currentYear = date("Y");
        $days = "+" . cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear) . "days";
        $currentDate = date("d-m-Y");
        $futureDate = strtotime($days, strtotime($currentDate));
        $futureDate = date('d-m-Y', $futureDate);
        return $futureDate;
    }

    public static  function some_months($months)
    {

        $days = "+" . $months . "month";
        $currentDate = date("d-m-Y");
        $futureDate = strtotime($days, strtotime($currentDate));
        $futureDate = date('d-m-Y', $futureDate);
        return $futureDate;
    }
    public static  function in1Year($date = "")
    {

        $days = date("L") == 0 ? "+ 365 days" : "+ 366 days";
        $currentDate = $date != "" ? $date : date("d-m-Y");
        $futureDate = strtotime($days, strtotime($currentDate));
        $futureDate = date('d-m-Y', $futureDate);
        return $futureDate;
    }


    public static function diffDate($date1, $date2)
    {
        $date1 = date_create($date1);
        $date2 = date_create($date2);
        $diff = date_diff($date1, $date2);
        return intval($diff->format("%R%a"));
    }
}
