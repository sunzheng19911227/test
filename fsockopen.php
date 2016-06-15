<?php
//	$fp = fsockopen("www.example.com",
//	 80, $errno, $errstr, 30);   
//	if (!$fp) {   
//	echo "$errstr ($errno)<br />\n";   
//	} else {   
//	$out = "GET / HTTP/1.1\r\n";   
//	$out .= "Host: www.example.com\r\n";   
//	$out .= "Connection: Close\r\n\r\n";   
//	 
//	fwrite($fp, $out);   
//	while (!feof($fp)) {   
//	echo fgets($fp, 128);   
//	}   
//	fclose($fp);   
//	} 
	echo "Program starts at ". date('h:i:s') . ".\n";

        $timeout=10; 
        $result=array(); 
        $sockets=array(); 
        $convenient_read_block=8192;
        
        /* Issue all requests simultaneously; there's no blocking. */
        $delay=15;
        $id=0;
        while ($delay > 0) {
            $s=stream_socket_client("phaseit.net:80", $errno,
                  $errstr, $timeout,
                  STREAM_CLIENT_ASYNC_CONNECT|STREAM_CLIENT_CONNECT); 
            if ($s) { 
                $sockets[$id++]=$s; 
                $http_message="GET /demonstration/delay?delay=" .
                    $delay . " HTTP/1.0\r\nHost: phaseit.net\r\n\r\n"; 
                //fwrite($s, $http_message);
            } else { 
                echo "Stream " . $id . " failed to open correctly.";
            } 
            $delay -= 3;
        } 
        
        while (count($sockets)) { 
            $read=$sockets; 
            stream_select($read, $w=null, $e=null, $timeout); 
            if (count($read)) {
                /* stream_select generally shuffles $read, so we need to
                   compute from which socket(s) we're reading. */
                foreach ($read as $r) { 
                    $id=array_search($r, $sockets); 
                    $data=fread($r, $convenient_read_block); 
                    /* A socket is readable either because it has
                       data to read, OR because it's at EOF. */
                    if (strlen($data) == 0) { 
                        echo "Stream " . $id . " closes at " . date('h:i:s') . ".\n";
                        fclose($r); 
                        unset($sockets[$id]); 
                    } else { 
                        $result[$id] .= $data; 
                    } 
                } 
            } else { 
                /* A time-out means that *all* streams have failed
                   to receive a response. */
                echo "Time-out!\n";
                break;
            } 
        } 
?>