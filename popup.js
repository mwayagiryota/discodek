// The display of project detail popups
function showForm(formId) {
   document.getElementById(formId).style.display = "block";
   document.getElementById('overlay').style.display = "block";
}

// Close popup form and overlay
function closeForm() {
   const forms = document.getElementsByClassName('form-popup');
   for(let form of forms) {
       form.style.display = "none";
   }
   document.getElementById('overlay').style.display = "none";
}

// Navigate to next column in timeline
function nextColumn() {
   const columns = ['column1', 'column2', 'column3'];
   const imageGrids = ['column1-images', 'column2-images', 'column3-images'];
   
   for(let i = 0; i < columns.length; i++) {
       if(document.getElementById(columns[i]).style.display !== 'none') {
           document.getElementById(columns[i]).style.display = 'none';
           document.getElementById(imageGrids[i]).style.display = 'none';
           
           if(i < columns.length - 1) {
               document.getElementById(columns[i + 1]).style.display = 'block';
               document.getElementById(imageGrids[i + 1]).style.display = 'grid'; // To show the project grid
           }
           
           break;
       }
   }
}

// Navigate to previous column in timeline 
function previousColumn() {
   const columns = ['column1', 'column2', 'column3'];
   const imageGrids = ['column1-images', 'column2-images', 'column3-images'];
   
   for(let i = 0; i < columns.length; i++) {
       if(document.getElementById(columns[i]).style.display !== 'none') {
           document.getElementById(columns[i]).style.display = 'none';
           document.getElementById(imageGrids[i]).style.display = 'none';
           
           if(i > 0) {
               document.getElementById(columns[i - 1]).style.display = 'block';
               document.getElementById(imageGrids[i - 1]).style.display = 'grid'; // Use 'grid' to show the project grid
           }
           
           break;
       }
   }
}

// Clicks for when the dcocment loads 
document.addEventListener('DOMContentLoaded', function() {
   // Timeline items to matching form IDs
   const itemToForm = {
       'Town Center': 'townCenterForm',
       'Waterside': 'watersideForm',
       'Peak Estate': 'peakEstateForm',
       'Station Plan': 'stationPlanForm',
       'Northern Gateway': 'northernGatewayForm',
       'Queenspark Sports Centre': 'queensParkSportForm',
       'Sheepbridge Lane': 'sheepbridgeForm',
       'Staveley Town Deal': 'staveleyForm',
       'St Helenas Campus': 'stHelenaForm'
   };
   
   // Click to all timeline items
   const items = document.getElementsByClassName('timeline-item');
   for(let item of items) {
       item.addEventListener('click', function() {
           const formId = itemToForm[item.textContent.trim()];
           if(formId) {
               showForm(formId);
           }
       });
   }

   // Making them visible
   document.getElementById('column1').style.display = 'block';
   document.getElementById('column1-images').style.display = 'grid';
   document.getElementById('column2').style.display = 'none';
   document.getElementById('column2-images').style.display = 'none';
   document.getElementById('column3').style.display = 'none';
   document.getElementById('column3-images').style.display = 'none';
});