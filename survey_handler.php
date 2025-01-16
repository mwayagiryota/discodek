<?php
// Include database connection 
require('../includes/connect_db.php');

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the submitted data
    $project_id = $_POST['project'];
    $postcode = strtoupper(trim($_POST['postcode']));
    $knew_field = "knew-" . $project_id;
    
    // Looking for excited or satisfied field based on project
    $response_field = "";
    if ($project_id == "queensParkSports" || $project_id == "stHelena") {
        $response_field = "satisfied-" . $project_id;
        $response_column = "happy_with_result";  // Use existing column for completed projects
    } else {
        $response_field = "excited-" . $project_id;
        $response_column = "excited_about_project";  // Use existing column for ongoing projects
    }
    
    // Directly get the values
    $knew_about = $_POST[$knew_field];
    $response_value = $_POST[$response_field];
    $comments = isset($_POST['comments']) ? substr(trim($_POST['comments']), 0, 200) : '';
    
    // Build the query based on project type
    if ($project_id == "queensParkSports" || $project_id == "stHelena") {
        $query = "INSERT INTO survey_responses 
                  (project_name, postcode, knew_about_project, happy_with_result, comments, submission_date) 
                  VALUES 
                  ('$project_id', '$postcode', '$knew_about', '$response_value', '$comments', NOW())";
    } else {
        $query = "INSERT INTO survey_responses 
                  (project_name, postcode, knew_about_project, excited_about_project, comments, submission_date) 
                  VALUES 
                  ('$project_id', '$postcode', '$knew_about', '$response_value', '$comments', NOW())";
    }
    
    // Query execution
    if ($dbc->query($query)) {
        echo "Thank you for your feedback!";
    } else {
        echo "Feedback error try again: " . $dbc->error;
    }
}
?>