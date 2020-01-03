<html>

<head>
    <title>Merchant Check Out Page</title>
</head>

<body>
    <center>
        <h1>Please do not refresh this page...</h1>
    </center>
    <form method="post" action="{{env('PAYTM_TXN_URL')}}" name="f1">
        @csrf
        @foreach($paramList as $name => $value)
        <input type="hidden" name="{{$name}}" value="{{$value}}">
        @endforeach
        <script type="text/javascript">
            document.f1.submit();

        </script>
    </form>
</body>

</html>