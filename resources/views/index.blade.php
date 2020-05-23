<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Nodos</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" integrity="sha384-1CmrxMRARb6aLqgBO7yyAxTOQE2AKb9GfXnEo760AUcUmFx3ibVJJAzGytlQcNXd" crossorigin="anonymous"></script>
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">

            <div class="container-fluid">
                <div class="row">
                <h1>NODOS</h1>
                </div>
                <div class="row">
                    <div class="col-6">
                        <hr>
                        <h2>Guardar Numero</h2>
                        <br>
                        {{ Form::open(array('url' => '/guardarNumero')) }}
                            {{Form::label('numero_lbl', 'Ingresa el numero a guardar')}}
                            <br>
                            {{Form::number('numero')}}
                            <br>

                            {{Form::submit('Generar')}}
                        {{ Form::close() }}

                    <br>
                        <h2>listado Numeros</h2>
                        <hr>
                        @if (count($listadoNumeros) > 0)
                        Cantidad de numeros Guardados: {{count($listadoNumeros)}}
                        {{$total = 0}}
                        <br>
                            @foreach ($listadoNumeros as $numero)
                            id{{$numero->id}} -Numero: {{$numero->numero}}
                            <?php $total += $numero->numero; ?>
                            <br>
                            @endforeach
                        @endif
                        Total: {{$total}}
                    </div>

                    <div class="col-6">
                        <hr>
                        <h2>Guardar nuevo servidor o url para consulta de sumas</h2>
                        <br>
                        {{ Form::open(array('url' => '/guardarURL')) }}
                            {{Form::label('url_lbl', 'Ingresa la url del api para retornar suma')}}
                            <br>
                            {{Form::text('url')}}
                            <br>

                            {{Form::submit('Guardar')}}
                        {{ Form::close() }}

                    <br>
                        <h2>listado de servidores</h2>
                        <hr>
                        @if (count($listadoURL) > 0)
                        Cantidad de numeros Guardados: {{count($listadoURL)}}
                        {{$total = 0}}
                        <br>
                            @foreach ($listadoURL as $servidor)
                            id{{$servidor->id}} -Numero: {{$servidor->url}}
                            <br>
                            @endforeach
                        @endif
                    </div>


                </div>
            </div>
        </div>
    </body>
</html>
