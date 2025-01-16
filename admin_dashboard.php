<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if logged in as admin
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: admin_login.php');
    exit();
}

// Include database connection in same directory
require(__DIR__ . '/connect_db.php');

// Function to get email subscribers
function getEmailSubscribers($dbc) {
    $query = "SELECT * FROM email_subscribers ORDER BY subscription_date DESC";
    $result = $dbc->query($query);
    if (!$result) {
        die('Error fetching subscribers: ' . $dbc->error);
    }
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Function to get survey responses
function getSurveyResponses($dbc) {
    $query = "SELECT project_name, postcode, knew_about_project, excited_about_project, 
              comments, submission_date 
              FROM survey_responses 
              ORDER BY submission_date DESC";
    $result = $dbc->query($query);
    if (!$result) {
        die('Error fetching survey responses: ' . $dbc->error);
    }
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Get data - using $dbc instead of $pdo
$subscribers = getEmailSubscribers($dbc);
$surveys = getSurveyResponses($dbc);
?>
<!DOCTYPE html>
<html lang="en">
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Chesterfield Connect</title>
    <!-- External stylesheet links -->
    <link href="https://fonts.googleapis.com/css2?family=Bubblegum+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poor+Story" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Bubblegum+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poor+Story" rel="stylesheet">
    <link rel="stylesheet" href="../css/timelinegrid.css">
    <link rel="stylesheet" href="../css/popupptl.css"> 
    <link rel="stylesheet" href="../css/navbar.css">  
    <link rel="stylesheet" href="../css/polaroid.css">  
    <link rel="stylesheet" href="../css/welcome.css">  
    <link rel="stylesheet" href="../css/accesibility.css">
     <link rel="stylesheet" href="../css/admin_tables.css">

</head>
<body>
    <!-- Main header section with Accessibility Controls -->
    <header class="header">
        <h1>Chesterfield Connect - Admin Dashboard</h1>
    </header>
    
    <nav class="topnav" id="myTopnav">
        <div class="nav-links">
            <a href="index.php">Home</a>
            <a href="email_updates.html">Email updates</a>  
            <a href="https://www.chesterfield.gov.uk/">Chesterfield Council</a>
            <a href="https://www.derbyshiretimes.co.uk/news">Chesterfield News</a>
            <a href="admin_logout.php" class="admin_logout">Logout</a>
        </div>
        
        <div class="accessibility-controls">
            <button class="accessibility-btn" onclick="toggleHighContrast()">
                <span class="icon"></span>
                High Contrast
            </button>
            <div class="text-size-controls">
                <button class="accessibility-btn" onclick="decreaseText()">
                    <span class="icon">A-</span>
                </button>
                <button class="accessibility-btn" onclick="increaseText()">
                    <span class="icon">A+</span>
                </button>
            </div>
        </div>
    </nav>

    <div class="welcome-section">
        <div class="tab-container">
            <button class="survey-button active" onclick="showTab('subscribers')">Email Subscribers</button>
            <button class="survey-button" onclick="showTab('surveys')">Survey Responses</button>
        </div>

        <!-- Email Subscribers Section -->
        <div id="subscribers" class="project-grid">
            <h2>Email Subscribers</h2>
            <div class="data-table">
                <table>
                    <thead>
                        <tr>
                            <th>Email</th>
                            <th>Subscription Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($subscribers as $subscriber): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($subscriber['email']); ?></td>
                            <td><?php echo htmlspecialchars($subscriber['subscription_date']); ?></td>
                            <td><?php echo htmlspecialchars($subscriber['status']); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
<!-- Survey Responses Section -->
<div id="surveys" class="project-grid" style="display: none;">
    <h2>Survey Responses</h2>
    <div class="data-table">
        <table>
            <thead>
                <tr>
                    <th>Project</th>
                    <th>Postcode</th>
                    <th>Knew About Project</th>
                    <th>Excited About Project</th>
                    <th>Comments</th>
                    <th>Submission Date</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                // 1. Taking the $surveys array , survey responses from the db
                // 2. Loop through each survey one at a time
                // 3. Each time store it in the variable
                // 4. Then loop creating a new table row
                foreach ($surveys as $survey): ?>
                <tr>
                    <td><?php echo htmlspecialchars($survey['project_name'] ?? 'Not specified'); ?></td>
                    <td><?php echo htmlspecialchars($survey['postcode'] ?? 'Not specified'); ?></td>
                    <td><?php echo htmlspecialchars($survey['knew_about_project'] ?? 'Not specified'); ?></td>
                    <td><?php echo htmlspecialchars($survey['excited_about_project'] ?? 'Not specified'); ?></td>
                    <td><?php echo htmlspecialchars($survey['comments'] ?? ''); ?></td>
                    <td><?php echo htmlspecialchars($survey['submission_date']); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
        <!-- Javascript -->
    <script src="accesibility.js"></script>
    <script>
    function showTab(tabName) {
        // Hide all sections
        document.querySelectorAll('.project-grid').forEach(section => {
            section.style.display = 'none';
        });
        
        // Show selected section
        document.getElementById(tabName).style.display = 'block';
        
        // Update active tab button
        document.querySelectorAll('.survey-button').forEach(button => {
            button.classList.remove('active');
        });
        event.target.classList.add('active');
    }
    </script>
</body>
</html>