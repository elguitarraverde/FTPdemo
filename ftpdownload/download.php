<?php

$ftp_server = "your_ftp_server";
$ftp_username = "your_ftp_username";
$ftp_password = 'your_ftp_password';
$download_dir = "/htdocs/";

if (isset($_POST["file"])) {
    $file_name = $_POST["file"];

    // Connect to the FTP server
    $conn_id = ftp_connect($ftp_server);

    if ($conn_id) {
        // Login to the FTP server
        $login_result = ftp_login($conn_id, $ftp_username, $ftp_password);

        if ($login_result) {
            // Enable passive mode
            ftp_pasv($conn_id, true);

            $remote_file_path = $download_dir . $file_name;
            $local_file_path = "C:/Users/your-username/Desktop/download/" . $file_name;

            // Download the file
            if (ftp_get($conn_id, $local_file_path, $remote_file_path, FTP_BINARY)) {
                echo "File downloaded successfully.";
            } else {
                echo "Download failed.";
            }
        } else {
            echo "FTP login failed.";
        }

        // Close the FTP connection
        ftp_close($conn_id);
    } else {
        echo "Could not connect to FTP server.";
    }
} else {
    echo "Invalid file name.";
}
