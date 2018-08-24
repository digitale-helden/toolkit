<?php

if(!function_exists('dh_export_csv'))
{
    /**
     * export/download csv data as string or array
     *
     * @param string|array|object $data expects the data to export
     * @param string $name expects the file name
     * @param string $delimiter expects the optional delimiter
     * @param string $enclosure expects the optional enclosure
     * @param string $escape_char expects the optional escape_char
     */
    function dh_export_csv($data, $name, $delimiter = ",", $enclosure = '"', $escape_char = "\\")
    {
        if(stripos($name, '.csv') === false)
        {
            $name = sprintf("%s.csv", trim($name));
        }
        header("Content-Description: File Transfer");
        header("Content-Type: application/csv");
        header("Content-Disposition: attachment; filename=$name");
        header("Cache-Control: private", false);
        header("Cache-Control: no-cache, no-store, must-revalidate");
        header("Content-Transfer-Encoding: binary");
        header("Pragma: no-cache");
        header("Expires: 0");
        if(is_array($data) || is_object($data))
        {
            $output = @fopen("php://output", "w");
            foreach((array)$data as $d)
            {
                @fputcsv($output, $d, $delimiter, $enclosure, $escape_char);
            }
            @fclose($output);
        }else{
            echo (string)$data;
        }
        exit();
    }
}
