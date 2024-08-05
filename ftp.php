<?php
            $ftp_server="files.000webhost.com";
             $ftp_user_name="orewaotaku";
             $ftp_user_pass='cxM$SM*kP#xnu$T$3ipj';
             $file = "file:///C:/Users/Chien/Downloads/Soloop_20210517112731.mp4";//tobe uploaded
             $remote_file = "a.mp4";
            
             // set up basic connection
             $conn_id = ftp_connect($ftp_server,21);
            
             // login with username and password
             $login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);
            
             // upload a file
             if (ftp_put($conn_id, $remote_file, $file, FTP_BINARY)) {
                echo "successfully uploaded $file\n";
                exit;
             } else {
                echo "There was a problem while uploading $file\n";
                exit;
                }
             // close the connection
             ftp_close($conn_id);
?>