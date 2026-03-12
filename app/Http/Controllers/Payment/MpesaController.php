<?php
namespace App\Http\Controllers\Payment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MpesaController extends Controller
{
    public function callback(Request $request)
    {
        // M-Pesa IPN callback — process async payment confirmation
        $data = $request->json()->all();
        \Log::info("mpesa.callback", $data);
        return response()->json(["ResultCode" => 0, "ResultDesc" => "Accepted"]);
    }
}
