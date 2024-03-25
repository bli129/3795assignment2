<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bucket;
use App\Models\Transaction;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function generateReportData($year = null)
    {
        if (!$year) {
            $year = Carbon::now()->year; // Default to the current year if not provided
        }

        // Initialize category totals with 0
        $categoryTotals = Bucket::distinct()->pluck('category')
                              ->keyBy(function ($item) { return $item; })
                              ->map(function () { return 0; })
                              ->toArray();
        $categoryTotals['Other'] = 0; // Include an "Other" category for unmatched transactions

        // Fetch transactions for the specified year
        $transactions = Transaction::whereYear('date', $year)->get();

        foreach ($transactions as $transaction) {
            $matched = false;
            // Attempt to match transaction vendors with buckets
            foreach (Bucket::all() as $bucket) {
                if (stripos($transaction->vendor, $bucket->vendor) !== false) {
                    $categoryTotals[$bucket->category] += $transaction->withdraw ?? 0;
                    $matched = true;
                    break;
                }
            }
            // Accumulate in "Other" if no match found
            if (!$matched) {
                $categoryTotals['Other'] += $transaction->withdraw ?? 0;
            }
        }

        return $categoryTotals;
    }

    public function showReport($year = null)
    {
        $reportData = $this->generateReportData($year);
        $year = $year ?? Carbon::now()->year;
        return view('reports.index', compact('reportData', 'year'));
    }
}
