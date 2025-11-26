
<?php
session_start();
include 'conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // 1. Generate Unique Case Number (e.g., HV-654A2B)
    $case_number = "HV-" . strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 6));

    // 2. Handle Anonymity
    $is_anonymous = isset($_POST['is_anonymous']) ? 1 : 0;
    
    if ($is_anonymous) {
        $victim_name = "Anonymous";
        $victim_contact = "Not Provided";
    } else {
        $victim_name = $_POST['victim_name'];
        $victim_contact = $_POST['victim_contact'];
    }

    // 3. Collect Other Inputs
    $org_id = $_POST['organization_id']; // This must be an Integer
    $incident_type = $_POST['incident_type'];
    $incident_date = $_POST['incident_date'];
    $incident_time = $_POST['incident_time'];
    $incident_location = $_POST['incident_location'];
    $description = $_POST['description'];
    $perpetrator_info = $_POST['perpetrator_info'];
    $ip_address = $_SERVER['REMOTE_ADDR'];

    // 4. Database Insertion (Using Prepared Statements for Security)
    $sql = "INSERT INTO reports (
        case_number, organization_id, victim_name, victim_contact, is_anonymous, 
        incident_type, incident_date, incident_time, incident_location, 
        description, perpetrator_info, ip_address, status
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'pending')";

    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        // "isssisssssss" refers to the data types: i=integer, s=string
        $stmt->bind_param("sissssssssss", 
            $case_number, 
            $org_id, 
            $victim_name, 
            $victim_contact, 
            $is_anonymous, 
            $incident_type, 
            $incident_date, 
            $incident_time, 
            $incident_location, 
            $description, 
            $perpetrator_info, 
            $ip_address
        );

        if ($stmt->execute()) {
            $_SESSION['message'] = "Report Submitted Successfully! Your Case Number is: <strong>" . $case_number . "</strong>. Please save this number.";
            $_SESSION['msg_type'] = "success";
        } else {
            $_SESSION['message'] = "Database Error: " . $stmt->error;
            $_SESSION['msg_type'] = "error";
        }
        $stmt->close();
    } else {
        $_SESSION['message'] = "Preparation Error: " . $conn->error;
        $_SESSION['msg_type'] = "error";
    }

    header("Location: index.php#report");
    exit();
}
?>