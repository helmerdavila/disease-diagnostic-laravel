<?php

if (!function_exists('array_months')) {
    function array_months()
    {
        $today   = \Carbon\Carbon::create(null, null, 1);
        $newDate = $today->copy();

        for ($month = 1; $month <= 12; $month++) {
            // si ya no es el primer mes, restamos un dia y mandamos la fecha
            // a primer dia de mes
            if ($month != 1) {
                $newDate->subDay();
                $newDate->startOfMonth();
            }
            $months[$month] = "{$newDate->year}-{$newDate->month}";
        }

        return $months;
    }
}
