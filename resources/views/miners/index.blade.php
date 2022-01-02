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
                <th scope="col">Имя</th>
                <th scope="col">Эфира</th>
{{--                <th scope="col">Баланс</th>--}}
                <th scope="col">Интервал</th>
                <th scope="col">Время вывода</th>
            </tr>
            </thead>
            <tbody>
            @if(isset($miners))
            @foreach($miners as $miner)
            <tr>
                <a href="{{url($miner->id)}}">
                    <td>{{$miner->name}}</td>
                    <td>{{$miner->ethBalance()}}</td>
{{--                    <td>{{$miner->balance}}</td>--}}

                    <td>{{$miner->interval}}</td>
                    <td>{{$miner->time}}</td>
                </a>

            </tr>
            @endforeach
            @endif
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="col-12">
            <form class="col-auto" method="POST" >
                @csrf
                <div class="form-group">
                    <label>Имя</label>
                    <input type="text" name="name" class="form-control" placeholder="Введите имя" required>


                    {{--                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>--}}
                </div>
                <div class="form-group">
                    <label>Хешрейт</label>
                    <input type="number"  name="ethash"  class="form-control" placeholder="Хешрейт в эфире" required>


                </div>
                <div class="form-group">
                    <label>Кошелек</label>
                    <input type="text"  name="address"  class="form-control" placeholder="USDT-TRC20" required>

                </div>
                <div class="form-group">
                    <label>Интервал</label>
                    <input type="number" name="interval" class="form-control" placeholder="Раз в сколько дней выводить" required>

                </div>
                <div class="form-group">
                    <label>Процент</label>
                    <input type="number" name="percent" class="form-control" placeholder="Наш процент" required>

                </div>


                <button type="submit" class="btn btn-primary">Добавить и авторизировать телеграм</button>
            </form>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
