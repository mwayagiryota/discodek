<?php

// Database connection
require('../includes/connect_db.php');

if (!empty($_POST['email'])) {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Check if email exists
        $check_query = "SELECT email FROM email_subscribers WHERE email = ?";
        $stmt = $dbc->prepare($check_query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            echo '<p style="font-weight: bold; color: red">
                    This email is already subscribed!
                  </p>';
        } else {
            // Add to database
           // Get the preferences from the form
$preferences = isset($_POST['preferences']) ? implode(',', $_POST['preferences']) : '';

// Add to database with preferences
$insert_query = "INSERT INTO email_subscribers (email, preferences, subscription_date) VALUES (?, ?, NOW())";
$stmt = $dbc->prepare($insert_query);
$stmt->bind_param("ss", $email, $preferences);
            
            if ($stmt->execute()) {
                // Send notification email to admin
// Sends email from domains email addresss 
$adminBody = "New subscriber email: {$email}\n";
$adminBody = wordwrap($adminBody, 70);
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
$headers .= "From: Chesterfield Connects <noreply@chesconnect.co.uk>\r\n";
$headers .= "Return-Path: noreply@chesconnect.co.uk\r\n";
// Send notification email to admin about who subscribes
// Add my own personal email here
mail('', 'New Subscription', $adminBody, $headers);
                //  Welcome email to subscriber with styling.
                $subscriberHTML = '
                <!DOCTYPE html>
                <html>
                <body style="margin: 0; padding: 0; font-family: Arial, sans-serif;">
                    <div style="max-width: 600px; margin: 0 auto; padding: 20px;">
                        <div style="text-align: center; margin-bottom: 30px;">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/46/Panorama_from_top_of_the_crooked_spire_chesterfield_-_panoramio.jpg/800px-Panorama_from_top_of_the_crooked_spire_chesterfield_-_panoramio.jpg" 
                                 alt="Chesterfield" 
                                 style="width: 100%; max-width: 600px; height: auto; border-radius: 8px;">
                        </div>
                        <div style="background-color: #f8f9fa; padding: 30px; border-radius: 5px;">
                            <h1 style="color: #4299e1; text-align: center;">Welcome to Chesterfield Connects!</h1>
                            <p>Thank you for subscribing to Chesterfield Connects updates. You will now receive regular updates about our projects.</p>
                            <p>To unsubscribe, please visit: <a href="https://chesconnect.co.uk/includes/email_updates.html" style="color: #4299e1;">Unsubscribe</a></p>
                        </div>
                    </div>
                </body>
                </html>';
                // Email sent from domain email
                  $headers = "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
                $headers .= "From: Chesterfield Connects <noreply@chesconnect.co.uk>\r\n";
                $headers .= "Return-Path: noreply@chesconnect.co.uk\r\n";
                mail($email, 'Welcome to Chesterfield Connects', $subscriberHTML, $headers);
                // When clicking subscribe button
                
                echo '<p style="font-weight: bold; color: green">
                        Thank you for subscribing! You will receive updates about Chesterfield Connects projects.
                      </p>';
            } else {
                echo '<p style="font-weight: bold; color: red">
                        There was an error processing your subscription. Please try again.
                      </p>';
            }
            $stmt->close();
        }
    } else {
        echo '<p style="font-weight: bold; color: red">
                Please enter a valid email address.
              </p>';
    }
} else {
    echo '<p style="font-weight: bold; color: red">
            Please enter your email address.
          </p>';
}
$dbc->close();
?>
                
