<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Bill Box</title>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <link rel="stylesheet" href="/css/bootstrap.min.css">
        <link rel="stylesheet" href="/css/style.css">
        <link rel="stylesheet" href="/css/fonts/stylesheet.css"/>
        {!!Html::favicon('../img/fav.png')!!}
    </head>

    <body>

    @include('alerts.errors')
    @include('alerts.request')

    <!-- -->
    <div  class="">
        <div id="blue">
        </div>

        <div id="login_box">
            <p><img src="/img/logo_tu.jpg" alt="logotipo"></p>
            
            <strong><p>Restaurar Contraseña</p></strong>
          
            <br>

                <form method="POST" action="/password/reset">
                    {!! csrf_field() !!}
                    <input type="hidden" name="token" value="{{ $token }}">

                    @if (count($errors) > 0)
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <div class="form-group">
                        <label>Email</label><br>
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Contraseña nueva</label><br>
                        <input type="password" name="password" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Confirmar contraseña nueva</label><br>
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>

                    <div>
                        <button type="submit" class="btn btn-primary">
                            Actualizar Contraseña
                        </button>
                    </div>
                </form>

            <br>
            <a href="/login">Regresar</a>

        </div>
    </div> <!-- END container-->


        <script src="js/jquery-1.11.3.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/main.js"></script>
    </body>

</html>