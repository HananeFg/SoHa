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
  <div id="popup">
    <form action="{{ route('menu.insertData') }}" method="POST" id="insertDataForm" style="display: flex;">
        @csrf
        <div class="servers">
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
            @foreach ($tables as $table)
            <div class="table-item">
                <label>
                    <input type="radio" name="tableId" value="{{ $table->id }}">
                    {{ $table->name }}
                </label>
            </div>
            @endforeach
        </div>
        <div style="position: absolute ; right:5px; bottom:8px; " >
            <button class="done" type="button" onclick="closePopup()" >Done</button>
        </div>
    </form>
</div>
  {{-- --------------------------------------------------------------------------------------------------------- --}}
    <div class="navbar">
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
        <button onclick="scrollUp()" class="scroll">        
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
        <button onclick="scrollDown()" class="scroll">        
            <img id="scrolldown" src="{{ asset('upload\Scroll_icon.png') }}" alt="Icon Down" width="50" height="30">
        </button>
    </div>

    <div class="menu-container">
        <div class="menu-items">
            <!-- Menu items go here -->
            @foreach ($menus as $menu)
                <div class="menu-item" data-category="{{ $menu->category_id }}" data-id="{{$menu->id}}" data-price="{{ $menu->unit_price }}">
                    <img src="{{ asset($menu->image) }}" class="menu-image">
                    <br>
                    <span class="menu-title">{{ $menu->title }}</span>
                </div>
            @endforeach
        </div>
        <div class="ticket-container"> 
            <div class="ticket-id">
                <span>Ticket : N° </span>
                <span> {{$facture->id}}</span>
                <span class="date"> {{$facture->datetime_facture}}</span>
            </div>
            <hr>
            <div class="ticket-items">
                
            </div>
            <hr>
            <div class="ticket-footer">
                <div class="total-price">
                    <span>Total Price:</span>
                    <span id="totalPrice">0.00DH</span>
                </div>
            </div>
            <div class="button-container">
                <button class="submit-button" >Submit</button>
                <button class="print-button">Print</button>
            </div>
        </div>
    </div>

    <script>
    
const categoryItems = document.querySelectorAll('.category-item');
const menuItems = document.querySelectorAll('.menu-item');
const ticketItemsContainer = document.querySelector('.ticket-items');
const totalPriceContainer = document.querySelector('.total-price span:last-child');
const submitButton = document.querySelector('.submit-button');
let totalPrice = 0;
const productQuantities = {};


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
// _________________________________________________________________________________________________






menuItems.forEach(item => {
  item.addEventListener('click', () => {
    const menuItemId = item.getAttribute('data-id');
    const menuItemTitle = item.textContent;
    const menuItemPrice = parseFloat(item.getAttribute('data-price'));

      if (productQuantities[menuItemId]) {
      productQuantities[menuItemId]++;
    } else {
      productQuantities[menuItemId] = 1;
    }
    // Create ticket item and update total price
    const ticketItem = document.createElement('div');
    ticketItem.classList.add('ticket-item');
    ticketItem.setAttribute('data-id', menuItemId);
    ticketItem.setAttribute('data-price', menuItemPrice.toString());

    const ticketItemText = document.createElement('span');
    ticketItemText.textContent = menuItemTitle + ' - ' + menuItemPrice.toFixed(2) + 'DH';

    const removeButton = document.createElement('button');
    removeButton.classList.add('remove-button');
   removeButton.innerHTML = '&times;'

    ticketItem.appendChild(ticketItemText);
    ticketItem.appendChild(removeButton);
    ticketItemsContainer.appendChild(ticketItem);

    totalPrice += menuItemPrice;
    totalPriceContainer.textContent = totalPrice.toFixed(2) + 'DH';

    removeButton.addEventListener('click', () => {
      ticketItem.remove();
      totalPrice -= menuItemPrice;
      totalPriceContainer.textContent = totalPrice.toFixed(2) + 'DH';
    });
  });
});





submitButton.addEventListener('click', () => {
  const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

  // Retrieve necessary data from the ticket items
  const ticketItems = document.querySelectorAll('.ticket-item');
  const items = Array.from(ticketItems).map(item => ({
    menuItemId: item.getAttribute('data-id'),
    menuItemPrice: parseFloat(item.getAttribute('data-price')),
    quantity: productQuantities[item.getAttribute('data-id')]
  }));


  // Send AJAX request to insert products into the database
  items.forEach(item => {
    fetch('{{ route('insertProduct') }}', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrfToken
      },
      body: JSON.stringify({ item, facture: '{{ $facture->id }}' })
    })
      .then(response => {
        if (response.ok) {
          console.log('Product inserted successfully');
        } else {
          throw new Error('Failed to insert product');
        }
      })
      .catch(error => {
        console.error(error);
      });
  });
  ticketItemsContainer.innerHTML = '';
  totalPrice = 0;
  totalPriceContainer.textContent = totalPrice.toFixed(2) + 'DH';


  fetch('/printTicket', {
  method: 'POST',
  headers: {
    'Content-Type': 'application/json',
    'X-CSRF-TOKEN': csrfToken
  },
  body: JSON.stringify({ factureId: '{{ $facture->id }}' })
})
  .then(response => {
    console.log(response); // Check the response status
    if (response.ok) {
      console.log('Print order successful');
    } else {
      throw new Error('Failed to print order');
    }
  })
  .catch(error => {
    console.error(error);
  });


  // setTimeout(function() {
  //   window.location.href = "/generatePdf";
  // }, 1000);

});

  


 

   
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
    //--------------------------select a table and server POP-UP------------------------------------------------------


    $(document).ready(function() {
  // Add click event listener to the "Done" button
  $('.done').click(function() {
    // Get the selected table and server IDs
    var tableId = $('input[name="tableId"]:checked').val();
    var serverId = $('input[name="serverId"]:checked').val();
    

    // Create the data object to send in the AJAX request
    var data = {
      tableId: tableId,
      serverId: serverId,
      factureId: '{{ $facture->id }}',
      _token: $('meta[name="csrf-token"]').attr('content') // Include the CSRF token
    };

    // Send the AJAX request
    $.ajax({
      url: '{{ route("menu.insertData") }}',
      type: 'POST',
      data: data,
      success: function(response) {
        // Handle the success response here
        console.log('Data inserted successfully');
      },
      error: function(xhr, status, error) {
        // Handle the error response here
        console.error('Failed to insert data:', error);
      }
    });
  });
});

        
//------------------------------------------------------------------------------------------------------
$(document).ready(function() {
  $(".table-item label").click(function() {
    $(".table-item label").removeClass("clicked"); // Remove the "clicked" class from all labels
    $(this).addClass("clicked"); // Add the "clicked" class to the clicked label
  });

  $(".server-item label").click(function() {
    $(".server-item label").removeClass("clicked"); // Remove the "clicked" class from all labels
    $(this).addClass("clicked"); // Add the "clicked" class to the clicked label
  });

});
 

</script>
</body>
</html>
