<?php

	$msg = $_POST['message'];

	if($_POST['android'] == 'on')
	{
		$registration_ids = array();

		$dbhost = '192.168.10.100';
		$dbuser = 'soroeru_app';
		$dbpass = 'soroeru19799';

		mysql_connect($dbhost, $dbuser, $dbpass) or DIE('Connection to host isailed, perhaps the service is down!');            
		mysql_select_db('soroeru_app');
	  

		$sql = "SELECT * FROM `tbl_devioe_token`";
		$query = mysql_query($sql);

		if(mysql_num_rows($query) != 0)
		{
			while($row = mysql_fetch_assoc($query))
			{
				array_push($registration_ids, $row['device_token']);
			}
		}
		
		$fields = array(
			'registration_ids' =>  $registration_ids,
			'data'			   => 	array('msg' => $msg)
			);

		$headers = array(
			'Authorization: key=AIzaSyCfpYkWWZfZAnV0aDEHk_I0QDiVPMGm2RM',
			'Content-Type: application/json'
		);

		$ch = curl_init();
		curl_setopt( $ch,CURLOPT_URL, 'https://android.googleapis.com/gcm/send' );
		curl_setopt( $ch,CURLOPT_POST, true );
		curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
		$result = curl_exec($ch );
		
	//	print_r($registration_ids);
	//	print_r($fields);
	//	echo $result;
		if(curl_errno($ch))
		{
			 // echo 'GCM error:'.curl_error($ch);
		}
		curl_close( $ch );
		
		echo "PUSH?????????????";
	}
	if($_POST['iphone'] == 'on')
	{
		$dbhost = '192.168.10.100';
		$dbuser = 'soroeru_app';
		$dbpass = 'soroeru19799';

		mysql_connect($dbhost, $dbuser, $dbpass) or DIE('Connection to host isailed, perhaps the service is down!');            
		mysql_select_db('soroeru_app');
	  

		$sql = "SELECT * FROM `tablename`";
		$query = mysql_query($sql);

		if(mysql_num_rows($query) != 0)
		{
			while($row = mysql_fetch_assoc($query))
			{
				$deviceToken = $row['token'];

				// ???????
				$alert = $msg;

				// ???
				$badge = 1;

				$body = array();
				$body['aps'] = array( 'alert' => $alert );
				$body['aps']['badge'] = $badge;

				// SSL???
				$cert = 'dist_pushcert.pem';
				
				//$url = 'ssl://gateway.sandbox.push.apple.com:2195'; // ???
				$url = 'ssl://gateway.push.apple.com:2195'; // ???

				$context = stream_context_create();
				stream_context_set_option( $context, 'ssl', 'local_cert', $cert );
				$fp = stream_socket_client( $url, $err, $errstr, 60, STREAM_CLIENT_CONNECT, $context );

				if( !$fp ) {

				///	echo 'Failed to connect.' . PHP_EOL;
					exit( 1 );

				}
				//echo $deviceToken;
				$payload = json_encode( $body );
				$message = chr( 0 ) . pack( 'n', 32 ) . pack( 'H*', $deviceToken ) . pack( 'n', strlen($payload ) ) . $payload;

				//print 'send message:' . $payload . PHP_EOL;

				fwrite( $fp, $message );
				fclose( $fp );

			}
		}
		
		echo "PUSH?????????????";
		mysql_free_result($query);
	}
?>
<html>
	<script>
		function onBack()
		{
			window.location = 'http://app.soroeru.jp/send/index.html';
		}
	</script>
	<body>
		<br>
		<button onclick="onBack()" style="margin-top: 20px; width: 150px; height: 40px;">??</button>
	</body>
</html>