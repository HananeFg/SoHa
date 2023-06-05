<!DOCTYPE html>
<!-- resources/views/commandList.blade.php -->

<html>
    <head>
        <!-- Latest compiled and minified CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Latest compiled JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.7.0/dist/css/bootstrap.min.css"> --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap-theme.min.css">

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
        <title>Caissier</title>
        <style>
            /* Add some basic styling for the table */
            .container {
                width: 90%;
                margin-left: 5%;
                margin-right: 5%;
            }
            table {
                
                width: 100%;
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

            .currentDate {
                margin-left: 5%;  
            }
            .icon {
                
                font-size: 50px;
                margin-bottom: 5px;
                margin-right: 5%;
                } 
                .title {
                display: flex;
                flex-direction: row;
                justify-content: space-between;
                align-items: center;
                }
                .card {
                    display: flex;
                    flex-direction: row;
                    justify-content: center;
                    align-items: center;
                    margin: auto;
                }
                .date {
                    border: 1px;
                    border-radius: 3px;
                    padding: 1%;
                    margin: 1%;
                    box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.2);
                }

        </style>
    </head>
    <body>
        <div class="navbar">
            <div class="back-button">
                <a href="{{ route('users.login') }}">        
                    <img src="{{ asset('upload\up-arrow.png') }}" alt="logo Soha" width="50" height="50">
                </a>
            </div>
            <div class="logo">
                <img src="{{ asset('upload\1.png') }}" alt="logo SoHa" width="50" height="50" style="padding-right: 15px">
            </div>
        </div>
        <br><br><br>

        <div class="container">
        <div class="title">
            <h3 class="text-secondary">
              <i class="fas fa-list fa-x2"></i> Rapports
            </h3>
            {{-- <span class="currentDate" id="currentDate" style="float: right"></span> --}}
            {{-- <div class="icon"> --}}
                <a href="{{ route("menu") }}" class="btn btn-secondary">
                    <i class="fas fa-chevron-left fa-x2" ></i>
                </a>
            {{-- </div> --}}
          </div>
          
          <div class="card">
            <div class="date">
                <form action="{{ route("reports.generate") }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="from">date début</label>
                        <input type="date" name="from" placeholder="date debut" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="from">date fin</label>
                        <input type="date" name="to" placeholder="date fin"  class="form-control">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary">
                            Afficher le rapport
                        </button>
                    </div>
                </form>
            </div>
          </div>
            <h4 class="text-secondary font-weight-bold">
                Rapport de {{ $startDate }} à {{ $endDate }}
          </h4>
        

<!-- resources/views/welcome.blade.php -->

<!-- ... -->

<table>
    <tr>
        <th>N°Ticket</th>
        <th>Server</th>
        <th>Table</th>
        <th>Details</th>
        <th>Prix</th>
        <th>Quantité</th>
        <th>Total TTC</th>
        
    </tr>
    @foreach ($factures as $facture)
        
        <tr>
            <td>{{ $facture->id }}</td>
            <td>
                @if ($facture->serveurs)
                    {{ $facture->serveurs->name }}
                @else
                    ---------
                @endif
            </td>
            <td>
                @if ($facture->tables)
                    {{ $facture->tables->name }}
                @else
                    ---------
                @endif
            </td>
            <td>
                @foreach ($facture->details as $detail)
                    <dl>{{ $detail->menus->title }}</dl>
                @endforeach
            </td>
            <td>
                @foreach ($facture->details as $detail)
                    <dl>{{ $detail->unit_price }}DH</dl>
                @endforeach
            </td>
            <td> 
                @foreach ($facture->details as $detail)
                    <dl>{{ $detail->quantity }}</dl>
                @endforeach
            </td>
            <td>{{ $facture->total_price }}</td>
        </tr>
    @endforeach
</table>
<div class="d-grid">
    <button type="button" class="btn btn-success btn-block">
        <dt>Total : {{ $total }} DH</dt>
    </button>
</div>
<form action="{{ route("reports.export") }}" method="post">
    @csrf
    <div class="form-group">
        <input type="hidden" name="from" value="{{ $startDate }}" class="form-control">
    </div>
    <div class="form-group">
        <input type="hidden" name="to" value="{{ $endDate }}"  class="form-control">
    </div>
    <div class="form-group">
        <button class="btn btn-outline-danger border border-danger">
            Génerer le rapport
        </button>
    </div>
</form>
<hr>

</div>

<!-- ... -->


        {{-- {{ $factures->onEachSide(1)->links() }} --}}


        {{-- scripts --}}
        <script src="{{ asset('JS/commandList.js') }}"></script>
    </body>
</html>
