<!DOCTYPE html>
<html>
<head>
    <title>Restaurant Menu</title>
    <link rel="stylesheet" href="{{asset('Css/menu.css')}}">

</head>
<body>
    <div class="navbar"  padding-bottom: 0px; padding-top: 0px;>
        <div class="back-button">
          <a href="#">        
            <img src="{{ asset('upload\up-arrow.png') }}" alt="logo Soha" width="50" height="50">
          </a>
        </div>
        <div class="logo">
          <img src="{{ asset('upload\1.png') }}" alt="logo SoHa" width="50" height="50" style="padding-right: 15px">
  
        </div>
      </div>
      <br>
      <br>
      <hr>
    
    <div class="category-sidebar">
        <div class="category-list">
            @foreach ($categories as $category)
                <div class="category-item" data-category="{{ $category->id }}">
                    <img src="{{ $category->image }}" alt="{{ $category->title }}" class="category-image">
                    <span class="category-title">{{ $category->title }}</span>
                </div>
            @endforeach
        </div>
        
    </div>
    
    <div class="menu-container">
        <div class="menu-items">
            <!-- Menu items go here -->
            @foreach ($menus as $menu)
               
                <div class="menu-item" data-category="{{ $menu->category_id }}" data-price="{{ $menu->unit_price }}">
                  <img src="{{ asset($menu->image) }}" class="menu-image">
                  <br>
                  <span class="menu-title">{{ $menu->title }}</span>
                </div>
            @endforeach
        </div>
        <div class="ticket-container"> 
            <h3>Ticket</h3>
            <div class="ticket-items">
                <!-- Ticket items go here -->
            </div>
            <div class="total-price">
              <span>Total Price:</span>
              <span>$0.00</span>
            </div>
            <button class="submit-button">Submit Order</button>
            <button class="clear-button">Clear Order</button>
            <button class="print-button">Print Order</button>



        </div>
    </div>
   
    <script>
       // JavaScript code for handling menu item selection and ticket updates goes here
const categoryItems = document.querySelectorAll('.category-item');
const menuItems = document.querySelectorAll('.menu-item');
const ticketItemsContainer = document.querySelector('.ticket-items');
const totalPriceContainer = document.querySelector('.total-price span:last-child');
const submitButton = document.querySelector('.submit-button');
const clearButton = document.querySelector('.clear-button');
const printButton = document.querySelector('.print-button');
let totalPrice = 0;

categoryItems.forEach(item => {
  item.addEventListener('click', () => {
    categoryItems.forEach(item => item.classList.remove('active'));
    item.classList.add('active');
    const categoryId = item.getAttribute('data-category');

    // Filter menu items based on the selected category
    menuItems.forEach(menuItem => {
      const menuCategoryId = menuItem.getAttribute('data-category');
      if (categoryId === menuCategoryId || categoryId === 'all') {
        menuItem.style.display = 'block';
      } else {
        menuItem.style.display = 'none';
      }
    });
  });
});
menuItems.forEach(menuItem => menuItem.style.display = 'none');



//--------new modifications---------------------------------------------------


menuItems.forEach(item => {
    item.addEventListener('click', () => {
        const menuItemId = item.getAttribute('data-menu');
        const menuItemTitle = item.textContent;
        const menuItemPrice = parseFloat(item.getAttribute('data-price'));

        // Create ticket item and update total price
        const ticketItem = document.createElement('div');
        ticketItem.classList.add('ticket-item');
        ticketItem.textContent = menuItemTitle + ' - $' + menuItemPrice.toFixed(2);
        ticketItemsContainer.appendChild(ticketItem);

        totalPrice += menuItemPrice;
        totalPriceContainer.textContent = '$' + totalPrice.toFixed(2);
    });
});

submitButton.addEventListener('click', () => {
    // Code to handle submitting the order
    // You can add your desired functionality here
});

clearButton.addEventListener('click', () => {
    ticketItemsContainer.innerHTML = '';
    totalPrice = 0;
    totalPriceContainer.textContent = '$0.00';
});

printButton.addEventListener('click', () => {
    // Code to handle printing the order
    // You can add your desired functionality here
});



    </script>


    
    
</body>
</html>
