<div class="bodyContainer">

    <table class="dataTable">
        <tr class="dataTableRows">
            <th colspan="1" height="1%">SEDE</th>
            <th colspan="2" height="1%">RESPONSABLE PATRIMONIAL PRIMARIO (RPP)</th>
            <th colspan="2" height="1%">RESPONSABLE PATRIMONIAL DE USO (RPU)</th>
            <th colspan="2" height="1%">C&Eacute;DULA DE IDENTIDAD</th>
        </tr>
        <tr class="dataTableRows">
            <td colspan="1" height="2%">{{ (isset($nb_sede)) ? $nb_sede : "" }}</td>
            <td colspan="2" height="2%">{{ (isset($nb_responsable_patrimonial_primario)) ? $nb_responsable_patrimonial_primario : "" }}</td>
            <td colspan="2" height="2%">{{ (isset($nb_responsable_patrimonial_uso)) ? $nb_responsable_patrimonial_uso : "" }}</td>
            <td colspan="2" height="2%">{{ (isset($nu_cedula_responsable_patrimonial_uso)) ? $nu_cedula_responsable_patrimonial_uso : "" }}</td>
        </tr>
        <tr class="dataTableRows">
            <th colspan="1" height="2%">Unidad</th>
            <td colspan="2" height="2%">{{ (isset($nb_unidad_solicitante)) ? $nb_unidad_solicitante : "" }}</td>
            <th colspan="1" height="2%">Ubicacion</th>
            <td colspan="3" height="2%">{{ (isset($nb_ubicacion)) ? $nb_ubicacion : "" }}</td>
        </tr>
        <tr></tr>
    </table>

    <table class="dataTable">
        <tr class="dataTableRows">
            <th colspan="1" rowspan="2" height="2%">SERIAL BANDES</th>
            <th colspan="1" rowspan="2" height="2%">DESCRIPCION</th>
            <th colspan="1" rowspan="2" height="2%">COLOR</th>
            <th colspan="1" rowspan="2" height="2%">MEDIDAS</th>
            <th colspan="1" rowspan="2" height="2%">MARCA</th>
            <th colspan="1" rowspan="2" height="2%">MODELO</th>
            <th colspan="1" rowspan="2" height="2%">SERIAL</th>
        </tr>
        <tr></tr>
        @foreach ($activos as $activo)
        <tr class="dataTableRows">
            <td colspan="1" rowspan="2" height="5%">{{ $activo["co_etiqueta"] }}</td>
            <td colspan="1" rowspan="2" height="5%">{{ $activo["tx_descripcion"] }}</td>
            <td colspan="1" rowspan="2" height="5%">{{ $activo["tx_color_activo"] }}</td>
            <td colspan="1" rowspan="2" height="5%">{{ $activo["md_activo"] }}</td>
            <td colspan="1" rowspan="2" height="5%">{{ $activo["nb_fabricante"] }}</td>
            <td colspan="1" rowspan="2" height="5%">{{ $activo["co_modelo"] }}</td>
            <td colspan="1" rowspan="2" height="5%">{{ $activo["co_serial"] }}</td>
        </tr>
        <tr></tr>
        @endforeach
    </table>
    <table class="dataTable">
            <tr class="dataTableRows">
                <th height="5%">OBSERVACIONES</th>
            </tr>
            <tr class="dataTableRows">
                <td height="5%">{{ $tx_observacion }}</td>
            </tr>
        </table>
        <table class="dataTable">
            <tr class="dataTableRows">
                <th colspan="7" height="1%">FIRMAS Y SELLOS</th>
            </tr>
            <tr class="dataTableRows">
                <th colspan="4" height="1%">COORDINACIÓN DE BIENES DE USO</th>
                <th colspan="3" height="1%">UNIDAD SOLICITANTE</th>
            </tr>
            <tr class="dataTableRows">
                <th colspan="2" height="5%">FUNCIONARIO RESPONSABLE</th>
                <th colspan="2" height="5%">COORDINADOR</th>
                <th colspan="3" height="5%">RESPONSABLE PATRIMONIAL DE USO (RPU)</th>
            </tr>
            <tr class="dataTableRows">
                <td colspan="2" height="10%"></td>
                <td colspan="2" height="10%"></td>
                <td colspan="3" height="10%"></td>
            </tr>
        </table>
        <p class="controlNumber">FORM_B_BIU_08-14</p>

</div>