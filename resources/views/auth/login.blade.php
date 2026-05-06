<html>
<head>
    <title>Вход в систему</title>
    <style>
        .error {
            color: red;
        }
    </style>
</head>
<body>

<form method="POST" action="{{ route('login') }}">
    @csrf
    @if ($errors->any())
        <div class="error">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <div>
        <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus>
    </div>

    <div>
        <input type="password" name="password" placeholder="Пароль" required>
    </div>

    <button type="submit">Войти</button>
</form>

</body>
</html>
