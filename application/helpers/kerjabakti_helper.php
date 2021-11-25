<?php
function configEmail()
{
  $config = [
          'protocol'    => 'smtp',
          'smtp_host'   => '192.168.8.3',
          'smtp_user'   => 'admin.web@mri-research-ind.com',
          'smtp_pass'   => 'w3bminMRI',
          'smtp_port'	  => 25,
          'smtp_timeout' => 30,
          'mailtype'    => 'html',
          'charset'     => 'iso-8859-1',
          'crlf'        => "\r\n",
          'newline'     => "\r\n",
  ];

  return $config;
}
function number_of_weekend_days($startDate, $endDate)
{
    $weekendDays = 0;
    $startTimestamp = strtotime($startDate);
    $endTimestamp = strtotime($endDate);
    for ($i = $startTimestamp; $i <= $endTimestamp; $i = $i + (60 * 60 * 24)) {
        if (date("N", $i) > 5) $weekendDays = $weekendDays + 1;
    }
    return $weekendDays;
}

function number_of_working_days($from, $to) {
    $workingDays = [1, 2, 3, 4, 5]; # date format = N (1 = Monday, ...)
    $holidayDays = ['*-12-25', '*-01-01', '2013-12-23']; # variable and fixed holidays

    $from = new DateTime($from);
    $to = new DateTime($to);
    $to->modify('+1 day');
    $interval = new DateInterval('P1D');
    $periods = new DatePeriod($from, $interval, $to);

    $days = 0;
    foreach ($periods as $period) {
        if (!in_array($period->format('N'), $workingDays)) continue;
        if (in_array($period->format('Y-m-d'), $holidayDays)) continue;
        if (in_array($period->format('*-m-d'), $holidayDays)) continue;
        $days++;
    }
    return $days;
}

function getWeeks($date, $rollover)
    {
        $cut = substr($date, 0, 8);
        $daylen = 86400;

        $timestamp = strtotime($date);
        $first = strtotime($cut . "00");
        $elapsed = ($timestamp - $first) / $daylen;

        $weeks = 1;

        for ($i = 1; $i <= $elapsed; $i++)
        {
            $dayfind = $cut . (strlen($i) < 2 ? '0' . $i : $i);
            $daytimestamp = strtotime($dayfind);

            $day = strtolower(date("l", $daytimestamp));

            if($day == strtolower($rollover))  $weeks ++;
        }

        return $weeks;
    }
