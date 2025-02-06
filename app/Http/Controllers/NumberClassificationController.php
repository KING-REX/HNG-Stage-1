<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NumberClassificationController extends Controller
{
    public function retrieve(Request $request)
    {
        $numberStr = request()->query("number");
        $number = intval($numberStr);

        $responseJson = [];
        $statusCode = 200;
        if (isset($numberStr) && ($numberStr == $number)) {
            $responseJson = [
                "number" => $number,
                "is_prime" => $this->isPrime($number),
                "is_perfect" => $this->isPerfect($number),
                "properties" => $this->getProperties($number),
                "digit_sum" => $this->getDigitSum($number),  // sum of its digits
                "fun_fact" => $this->getFunFact($number)
            ];
        } else {
            $responseJson = [
                "number" => $numberStr,
                "error" => true
            ];
            $statusCode = 400;
        }


        return response()->json($responseJson, $statusCode);
    }

    private function isPrime(int $number): bool
    {
        if ($number < 0)
            return false; //don't ask me why. just kidding negative numbers can't be prime

        if ($number === 0 or $number === 1)
            return false;

        for ($i = 2; $i <= $number / 2; $i++) {
            if ($number % $i === 0)
                return false;
        }

        return true;
    }

    private function isPrimeBetter(int $number): bool
    {
        if ($number < 0)
            return false;

        if ($number === 0 or $number === 1)
            return false;

        for ($i = 2; $i <= sqrt($number); $i++) {
            if ($number % $i === 0)
                return false;

            if ($number % ($number / $i) === 0)
                return false;
        }

        return true;
    }
    private function isPrimeEvenBetter(int $number): bool
    {
        if ($number < 0)
            return false;

        if ($number === 0 or $number === 1)
            return false;

        if ($number === 2 or $number % 2 === 0)
            return false;

        for ($i = 3; $i <= sqrt($number); $i += 2) {
            if ($number % $i === 0)
                return false;
        }

        return true;
    }

    private function isPerfect(int $number): bool
    {
        if ($number < 0)
            return false; // lmao negative numbers can't be perfect as well

        $sum = 1;

        for ($i = 2; $i <= $number / 2; $i++) {
            if ($number % $i === 0) {
                $sum += $i;
            }
        }

        return $sum === $number;
    }

    private function isPerfectBetter(int $number): bool
    {
        if ($number < 0)
            return false;

        $sum = 1;

        for ($i = 2; $i <= sqrt($number); $i++) {
            if ($number % $i === 0) {
                $sum += $i;
            }

            if ($i !== $number / $i) {
                $sum += $number / $i;
            }
        }

        return $sum === $number;
    }

    private function isArmstrong(int $number): bool
    {
        if ($number < 0)
            return false; // woulda been fun if this could be checked for negatives tho

        $length = strlen(strval($number));

        $sum = 0;

        for ($i = $number; $i >= 1; $i /= 10) {
            $sum += ($i % 10) ** $length;
        }

        return $sum === $number;
    }

    private function getProperties(int $number): array
    {
        $properties = [];

        if ($this->isArmstrong($number)) {
            $properties[] = "armstrong";
        }

        if ($number % 2 === 0) {
            $properties[] = "even";
        } else {
            $properties[] = "odd";
        }

        return $properties;
    }

    private function getDigitSum(int $number): int
    {
        //NOTE: This function will cover for signed digit representation cos apparently the modulos already return negative numbers
        $sum = 0;

        for (; $number >= 1 || $number <= -1; $number /= 10) {
            $sum += $number % 10;
        }

        return $sum;
    }

    private function getDigitSumWithSignedDigitRepresentation(int $number): int
    {
        $sum = 0;

        $sign = ($number > 0) - ($number < 0);

        $absNumber = abs($number);

        for (; $absNumber >= 1; $absNumber /= 10) {
            $sum += ($absNumber % 10) * $sign;
        }

        return $sum;
    }

    private function getFunFact(int $number): string
    {
        return Http::get("http://numbersapi.com/$number/math");
    }
}
