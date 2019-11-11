<?php
//  select invoice_number from fa_asset_invoices_v where invoice_number like '%648%' group by invoice_number order by invoice_number desc

namespace App\Http\Controllers\ControlPerceptivo;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class FaAssetInvoicesVController extends Controller
{
    /**
     * Returns Invoices by invoice number
     * @param String $num
     * @return Array
     */
    public function getInvoicesByNumber($num)
    {

        return ['results' => DB::connection('oracle')
                ->table('FA_ASSET_INVOICES_V')
                ->select(
                    'FA_ASSET_INVOICES_V.INVOICE_NUMBER'
                )
                ->where(
                    'FA_ASSET_INVOICES_V.BOOK_TYPE_CODE', '=', 'BANDES_FA_VES'
                )
                ->where(
                    'FA_ASSET_INVOICES_V.INVOICE_NUMBER', 'like', '%' . $num . '%'
                )
                ->groupBy('INVOICE_NUMBER')
                ->orderBy('INVOICE_NUMBER', 'desc')
                ->get()
                ->toArray(),
        ];

    }
}
