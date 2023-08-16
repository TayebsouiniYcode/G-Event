<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Stripe\Stripe;

class PaymentController extends Controller
{
    public function checkout(Request $request) {
        Stripe::setApiKey(env("STRIPE_SECRET_KEY"));

        $lineItems = [];
        $eventList = Event::all();
        $totalPrice = 0;
        foreach ($eventList as $event) {
            foreach ($event['tickets'] as $ticket) {
                $lineItems[] = [[
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => $event['name'],
                        ],
                        'unit_amount' => $ticket['price'],
                    ],
                    'quantity' => 1,
                ]];

                $totalPrice += $ticket->price;
            }
        }

        $checkout_session = \Stripe\Checkout\Session::create([
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('checkout.success', [], true),
            'cancel_url' => route('checkout.cancel', [], true),
        ]);

        $reservation = new Reservation();
        //TODO Refactoring
        $reservation->event_id = $eventList[0]->id;
        $reservation->user_id = 1;
        $reservation->ticket_id = 1;
        $reservation->numberOfTicket = 23;
        $reservation->paymentStatus = 'unpaid';
        $reservation->total_price= $totalPrice;
        $reservation->session_id = $checkout_session->id;

        $reservation->save();

        return redirect($checkout_session->url);
    }

    public function success() {
        return view('checkout.success');
    }

    public function cancel () {

    }
}
