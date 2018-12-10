<?php
/**
 * csv服务
 */
namespace common\utils;

use Yii;

class CsvUtil
{

    public static function export($filename, $data,$charset="GBK")
    {
        header("Content-type:text/csv");
        header("Content-Disposition:attachment;filename=" . $filename);
        header('Cache-Control:must-revalidate,post-check=0,pre-check=0');
        header('Expires:0');
        header('Pragma:public');
        $data = mb_convert_encoding($data, $charset, 'utf-8');
        echo $data;
    }
    /**
     * 获取csv文件内容，返回数据
     * 
     * @param  [type] $filename [description]
     * @param  string $charset  [description]
     * @return [type]           [description]
     */
    public static function read($filename,$to_charset="",$from_charset="",$delimiter=","){
        $result = array ();
        if (file_exists ( $filename )) {
            $handle = fopen ( $filename, "r" );
            while ( ($data = self::getcsvdata ($handle,null,$delimiter)) !== FALSE ) {
                if(!empty($to_charset) && !empty($from_charset)){
                    foreach ($data as $key => $value) {
                       $data[$key]=mb_convert_encoding($value,$to_charset,$from_charset);
                    }
                }
                $result [] = $data;
            }
            fclose ( $handle );
        }
        return $result;
    }
    /**
     * 
     * 
     * @param unknown_type $handle
     * @param unknown_type $length
     * @param unknown_type $d
     * @param unknown_type $e
     */
    public static function  getcsvdata(& $handle, $length = null, $d = ',', $e = '"') {
         $d = preg_quote($d);
         $e = preg_quote($e);
         $_line = "";
         $eof=false;
         while ($eof != true) {
             $_line .= (empty ($length) ? fgets($handle) : fgets($handle, $length));
             $itemcnt = preg_match_all('/' . $e . '/', $_line, $dummy);
             if ($itemcnt % 2 == 0)
                 $eof = true;
         }
         $_csv_line = preg_replace('/(?: |[ ])?$/', $d, trim($_line));
         $_csv_pattern = '/(' . $e . '[^' . $e . ']*(?:' . $e . $e . '[^' . $e . ']*)*' . $e . '|[^' . $d . ']*)' . $d . '/';
         preg_match_all($_csv_pattern, $_csv_line, $_csv_matches);
         $_csv_data = $_csv_matches[1];
         for ($_csv_i = 0; $_csv_i < count($_csv_data); $_csv_i++) {
             $_csv_data[$_csv_i] = preg_replace('/^' . $e . '(.*)' . $e . '$/s', '$1' , $_csv_data[$_csv_i]);
             $_csv_data[$_csv_i] = str_replace($e . $e, $e, $_csv_data[$_csv_i]);
         }
         return empty ($_line) ? false : $_csv_data;
    }
}
