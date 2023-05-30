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
            // Logic for Button 1
            contentDiv.innerHTML += `
            <div class="dashboard">
              <h1>Restaurant Management Dashboard</h1>
              <div class="statistics">
                <div class="statistic">
                  <h2>Total Orders</h2>
                  <p id="totalOrders">0</p>
                </div>
                <div class="statistic">
                  <h2>Total Revenue</h2>
                  <p id="totalRevenue">0DH</p>
                </div>
              </div>

              <div class="graph-container">
                <div class="statistic">
                  <h2>Revenue Trend</h2>
                  <canvas id="revenueChart"></canvas>
                </div>
                <div class="statistic">
                  <h2>Order Status</h2>
                  <canvas id="orderStatusChart"></canvas>
                </div>
              </div>
            
              <div class="orders">
                <h2>Recent Orders</h2>
                <table id="orderTable">
                  <tr>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Total Amount</th>
                    <th>Status</th>
                  </tr>
                </table>
              </div>
            </div>`;
            // Add more specific functionality for Dashbord
    // Sample data for demonstration
    const orders = [
      { id: 1, customer: 'John Doe', amount: 50, status: 'Completed' },
      { id: 2, customer: 'Jane Smith', amount: 30, status: 'In Progress' },
      { id: 3, customer: 'Michael Johnson', amount: 25, status: 'Completed' },
    ];

    // Update the statistics and orders table
    function updateDashboard() {
      const totalOrders = document.getElementById('totalOrders');
      const totalRevenue = document.getElementById('totalRevenue');
      const orderTable = document.getElementById('orderTable');
      const revenueChart = document.getElementById('revenueChart');
    
      // Calculate total orders and revenue
      let orderCount = 0;
      let totalAmount = 0;
    
      for (const order of orders) {
        orderCount++;
        totalAmount += order.amount;
        const row = orderTable.insertRow();
        row.innerHTML = `<td>${order.id}</td><td>${order.customer}</td><td>$${order.amount}</td><td>${order.status}</td>`;
      }
    
      totalOrders.textContent = orderCount;
      totalRevenue.textContent = `$${totalAmount}`;
    
      // Generate revenue trend graph
      const revenueData = {
        labels: ['January', 'February', 'March', 'April', 'May', 'June'],
        datasets: [
          {
            label: 'Revenue',
            data: [500, 1000, 800, 1200, 1500, 2000],
            backgroundColor: 'rgba(75, 192, 192, 0.6)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1,
          },
        ],
      };
    
      const revenueConfig = {
        type: 'line',
        data: revenueData,
        options: {
          responsive: true,
          scales: {
            y: {
              beginAtZero: true,
            },
          },
        },
      };
    
      new Chart(revenueChart, revenueConfig);

      // Generate order status graph
      const orderStatusData = {
        labels: ['Completed', 'In Progress', 'Pending'],
        datasets: [
          {
            label: 'Order Status',
            data: [30, 20, 10],
            backgroundColor: ['rgba(54, 162, 235, 0.6)', 'rgba(255, 206, 86, 0.6)', 'rgba(255, 99, 132, 0.6)'],
            borderColor: ['rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)', 'rgba(255, 99, 132, 1)'],
            borderWidth: 1,
          },
        ],
      };

      const orderStatusConfig = {
        type: 'bar',
        data: orderStatusData,
        options: {
          responsive: true,
          scales: {
            y: {
              beginAtZero: true,
            },
          },
        },
      };

      new Chart(orderStatusChart, orderStatusConfig);
    }
    

    // Call the updateDashboard function when the page loads
    updateDashboard();

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
                <button class="add-button" id="addPB">View Products</button>
            </div>
          `;
            // Add more specific functionality 
            // Add event listener to the Add Product button
            const addProductButton = document.getElementById('addProductButton');
            addProductButton.addEventListener('click', () => {
                // Redirect to the desired route when the button is clicked
                window.location.href = "/ajoutArticle"; 
             });
             const addPB = document.getElementById('addPB');
            addPB.addEventListener('click', () => {
                // Redirect to the desired route when the button is clicked
                window.location.href = "products"; 
             });
        } else if (buttonText === 'Categories') {
            // Logic for Button 3
            contentDiv.innerHTML += `<div class="item-section">
            <div class="icon">
              <i class="fas fa-tags"></i>
            </div>
            <p>Here you can manage your categories.<a href="">Learn more</a></p>
            <h2 class="title">Categorie</h2>
            <button class="add-button" id="addProductButton">Ajouter Categorie</button>
            <button class="add-button" id="addPB">Voir les Categories</button>
          </div>`;
            // Add more specific functionality
            // Add event listener to the Add Category button
            const addProductButton = document.getElementById('addProductButton');
            addProductButton.addEventListener('click', () => {
                // Redirect to the desired route when the button is clicked
                window.location.href = "/ajoutCategory"; 
            });
            const addPB = document.getElementById('addPB');
            addPB.addEventListener('click', () => {
                // Redirect to the desired route when the button is clicked
                window.location.href = "categories"; 
            });
        } else if (buttonText === 'Sales') {
            // Logic for Button 4
            contentDiv.innerHTML += `<div class="item-section">
            <div class="icon">
              <i class="fas fa-bag-shopping"></i>
            </div>
            <p>Here you can manage your sales.<a href="">Learn more</a></p>
            <h2 class="title">Ventes</h2>
            <button class="add-button" id="addProductButton">Ajouter une vente</button>
            <button class="add-button" id="addPB">Voir les ventes</button>
          </div>`;
            // Add more specific functionality
            //window.location.href = "/commandList";
            const addProductButton = document.getElementById('addProductButton');
            addProductButton.addEventListener('click', () => {
                // Redirect to the desired route when the button is clicked
                window.location.href = "/menu"; 
            });
            const addPB = document.getElementById('addPB');
            addPB.addEventListener('click', () => {
                // Redirect to the desired route when the button is clicked
                window.location.href = "/commandList"; 
            });
        } else if (buttonText === 'Clients') {
            // Logic for Button 5
            contentDiv.innerHTML += `<div class="item-section">
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <p>Here you can manage your customers.<a href="">Learn more</a></p>
            <h2 class="title">Clients</h2>
            <button class="add-button" id="addProductButton">Ajouter un client</button>
            <button class="add-button" id="addPB">Voir les clients</button>
          </div>
          `;
            // Add more specific functionality
            const addProductButton = document.getElementById('addProductButton');
            addProductButton.addEventListener('click', () => {
                // Redirect to the desired route when the button is clicked
                window.location.href = "clients"; 
            });
            const addPB = document.getElementById('addPB');
            addPB.addEventListener('click', () => {
                // Redirect to the desired route when the button is clicked
                window.location.href = "clients"; 
            });
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
            <h2 class="title">Utilisateurs</h2>
            <button class="add-button" id="addProductButton">Ajouter un utilisateur</button>
            <button class="add-button" id="addPB">Voir les utilisateurs</button>
          </div>`;
            // Add more specific functionality
            const addProductButton = document.getElementById('addProductButton');
            addProductButton.addEventListener('click', () => {
                // Redirect to the desired route when the button is clicked
                window.location.href = "user"; 
            });
            const addPB = document.getElementById('addPB');
            addPB.addEventListener('click', () => {
                // Redirect to the desired route when the button is clicked
                window.location.href = "user"; 
            });
        } else if (buttonText === 'Tables') {
            // Logic for Button 8
            contentDiv.innerHTML += `<div class="item-section">
            <div class="icon">
              <i class="fas fa-chair"></i>
            </div>
            <p>Here you can manage your tables.<a href="">Learn more</a></p>
            <h2 class="title">Table</h2>
            <button class="add-button" id="addProductButton">Ajouter une Table</button>
            <button class="add-button" id="addPB">Voir les tables</button>
          </div>`;
            // Add more specific functionality
            //redirect to tables
            const addProductButton = document.getElementById('addProductButton');
            addProductButton.addEventListener('click', () => {
                // Redirect to the desired route when the button is clicked
                window.location.href = "tables";
            });
            const addPB = document.getElementById('addPB');
            addPB.addEventListener('click', () => {
                // Redirect to the desired route when the button is clicked
                window.location.href = "tables"; 
            });
        } else if (buttonText === 'Settings') {
            // Logic for Button 9
            contentDiv.innerHTML += `<p>This is the content for settings.</p>`;
            // Add more specific functionality for Button 3
        }
    });
});
