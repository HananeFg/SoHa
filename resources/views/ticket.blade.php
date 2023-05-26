<!DOCTYPE html>
<html>
<head>
    <style>
      @page {
        size: 8cm 10000cm;
      }
      .ticket {
        font-family: 'Courier New', Courier, monospace;
        width: 80mm;
        margin: 0 auto;
        padding: 5px;
      
    }
    
    .ticket .header {
        text-align: center;
        width: 40px;
        height: 40px;
        margin-bottom: 10px;
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
            <img src="{{ asset('upload\1.png') }}" alt="logo SoHa" width="50" height="50" style="padding-right: 15px">
        </div>
        <div class="content">
            
                @foreach ($items as $item)
                <p>
                    <span class="item-name">{{ $item->title }}</span>
                </p>
                @endforeach
          
        </div>
    </div>
</body>
</html>
