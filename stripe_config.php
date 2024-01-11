<?php
require_once 'vendor/autoload.php';

// Replace 'YOUR_PUBLISHABLE_KEY' and 'YOUR_SECRET_KEY' with your actual Stripe API keys.
define('STRIPE_PUBLISHABLE_KEY', 'pk_test_51NSt17SDYmcNpPnxwmY3eMsTTlDr4lpsW9yf5tQZ4LwQPFylJCIYgFLTuVPH1pcRrfMuphq5QyLSl0um5sLGG6Bj002BlFseB4');
define('STRIPE_SECRET_KEY', 'sk_test_51NSt17SDYmcNpPnx44uOr7QHw22cIsmMer0DbtfZTWJsPsnM1mLbbF8wsmu5EFvS8G8WYYgw3KhMQhCrzWRFzlGB00VUsx6hsg');

\Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY);
