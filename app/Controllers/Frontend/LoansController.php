<?php

namespace App\Controllers\Frontend;

use App\Models\LoanProduct;
use Core\Controller;
use Core\Request;
use Core\Response;

class LoansController extends Controller
{
    public function index(Request $request): void
    {
        $prefix = LoanProduct::db()->getPrefix();

        $loanProducts = LoanProduct::db()->fetchAll(
            "SELECT * FROM {$prefix}loan_products WHERE status = 'published' ORDER BY `order` ASC"
        );

        $this->render('frontend.loans', compact('loanProducts'));
    }

    public function show(Request $request, string $slug): void
    {
        $loanProduct = LoanProduct::whereFirst('slug', '=', $slug);

        if (!$loanProduct) {
            Response::status(404);
            $this->render('frontend.errors.404');
            return;
        }

        $this->render('frontend.loan-detail', compact('loanProduct'));
    }
}
