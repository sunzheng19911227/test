<?php
$string =  'iUxaTwANChoKEDAgQAlAAQUOMAA9AAAAAFaYvG1WmLxtADKLBZkAAAJmAAACNKu8
            wBMAFzJhMzhhNGE5MzE2YzQ5ZTVhODMzNTE3YzQ1ZDMxMDcwIDg2MTM5ODVldAMA
            E2I4Zjc1N2FlNjQzOWU4NzliYjJhIHwgUm9tYW4gSGl0bWFuCj0gHgAAAAcKL1Rk
            NldGb0FBQVRtMXJSR0FnQWhBUndBQAAAAHRRejFqTTRBRnlBUlZkQUNrSUJFU2l3
            VU5uMHF1VVVBRElIZ3kyCjVsU1RROFM3R1ZHcU1TeTBxNUlqbjR1cmFJS05zcjRW
            Q2J1WmRhOXllTElEUWZYTkc2UUFpWW1YWmZXQmx5SjQKa2NJTGFHcnAyWkc0d1NY
            dzUzaEJyOHNQd1RRb1B1QjNsTGtySEdWV2N5OFZxMklRUGlnaTU0d3dZNGpJVFpi
            dgpudmwxOFNJYWtvOWsyZUhGd3h6SXY0b1BJWG1zeXRiQmRWZVVhTStFTzQwbm1J
            UkthTk9SNzFNZUROZkxVQmFkCmdHa2RnM2t2alRPa0xwNkJiSWMzOS9icm1yTzBH
            Z1ZhdUQ1WHRHVU5CdHJ2aTBlemRSSlJGcldxT1N1SkdKd2UKTWRsNVJrMTdidFc3
            ekFUUmI5cXRYZTlDTW1JQUUvM2I0Y1d1WW5uKy9MdFFNYW1yU3BOWGk2VnpGMThZ
            eEpMcwpycHZScTlRcTdyWk9ZZk10YXJxZWdRUG5TYVwwTDMAHHRqeEdhc0JiaThz
            QUFiRUM4d0lBQUVvcVZQK3h4R2Y3CkFnQUFBQUFFV1ZvPQoRAAAAAAAA';
echo gzdecode($string);
exit;
echo strlen($string);
$string =  'iUxaTwANChoKEDAgQAlAAQUOMAA9AAAAAFaYvG1WmLxtADKLBZkAAAJmAAACNKu8';
echo strlen($string);
$string = 'Q09OQ0FUKEQzMjEgTzE0NTQgQjEwMTAxMTAwLCBDQVBUQ0hBPVYyRVgpDQo=';
echo strlen($string);
var_dump(base64_decode($string));
echo '321812172';

function gzdecode ($data) {      
    $flags = ord(substr($data, 3, 1));      
    $headerlen = 10;      
    $extralen = 0;      
    $filenamelen = 0;      
    if ($flags & 4) {      
        $extralen = unpack('v' ,substr($data, 10, 2));      
        $extralen = $extralen[1];      
        $headerlen += 2 + $extralen;      
    }      
    if ($flags & 8) // Filename      
        $headerlen = strpos($data, chr(0), $headerlen) + 1;      
    if ($flags & 16) // Comment      
        $headerlen = strpos($data, chr(0), $headerlen) + 1;      
    if ($flags & 2) // CRC at end of file      
        $headerlen += 2;      
    $unpacked = @gzinflate(substr($data, $headerlen));      
    if ($unpacked === FALSE)      
          $unpacked = $data;      
    return $unpacked;      
 }    
?> 