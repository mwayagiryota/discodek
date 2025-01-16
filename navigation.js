// Track which column is currently visible (start with column 1)
let currentColumn = 1;

// Total number of columns in the interface
const totalColumns = 3;

// Function to handle showing/hiding the project image gridss
function showColumnImages(columnNumber) {
    //  hide all image columns
    for (let i = 1; i <= totalColumns; i++) {
        const column = document.getElementById(`column${i}-images`);
        if (column) {
            column.style.display = 'none';
        }
    }
    
    //  Sshow only the selected column's images
    const selectedColumn = document.getElementById(`column${columnNumber}-images`);
    if (selectedColumn) {
        selectedColumn.style.display = 'block'; // or 'grid' depending on your layout needs
    }
}

// To handle showing/hiding the timeline columns
function showTimelineColumn(columnNumber) {
    // First hide all timeline columns
    for (let i = 1; i <= totalColumns; i++) {
        const column = document.getElementById(`column${i}`);
        if (column) {
            column.style.display = 'none';
        }
    }
    
    // To show only the selected timeline column
    const selectedColumn = document.getElementById(`column${columnNumber}`);
    if (selectedColumn) {
        selectedColumn.style.display = 'block';
    }
}

// When user clicks "Next" button
function nextColumn() {
    // Only move forward if  not at the last column
    if (currentColumn < totalColumns) {
        // Increment the column counter
        currentColumn++;
        // Update both timeline and image displays
        showTimelineColumn(currentColumn);
        showColumnImages(currentColumn);
    }
}

//  When user clicks "Previous" button
function previousColumn() {
    // Only move backward if not at the first column
    if (currentColumn > 1) {
        // Decrement the column counter
        currentColumn--;
        // Update both timeline and image displays
        showTimelineColumn(currentColumn);
        showColumnImages(currentColumn);
    }
}

// When the page loads, set up initial state
document.addEventListener('DOMContentLoaded', () => {
    // Show the first column of both timeline and images
    showTimelineColumn(1);
    showColumnImages(1);
});