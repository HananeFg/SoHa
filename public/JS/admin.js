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
            contentDiv.innerHTML += `
            <div class="item-section">
                <div class="icon">
                    <!-- Icône pour le produit (remplacez avec votre propre icône) -->
                    <i class="fas fa-box"></i>
                </div>
                <p>Here you can manage your products.<a href="">Learn more</a></p>
                <h2 class="title">Product</h2>
                <button class="add-button" id="addProductButton">Add Product</button>
            </div>
          `;
            // Add more specific functionality 
            // Add event listener to the Add Product button
            const addProductButton = document.getElementById('addProductButton');
            addProductButton.addEventListener('click', () => {
                // Redirect to the desired route when the button is clicked
                window.location.href = "/ajoutArticle"; 
             });
        } else if (buttonText === 'Categories') {
            // Logic for Button 3
            contentDiv.innerHTML += `<div class="item-section">
            <div class="icon">
              <i class="fas fa-tags"></i>
            </div>
            <p>Here you can manage your categories.<a href="">Learn more</a></p>
            <h2 class="title">Category</h2>
            <button class="add-button" id="addProductButton">Add Category</button>
          </div>`;
            // Add more specific functionality
            // Add event listener to the Add Category button
            const addProductButton = document.getElementById('addProductButton');
            addProductButton.addEventListener('click', () => {
                // Redirect to the desired route when the button is clicked
                window.location.href = "/ajoutCategory"; 
            });
        } else if (buttonText === 'Sales') {
            // Logic for Button 4
            contentDiv.innerHTML += `<p>This is the content for Button 2.</p>`;
            // Add more specific functionality for Button 2
        } else if (buttonText === 'Clients') {
            // Logic for Button 5
            contentDiv.innerHTML += `<div class="item-section">
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
            contentDiv.innerHTML += `<div class="item-section">
            <div class="icon">
            <i class="fas fa-user"></i>
            </div>
            <p>Here you can manage your users.<a href="">Learn more</a></p>
            <h2 class="title">User</h2>
            <button class="add-button">Add User</button>
          </div>`;
            // Add more specific functionality for Button 3
        } else if (buttonText === 'Tables') {
            // Logic for Button 8
            contentDiv.innerHTML += `<div class="item-section">
            <div class="icon">
              <i class="fas fa-chair"></i>
            </div>
            <p>Here you can manage your tables.<a href="">Learn more</a></p>
            <h2 class="title">Table</h2>
            <button class="add-button">Add Table</button>
          </div>`;
            // Add more specific functionality for Button 2
        } else if (buttonText === 'Settings') {
            // Logic for Button 9
            contentDiv.innerHTML += `<p>This is the content for settings.</p>`;
            // Add more specific functionality for Button 3
        }
    });
});
