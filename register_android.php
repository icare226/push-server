<?php
	
				$token = $_GET['token'];
				
				if($token == "")
					return;

            $dbhost = '192.168.10.100';
            $dbuser = 'soroeru_app';
            $dbpass = 'soroeru19799';

            mysql_connect($dbhost, $dbuser, $dbpass) or DIE('Connection to host isailed, perhaps the service is down!');            
            mysql_select_db('soroeru_app');
                      
				$sql = "SELECT * FROM tbl_device_token WHERE device_token='".$token."'";
				$result = mysql_query( $sql );
				
				if(mysql_num_rows($result) != 0)
				{
					return;
				}
			
            $sql = "INSERT INTO tbl_device_token". "(device_token)". "VALUES('$token')";

			
            $retval = mysql_query( $sql );
            
            if(! $retval)
            {
               die('Could not enter data: ' . mysql_error());
            }
			            
            echo "Entered data successfully\n";
            
            mysql_close();
	
?>