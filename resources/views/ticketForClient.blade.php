<!DOCTYPE html>
<html>
<head>
    <style>
      @page {
        size: 9cm 20cm;
      }
      .ticket {
        font-family: 'Courier New', Courier, monospace;
        width: 85mm;
        margin: 0 auto;
        padding: 3px;
        line-height: 0.5;
      
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
 
    
    /* .ticket .footer {
        text-align: right;
    } */
</style>

</head>
<body>
    <div class="ticket">
        <div class="header">
            <p style=" font-size: 30px; text-align:center; margin: 0 auto; font-family: 'Lato', sans-serif;">SoHa Restaurant</p>
            <br>
            <p style=" font-size: 17px; text-align:center; margin: 0 auto; font-family: 'Lato', sans-serif;">0611743256</p>
        </div>
        <p style="text-align: center;">--------------------------------------------------</p>
        <h3>Ticket N°: {{$factureId}}</h3>
        @foreach ($facture as $facture)
        <p>{{$facture->datetime_facture}}</p>
    
        @endforeach
        <p style="text-align: center;">--------------------------------------------------</p>

        <div class="content">
            <div style=" display: inline-block;">
                @foreach ($table as $table)
                <p>{{$table->name}}</p>
                @endforeach
            </div>
            <div style=" display: inline-block;">
                @foreach ($server as $server)
                <p>| serveur : {{$server->name}}</p>
                @endforeach
            </div>
                <p style="text-align: center;">--------------------------------------------------</p>

                
                @foreach ($items as $item)
                <p>
                    <span class="item-name">{{ $item->quantity }} x {{ $item->product_name }}</span>
                    <span class="item-name" style=" position:absolute; right: -20px;">{{ $item->price }} </span>

                </p>
              
                @endforeach
                
                <p style="text-align: center;">--------------------------------------------------</p>
                @foreach ($facturee as $fact)
                <span  style=" position:absolute; right: 0px;">Total : {{$fact->total_price}}</span>
                <br>
                <br>
                <br>
                <span  style=" position:absolute; right: 0px;">Method : {{$fact->payment_type}}</span>

                @endforeach
                <br>
                <br>
                <br>
                <br>
                <p>MERCI POUR VOTRE VISITE !</p>
        </div>
    </div>
</body>
</html>
