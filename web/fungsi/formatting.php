<?php
function formatPrice($price)
{
    $formatted = number_format($price, 2, ',', '.');
    return $formatted;
}
