<?php

namespace App\Http\Controllers\Back_End;

use App\Http\Controllers\Controller;
use App\Models\Cardsinfo;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function orders_index()
    {
        $orders = Order::get();
        $paymentcard = Cardsinfo::first();
        $lastFourDigits = substr($paymentcard->Cardnumber, -4); // Get the last four digits
        $maskedCardNumber = '************' . $lastFourDigits;
        return view('Back_End.pages.orders.orders_index', compact('orders','maskedCardNumber','paymentcard'));
    }
}
