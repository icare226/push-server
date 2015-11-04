<html>

<head>
<title>Add New Record in MySQL Database</title>
</head>

<body>
<?php
    if(isset($_POST['add']))
    {
        $servername = '192.168.10.100';
        $username = 'soroeru_app';
        $password = 'soroeru19799';
        $dbname = 'soroeru_app';
        
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $query = "SELECT token FROM tablename";
        $result = mysql_query($query) or die ("no query");
        
        $result_array = array();
        while($row = mysql_fetch_assoc($result))
        {
            $result_array[] = $row;
        }
        
//        echo ' token Array' .$storeArray;


        $message = $_POST['message'];
        $tHost = 'gateway.sandbox.push.apple.com';
        $tPort = 2195;
        $tCert = 'AppleDevelopment.pem';
             $tPassphrase = 'password';
      
        $tToken = '5c98e682120e81b0a240489a81613acbbf91275134a686db4651819bf049d75f';
         $tBadge = 1;
        
        // Audible Notification Option.
        
        $tSound = 'default';
        
        // The content that is returned by the LiveCode "pushNotificationReceived" message.
        
        $tPayload = 'APNS Message Handled by LiveCode';
        
        // Create the message content that is to be sent to the device.
        
        $tBody['aps'] = array (
                               
                               'alert' => $message,
                               
                               'badge' => $tBadge,
                               
                               'sound' => $tSound,
                               
                               );
        
        $tBody ['payload'] = $tPayload;
        
        
        $tBody = json_encode ($tBody);
        
        // Create the Socket Stream.
        
        $tContext = stream_context_create ();
        
        stream_context_set_option ($tContext, 'ssl', 'local_cert', $tCert);
        
        // Remove this line if you would like to enter the Private Key Passphrase manually.
        
        stream_context_set_option ($tContext, 'ssl', 'passphrase', $tPassphrase);
        $apns = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $error, $errorString, 2, STREAM_CLIENT_CONNECT, $tContext);
       if (!$apns)
            
       exit ("APNS Connection Failed: $error $errstr" . PHP_EOL);
        $tMsg = chr (0) . chr (0) . chr (32) . pack ('H*', $tToken) . pack ('n', strlen ($tBody)) . $tBody;
        $tResult = fwrite ($apns, $tMsg, strlen ($tMsg));
       if ($tResult)
        echo 'Delivered Message to APNS' . PHP_EOL;
        else
          echo 'Could not Deliver Message to APNS' . PHP_EOL;
        
        // Close the Connection to the Server.
        
        fclose ($apns);
        
    }
    else
    {
        ?>

<form method="post" action="<?php $_PHP_SELF ?>">
<table width="400" border="0" cellspacing="1" cellpadding="2">

<tr>
<td width="400">SendMessage</td>
<td><input name="message" type="text" id="message"></td>
</tr>


<tr>
<td width="100"> </td>
<td> </td>
</tr>

<tr>
<td width="100"> </td>
<td>
<input name="add" type="submit" id="add" value="Send Message">
</td>
</tr>

</table>
</form>

<?php
    }
    ?>

</body>
</html><html>

<head>
<title>Add New Record in MySQL Database</title>
</head>

<body>
<?php
    if(isset($_POST['add']))
    {
        $servername = '192.168.10.100';
        $username = 'soroeru_app';
        $password = 'soroeru19799';
        $dbname = 'soroeru_app';
        
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $query = "SELECT token FROM tablename";
        $result = mysql_query($query) or die ("no query");
        
        $result_array = array();
        while($row = mysql_fetch_assoc($result))
        {
            $result_array[] = $row;
        }
        
//        echo ' token Array' .$storeArray;


        $message = $_POST['message'];
        $tHost = 'gateway.sandbox.push.apple.com';
        $tPort = 2195;
        $tCert = 'AppleDevelopment.pem';
             $tPassphrase = 'password';
      
        $tToken = '5c98e682120e81b0a240489a81613acbbf91275134a686db4651819bf049d75f';
         $tBadge = 1;
        
        // Audible Notification Option.
        
        $tSound = 'default';
        
        // The content that is returned by the LiveCode "pushNotificationReceived" message.
        
        $tPayload = 'APNS Message Handled by LiveCode';
        
        // Create the message content that is to be sent to the device.
        
        $tBody['aps'] = array (
                               
                               'alert' => $message,
                               
                               'badge' => $tBadge,
                               
                               'sound' => $tSound,
                               
                               );
        
        $tBody ['payload'] = $tPayload;
        
        
        $tBody = json_encode ($tBody);
        
        // Create the Socket Stream.
        
        $tContext = stream_context_create ();
        
        stream_context_set_option ($tContext, 'ssl', 'local_cert', $tCert);
        
        // Remove this line if you would like to enter the Private Key Passphrase manually.
        
        stream_context_set_option ($tContext, 'ssl', 'passphrase', $tPassphrase);
        $apns = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $error, $errorString, 2, STREAM_CLIENT_CONNECT, $tContext);
       if (!$apns)
            
       exit ("APNS Connection Failed: $error $errstr" . PHP_EOL);
        $tMsg = chr (0) . chr (0) . chr (32) . pack ('H*', $tToken) . pack ('n', strlen ($tBody)) . $tBody;
        $tResult = fwrite ($apns, $tMsg, strlen ($tMsg));
       if ($tResult)
        echo 'Delivered Message to APNS' . PHP_EOL;
        else
          echo 'Could not Deliver Message to APNS' . PHP_EOL;
        
        // Close the Connection to the Server.
        
        fclose ($apns);
        
    }
    else
    {
        ?>

<form method="post" action="<?php $_PHP_SELF ?>">
<table width="400" border="0" cellspacing="1" cellpadding="2">

<tr>
<td width="400">SendMessage</td>
<td><input name="message" type="text" id="message"></td>
</tr>


<tr>
<td width="100"> </td>
<td> </td>
</tr>

<tr>
<td width="100"> </td>
<td>
<input name="add" type="submit" id="add" value="Send Message">
</td>
</tr>

</table>
</form>

<?php
    }
    ?>

</body>
</html>