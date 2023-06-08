// JavaScript code for handling sidebar button clicks
const sidebarButtons = document.querySelectorAll('.sidebar-button');
const contentDiv = document.querySelector('.content');

sidebarButtons.forEach(button => {
    button.addEventListener('click', () => {
        // Clear existing content
        contentDiv.innerHTML = '';

        // Get button text and display relevant content
        const buttonText = button.innerText;
        // contentDiv.innerHTML = `<h1>${buttonText}</h1>`;
        // Add additional content based on the selected button
        // For example, you can make AJAX requests here to fetch dynamic data
          // Implement your logic for each button's functionality
          
        if (buttonText === 'Dashboard') {
          // Clear existing content
          contentDiv.innerHTML = '';
          window.location.href = "admin";
        }
        else if (buttonText === 'Products') {
          window.location.href = "products";
        } else if (buttonText === 'Categories') {
          window.location.href = "categories";
        } else if (buttonText === 'Sales') {
          window.location.href = "commandList";
        } else if (buttonText === 'Clients') {
          window.location.href = "clients";
        } else if (buttonText === 'Rapports') {
          window.location.href = "reports";
        } else if (buttonText === 'Users') {
          window.location.href = "utilisateurs";
        } else if (buttonText === 'Tables') {
          window.location.href = "tables";
        } else if (buttonText === 'Settings') {
          window.location.href = "admin";
        }

        var currentDate = new Date();
        var currentYear = currentDate.getFullYear();
        var currentMonth = ('0' + (currentDate.getMonth() + 1)).slice(-2);
        var currentDay = ('0' + currentDate.getDate()).slice(-2);
        var currentTime = ('0' + currentDate.getHours()).slice(-2) + ':' + ('0' + currentDate.getMinutes()).slice(-2);
      
        // Set the current date and remembered time for the opening input field
        var ouvertureValue = currentYear + '-' + currentMonth + '-' + currentDay + 'T' + localStorage.getItem('ouverture') || currentTime;
        document.getElementById('ouverture').value = ouvertureValue;
      
        // Set tomorrow's date and remembered time for the closing input field
        var tomorrowDate = new Date(currentYear, currentDate.getMonth(), currentDate.getDate() + 1);
        var tomorrowYear = tomorrowDate.getFullYear();
        var tomorrowMonth = ('0' + (tomorrowDate.getMonth() + 1)).slice(-2);
        var tomorrowDay = ('0' + tomorrowDate.getDate()).slice(-2);
        var fermetureValue = tomorrowYear + '-' + tomorrowMonth + '-' + tomorrowDay + 'T' + localStorage.getItem('fermeture') || currentTime;
        document.getElementById('fermeture').value = fermetureValue;
      
        // Save the entered time to local storage when the time input fields change
        document.getElementById('ouverture').addEventListener('change', function() {
          var selectedTime = this.value.split('T')[1];
          localStorage.setItem('ouverture', selectedTime);
        });
      
        document.getElementById('fermeture').addEventListener('change', function() {
          var selectedTime = this.value.split('T')[1];
          localStorage.setItem('fermeture', selectedTime);
        });
});
              
});
