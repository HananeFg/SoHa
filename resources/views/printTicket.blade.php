<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Ticket</title>
</head>
<body>
    <div id="print-area">
        <h2>This is the print section</h2>
        <p>This is some text in the print section</p>
    </div>

    <script>
        $(document).ready(function() {
            $('#print-area').on('click', function() {
                var printContent = $(this).html();
                var originalContent = document.body.innerHTML;
                document.body.innerHTML = printContent;
                window.print();
                document.body.innerHTML = originalContent;
            });
        });
   
    </script>
</body>
</html>