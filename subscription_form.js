document.addEventListener('DOMContentLoaded', function() {
    const subscriptionForm = document.getElementById('subscriptionForm');
    const unsubscribeForm = document.getElementById('unsubscribeForm');
    const subscribeMessage = document.querySelector('#subscribe-message');
    const unsubscribeMessage = document.querySelector('#unsubscribe-message');
    
    // Handle new subscriptions
    if (subscriptionForm) {
        subscriptionForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            
            // Send subscription request
            fetch('/includes/subscribe.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                subscribeMessage.style.display = 'block';
                subscribeMessage.innerHTML = data;
                
                // Style the message based on the response
                if (data.includes('color: green')) {
                    subscribeMessage.className = 'message-success';
                    subscriptionForm.reset();
                } else {
                    subscribeMessage.className = 'message-error';
                }
            })
            .catch(error => {
                subscribeMessage.style.display = 'block';
                subscribeMessage.className = 'message-error';
                subscribeMessage.innerHTML = '<p style="font-weight: bold; color: red">An error occurred. Please try again later.</p>';
                console.error('Error:', error);
            });
        });
    }
    // Handle unsubscribe requests
    if (unsubscribeForm) {
        unsubscribeForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            
            // Process unsubscribe request
            fetch('/includes/unsubscribe.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                unsubscribeMessage.style.display = 'block';
                unsubscribeMessage.innerHTML = data;
                
                // Clear form if unsubscribe was successful
                if (data.includes('successfully unsubscribed')) {
                    unsubscribeMessage.className = 'message-success';
                    unsubscribeForm.reset();
                } else {
                    unsubscribeMessage.className = 'message-error';
                }
            })
            .catch(error => {
                unsubscribeMessage.style.display = 'block';
                unsubscribeMessage.className = 'message-error';
                unsubscribeMessage.innerHTML = '<p style="font-weight: bold; color: red">An error occurred. Please try again later.</p>';
                console.error('Error:', error);
            });
        });
    }
});