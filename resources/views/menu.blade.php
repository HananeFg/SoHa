<!DOCTYPE html>
<html>
<head>
    <title>Restaurant Menu</title>
    <link rel="stylesheet" href="{{asset('Css/menu.css')}}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
</head>
<body>
  {{-- --------------------------------------------------------------------------------------------------------- --}}
  {{-- <div id="popup">
    <form action="{{ route('menu.insertData') }}" method="POST" id="insertDataForm">
        @csrf
        <div class="servers">
            <h4>Select a server:</h4>
            @foreach ($servers as $server)
            <div class="server-item">
                <label>
                    <input type="radio" name="serverId" value="{{ $server->id }}">
                    {{ $server->name }}
                </label>
            </div>
            @endforeach
        </div>
        <div class="tables">
            <h4>Select a table:</h4>
            @foreach ($tables as $table)
            <div class="table-item">
                <label>
                    <input type="radio" name="tableId" value="{{ $table->id }}">
                    {{ $table->name }}
                </label>
            </div>
            @endforeach
        </div>
        <div>
            <button class="done" type="button" onclick="submitForm()">Done</button>
        </div>
    </form>
</div> --}}
  {{-- --------------------------------------------------------------------------------------------------------- --}}

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
     
      <button onclick="scrollUp()" class="scroll" >        
        <img src="{{ asset('upload\Scroll_icon.png') }}" alt="Icon Up" width="50" height="30">
      </button>
       
     
        <div class="category-list" id="category-list">
            @foreach ($categories as $category)
                <div class="category-item" data-category="{{ $category->id }}">
                    <img src="{{ $category->image }}" alt="{{ $category->title }}" class="category-image">
                    <span class="category-title">{{ $category->title }}</span>
                </div>
            @endforeach
        </div>

      <button  onclick="scrollDown()" class="scroll" >        
        <img  id="scrolldown"  src="{{ asset('upload\Scroll_icon.png') }}" alt="Icon Down" width="50" height="30">
      </button>
       
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
          <div class="ticket-id">
            <span>Ticket     </span>
            <span id="ticketId"></span>
          </div>
          <hr>
            <div class="ticket-items">
                <!-- Ticket items go here -->
            </div>
            <hr>
            <div class="ticket-footer">
              <div class="total-price">
                  <span>Total Price:</span>
                  <span id="totalPrice">0.00DH</span>
              </div>
          </div>
          
          <div class="button-container">
            <button class="submit-button">Submit</button>
            <button class="print-button">Print</button>
          </div>



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
      let ticketId = generateTicketId(); 
      document.querySelector("#ticketId").textContent = ticketId ;
      // Generate a unique ticket ID

      const ticketIdSpan = document.getElementById('ticketId');
    ticketIdSpan.textContent = ticketId;

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

    const ticketItemText = document.createElement('span');
    ticketItemText.textContent = menuItemTitle + ' - ' + menuItemPrice.toFixed(2) + 'DH';

    const removeButton = document.createElement('button');
    removeButton.classList.add('remove-button');
    removeButton.textContent = 'X';

    ticketItem.appendChild(ticketItemText);
    ticketItem.appendChild(removeButton);
    ticketItemsContainer.appendChild(ticketItem);

    totalPrice += menuItemPrice;
    totalPriceContainer.textContent = totalPrice.toFixed(2) + 'DH';

    removeButton.addEventListener('click', () => {
    ticketItem.remove();
    totalPrice -= menuItemPrice;
    totalPriceContainer.textContent =  totalPrice.toFixed(2) + 'DH';
    });
    });
    });

    submitButton.addEventListener('click', () => {
    // Code to handle submitting the order
    // You can add your desired functionality here
    const ticketData = {
    id: ticketId,
    totalPrice: totalPrice,
    items: Array.from(ticketItemsContainer.children).map(item => item.textContent)
    };
    console.log(ticketData);
    });

    function generateTicketId() {
    const timestamp = Date.now();
    const random = Math.floor(Math.random() * 1000);
    return timestamp + '-' + random;
    }

    const clearTicketLinks = document.querySelectorAll('.clear-ticket');
    clearTicketLinks.forEach(link => {
    link.addEventListener('click', (event) => {
      event.preventDefault();
      const ticketItem = link.parentElement;
      const priceElement = ticketItem.querySelector('.menu-price');
      const price = parseFloat(priceElement.getAttribute('data-price'));

      totalPrice -= price;
      totalPriceContainer.textContent = totalPrice.toFixed(2) + 'DH';

      ticketItem.remove();
    });
    });


    printButton.addEventListener('click', () => {
      // Code to handle printing the order
      // You can add your desired functionality here
    });


    //--------------------------select a table and server POP-UP------------------------------------------------------


      //  window.addEventListener("load", function() {
      //   document.getElementById("popup").style.display = "block";
      //   }); 
        

      // function selectTable(tableNumber) {
      //  document.querySelector(".table-item[data-id='" + tableNumber + "']").classList.add("selected");
      // }

      //   function selectServant(servantName) {
      //     document.getElementById("popup").style.display = "none";
      //   }

        function closePopup() {
          document.getElementById("popup").style.display = "none";
          document.body.style.pointerEvents = "initial";
        }

        function scrollUp() {
        var scrollableContainer = document.getElementById("category-list");
        scrollableContainer.scrollTop -= 300;
        }

        function scrollDown() {
        var scrollableContainer = document.getElementById("category-list");
        scrollableContainer.scrollTop += 300;
        }
//------------------------------------------------------------------------------------------------------

    //   function submitForm() {
    //     var selectedUsers = Array.from(document.querySelectorAll('input[name="serverId"]:checked'))
    //         .map(function (radio) {
    //             return radio.value;
    //         });

    //     var selectedTables = Array.from(document.querySelectorAll('input[name="tableId"]:checked'))
    //         .map(function (radio) {
    //             return radio.value;
    //         });

    //     if (selectedUsers.length === 1 && selectedTables.length === 1) {
    //         // Add the selected user and table values to the form data
    //         var formData = new FormData(document.getElementById('insertDataForm'));
    //         formData.set('serverId', selectedUsers[0]);
    //         formData.set('tableId', selectedTables[0]);

    //         // Send an AJAX request to submit the form data
    //         var xhr = new XMLHttpRequest();
    //         xhr.open('POST', "{{ route('menu.insertData') }}", true);
    //         xhr.onload = function () {
    //             if (xhr.status === 200) {
    //                 // Handle response here if needed
    //             }
    //         };
           
    //         xhr.send(formData);
    //     } else {
    //         alert('Please select one server and one table.');
    //     }
    // }

</script>
        
    
</body>
</html>
