<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProductEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $produit;
    public $message_content;
    public $sender_name;
    public $sender_email;

    public function __construct($produit, $message_content, $sender_name, $sender_email)
    {
        $this->produit = $produit;
        $this->message_content = $message_content;
        $this->sender_name = $sender_name;
        $this->sender_email = $sender_email;
    }

    public function build()
    {
        return $this->subject('Produit recommandé : ' . $this->produit->nom)
                    ->view('emails.product')
                    ->with([
                        'produit' => $this->produit,
                        'message_content' => $this->message_content,
                        'sender_name' => $this->sender_name,
                        'sender_email' => $this->sender_email,
                    ]);
    }
}