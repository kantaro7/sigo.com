<?php
// Register API keys at https://www.google.com/recaptcha/admin
$siteKey = "6Ld3kAwTAAAAACA_QM3m70bLOK6Fw-15FrRdvQcM";
$secret = "6Ld3kAwTAAAAACdYsDs3BB214utzgO8FOkUOZ1_Y";

// reCAPTCHA supported 40+ languages listed here: https://developers.google.com/recaptcha/docs/language
$lang = "es";

// The response from reCAPTCHA
$resp = null;

// The error code from reCAPTCHA, if any
$error = null;
$reCaptcha = new ReCaptcha($secret);
?>
