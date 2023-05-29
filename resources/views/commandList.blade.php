<!DOCTYPE html>
<!-- resources/views/commandList.blade.php -->

<html>
    <head>
        <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
        <title>Caissier</title>
        <style>
            /* Add some basic styling for the table */
            table {
                margin-left: 5%;
                margin-right: 5%;
                width: 90%;
                border-collapse: collapse;
            }
            
            th, td {
                padding: 10px;
                text-align: left;
                border-bottom: 1px solid #ddd;
            }
            
            th {
                background-color: #f2f2f2;
            }

            .add-sale-button {
                margin-top: 20px;
            }

            /* Example custom styles for pagination */
            .pagination {
            display: flex;
            justify-content: center;
            }

            .pagination li {
            margin: 0 5px;
            list-style-type: none;
            }

            .pagination a {
            padding: 5px 10px;
            text-decoration: none;
            color: #333;
            background-color: #f2f2f2;
            border-radius: 4px;
            }

            .pagination .active a {
            background-color: #666;
            color: #fff;
            }

            .navbar {
       
       position: fixed;
       top: 0;
       left: 0;
       background-color: #000066;
       color: #fff;
      
       width: 100%;
       z-index: 999; /* Add a higher z-index to ensure the navbar appears on top of other elements */
     
   }
   .navbar::after {
   content: "";
   display: table;
   clear: both;
   }
   .navbar .logo {
   font-size: 24px;
   font-weight: bold;
   float: right;
   }
   .navbar .back-button {
   font-size: 18px;
   float: left;
   }

   .add-button {
    position: absolute;
    bottom: 5px;
    right: 5%;
    padding: 10px 20px;
    background-color: #4caf50;
    color: white;
    border: none;
    /* border-radius: 4px; */
    cursor: pointer;
  }

  h3 {
    margin-left: 5%;
  }

  .currentDate {
    margin-left: 5%;  
  }

        </style>
    </head>
    <body>
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
        <br><br><br>

        <h3>Liste des Commandes</h3>
        <div class="currentDate" id="currentDate"></div>

<!-- resources/views/welcome.blade.php -->

<!-- ... -->

<table>
    <tr>
        <th>N°Ticket</th>
        <th>Date and Time</th>
        <th>Table</th>
        <th>Server</th>
        <th>Status</th>
        <th>View</th>
    </tr>
    @foreach ($factures as $facture)
        <tr>
            <td>{{ $facture->id }}</td>
            <td>{{ $facture->created_at }}</td>
            <td>{{ $facture->table_id }}</td>
            <td>{{ $facture->serveur_id }}</td>
            <td>{{ $facture->payment_status }}</td>
            <td>
                <a href="{{ route('menuId', [ 'variable' => $facture->id]) }}">View</a>               
            </td>
        </tr>
    @endforeach
</table>

<!-- ... -->


        {{ $factures->onEachSide(1)->links() }}


        <div class="add-sale-button">
            <button class="add-button" href="{{ route('add.sale') }}">Add a Sale</button>
        </div>


        {{-- scripts --}}
        <script src="{{ asset('JS/commandList.js') }}"></script>
    </body>
</html>
