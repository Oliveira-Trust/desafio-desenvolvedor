<?php

/**
 * Display date regarding to language preferences
 *
 * @param string $date Date to display format UNIX
 * @param integer $id_lang Language id
 * @param boolean $full With time or not (optional)
 * @return string Date
 */
function displayDate($date, $id_lang, $full = FALSE, $separator = '/')
{
    $tmpTab = explode($separator, substr($date, 0, 10));
    $hour = ' ' . substr($date, -8);

    if ($id_lang == 'birthdate')
        return ($tmpTab[2] . '/' . $tmpTab[1]);
    elseif ($id_lang == 'us')
        return ($tmpTab[2] . '-' . $tmpTab[1] . '-' . $tmpTab[0] . ($full ? $hour : ''));
    elseif ($id_lang == 'fb')
        return ($tmpTab[2] . '-' . $tmpTab[0] . '-' . $tmpTab[1] . ($full ? $hour : ''));
    else
        return ($tmpTab[0] . '-' . $tmpTab[1] . '-' . $tmpTab[2] . ($full ? $hour : ''));
}

/**
 * humanized to date ex. 1 meses atrás = 2013-09-04
 * @param      $date
 * @param bool $group
 * @return string
 */
function humanizeDate($date, $group = FALSE)
{
    $timestamp = strtotime($date); #converto a data para strtotime
    $date = displayDate($date, '', FALSE, '-');

    //type cast, current time, difference in timestamps
    $timestamp = (int)$timestamp;
    $current_time = time();
    $diff = $current_time - $timestamp;

    //intervals in seconds
    $intervals = array(
        'year' => 31556926, 'month' => 2629744, 'week' => 604800, 'day' => 86400, 'hour' => 3600, 'minute' => 60
    );

    if ($group) {
        if (strtotime($date) == strtotime(Date('Y-m-d'))) {
            return 'Hoje';
        }

        if (strtotime($date) == strtotime(Date('Y-m-d', strtotime("-1 days")))) {
            return 'Ontem';
        }

        if ($diff >= $intervals['day'] && $diff < $intervals['week']) {
            return Tools::longDate(displayDate($date, '', FALSE, '-'), TRUE, FALSE, FALSE);
        }

        if ($diff >= $intervals['day'] && $diff > $intervals['week'] && date('Y', strtotime($date)) == date('Y')) {
            return Tools::longDate(displayDate($date, '', FALSE, '-'), FALSE, TRUE, FALSE);
        }

        if (date('Y', strtotime("-1 year", strtotime(date('Y-m-d')))) < date('Y')) {
            return Tools::longDate(displayDate($date, '', FALSE, '-'), FALSE, TRUE, TRUE);
        }
    } else {
        //now we just find the difference
        if ($diff == 0) {
            return 'agora mesmo';
        }

        if ($diff < 60) {
            return $diff == 1 ? $diff . ' segundo atrás' : $diff . ' segundos atrás';
        }

        if ($diff >= 60 && $diff < $intervals['hour']) {
            $diff = floor($diff / $intervals['minute']);

            return $diff == 1 ? $diff . ' minuto atrás' : $diff . ' minutos atrás';
        }

        if ($diff >= $intervals['hour'] && $diff < $intervals['day']) {
            $diff = floor($diff / $intervals['hour']);

            return $diff == 1 ? $diff . ' hora atrás' : $diff . ' horas atrás';
        }

        if ($diff >= $intervals['day'] && $diff < $intervals['week']) {
            $diff = floor($diff / $intervals['day']);

            return $diff == 1 ? $diff . ' dia atrás' : $diff . ' dias atrás';
        }

        if ($diff >= $intervals['week'] && $diff < $intervals['month']) {
            $diff = floor($diff / $intervals['week']);

            return $diff == 1 ? $diff . ' semana atrás' : $diff . ' semanas atrás';
        }

        if ($diff >= $intervals['month'] && $diff < $intervals['year']) {
            $diff = floor($diff / $intervals['month']);

            return $diff == 1 ? $diff . ' meses atrás' : $diff . ' meses atrás';
        }

        if ($diff >= $intervals['year']) {
            $diff = floor($diff / $intervals['year']);

            return $diff == 1 ? $diff . ' ano atrás' : $diff . ' anos atrás';
        }
    }
}