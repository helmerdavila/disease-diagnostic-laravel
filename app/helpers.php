
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

if (!function_exists('collect_clean')) {
    /**
     * Transforma un array en coleccion y se encarga de limpiar los valores
     * que se encuentran vacios
     *
     * @param  array                           $array
     * @return Illuminate\Support\Collection
     */
    function collect_clean($array = [])
    {
        $collection = collect($array);
        $collection = $collection->filter(function ($element) {
            if ($element === '') {
                return false;
            }
            return true;
        });

        return $collection;
    }
}