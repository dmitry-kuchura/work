<?php

class Helper
{
    /**
     * Converts human readable quota size (e.g. 10 MB, 200.20 GB) into Kb, Mb, Gb, or Tb
     *
     * @param integer $bytes
     * @return int the result is in bytes
     */
    public static function fileSizeConvert($bytes = 0)
    {
        if ($bytes == 0) {
            return 0;
        } else {
            $base = log($bytes) / log(1024);
            $suffix = ['', 'KB', 'MB', 'GB', 'TB'];
            $f_base = floor($base);
            return round(pow(1024, $base - floor($base)), 1) . ' ' . $suffix[$f_base];
        }
    }

    /**
     * Convert to bytes quota size our company
     *
     * @param $bytes
     * @param $type
     * @return integer
     */
    public static function revertFileSizeConvert($bytes, $type)
    {
        switch ($type) {
            case 'KB':
                return $bytes * 1024;
                break;
            case 'MB':
                return $bytes * pow(1024, 2);
                break;
            case 'GB':
                return $bytes * pow(1024, 3);
                break;
            case 'TB':
                return $bytes * pow(1024, 4);
                break;
            default:
                return $bytes;
                break;
        }
    }
}