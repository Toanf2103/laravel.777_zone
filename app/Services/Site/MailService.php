<?php

namespace App\Services\Site;

use Illuminate\Support\Facades\Mail;

class MailService
{
    public function sendMailOrder($order){
        if($order->email!==null){
            $email = $order->email;
            Mail::send(
                'site.partials.billPdf',
                compact('order'),
                function ($e) use ($email) {
                    $e->subject('Hóa đơn đặt hàng');
                    $e->to($email);
                }
            );
        }
        
       
    }
}
