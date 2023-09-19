<?php

namespace App\Service;

class ConversionClass {
    
    public function getTheCurrencyCombination($amountToConvert, $cuurencyInput, $cuurencyOutput){
        
        //the value assigned depending on the currency-combinations
        $rateMultiplier = '';

        //save the currency combinations depending on the user inputs
        $rate = $cuurencyInput . '-' . $cuurencyOutput;

        //check to see which currency combination is true
        switch ($rate) {
        case "AUD-USD":
            $rateMultiplier = 0.67; //100AUD --> 67USD ---> 100         %15 --> 15%
            break;
        case "USD-AUD":
            $rateMultiplier = 1.5;
            break;
        case "AUD-NZD":
            $rateMultiplier = 1.11;
            break;
        case "NZD-AUD":
            $rateMultiplier = 0.90;
            break;
        case "AUD-GBP":
            $rateMultiplier = 0.58;
            break;
        case "AUD-GBP":
            $rateMultiplier = 1.70;
            break;
        case "AUD-EUR":
            $rateMultiplier = 0.67;
            break;
        case "EUR-AUD":
            $rateMultiplier = 1.50;
            break;
        default:
            echo "Please input something";
        }

        //Total amount of money received after conversion
         $totalAmount = ($rateMultiplier * $amountToConvert);

         return  $totalAmount;
    }

}