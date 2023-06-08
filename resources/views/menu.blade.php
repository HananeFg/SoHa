<!DOCTYPE html>
<html>
<head>
    <title>Restaurant Menu</title>
    <link rel="stylesheet" href="{{asset('Css/menu.css')}}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body>

  {{-- --------------------------------------------------------------------------------------------------------- --}}
 
  @if ($showPopup)
  <div id="pop" >
  <div id="popup">
    <form action="{{ route('menu.insertData') }}" method="POST" id="insertDataForm" style="display: flex;">
        @csrf
        <div class="servers">
            @foreach ($servers as $server)
            <div class="server-item">
                <label>
                    <input type="radio" name="serverId" value="{{ $server->id }}"  required>
                    {{ $server->name }}
                </label>
            </div>
            @endforeach
        </div>
        <div class="tables">
            @foreach ($tables as $table)
            <div class="table-item">
              <label style="background-color: {{ ($table->status == 1) ? 'red' : 'white' }};">
                <input type="radio" name="tableId" value="{{ $table->id }}" required
                  {{ ($table->status == 1) ? 'disabled' : '' }}>
                {{ $table->name }}
              </label>
            </div>
            @endforeach
        </div>
        <div style="position: absolute ; right:5px; bottom:8px; " >
            <button class="done" type="button" onclick="validateFormAndClosePop()" >Done</button>
        </div>
    </form>
</div>
</div>
@endif
  {{-- --------------------------------------------------------------------------------------------------------- --}}
  <div id="pop" style="display: none;">
  <div id="popupPayment">
    <form method="POST" action="{{ route('insertPayment') }}" onsubmit="event.preventDefault(); submitForm()">
        @csrf
        <div class="total" style="display: flex;
        justify-content: space-evenly;">
            <div>
                <h1 style="margin-bottom: 0;">{{$facture->total_price}}DH</h1>
                <p style="color: rgb(94, 91, 91); margin-top: 0;">Total amount</p>
            </div>
            <div>
                <h1 id="remainingPrice" style="margin-bottom: 0;">0.00 DH</h1>
                <p style="color: rgb(94, 91, 91); margin-top: 0;">Change</p>
            </div>
        </div>

        <div>
            <p>Cache received</p>
        </div>
        <div>
            <input type="text" class="charge" name="received_amount" value="">
        </div>

        <br>
        <br>
      <div style="grid-gap: 10px ;display: grid;">
        <label for="cardOption" class="methodPayment">
          <input type="radio" style="width: 30px;" id="cardOption" class="methodPayment" name="payment_option" value="card">
          Card
        </label>
    
        <label for="gratuitOption" class="methodPayment">
          <input type="radio" style="width: 30px;" id="gratuitOption" class="methodPayment" name="payment_option" value="gratuit">
          Gratuit
        </label>

        <label for="cashOption" class="methodPayment">
          <input type="radio" style="width: 30px;" id="cashOption" class="methodPayment" name="payment_option" value="cash">
          Cash
        </label>
      </div>
        <br>
        <br>
        <button class="print-button" style="position:absolute; right:130px; width:100px;">PRINT</button>
        <button type="submit" class="valider" onclick="submitForm()">VALIDER</button>
    </form>
</div>
</div>
    {{-- ------------------------------------------------------------------------------------------------------ --}}
  <div class="navbar">
        <div class="back-button">
            <a href="{{ route('commandList') }}">        
                <img src="{{ asset('upload\up-arrow.png') }}" alt="logo Soha" width="50" height="50">
            </a>
        </div>
        <div class="logo">
            <img src="{{ asset('upload\1.png') }}" alt="logo SoHa" width="50" height="50" style="padding-right: 15px">
          </div>
          <div id="timeElement" class="current-time"></div>
        </div>
        
        <script>
            // Add 'active' class to the current page link
            var currentPageURL = window.location.href;
            var links = document.querySelectorAll('.navbar a');
            for (var i = 0; i < links.length; i++) {
                if (links[i].href === currentPageURL) {
                    links[i].classList.add('active');
                    break;
                }
            }
        
            // Update the current time
            function updateTime() {
                var currentTime = new Date();
                var hours = currentTime.getHours();
                var minutes = currentTime.getMinutes();
                var seconds = currentTime.getSeconds();
                
                // Format the time
                var timeString = hours.toString().padStart(2, '0') + ':' +
                    minutes.toString().padStart(2, '0') + ':' +
                    seconds.toString().padStart(2, '0');
                
                // Update the time in the HTML element
                var timeElement = document.getElementById('timeElement');
                timeElement.innerHTML =  timeString;
            }
        
            // Update the time initially and then every second
            updateTime();
            setInterval(updateTime, 1000);
        </script>
    <br>
    <br>
   

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
                <button class="submit-button" >SUBMIT</button>
                @if (!$showPopup)
                <button class="payer-button" style="width:100px" onclick="openPaymentPopup()">PAYER</button>
                @endif
            </div>
        </div>
    </div>

    <script>
    
const categoryItems = document.querySelectorAll('.category-item');
const menuItems = document.querySelectorAll('.menu-item');
const ticketItemsContainer = document.querySelector('.ticket-items');
const totalPriceContainer = document.querySelector('.total-price span:last-child');
const printButton = document.querySelector('.print-button');
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
    removeButton.innerHTML = '<i style=" color:#000066;  font-size: 18px;" class="fa-solid fa-trash-can"></i>'

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

  setTimeout(function() {window.location.href = "/printTicket";},6000);

  setTimeout(function() {
    window.location.href = "/commandList";
  }, 7050);

  
});

      printButton.addEventListener('click', () => {

        window.location.href = "/printForClient";

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

 
        function closepop() {
          document.getElementById("pop").style.display = "none";
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
 

const total_price = parseFloat("{{$facture->total_price}}");
const chargeInput = document.querySelector('.charge');
const remainingPrice = document.getElementById('remainingPrice');

chargeInput.addEventListener('input', () => {
    const charge = parseFloat(chargeInput.value) || 0;
    const remaining = charge - total_price;
    remainingPrice.textContent = remaining.toFixed(2) + " DH";
});

function submitForm() {
    const receivedAmount = chargeInput.value;
    const paymentOption = document.querySelector('input[name="payment_option"]:checked').value;

    const data = {
        payment_option: paymentOption,
        received_amount: receivedAmount
    };

    fetch('{{ route("insertPayment") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify(data)
    })
    .then(response => {
        if (response.ok) {
            closepop();
            setTimeout(function() {
          window.location.href = "/commandList";
        }, 1050);
        } else {
            console.error('Error:', response.statusText);
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });

   
    
}


function openPaymentPopup() {
    var popup = document.getElementById("pop");
    popup.style.display = "block";
  }


  function validateFormAndClosePop() {
        var serverSelected = false;
      

        var serverRadios = document.getElementsByName('serverId');
        for (var i = 0; i < serverRadios.length; i++) {
            if (serverRadios[i].checked) {
                serverSelected = true;
                break;
            }
        }

        if (serverSelected) {
            closepop();
        } else {
            alert('Please select a server ');
        }
    }
</script>
</body>
</html>
