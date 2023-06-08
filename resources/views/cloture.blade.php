<!DOCTYPE html>
<html>
<head>
    <style>
      @page {
        size: 9cm 30cm;
      }
      .ticket {
        font-family: 'Courier New', Courier, monospace;
        width: 85mm;
        margin: 0 auto;
        padding: 3px;
      
    }
    
    .ticket .header {
        /* text-align: center; */
        /* width: 20px;
        height: 20px; */
        margin-bottom: 7px;
       
    }
    
    .ticket .content {
        margin-bottom: 3px;
    }
 
    
    .ticket .footer {
        text-align: right;
    }
</style>

</head>
<body>
    <div class="ticket">
        <div class="header">
          <h2 style=" background-color: black; height:30px; color:white;">Cloture N°: {{ $cloture->id }}</h2>
          <H1 style=" font-size: 20px; text-align:center; margin: 0 auto; font-family: 'Lato', sans-serif;">SoHa Restaurant</H1>
          <H1 style=" font-size: 13px; text-align:center; margin: 0 auto; font-family: 'Lato', sans-serif;">0611743256</H1>
          <br>
          <br>
          <H1 style=" font-size: 13px;  margin: 0 auto; font-family: 'Lato', sans-serif;">Date d'impression :   {{ $cloture->dateImpression }}</H1>
          <H1 style=" font-size: 13px;  margin: 0 auto; font-family: 'Lato', sans-serif;">Ouverture :   {{ $cloture->dateOuverture }}</H1>
          <H1 style=" font-size: 13px;  margin: 0 auto; font-family: 'Lato', sans-serif;">Clôture :   {{ $cloture->dateImpression }}</H1>



        </div>
        <p style="text-align: center;">--------------------------------</p>
        <H1 style=" font-size: 17px;  font-family: 'Lato', sans-serif;">Catégories </H1>
     
        
        <table>
            <thead>
                <tr>
                    <th style="text-align: -webkit-match-parent">Catégorie</th>
                    <th>Total Montant</th>
                    <th>Total Quantité</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categoryData as $category)
                <tr>
                    <td>{{ $category['label'] }}</td>
                    <td style="text-align: center" >{{ $category['totalAmount'] }} DH</td>
                    <td style="text-align: center">{{ $category['totalQuantity'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <p style="text-align: center;">--------------------------------</p>
        <H1 style=" font-size: 17px;  font-family: 'Lato', sans-serif;">Produits </H1>
        <table>
            <thead>
                <tr>
                    <th>Menu</th>
                    <th>Total Montant</th>
                    <th>Total Quantité</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($menuData as $menu)
                <tr>
                    <td>{{ $menu['menu'] }}</td>
                    <td style="text-align: center">{{ $menu['totalAmount'] }} DH</td>
                    <td style="text-align: center">{{ $menu['totalQuantity'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <p style="text-align: center;">--------------------------------</p>
        <H1 style=" font-size: 17px;  font-family: 'Lato', sans-serif;">Total par serveur </H1>
        <table>
        <thead>
            <tr>
                <th>Server</th>
                <th>Total Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($serverData as $data)
            <tr>
            <td style="text-align: center" >Serveur {{ $data['server'] }}</td>
            <td style="text-align: center" >{{ $data['totalAmount'] }} DH</td>
            </tr>
            @endforeach
        </tbody>
        </table>
        <p style="text-align: center;">--------------------------------</p>
        <H1 style=" font-size: 17px;  font-family: 'Lato', sans-serif;">Method de payment </H1>

        <p>Total Montant (Cash) : {{ $totalAmountCash }} DH</p>
        <p>Total Montant (Carte) : {{ $totalAmountCard }} DH</p>
        <p>Total Montant (Gratuit) : {{ $totalAmountGratuit }} DH</p>
        <p style="text-align: center;">--------------------------------</p>
        <p style="text-align: center;">--------------------------------</p>

        <p>Montant total : {{ $totalAmountDay }} DH</p>

    </div>
</body>
</html>
