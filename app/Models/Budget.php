<?php

namespace App\Models;

use App\Casts\MoneyCast;
use App\DeleteBudgetCategoriesTrait;
use App\Filament\Resources\BudgetResource\RelationManagers\TransactionsRelationManager;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Facades\DB;

class Budget extends Model
{
    use HasFactory, DeleteBudgetCategoriesTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
        'total_amount',
        'start_date',
        'end_date',
    ];
    private mixed $available_amount;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'id' => 'integer',
            'total_amount' => MoneyCast::class,
            'start_date' => 'date',
            'end_date' => 'date',
            'available_amount' => MoneyCast::class,
        ];
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'budget_categories', 'budget_id', 'category_id');
    }

    public function transactions(): HasManyThrough
    {
        return $this->hasManyThrough(
            Transaction::class,
            BudgetCategory::class,
            'budget_id',
            'category_id',
            'id',
            'category_id'
        )->orderBy('transaction_date', 'desc');
    }

    public function budgetCategories(): HasMany
    {
        return $this->hasMany(BudgetCategory::class)
            ->with(['category', 'category.transactions'])
            ->orderBy('created_at', 'desc');
    }

    public function getAvailableAmount(): float
    {

        $result = DB::select("SELECT (bg.total_amount - (SUM(trxnd.amount) ))/100 AS available_amount FROM budgets bg JOIN budget_categories bgc ON bg.id = bgc.budget_id JOIN categories c ON bgc.category_id = c.id JOIN transactions trxnd ON trxnd.category_id = c.id WHERE bg.id = :budget_id GROUP BY bg.id", ['budget_id' => $this->id]);

        return $result ? (float)$result[0]->available_amount : 0.0;
    }
}
