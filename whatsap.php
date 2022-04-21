<?php
require __DIR__ . '/vendor/autoload.php';
use Twilio\Rest\Client;

// Your Account SID and Auth Token from twilio.com/console
$account_sid = 'AC9d94b24548695d452edcef26889a6a94';
$auth_token = 'your_auth_token';
// In production, these should be environment variables. E.g.:
$auth_token = $_ENV["TWILIO_AUTH_TOKEN"];

// A Twilio number you own with SMS capabilities
$twilio_number = "+19896144628";
//+15017122661
$client = new Client($account_sid, $auth_token);
$client->messages->create(
    // Where to send a text message (your cell phone?)
    '+250788665601',
    array(
        'from' => $twilio_number,
        'body' => 'I sent this message in under 10 minutes!'
    )
);
