<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Services\MercadolibreTokenService;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MercadolibreAuthController extends Controller
{

    private $service;

    public function __construct(MercadolibreTokenService $mercadolibreTokenService)
    {
        $this->service = $mercadolibreTokenService;
    }

    public function auth(Request $request)
    {
        $mlCode = $request->input('code');
        $userId = Auth::id();
        if (empty($userId)) {
            Helper::flash_error('Hubo un error, por favor intenta nuevamente');
            return view('home');
        }
        if (!empty($mlCode)) {
            try {
                $res = $this->service->update_access_token($userId, $mlCode);
                if ($res) {
                    Helper::flash_success('Autorizado correctamente');
                } else {
                    Helper::flash_error('Hubo un error autorizando. Por favor intenta nuevamente');
                }
            } catch (RequestException $e) {
                Helper::flash_error('Hubo un error autorizando. Por favor intenta nuevamente');
            }
        }
        return view('home');
    }
}
