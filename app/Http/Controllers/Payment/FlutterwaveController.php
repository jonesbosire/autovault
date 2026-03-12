<?php
namespace App\Http\Controllers\Payment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FlutterwaveController extends Controller
{
    public function callback(Request $request)
    {
        // Flutterwave redirect callback after payment
        return redirect()->route("my-listings.index")->with("status", "Payment processed.");
    }
}
