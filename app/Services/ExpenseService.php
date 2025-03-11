<?php
namespace App\Services;

class ExpenseService
{
    public function create($data)
    {
        return auth()->user()->expenses()->create($data);
    }

    public function update($expense, $data)
    {
        $expense->update($data);
        return $expense;
    }

    public function delete($expense)
    {
        $expense->delete();
    }

    public function getExpenses()
    {
        return auth()->user()->expenses;
    }

    public function getExpense($expense)
    {
        return $expense;
    }
}