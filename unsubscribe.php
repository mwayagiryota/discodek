<?php
// Include the database connection
require('../includes/connect_db.php');
error_reporting(0);

if (!empty($_POST['email'])) {
    // Sanitize the email
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Check if email exists and is active
     $check_query = "SELECT status FROM email_subscribers WHERE email = ?";        $stmt = $dbc->prepare($check_query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($row['status'] === 'unsubscribed') {
                echo '<p style="font-weight: bold; color: red">
                        This email is already unsubscribed!
                      </p>';
            } else {
                // Update subscriber status
                $update_query = "UPDATE email_subscribers SET status = 'unsubscribed', unsubscribe_date = NOW() WHERE email = ?";
                $stmt = $dbc->prepare($update_query);
                $stmt->bind_param("s", $email);
                
                if ($stmt->execute()) {
                    // The email body
                    $body = "Unsubscribe request from email: {$_POST['email']}\n";
                    $body = wordwrap($body, 70);
                    
                    // Send notification email
                    mail('mwaka@live.co.uk', 'Subscription Cancelled', $body, "From: {$_POST['email']}");
                    
                    // Reset the form data
                    $_POST = array();
                    
                    // Display success message
                    echo '<p style="font-weight: bold; color: green">
                            You have been successfully unsubscribed from our mailing list.
                          </p>';
                } else {
                    echo '<p style="font-weight: bold; color: red">
                            There was an error processing your unsubscribe request. Please try again.
                          </p>';
                }
            }
        } else {
            echo '<p style="font-weight: bold; color: red">
                    This email address is not found in our subscription list.
                  </p>';
        }
        $stmt->close();
    } else {
        echo '<p style="font-weight: bold; color: red">
                Please enter a valid email address.
              </p>';
    }
} else {
    echo '<p style="font-weight: bold; color: red">
            Please enter your email address to unsubscribe.
          </p>';
}
$dbc->close();
?>