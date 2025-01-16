// Set starting text size for the page
let currentTextSize = 16; // Starting at 16 pixels

// Function to make text bigger
function increaseText() {
    if (currentTextSize < 24) { // Text no bigger than 24 pixels
        currentTextSize += 2;    // Add 2 pixels to the current size
        updateTextSize();        // Applying the new size
    }
}

// Function to make text smaller
function decreaseText() {
    if (currentTextSize > 14) { // Not let text get smaller than 14 pixels
        currentTextSize -= 2;    // Remove 2 pixels from the current size
        updateTextSize();        // Apply the new size
    }
}

// Function that actually changes the text size on the page
function updateTextSize() {
    document.documentElement.style.fontSize = currentTextSize + 'px';  // Apply new size to whole page
}

// Initialize high contrast mode state
let highContrastEnabled = false;

// Function to toggle high contrast mode
function toggleHighContrast() {
    console.log('Toggle function called');
    highContrastEnabled = !highContrastEnabled;
    console.log('High contrast mode:', highContrastEnabled);
    
    const body = document.body;
    
    if (highContrastEnabled) {
        body.classList.add('high-contrast');
        console.log('Added high-contrast class');
    } else {
        body.classList.remove('high-contrast');
        console.log('Removed high-contrast class');
    }
}

// Alert to see if the file is loaded
console.log('Accessibility.js loaded');