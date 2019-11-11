<?php

namespace App\Http\Controllers\ControlPerceptivo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class FaAssetVController extends Controller
{
    /**
     * Returns Assets by Asset number
     * @param String $num
     * @return Array
     */
    public function getAssetsByNumber($num)
    {
            
            return ['ASSETS' => DB::connection('oracle')
                ->table('FA_ASSET_V')
                ->select(
                    'FA_ASSET_V.ASSET_NUMBER',
                    'FA_ASSET_V.TAG_NUMBER'
                )
                ->where(
                    'FA_ASSET_V.BOOK_TYPE_CODE', '=', 'BANDES_FA_VES'
                )
                ->where(
                    'FA_ASSET_V.ASSET_NUMBER', 'like', '%'.$num.'%'
                )
                ->groupBy('ASSET_NUMBER', 'TAG_NUMBER')
                ->orderBy('ASSET_NUMBER', 'desc')
                ->get()
                ->toArray()
            ];

    }

    /**
     * Returns Assets by Asset tag
     * @param String $num
     * @return Array
     */
    public function getAssetsByTag($num)
    {
        return ['ASSETS' => DB::connection('oracle')
                ->table('FA_ASSET_V')
                ->select(
                    'FA_ASSET_V.ASSET_NUMBER',
                    'FA_ASSET_V.TAG_NUMBER'
                )
                ->where(
                    'FA_ASSET_V.BOOK_TYPE_CODE', '=', 'BANDES_FA_VES'
                )
                ->where(
                    'FA_ASSET_V.TAG_NUMBER', 'like', '%'.$num.'%'
                )
                ->groupBy('ASSET_NUMBER', 'TAG_NUMBER')
                ->orderBy('TAG_NUMBER', 'desc')
                ->get()
                ->toArray()
            ];

    }
}
