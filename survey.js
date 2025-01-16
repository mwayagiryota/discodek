document.addEventListener('DOMContentLoaded', function() {
    // Open survey popup
    const surveyButtons = document.querySelectorAll('.survey-button');
    
    surveyButtons.forEach(button => {
        button.addEventListener('click', function() {
            const projectId = this.getAttribute('data-project');
            const surveyPopup = document.getElementById(`survey-${projectId}`);
            if (surveyPopup) {
                surveyPopup.style.display = 'block';
            }
        });
    });

    // Handle form submissions
    document.querySelectorAll('.survey-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault(); 
            
            // Collect form data
            const formData = new FormData(this);
            
            // Send data to the PHP handler
            fetch('../includes/survey_handler.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                console.log('Server response:', data);
                
                // Get the project ID and close the form
                const projectId = this.closest('.survey-popup').id.replace('survey-', '');
                
                // Show response message 
                alert(data);
                
                // Close the form
                closeSurveyForm(projectId);
            })
            .catch(error => {
                console.error('Error:', error);
                alert('There was an error submitting your feedback. Please try again.');
            });
        });
    });
});

// Closing survey forms - used by both submit and close buttons
function closeSurveyForm(projectId) {
    const surveyPopup = document.getElementById(`survey-${projectId}`);
    if (surveyPopup) {
        surveyPopup.style.display = 'none';
    }
}