<?php 

if(!function_exists('roundedValue'))
{
    function roundedValue($value)
    {
        return round($value * 20) / 20;
    }//end method helper
}//end rounded function condition

if(!function_exists('calculateDiscount'))
{
    function calculateDiscount($value,$discount)
    {
        $deduct =($value * $discount) / 100;
        $total = $value - $deduct;
        return round($total * 20) / 20;
    }//end method helper
}//end rounded function condition




?>