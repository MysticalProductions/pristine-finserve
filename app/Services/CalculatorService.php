<?php

namespace App\Services;

use Core\Database;

class CalculatorService
{
    private Database $db;

    public function __construct()
    {
        $this->db = Database::instance();
    }

    public function calculateEmi(float $principal, float $rate, int $tenureMonths): object
    {
        $monthlyRate = ($rate / 12) / 100;
        $emi = $principal * $monthlyRate * pow(1 + $monthlyRate, $tenureMonths)
            / (pow(1 + $monthlyRate, $tenureMonths) - 1);
        $totalAmount = $emi * $tenureMonths;
        $totalInterest = $totalAmount - $principal;

        $schedule = [];
        $balance = $principal;
        for ($i = 1; $i <= $tenureMonths; $i++) {
            $interest = $balance * $monthlyRate;
            $principalPart = $emi - $interest;
            $balance -= $principalPart;
            $schedule[] = (object) [
                'month' => $i,
                'emi' => round($emi, 2),
                'interest' => round($interest, 2),
                'principal' => round($principalPart, 2),
                'balance' => round(max($balance, 0), 2),
            ];
        }

        return (object) [
            'emi' => round($emi, 2),
            'totalInterest' => round($totalInterest, 2),
            'totalAmount' => round($totalAmount, 2),
            'schedule' => $schedule,
        ];
    }

    public function calculateEligibility(float $monthlyIncome, float $existingEmi, float $rate, int $tenureMonths): object
    {
        $monthlyRate = ($rate / 12) / 100;
        $maxEmi = ($monthlyIncome * 0.8) - $existingEmi;
        $maxEmi = max($maxEmi, 0);

        $factor = (pow(1 + $monthlyRate, $tenureMonths) - 1)
            / ($monthlyRate * pow(1 + $monthlyRate, $tenureMonths));
        $eligibleAmount = $maxEmi * $factor;

        $result = $this->calculateEmi($eligibleAmount, $rate, $tenureMonths);

        return (object) [
            'eligibleAmount' => round($eligibleAmount, 2),
            'monthlyIncome' => $monthlyIncome,
            'existingEmi' => $existingEmi,
            'maxEmi' => round($maxEmi, 2),
            'emi' => $result->emi,
            'totalInterest' => $result->totalInterest,
            'totalAmount' => $result->totalAmount,
            'rate' => $rate,
            'tenureMonths' => $tenureMonths,
        ];
    }

    public function calculateLumpsum(float $principal, float $rate, int $years): object
    {
        $amount = $principal * pow(1 + ($rate / 100), $years);
        $interest = $amount - $principal;

        return (object) [
            'principal' => round($principal, 2),
            'rate' => $rate,
            'years' => $years,
            'maturityAmount' => round($amount, 2),
            'totalInterest' => round($interest, 2),
        ];
    }

    public function saveCalculation(string $type, array $input, array $result, ?string $sessionId, ?int $userId): void
    {
        $data = [
            'type' => $type,
            'input_data' => json_encode($input),
            'result_data' => json_encode($result),
            'session_id' => $sessionId ?? '',
            'user_id' => $userId,
            'created_at' => date('Y-m-d H:i:s'),
        ];

        $this->db->insert('calculators', $data);
    }
}
