<?php

namespace App\Http\Controllers\User;

use App\Models\Btypes;
use App\Models\Bstypes;
use App\Models\Summary;
use App\Models\Expenses;
use App\Models\Types;
use App\Models\Budget;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class Ysummary extends Controller
{
    public function index()
    {


        $user = auth()->user();

        // Get the expenses types created by the user
        $userExpenseTypes = Types::where('created_by', $user->id)->pluck('id');

        // Fetch the expense types
        $types = Types::whereIn('id', $userExpenseTypes)->get();
        $btypes = Btypes::all();
        $bstypes = Bstypes::all();
        $summary = Summary::all();

        // Get the current year
        $currentYear = date('Y');

        // Initialize arrays to store yearly summaries and months
        $yearlySummaries = [];
        $months = [];

        // Loop through the retrieved months and populate the $months array
        foreach ($summary as $item) {
            $year = $item->year;
            $month = $item->month;

            // Check if the month belongs to the current year
            if ($year == $currentYear) {
                // Populate the months array with the current and previous month
                if (!in_array($month, $months)) {
                    $months[] = $month;
                }
            }
        }

        // Loop through each unique month in reverse order
        foreach ($months as $month) {
            // Calculate the year for the month
            $yearForMonth = ($month == 1) ? $currentYear - 1 : $currentYear;

            // Retrieve summaries for the specific year and month
            $monthlySummary = Summary::where('created_by', $user->id)
                ->whereYear('created_at', $yearForMonth)
                ->whereMonth('created_at', $month)
                ->get();

            // Perform calculations on $monthlySummary as needed

            // Store the calculated monthly summary in the yearlySummaries array
            $yearlySummaries[$yearForMonth][$month] = $monthlySummary;
        }





        // Calculate the current month and previous month
        $currentMonth = Carbon::now()->month;
        $previousMonth = ($currentMonth - 1) > 0 ? ($currentMonth - 1) : 12;

        // Retrieve all unique years and months from the summary table
        $yearMonthData = Summary::select('year', 'month')
            ->groupBy('year', 'month')
            ->get();

        // Retrieve budget data for each month
        $budgetDataBySummary = [];

        foreach ($yearMonthData as $yearMonth) {
            $summaryId = Summary::where('year', $yearMonth->year)
                ->where('month', $yearMonth->month)
                ->pluck('id')
                ->first();

            $currentMonthBudgets = Budget::where('summary_id', $summaryId)
                ->get();

            // Organize budget data by btype and bstype
            $budgetData = [];
            foreach ($currentMonthBudgets as $budget) {
                $btypeName = $budget->btype->name;
                $bsname = $budget->bstype->bsname;
                $amount = $budget->amount;

                if (!isset($budgetData[$btypeName])) {
                    $budgetData[$btypeName] = [];
                }

                if (!isset($budgetData[$btypeName][$bsname])) {
                    $budgetData[$btypeName][$bsname] = [
                        'current_month_amount' => $amount,
                        'previous_month_amount' => 0,
                    ];
                } else {
                    $budgetData[$btypeName][$bsname]['current_month_amount'] = $amount;
                }
            }

            // Retrieve previous month's budget data
            $previousMonthSummaryId = Summary::where('year', $yearMonth->year)
                ->where('month', $yearMonth->month - 1)
                ->pluck('id')
                ->first();

            $previousMonthBudgets = Budget::where('summary_id', $previousMonthSummaryId)
                ->get();

            foreach ($previousMonthBudgets as $budget) {
                $btypeName = $budget->btype->name;
                $bsname = $budget->bstype->bsname;
                $amount = $budget->amount;

                if (isset($budgetData[$btypeName][$bsname])) {
                    $budgetData[$btypeName][$bsname]['previous_month_amount'] = $amount;
                } else {
                    $budgetData[$btypeName][$bsname] = [
                        'current_month_amount' => 0,
                        'previous_month_amount' => $amount,
                    ];
                }
            }

            $budgetDataBySummary[$summaryId] = $budgetData;
        }




        // Calculate the current month and the previous month
        $currentMonth = Carbon::now()->month;
        $previousMonth = ($currentMonth - 1) > 0 ? ($currentMonth - 1) : 12;

        // Retrieve all unique months from the expenses
        $months = [$currentMonth, $previousMonth];



        $months = Expenses::where('created_by', $user->id)

            ->select(DB::raw('MONTH(encashment) as month'))
            ->groupBy('month')
            ->orderByDesc('month') // Order by month in descending order
            ->take(2) // Take only the last two months
            ->pluck('month')
            ->sort()
            ->values()
            ->all();



        // Retrieve the expenses for each month
        $totalExpensesByType = [];

        foreach ($months as $month) {
            $expenses = Expenses::where('created_by', $user->id)
                ->whereMonth('encashment', $month)
                ->whereIn('type_id', $userExpenseTypes)
                ->select('type_id', DB::raw('SUM(amount) as total_amount'))
                ->groupBy('type_id')
                ->get();

            $totalExpensesByType[$month] = $expenses;
        }
        $totalExpensesByStypeAndType = [];

        foreach ($months as $month) {
            foreach ($types as $type) {
                foreach ($type->stypes as $stype) {
                    $expenses = Expenses::where('created_by', $user->id)
                        ->whereMonth('encashment', $month)
                        ->where('type_id', $type->id)
                        ->where('stype_id', $stype->id)
                        ->sum('amount');

                    $totalExpensesByStypeAndType[$stype->id][$type->id][$month] = $expenses;
                }
            }
        }




        // Fill in any missing months with empty expenses
        for ($i = 1; $i <= 12; $i++) {
            if (!isset($totalExpensesByType[$i])) {
                $totalExpensesByType[$i] = collect();
            }
        }
        ksort($totalExpensesByType);

        // Total expenses per month
        $expensesByMonth = Expenses::where('created_by', $user->id)
            ->whereIn('type_id', $userExpenseTypes) // Filter expenses by user's types
            ->selectRaw('YEAR(encashment) as year, MONTH(encashment) as month, SUM(amount) as total_amount')
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get()
            ->take(2)
            ->reverse(); // Get the last two months and reverse the order

        $totalExpensesByMonth = [];

        // Loop through the expenses by month and populate the total expenses array
        foreach ($expensesByMonth as $expense) {
            $year = $expense->year;
            $month = $expense->month;
            $totalAmount = $expense->total_amount;

            $totalExpensesByMonth[] = [
                'year' => $year,
                'month' => $month,
                'total_amount' => $totalAmount,
            ];
        }



        return view('user.ysummary.index', compact(
            'summary',
            'months',
            'year',
            'types',
            'currentMonth',

            'totalExpensesByMonth',
            'totalExpensesByType',
            'user',
            'btypes',
            'bstypes',

            'budgetDataBySummary',
            'totalExpensesByStypeAndType'
        ));
    }
}
