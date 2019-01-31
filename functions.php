<?php
    function getFormatDate($date){
        $date_timestamp = strtotime(str_replace('/', '-', $date));

        setlocale(LC_ALL, 'it_IT.UTF-8');
        $month = ucfirst(strftime("%B", strtotime($date_timestamp)));
        $day = strftime("%d", strtotime($date_timestamp));
        $hour = strftime("%H", strtotime($date_timestamp));
        return $day . ' ' . $month . ' alle ' . $hour;
    }

?>