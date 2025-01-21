<?php

include_once 'includes/Database.class.php';

function submit($name, $mobile, $email, $file, $position, $others, $experience) {
    // Establish database connection
    $conn = Database::getConnection();

    // Validate the file type (PDF)
    $allowedTypes = ['application/pdf'];
    if (!in_array($file['type'], $allowedTypes)) {
        return "Only PDF files are allowed.";
    }

    // Check for upload errors
    if ($file['error'] != 0) {
        return "Error uploading file: " . $file['error'];
    }

    // Read the file content and store it as a blob
    $file = file_get_contents($file['tmp_name']);

    // Use prepared statements to prevent SQL injection
    $sql = "INSERT INTO `applications` 
            (`NAME`, `MOBILE`, `EMAIL`, `RESUME_PATH`, `POSITION`, `OTHERS`, `EXPERIENCE`) 
            VALUES ('$name','$mobile','$email','$file','$postion','$others','$experience')";

    // Prepare the SQL statement
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        return "Error preparing statement: " . $conn->error;
    }

    // Bind parameters to the placeholders in the SQL query
    $stmt->bind_param("ssssssi", $name, $mobile, $email, $file, $position, $others, $experience);

    // Execute the statement
    $result = $stmt->execute();

    if ($result === true) {
        $error = false; // Successfully inserted
    } else {
        $error = "Error executing query: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();

    return $error;
}



//('$name','$mobile','$email','$file','$postion','$others','$experience')";