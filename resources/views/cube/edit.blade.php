<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Title Page</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
          integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<div class="row">
    <div class="col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">
        <div class="page-header">
            <h1>Cube summation
                <small> - Camilo Urrego</small>
            </h1>
        </div>

        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{ Form::open(array('url' => 'cube/1', 'method' => 'patch', 'role' => 'form', 'class' => 'form-horizontal')) }}
                <legend>Value Cube</legend>
                @for( $i=0;$i < $repeat; $i++)
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
                                {{ Form::label('update', 'Seleccione la acción') }}
                                {{ Form::select('query_type[]', [
                                'QUERY' => 'QUERY',
                                'UPDATE' => 'UPDATE'
                                ], [$i], ['class' => 'form-control']) }}
                            </div>
                            <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
                                {{ Form::label('value', 'digite los valores') }}
                                {{ Form::text('query_string[]', '', array('class' => 'form-control', 'placeholder' => 'value')) }}
                            </div>
                        </div>
                    </div>
                @endfor
                {{ Form::submit('Enviar', array('class' => 'btn btn-primary')) }}

                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="//code.jquery.com/jquery.js"></script>
<!-- Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
        integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
        crossorigin="anonymous"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="Hello World"></script>
</body>
</html>