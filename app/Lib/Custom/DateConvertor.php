<?php

/*
 */

class DateConvertor {

    /**
     * converts a string of type 'mm/dd/yyyy' to the cake expected format:
     * array('day' => dd, 'month' => mm, 'year' => yyyy)
     * @param type $datePicker date string of type dd/mm/yyyy
     * @return mixed cake friendly date
     */
    public static function convert($datePicker) {
        //check if valid date
        $pattern = '~(0[1-9]|1[012])/(0[1-9]|[12][0-9]|3[01])/((19|20)\d\d)~';

        if (!$datePicker && preg_match($pattern, $datePicker)) {
            $splitDate = explode('/', $datePicker);
            $convertedDate = array(
                'month' => $splitDate[0],
                'day' => $splitDate[1],
                'year' => $splitDate[2]
            );
        } else {
            $convertedDate = array(
                'month' => '',
                'day' => '',
                'year' => ''
            );
        }

        return $convertedDate;
    }

}
