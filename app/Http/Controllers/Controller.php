<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static function newListLimit($query)
    {
        $newSizeLimit = PAGE_SIZE_DEFAULT;
        $arrPageSize = PAGE_SIZE_LIMIT;
        if (isset($query['limit'])) {
            $newSizeLimit = (($query['limit'] === '') || !in_array($query['limit'], $arrPageSize)) ? $newSizeLimit : $query['limit'];
        }
        if (((isset($query['limit']))) && (!empty($query->query('limit')))){
            $newSizeLimit = (!in_array($query->query('limit'), $arrPageSize)) ? $newSizeLimit : $query->query('limit');
        }
        return $newSizeLimit;
    }
}
