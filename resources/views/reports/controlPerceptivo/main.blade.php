<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $data['titulo'] }}</title>
</head>

<body>


    <div class="container">
        @include('reports.controlPerceptivo.header', [
        'titulo' => $data['titulo'],
        'co_control_perceptivo' => $data['co_control_perceptivo'],
        'fe_formulario' => $data['fe_formulario'],
        'tx_tipo_asignacion' => $data['tx_tipo_asignacion']
        ])
        @switch($data['nombre'])
        @case('recepcion')
        @include('reports.controlPerceptivo.recepcion.body', $data)
        @break

        @case('control')
        @include('reports.controlPerceptivo.control.body', $data)
        @break

        @case('asignacion')
        @include('reports.controlPerceptivo.asignacion.body', $data)
        @break
        @endswitch
    </div>

</body>
@include('reports.controlPerceptivo.styles')

</html>