<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body>
<div class="container">
    <div class="row">
        <table class="table table-striped table-dark">
            <thead>
            <tr>
                <th scope="col">Выплата</th>

                <th scope="col">Выполнен</th>
                <th scope="col">Профит</th>
                <th scope="col">Статус</th>
                <th scope="col">Общий коофицент</th>
                <th scope="col">Коофицент клиенту</th>

            </tr>
            </thead>
            <tbody>
            @if(isset($withdraws))
            @foreach($withdraws as $withdraw)
            <tr>
                <td>{{$withdraw->payout}}</td>

                <td>{{$withdraw->completed_at}}</td>
                <td>{{$withdraw->profits}}</td>
                <td>{{$withdraw->status}}</td>
                <td>{{$withdraw->toncoin_usd/$withdraw->toncoin_eth}}</td>
                <td>{{$withdraw->payout/$withdraw->eth_usd}}</td>


            </tr>
            @endforeach
            @endif
            </tbody>
        </table>
    </div>

</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
