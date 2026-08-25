<?php

namespace App\Controllers\Frontend;

use App\Services\CalculatorService;
use Core\Controller;
use Core\Database;
use Core\Request;
use Core\Response;

class CalculatorsController extends Controller
{
    private CalculatorService $calculatorService;

    public function __construct()
    {
        parent::__construct();
        $this->calculatorService = new CalculatorService();
    }

    public function index(Request $request): void
    {
        $prefix = Database::instance()->getPrefix();

        $calculators = Database::instance()->fetchAll(
            "SELECT * FROM {$prefix}calculators WHERE status = 'active' ORDER BY `order` ASC"
        );

        $this->render('frontend.calculators', compact('calculators'));
    }

    public function show(Request $request, string $type): void
    {
        $prefix = Database::instance()->getPrefix();

        $calculator = Database::instance()->fetch(
            "SELECT * FROM {$prefix}calculators WHERE type = :type AND status = 'active' LIMIT 1",
            ['type' => $type]
        );

        if (!$calculator) {
            Response::status(404);
            $this->render('frontend.errors.404');
            return;
        }

        $this->render('frontend.calculator-detail', compact('calculator'));
    }

    public function calculateEmi(Request $request): void
    {
        if (!$request->isPost()) {
            Response::json(['error' => 'Method not allowed'], 405);
            return;
        }

        $principal = (float) $request->input('principal', 0);
        $rate = (float) $request->input('rate', 0);
        $tenure = (int) $request->input('tenure', 0);

        if ($principal <= 0 || $rate <= 0 || $tenure <= 0) {
            Response::json(['error' => 'Invalid input parameters'], 422);
            return;
        }

        $result = $this->calculatorService->calculateEmi($principal, $rate, $tenure);

        Response::json([
            'success' => true,
            'data' => $result,
        ]);
    }
}
