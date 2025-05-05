<?php

namespace App;

use App\Models\Budget;

trait DeleteBudgetCategoriesTrait
{
    protected static function bootDeleteBudgetCategoriesTrait()
    {
        static::deleting(function (Budget $budget) {
            $budget->budgetCategories()->delete();
        });
    }
}
