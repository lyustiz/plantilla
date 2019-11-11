<div class="bodyContainer">

    <table class="dataTable">
        <tr class="dataTableRows">
            <th colspan="11" heigth="1%">DATOS B&Aacute;SICOS</th>
        </tr>
        <tr class="dataTableRows">
            <th colspan="6" height="1%">UNIDAD SOLICITANTE</th>
            <th colspan="5" height="1%">RESPONSABLE PATRIMONIAL PRIMARIO (RPP)</th>
        </tr>
        <tr class="dataTableRows">
            <td colspan="6" height="2%">{{ (isset($nb_unidad_solicitante)) ? $nb_unidad_solicitante : "" }}
            </td>
            <td colspan="5" height="2%">
                {{ (isset($nb_responsable_patrimonial_primario)) ? $nb_responsable_patrimonial_primario : "" }}</td>
        </tr>
        <tr class="dataTableRows">
            <th colspan="3" rowspan="2" height="2%">NO. DE ORDEN DE COMPRA</th>
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
        <th colspan="5" rowspan="2" height="2%">MONTO EN {{ (isset($tx_simbolo)) ? $tx_simbolo : 'Bs' }}</th>
        </tr>
        <tr></tr>
        <tr class="dataTableRows">
            <td colspan="3" rowspan="2" height="2%">{{ (isset($co_orden_compra)) ? $co_orden_compra : "" }}
            </td>
            <td colspan="1" rowspan="2" height="2%">
                {{ (isset($purchase_order_date)) ? explode('-', $fe_orden_compra)[2] : "" }}</td>
            <td colspan="1" rowspan="2" height="2%">
                {{ (isset($fe_orden_compra)) ? explode('-', $fe_orden_compra)[1] : "" }}</td>
            <td colspan="1" rowspan="2" height="2%">
                {{ (isset($fe_orden_compra)) ? explode('-', $fe_orden_compra)[0] : "" }}</td>
            <td colspan="5" rowspan="2" height="2%">
                {{ (isset($mo_orden_compra)) ? $mo_orden_compra : "N/A" }}
            </td>
        </tr>
        <tr></tr>
        <tr class="dataTableRows">
            <th colspan="6" rowspan="1" height="2%">NOMBRE DEL PROVEEDOR / CONTRATISTA</th>
            <th colspan="3" rowspan="1" height="2%">TIPO DE ENTREGA</th>
            <th colspan="2" rowspan="1" height="2%">VIGENCIA DE LA GARANTIA</th>
        </tr>
        <tr class="dataTableRows">
            <td colspan="6" rowspan="1" height="2%">{{ (isset($nb_vendedor)) ? $nb_vendedor : "" }}</td>
            <td colspan="3" rowspan="1" height="2%">{{ (isset($tx_tipo_entrega)) ? $tx_tipo_entrega : "TOTAL" }}</td>
            <td colspan="2" rowspan="1" height="2%">
                {{ (isset($tx_garantia)) ? $tx_garantia : "" }}
            </td>
        </tr>
        <tr class="dataTableRows">
            <th colspan="3" rowspan="2" height="2%">FACTURA</th>
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
            <th colspan="5" rowspan="2" height="2%">MONTO EN {{ (isset($tx_simbolo)) ? $tx_simbolo : 'Bs' }}</th>
        </tr>
        <tr></tr>
        <tr class="dataTableRows">
            <td colspan="3" rowspan="2" height="2%">{{ (isset($co_factura)) ? $co_factura : "" }}
            </td>
            <td colspan="3" rowspan="2" height="2%">
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
            <td colspan="5" rowspan="2" height="2%">{{ (isset($mo_factura)) ? $mo_factura : "" }}
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
            <th colspan="1" rowspan="2" height="2%">PRECIO UNITARIO {{ (isset($tx_simbolo)) ? $tx_simbolo : 'Bs' }}</th>
            <th colspan="1" rowspan="2" height="2%">PRECIO TOTAL {{ (isset($tx_simbolo)) ? $tx_simbolo : 'Bs' }}</th>
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
            <td colspan="1" rowspan="2" height="5%">{{ $activo["mo_precio_unitario"] }}</td>
            <td colspan="1" rowspan="2" height="5%">{{ $activo["mo_precio_total"] }}</td>
        </tr>
        <tr></tr>
        @endforeach
    </table>
    <table class="dataTable">
        <tr class="dataTableRows">
            <th height="1%" width="81.3%">OBSERVACIONES</th>
            <th height="1%" width="9.55%">SUB-TOTAL {{ (isset($tx_simbolo)) ? $tx_simbolo : 'Bs' }}</th>
            <td height="1%">{{ $mo_sub_total }}</td>
        </tr>
        <tr class="dataTableRows">
            <td height="3%" width="81.3%">{{ $tx_observacion }}</td>
            <td height="3%" colspan="2">
                <table class="dataTable">
                    <tr class="dataTableRows">
                        <th style="border-left: inherit; border-top: inherit;" width="51%">I.V.A. {{ $pc_iva }}%
                        </th>
                        <td style="border-top: inherit; border-rigth: inherit;" width="49%">{{ $mo_iva }}</td>
                    </tr>
                    <tr class="dataTableRows">
                        <th style="border-bottom: inherit; border-left: inherit;" width="51%">TOTAL {{ (isset($tx_simbolo)) ? $tx_simbolo : 'Bs' }}</th>
                        <td style="border-bottom: inherit" width="49%">{{ $mo_total }}</td>
                    </tr>
                </table>
            </td>
    </table>
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
    <p class="controlNumber">FORM_B_BIU_07_14</p>

</div>