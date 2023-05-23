// JavaScript code for handling sidebar button clicks
const sidebarButtons = document.querySelectorAll('.sidebar-button');
const contentDiv = document.querySelector('.content');

sidebarButtons.forEach(button => {
    button.addEventListener('click', () => {
        // Clear existing content
        contentDiv.innerHTML = '';

        // Get button text and display relevant content
        const buttonText = button.innerText;
        contentDiv.innerHTML = `<h1>${buttonText}</h1>`;
        // Add additional content based on the selected button
        // For example, you can make AJAX requests here to fetch dynamic data

        // Implement your logic for each button's functionality

          // Implement your logic for each button's functionality
          if (buttonText === 'Dashboard') {
            // Logic for Button 1
            contentDiv.innerHTML += `<p>This is the content for Button 1.</p>`;
            // Add more specific functionality for Button 1
        } else if (buttonText === 'Products') {
            // Logic for Button 2
            contentDiv.innerHTML += `<p>This is the content for Button 2.</p>`;
            // Add more specific functionality for Button 2
        } else if (buttonText === 'Categories') {
            // Logic for Button 3
            contentDiv.innerHTML += `<p>This is the content for Button 3.</p>`;
            // Add more specific functionality for Button 3
        } else if (buttonText === 'Sales') {
            // Logic for Button 4
            contentDiv.innerHTML += `<p>This is the content for Button 2.</p>`;
            // Add more specific functionality for Button 2
        } else if (buttonText === 'Clients') {
            // Logic for Button 5
            contentDiv.innerHTML += `<div class="customer-section">
            <div class="icon">
              <!-- Icône de clients (remplacez avec votre propre icône) -->
              <i class="fa fa-users"></i>
            </div>
            <p>Here you can manage your customers.<a href="">Learn more</a></p>
            <h2 class="title">Customers</h2>
            <button class="add-button">Add Customer</button>
          </div>
          `;
            // Add more specific functionality for Button 3
        } else if (buttonText === 'Rapports') {
            // Logic for Button 6
            contentDiv.innerHTML += `<p>This is the content for Button 2.</p>`;
            // Add more specific functionality for Button 2
        } else if (buttonText === 'Users') {
            // Logic for Button 7
            contentDiv.innerHTML += `<p>This is the content for Button 3.</p>`;
            // Add more specific functionality for Button 3
        } else if (buttonText === 'Tables') {
            // Logic for Button 8
            contentDiv.innerHTML += `<p>This is the content for Button 2.</p>`;
            // Add more specific functionality for Button 2
        } else if (buttonText === 'Settings') {
            // Logic for Button 9
            contentDiv.innerHTML += `<p>This is the content for Button 3.</p>`;
            // Add more specific functionality for Button 3
        }
    });
});
