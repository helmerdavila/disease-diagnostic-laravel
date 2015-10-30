<?php

if (!function_exists('array_months')) {
    function array_months()
    {
        $today   = \Carbon\Carbon::create(null, null, 1);
        $newDate = $today->copy();

        for ($month = 1; $month <= 12; $month++) {
            if ($month != 1) {
                $newDate = $today->copy()->subMonth($month);
            }
            $months[$month] = "{$newDate->year}-{$newDate->month}";
        }

        return $months;
    }
}
