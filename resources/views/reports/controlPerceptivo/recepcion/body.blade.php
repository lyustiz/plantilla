<div class="bodyContainer">

    <table class="dataTable">
        <tr class="dataTableRows">
            <th colspan="4" height="1%">UNIDAD SOLICITANTE</th>
            <th colspan="5" height="1%">RESPONSABLE PATRIMONIAL PRIMARIO (RPP)</th>
        </tr>
        <tr class="dataTableRows">
            <td colspan="4" height="2%">{{ (isset($nb_unidad_solicitante)) ? $nb_unidad_solicitante : "" }}
            </td>
            <td colspan="5" height="2%">
                {{ (isset($nb_responsable_patrimonial_primario)) ? $nb_responsable_patrimonial_primario : "" }}</td>
        </tr>
        <tr class="dataTableRows">
            <th colspan="9" height="1%">DATOS DEL PROVEEDOR / CONTRATISTA</th>
        </tr>
        <tr class="dataTableRows">
            <th colspan="4" rowspan="2" height="2%">NOMBRE O RAZ&Oacute;N SOCIAL</th>
            <th colspan="2" rowspan="2" height="2%">NO. DE ORDEN DE COMPRA</th>
            <th colspan="3" rowspan="2" height="2%">
                <table class="dataTable">
                    <tr class="dataTableRows">
                        <th style="border-top: inherit; border-left: inherit; border-right: inherit;" colspan="3"
                            width="100%">FECHA</th>
                    </tr>
                    <tr class="dataTableRows">
                        <th style="border-left: inherit; border-top: inherit; border-bottom: inherit;" width="33.3%">
                            D&Iacute;A</th>
                        <th style="border-left: inherit; border-top: inherit; border-bottom: inherit;" width="33.3%">MES
                        </th>
                        <th style="border-left: inherit; border-top: inherit; border-bottom: inherit; border-right: inherit;"
                            width="33.3%">AÑO</th>
                    </tr>
                </table>
            </th>
        </tr>
        <tr></tr>
        <tr class="dataTableRows">
            <td colspan="4" rowspan="2" height="2%">{{ (isset($nb_vendedor)) ? $nb_vendedor : "" }}</td>
            <td colspan="2" rowspan="2" height="2%">{{ (isset($co_orden_compra)) ? $co_orden_compra : "" }}
            </td>
            <td colspan="1" rowspan="2" height="2%">
                {{ (isset($fe_orden_compra)) ? explode('-', $fe_orden_compra)[2] : "" }}</td>
            <td colspan="1" rowspan="2" height="2%">
                {{ (isset($fe_orden_compra)) ? explode('-', $fe_orden_compra)[1] : "" }}</td>
            <td colspan="1" rowspan="2" height="2%">
                {{ (isset($fe_orden_compra)) ? explode('-', $fe_orden_compra)[0] : "" }}</td>
        </tr>
        <tr></tr>
        <tr class="dataTableRows">
            <th colspan="2" rowspan="2" height="2%">NOTA DE ENTREGA</th>
            <th colspan="1" rowspan="2" height="2%">
                <table class="dataTable">
                    <tr class="dataTableRows">
                        <th style="border-top: inherit; border-left: inherit; border-right: inherit;" colspan="3"
                            width="100%">FECHA</th>
                    </tr>
                    <tr class="dataTableRows">
                        <th style="border-left: inherit; border-top: inherit; border-bottom: inherit;" width="33.3%">
                            D&Iacute;A</th>
                        <th style="border-left: inherit; border-top: inherit; border-bottom: inherit;" width="33.3%">MES
                        </th>
                        <th style="border-left: inherit; border-top: inherit; border-bottom: inherit; border-right: inherit;"
                            width="33.3%">AÑO</th>
                    </tr>
                </table>
            </th>
            <th colspan="2" rowspan="2" height="2%">FACTURA</th>
            <th colspan="2" rowspan="2" height="2%">
                <table class="dataTable">
                    <tr class="dataTableRows">
                        <th style="border-top: inherit; border-left: inherit; border-right: inherit;" colspan="3"
                            width="100%">FECHA</th>
                    </tr>
                    <tr class="dataTableRows">
                        <th style="border-left: inherit; border-top: inherit; border-bottom: inherit;" width="33.3%">
                            D&Iacute;A</th>
                        <th style="border-left: inherit; border-top: inherit; border-bottom: inherit;" width="33.3%">MES
                        </th>
                        <th style="border-left: inherit; border-top: inherit; border-bottom: inherit; border-right: inherit;"
                            width="33.3%">AÑO</th>
                    </tr>
                </table>
            </th>
            <th colspan="2" rowspan="2" height="2%">VIGENCIA DE LA GARANTIA</th>
        </tr>
        <tr></tr>
        <tr class="dataTableRows">
            <td colspan="2" rowspan="2" height="2%">{{ (isset($co_nota_entrega)) ? $co_nota_entrega : "" }}
            </td>
            <td colspan="1" rowspan="2" height="2%">
                <table class="dataTable">
                    <tr class="dataTableRows">
                        <td style="border-left: inherit; border-top: inherit; border-bottom: inherit;" colspan="1"
                            rowspan="2" height="2%" width="33%">
                            {{ (isset($fe_nota_entrega)) ? explode('-', $fe_nota_entrega)[2] : "" }}</td>
                        <td style="border-left: inherit; border-top: inherit; border-bottom: inherit;" colspan="1"
                            rowspan="2" height="2%" width="33%">
                            {{ (isset($fe_nota_entrega)) ? explode('-', $fe_nota_entrega)[1] : "" }}</td>
                        <td style="border-left: inherit; border-top: inherit; border-bottom: inherit; border-right: inherit;"
                            colspan="1" rowspan="2" height="2%" width="34%">
                            {{ (isset($fe_nota_entrega)) ? explode('-', $fe_nota_entrega)[0] : "" }}</td>
                    </tr>
                </table>
            </td>
            <td colspan="2" rowspan="2" height="2%">{{ (isset($co_factura)) ? $co_factura : "" }}
            </td>
            <td colspan="2" rowspan="2" height="2%">
                <table class="dataTable">
                    <tr class="dataTableRows">
                        <td style="border-left: inherit; border-top: inherit; border-bottom: inherit;" colspan="1"
                            rowspan="2" height="2%" width="33%">
                            {{ (isset($fe_factura)) ? explode('-', $fe_factura)[2] : "" }}</td>
                        <td style="border-left: inherit; border-top: inherit; border-bottom: inherit;" colspan="1"
                            rowspan="2" height="2%" width="33%">
                            {{ (isset($fe_factura)) ? explode('-', $fe_factura)[1] : "" }}</td>
                        <td style="border-left: inherit; border-top: inherit; border-bottom: inherit; border-right: inherit;"
                            colspan="1" rowspan="2" height="2%" width="34%">
                            {{ (isset($fe_factura)) ? explode('-', $fe_factura)[0] : "" }}</td>
                    </tr>
                </table>
            </td>
            <td colspan="2" rowspan="2" height="2%">
                {{ (isset($tx_garantia)) ? $tx_garantia : "" }}
            </td>
        </tr>
    </table>

    <table class="dataTable">
        <tr class="dataTableRows">
            <th colspan="1" rowspan="2" height="2%">CANT</th>
            <th colspan="1" rowspan="2" height="2%">DESCRIPCION</th>
            <th colspan="1" rowspan="2" height="2%">MEDIDAS</th>
            <th colspan="1" rowspan="2" height="2%">COLOR</th>
            <th colspan="1" rowspan="2" height="2%">MARCA</th>
            <th colspan="1" rowspan="2" height="2%">MODELO</th>
            <th colspan="1" rowspan="2" height="2%">SERIAL</th>
            <th colspan="1" rowspan="2" height="2%">SERIAL BANDES</th>
        </tr>
        <tr></tr>
        @foreach ($activos as $activo)
        <tr class="dataTableRows">
            <td colspan="1" rowspan="2" height="5%">{{ $activo["ca_activo"] }}</td>
            <td colspan="1" rowspan="2" height="5%">{{ $activo["tx_descripcion"] }}</td>
            <td colspan="1" rowspan="2" height="5%">{{ $activo["md_activo"] }}</td>
            <td colspan="1" rowspan="2" height="5%">{{ $activo["tx_color_activo"] }}</td>
            <td colspan="1" rowspan="2" height="5%">{{ $activo["nb_fabricante"] }}</td>
            <td colspan="1" rowspan="2" height="5%">{{ $activo["co_modelo"] }}</td>
            <td colspan="1" rowspan="2" height="5%">{{ $activo["co_serial"] }}</td>
            <td colspan="1" rowspan="2" height="5%">{{ $activo["co_etiqueta"] }}</td>
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
            <th colspan="4" height="1%">FIRMAS Y SELLOS</th>
        </tr>
        <tr class="dataTableRows">
            <th height="5%">PROVEEDOR / CONTRATISTA</th>
            <th height="5%">UNIDAD SOLICITANTE FUNCIONARIO AUTORIZADO</th>
            <th height="5%">FUNCIONARIO RESPONSABLE DE COMPRAS</th>
            <th height="5%">FUNCIONARIO RESPONSABLE DE BIENES DE USO</th>
        </tr>
        <tr class="dataTableRows">
            <td height="10%"></td>
            <td height="10%"></td>
            <td height="10%"></td>
            <td height="10%"></td>
        </tr>
    </table>
    <p class="controlNumber">FORM_B_BIU_06- 14</p>

</div>