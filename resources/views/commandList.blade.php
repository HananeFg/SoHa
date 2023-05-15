<!DOCTYPE html>
<!-- resources/views/commandList.blade.php -->

<html>
    <head>
        <title>Caissier</title>
        <style>
            /* Add some basic styling for the table */
            table {
                border-collapse: collapse;
                width: 100%;
            }

            th, td {
                border: 1px solid black;
                padding: 8px;
            }

            th {
                text-align: left;
            }

            .add-sale-button {
                margin-top: 20px;
            }
        </style>
    </head>
    <body>
        <h1>Welcome !</h1>
        
<!-- resources/views/welcome.blade.php -->

<!-- ... -->

<table>
    <tr>
        <th>N°Ticket</th>
        <th>Product</th>
        {{-- <th>Description</th> 
        <th>Unit Price</th>
        <th>TTC Price</th>
        <th>TVA</th>
        <th>Image</th> 
        <th>Category</th> --}}
        <th>Date and Time</th>
        <th>Table</th>
        <th>Server</th>
        <th>Status</th>
        <th>View</th>
    </tr>
    @foreach ($menus as $menu)
        <tr>
            <td>{{ $menu->id }}</td>
            <td>{{ $menu->title }}</td>
            {{-- <td>{{ $menu->description }}</td>
            <td>{{ $menu->unit_price }}</td>
            <td>{{ $menu->TTC_price }}</td>
            <td>{{ $menu->TVA }}</td>
            <td>{{ $menu->image }}</td> 
            <td>{{ $menu->category->title }}</td> --}}
            <td>{{ $menu->created_at }}</td>
            <td>Table</td>
            <td>Server</td>
            <td>Status</td>
            <td>
                <a href="{{ route('menu.details', $menu->id) }}">View</a>
            </td>
        </tr>
    @endforeach
</table>

<!-- ... -->


        {{ $menus->links() }}


        <div class="add-sale-button">
            <a href="{{ route('add.sale') }}">Add a Sale</a>
        </div>
    </body>
</html>
