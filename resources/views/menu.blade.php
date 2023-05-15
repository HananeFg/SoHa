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
                <div class="menu-item" data-category="{{ $menu->category_id }}" data-price="{{ $menu->unit_price }}">{{ $menu->title }}</div>
            @endforeach
        </div>
        <div class="ticket-container">
            <h3>Ticket</h3>
            <div class="ticket-items">
                <!-- Ticket items go here -->
            </div>
        </div>
    </div>
    {{-- <script>
        // JavaScript code for handling menu item selection and ticket updates goes here
        const categoryItems = document.querySelectorAll('.category-item');
        const menuItems = document.querySelectorAll('.menu-item');
        const ticketItemsContainer = document.querySelector('.ticket-items');

        categoryItems.forEach(item => {
            item.addEventListener('click', () => {
                categoryItems.forEach(item => item.classList.remove('active'));
                item.classList.add('active');
                const categoryId = item.getAttribute('data-category');

                // Filter menu items based on the selected category
                menuItems.forEach(menuItem => {
                    const menuCategoryId = menuItem.getAttribute('data-category');
                    menuItem.style.display = categoryId === menuCategoryId || categoryId === 'all' ? 'block' : 'none';
                });
            });
        });

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
            });
        });
    </script> --}}
    <script>
       // JavaScript code for handling menu item selection and ticket updates goes here
const categoryItems = document.querySelectorAll('.category-item');
const menuItems = document.querySelectorAll('.menu-item');
const ticketItemsContainer = document.querySelector('.ticket-items');

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
  });
});

    </script>


    
    
</body>
</html>
