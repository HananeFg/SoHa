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
          <h2 style=" background-color: black; height:30px; color:white;">Ticket 1</h2>
          <H1 style=" font-size: 20px; text-align:center; margin: 0 auto; font-family: 'Lato', sans-serif;">SoHa Restaurant</H1>
          <H1 style=" font-size: 13px; text-align:center; margin: 0 auto; font-family: 'Lato', sans-serif;">0611743256</H1>
          <br>
          <br>
          <H1 style=" font-size: 13px;  margin: 0 auto; font-family: 'Lato', sans-serif;">Date d'impression :</H1>
          <H1 style=" font-size: 13px;  margin: 0 auto; font-family: 'Lato', sans-serif;">Ouverture :</H1>
          <H1 style=" font-size: 13px;  margin: 0 auto; font-family: 'Lato', sans-serif;">Cloture :</H1>



        </div>
        <p style="text-align: center;">--------------------------------</p>
        <H1 style=" font-size: 17px;  font-family: 'Lato', sans-serif;">Categories </H1>
     
        
        <table>
            <thead>
                <tr>
                    <th style="text-align: -webkit-match-parent">Categorie</th>
                    <th>Total Amount</th>
                    <th>Total Quantity</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categoryData as $category)
                <tr>
                    <td>{{ $category['label'] }}</td>
                    <td>{{ $category['totalAmount'] }}</td>
                    <td style="text-align: center">{{ $category['totalQuantity'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
    </div>
</body>
</html>
