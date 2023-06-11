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
                 
      
         
                  <div class="statistics">
                  <div  class="statistic2" >
                  <div class="statistics-text">
                  <i class="fa-solid fa-file-lines"  style="color: #404040; size :20px font-size:100px"></i>
                  </div>
                  <div display: flex; flex-direction: column;>
                  <p style="font-size :30px; margin-bottom: 2px; margin-top: 8px; text-align :left;" id="totalOrders" value="">0</p>
                  <p style="color:grey; margin-top: 8px; margin-bottom: 2px; text-align :left;">Total Orders</p>
                   </div>
                  </div>
                  <div class="statistic2" >
                  <div class="statistics-text">
                  <i class="fa-solid fa-arrow-trend-up" style="color: red; size :20px font-size:100px"></i>
                  </div>
                  <div display: flex; flex-direction: column;>
                    <p   style="font-size :30px; margin-bottom: 2px; margin-top: 8px; text-align :left;" id="totalRevenue">0 dh</p>
                    <p   style="color:grey; margin-top: 8px; margin-bottom: 2px; text-align :left;" >Total Revenue</p>
                  </div>
                  </div>
                  <div  class="statistic2" >
                  <div class="statistics-text">
                  <i  class="fa-solid fa-chart-line" style=" color: green;  font-size:50px"></i>
                  </div>
                  <div display: flex; flex-direction: column;>
                  <p style="font-size :30px; margin-bottom: 2px; margin-top: 8px; text-align :left;" id="averagePrice" value="">0</p>
                  <p style="color:grey; margin-top: 8px; margin-bottom: 2px; text-align :left;">Revenu moyen</p>
                   </div>
                  </div>
                </div>

                <div class="graph-container">
                  <div class="statistic">
                    <h2>Revenue Trend (Daily)</h2>
                    <canvas id="dailyRevenueChart"></canvas>
                  </div>
                  <div class="statistic">
                    <h2>Revenue Trend (Monthly)</h2>
                    <canvas id="monthlyRevenueChart"></canvas>
                  </div>
                </div>
                <div class="graph-container">

                <div class="statistic">
                  <h2>Revenue par categorie</h2>
                  <canvas id="categoryRevenueChart"></canvas>
                </div>
                <div class="statistic">
                  <h2>Produits les plus vendus</h2>
                  <canvas id="topRevenueMenusChart"></canvas>
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
              </div>
              `;
            
            // Update the statistics and orders table
            
            const topRevenueMenusDataElement = document.getElementById('topRevenueMenusDataJson');
            const topRevenueMenusDataJson = topRevenueMenusDataElement.getAttribute('data-json');
            const topRevenueMenusData = JSON.parse(topRevenueMenusDataJson);

            const dailyRevenueDataElement = document.getElementById('dailyRevenueDataJson');
            const dailyRevenueDataJson = dailyRevenueDataElement.getAttribute('data-json');
            const dailyRevenueData = JSON.parse(dailyRevenueDataJson);

            const categoryRevenueDataElement = document.getElementById('categoryRevenueDataJson');
            const categoryRevenueDataJson = categoryRevenueDataElement.getAttribute('data-json');
            const categoryRevenueData = JSON.parse(categoryRevenueDataJson);

            const monthlyRevenueDataElement = document.getElementById('monthlyRevenueDataJson');
            const monthlyRevenueDataJson = monthlyRevenueDataElement.getAttribute('data-json');
            const monthlyRevenueData = JSON.parse(monthlyRevenueDataJson);

            const totalOrdersDataElement = document.getElementById('totalOrdersDataJson');
            const totalOrdersDataJson = totalOrdersDataElement.getAttribute('data-json');
            const totalOrdersData = JSON.parse(totalOrdersDataJson);

            const totalPriceDataElement = document.getElementById('totalPriceDataJson');
            const totalPriceDataJson = totalPriceDataElement.getAttribute('data-json');
            const totalPriceData = JSON.parse(totalPriceDataJson);
            
            const averagePriceDataElement = document.getElementById('averagePriceDataJson');
            const averagePriceDataJson = averagePriceDataElement.getAttribute('data-json');
            const averagePriceData = JSON.parse(averagePriceDataJson);
            dailyRevenueData.forEach(entry => {
              entry.data = parseFloat(entry.data);
            });

            monthlyRevenueData.forEach(entry => {
              entry.data = parseFloat(entry.data);
            });

            function updateDashboard(dailyRevenueData, monthlyRevenueData,categoryRevenueData,topRevenueMenusData, totalOrders,totalRevenue, averagePrice) {
              const dailyRevenueChart = document.getElementById('dailyRevenueChart');
              const monthlyRevenueChart = document.getElementById('monthlyRevenueChart');
              const categoryRevenueChart = document.getElementById('categoryRevenueChart');

              // const orderTable = document.getElementById('orderTable');

              // Generate daily revenue trend graph
              const dailyRevenueChartData = {
                labels: dailyRevenueData.map(entry => entry.label),
                datasets: [
                  {
                    label: 'Daily Revenue',
                    data: dailyRevenueData.map(entry => entry.data),
                    backgroundColor: 'rgba(75, 192, 192, 0.6)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                  },
                ],
              };
              dailyRevenueChart.style.height = '200px'
              dailyRevenueChart.style.width = '300px'
              // Create and render the daily revenue chart
              new Chart(dailyRevenueChart, {
                type: 'line', // Change the chart type to 'line'
                data: dailyRevenueChartData,
                options: {
                  // Add any desired options for the chart
                },
              });
              
              const monthlyRevenueChartData = {
                labels: monthlyRevenueData.map(entry => entry.label),
                datasets: [
                  {
                    label: 'monthly Revenue',
                    data: monthlyRevenueData.map(entry => entry.data),
                    backgroundColor:'rgb(153, 102, 255)',
                    
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                  },
                ],
              };

              monthlyRevenueChart.style.height = '200px'
              monthlyRevenueChart.style.width = '300px'
              // Create and render the daily revenue chart
              
              new Chart(monthlyRevenueChart, {
                type: 'bar',
                data: monthlyRevenueChartData,
                options: {
                  // Add any desired options for the chart
                },
              });

              // Generate monthly revenue trend graph
              const categoryRevenueChartData = {
                labels: categoryRevenueData.map(entry => entry.label),
                datasets: [
                  {
                    label: 'categoryRevenue',
                    data: categoryRevenueData.map(entry => entry.data),
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1,
                  },
                ],
              };

              categoryRevenueChart.style.height = '80px'
              categoryRevenueChart.style.width = '100px'
              // Create and render the monthly revenue chart
              new Chart(categoryRevenueChart, {
                type: 'doughnut',
                data: {
                  labels: categoryRevenueChartData.labels,
                  datasets: [
                    {
                      data: categoryRevenueChartData.datasets[0].data,
                      backgroundColor: [
                        'rgb(75, 192, 192)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(153, 102, 255)',
                        'rgb(255, 128, 0)',
                        'rgb(128, 128, 128)',
                        'rgb(0, 153, 0)',
                        'rgb(255, 0, 0)',
                      ],
                    },
                  ],
                },
                options: {
                  plugins: {
                    legend: {
                      display: true,
                      position: 'bottom',
                    },
                   
                    datalabels: {
                      formatter: (value) => {
                        return value + '%';
                      },
                    },
                  },
                },
              });
              

            
        
            // Create the chart
         
            const topRevenueMenusChartData = {
              labels: topRevenueMenusData.map(entry => entry.title),
              datasets: [
                {
                  label: 'Revenue',
                  data: topRevenueMenusData.map(entry => entry.total_revenue),
                  backgroundColor: 'rgba(30, 142, 442, 0.6)',
                
                  borderWidth: 1,
                },
              ],
            };
            
            // Create and render the top revenue menus chart
            const topRevenueMenusChart = document.getElementById('topRevenueMenusChart');
            if (topRevenueMenusChart) {
              topRevenueMenusChart.style.height = '200px'
              topRevenueMenusChart.style.width = '350px'

              new Chart(topRevenueMenusChart, {
                type: 'bar',
                data: topRevenueMenusChartData,
                options: {
                  indexAxis: 'y',
                  // Add any desired options for the chart
                },
              });
            } else {
              console.log('Error: Could not find the "topRevenueMenusChart" canvas element.');
            }
              
             
              const totalOrdersElement = document.getElementById('totalOrders');
              totalOrdersElement.innerText = totalOrdersData;

              const totalPriceElement = document.getElementById('totalRevenue');
              totalPriceElement.innerText = totalPriceData+" dh";
             
              const  averagePriceElement = document.getElementById('averagePrice');
              averagePriceElement.innerText =  averagePriceData+" dh";
              // Fetch recent orders data and update the table
              // fetch('/orders')
              //   .then(response => response.json())
              //   .then(data => {
              //     data.forEach(order => {
              //       const row = document.createElement('tr');
              //       row.innerHTML = `
              //         <td>${order.id}</td>
              //         <td>${order.customer_name}</td>
              //         <td>${order.total_amount}</td>
              //         <td>${order.status}</td>
              //       `;
              //       orderTable.appendChild(row);
              //     });
              //   });
            }

            updateDashboard(dailyRevenueData, monthlyRevenueData,categoryRevenueData,topRevenueMenusData, totalOrdersData,totalPriceData, averagePriceData);
          }

         
         
           else if (buttonText === 'Products') {
            window.location.href = "products";
            // Logic for Button 2
          //   contentDiv.innerHTML += `
          //   <div class="item-section">
          //       <div class="icon">
          //           <!-- Icône pour le produit (remplacez avec votre propre icône) -->
          //           <i class="fas fa-box"></i>
          //       </div>
          //       <p>Here you can manage your products.<a href="">Learn more</a></p>
          //       <h2 class="title">Product</h2>
          //       <button class="add-button" id="addProductButton">Add Product</button>
          //       <button class="add-button" id="addPB">View Products</button>
          //   </div>
          // `;
          //   // Add more specific functionality 
          //   // Add event listener to the Add Product button
          //   const addProductButton = document.getElementById('addProductButton');
          //   addProductButton.addEventListener('click', () => {
          //       // Redirect to the desired route when the button is clicked
          //       window.location.href = "/ajoutArticle"; 
          //    });
          //    const addPB = document.getElementById('addPB');
          //   addPB.addEventListener('click', () => {
          //       // Redirect to the desired route when the button is clicked
          //       window.location.href = "products"; 
          //    });
        } else if (buttonText === 'Categories') {
          window.location.href = "categories";
          //   // Logic for Button 3
          //   contentDiv.innerHTML += `<div class="item-section">
          //   <div class="icon">
          //     <i class="fas fa-tags"></i>
          //   </div>
          //   <p>Here you can manage your categories.<a href="">Learn more</a></p>
          //   <h2 class="title">Categorie</h2>
          //   <button class="add-button" id="addProductButton">Ajouter Categorie</button>
          //   <button class="add-button" id="addPB">Voir les Categories</button>
          // </div>`;
          //   // Add more specific functionality
          //   // Add event listener to the Add Category button
          //   const addProductButton = document.getElementById('addProductButton');
          //   addProductButton.addEventListener('click', () => {
          //       // Redirect to the desired route when the button is clicked
          //       window.location.href = "/ajoutCategory"; 
          //   });
          //   const addPB = document.getElementById('addPB');
          //   addPB.addEventListener('click', () => {
          //       // Redirect to the desired route when the button is clicked
          //       window.location.href = "categories"; 
          //   });
        } else if (buttonText === 'Sales') {
          window.location.href = "commandList";

            // Logic for Button 4
          //   contentDiv.innerHTML += `<div class="item-section">
          //   <div class="icon">
          //     <i class="fas fa-bag-shopping"></i>
          //   </div>
          //   <p>Here you can manage your sales.<a href="">Learn more</a></p>
          //   <h2 class="title">Ventes</h2>
          //   <button class="add-button" id="addProductButton">Ajouter une vente</button>
          //   <button class="add-button" id="addPB">Voir les ventes</button>
          // </div>`;
          //   // Add more specific functionality
          //   //window.location.href = "/commandList";
          //   const addProductButton = document.getElementById('addProductButton');
          //   addProductButton.addEventListener('click', () => {
          //       // Redirect to the desired route when the button is clicked
          //       window.location.href = "/menu"; 
          //   });
          //   const addPB = document.getElementById('addPB');
          //   addPB.addEventListener('click', () => {
          //       // Redirect to the desired route when the button is clicked
          //       window.location.href = "/commandList"; 
          //   });
        } else if (buttonText === 'Clients') {
          window.location.href = "clients";
            // Logic for Button 5
          //   contentDiv.innerHTML += `<div class="item-section">
          //   <div class="icon">
          //     <i class="fa fa-users"></i>
          //   </div>
          //   <p>Here you can manage your customers.<a href="">Learn more</a></p>
          //   <h2 class="title">Clients</h2>
          //   <button class="add-button" id="addProductButton">Ajouter un client</button>
          //   <button class="add-button" id="addPB">Voir les clients</button>
          // </div>
          // `;
          //   // Add more specific functionality
          //   const addProductButton = document.getElementById('addProductButton');
          //   addProductButton.addEventListener('click', () => {
          //       // Redirect to the desired route when the button is clicked
          //       window.location.href = "clients/create"; 
          //   });
          //   const addPB = document.getElementById('addPB');
          //   addPB.addEventListener('click', () => {
          //       // Redirect to the desired route when the button is clicked
          //       window.location.href = "clients"; 
          //   });
        } else if (buttonText === 'Rapports') {
          window.location.href = "reports";
          // Logic for Button 6
          //contentDiv.innerHTML += `<p>This is the content for Button 2.</p>`;
          // Add more specific functionality for Button 2
        } else if (buttonText === 'Users') {
          window.location.href = "utilisateurs";
          //   // Logic for Button 7
          //   contentDiv.innerHTML += `<div class="item-section">
          //   <div class="icon">
          //   <i class="fas fa-user"></i>
          //   </div>
          //   <p>Here you can manage your users.<a href="">Learn more</a></p>
          //   <h2 class="title">Utilisateurs</h2>
          //   <button class="add-button" id="addProductButton">Ajouter un utilisateur</button>
          //   <button class="add-button" id="addPB">Voir les utilisateurs</button>
          // </div>`;
          //   // Add more specific functionality
          //   const addProductButton = document.getElementById('addProductButton');
          //   addProductButton.addEventListener('click', () => {
          //       // Redirect to the desired route when the button is clicked
          //       window.location.href = "utilisateurs/create"; 
          //   });
            // const addPB = document.getElementById('addPB');
            // addPB.addEventListener('click', () => {
            //     // Redirect to the desired route when the button is clicked
            //     window.location.href = "utilisateurs"; 
            // });

        } else if (buttonText === 'Tables') {
          window.location.href = "tables";
            // Logic for Button 8
          /*   contentDiv.innerHTML += `<div class="item-section">
          //   <div class="icon">
          //     <i class="fas fa-chair"></i>
          //   </div>
          //   <p>Here you can manage your tables.<a href="">Learn more</a></p>
          //   <h2 class="title">Table</h2>
          //   <button class="add-button" id="addProductButton">Ajouter une Table</button>
          //   <button class="add-button" id="addPB">Voir les tables</button>
          </div>`;*/
            // Add more specific functionality
            //redirect to tables
            // const addProductButton = document.getElementById('addProductButton');
            // addProductButton.addEventListener('click', () => {
            //     // Redirect to the desired route when the button is clicked
            //     window.location.href = "tables/create";
            // });
            // const addPB = document.getElementById('addPB');
            // addPB.addEventListener('click', () => {
            //     // Redirect to the desired route when the button is clicked
            //     window.location.href = "tables"; 
            // });
          } else if (buttonText === 'Settings') {
            // Logic for Button 9
            contentDiv.innerHTML += `
            <form action="${storeRoute}" method="POST">
            <input type="hidden" name="_token" value="${csrfToken}">
            <div class="form-group" style="margin-bottom: 20px;">
              <label for="ouverture" style="display: block; margin-bottom: 5px; font-weight: bold;">Ouverture:</label>
              <input type="datetime-local" style="padding: 8px; border: 1px solid #ccc; border-radius: 4px; width: 40%; box-sizing: border-box;" name="ouverture" id="ouverture" class="form-control" required>
            </div>
            <div class="form-group" style="margin-bottom: 20px;">
              <label for="fermeture" style="display: block; margin-bottom: 5px; font-weight: bold;">Fermeture:</label>
              <input type="datetime-local" style="padding: 8px; border: 1px solid #ccc; border-radius: 4px; width: 40%; box-sizing: border-box;" name="fermeture" id="fermeture" class="form-control" required>
            </div>
            <button style="padding: 10px 20px; background-color: #007bff; color: #fff; border: none; border-radius: 4px; cursor: pointer;" type="submit" class="btn btn-primary">Générer le clôture</button>
          </form>`;
            // Add more specific functionality for Button 3
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
const dashboardButton = document.querySelector('.sidebar-button[data-target="Dashboard"]');
if (dashboardButton) {
  dashboardButton.click();
}