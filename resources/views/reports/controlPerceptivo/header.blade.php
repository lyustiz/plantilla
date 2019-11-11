<!-- PDF HEADER-->
<div class="headerContainer header">

    <!-- IMAGE -->
    <div class="bandesImageContainer">
        <img src="images/ControlPerceptivo/logoDos.png" class="bandesImage">
    </div>
    <!-- END IMAGE -->

    <!-- TITLE -->
    @if (strpos($titulo, 'ASIGNACION') === false)
    <div class="titleContainer">
        <h6 class="titulo">{{ (isset($titulo)) ? $titulo : "" }}</h6>
    </div>
    @else
    <div class="titleContainerAsignment">
        <h6 class="titulo">{{ (isset($titulo)) ? $titulo : "" }}<br/>({{ $tx_tipo_asignacion }})</h6>
    </div>
    @endif
    <!-- END TITLE -->

    <!-- PDF NUMBER AND DATE -->
    <div class="dateContainer">
        <p class="controlNumber">N° CONTROL PERCEPTIVO:
            {{ (isset($co_control_perceptivo)) ? $co_control_perceptivo : "" }}</p>
        <table class="dataTable">
            <tr class="dataTableRows">
                <th colspan="3" width="100%">FECHA</th>
            </tr>
            <tr class="dataTableRows">
                <th width="33.3%">D&Iacute;A</th>
                <th width="33.3%">MES</th>
                <th width="33.3%">AÑO</th>
            </tr>
            <tr class="dataTableRows">
                <td>{{ (isset($fe_formulario)) ? explode('-', $fe_formulario)[2] : "" }}</td>
                <td>{{ (isset($fe_formulario)) ? explode('-', $fe_formulario)[1] : "" }}</td>
                <td>{{ (isset($fe_formulario)) ? explode('-', $fe_formulario)[0] : "" }}</td>
            </tr>
        </table>
    </div>
    <!-- END PDF NUMBER AND DATE -->

</div>
<!-- END PDF HEADER -->