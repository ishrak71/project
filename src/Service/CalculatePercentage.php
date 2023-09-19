<?Php

namespace App\Service;

class CalculatePercentage { 
    public static function calculate15Percent($amount) {

        // Calculate 15% of the amount after raeding through the file
        $result = $amount * 0.15;
        return $result;
    }
}