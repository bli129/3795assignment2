<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use DateTime;
use Illuminate\Support\Facades\Storage;

class TransactionsController extends Controller
{
    /**
     * Display a listing of transactions.
     */
    public function index()
    {
        // Order transactions by the 'date' field in descending order, and then by 'id' in ascending order
        // to maintain the order of entry for transactions on the same date.
        $transactions = Transaction::orderBy('date', 'desc')
                                ->orderBy('id', 'desc')
                                ->paginate(10);

        return view('transactions.index', compact('transactions'));
    }


    /**
     * Show the form for creating a new transaction.
     */
    public function create()
    {
        return view('transactions.create');
    }

    /**
     * Store a newly created transaction in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'vendor' => 'required|string|max:255',
            'withdraw' => 'nullable|numeric|min:0',
            'deposit' => 'nullable|numeric|min:0',
        ]);

        // Before adding the new transaction, get the balance up to the date of the new transaction
        $previousTransaction = Transaction::where('date', '<=', $request->date)
                                        ->orderBy('date', 'desc')
                                        ->orderBy('id', 'desc')
                                        ->first();

        $balance = $previousTransaction ? $previousTransaction->balance : 0;
        $balance += ($request->deposit ?? 0) - ($request->withdraw ?? 0);

        // Create the new transaction with the calculated balance
        $transaction = Transaction::create([
            'date' => $request->date,
            'vendor' => $request->vendor,
            'withdraw' => $request->withdraw,
            'deposit' => $request->deposit,
            'balance' => $balance,
        ]);

        // Recalculate balances for all subsequent transactions
        $this->recalculateBalancesFromDate($request->date);

        return redirect()->route('transactions.index')
                        ->with('success', 'Transaction created successfully.');
    }

    /**
     * Display the specified transaction.
     */
    public function show(Transaction $transaction)
    {
        return view('transactions.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified transaction.
     */
    public function edit(Transaction $transaction)
    {
        return view('transactions.edit', compact('transaction'));
    }

    /**
     * Update the specified transaction in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'date' => 'required|date',
            'vendor' => 'required|string|max:255',
            'withdraw' => 'nullable|numeric',
            'deposit' => 'nullable|numeric',
        ]);

        // Update the transaction
        $transaction->update($request->only(['date', 'vendor', 'withdraw', 'deposit']));

        // Recalculate balances starting from the updated transaction's date
        $this->recalculateBalancesFromDate($transaction->date);

        return redirect()->route('transactions.index')->with('success', 'Transaction updated successfully.');
    }

    /**
     * Recalculate balances for all transactions from a specific date.
     */
    protected function recalculateBalancesFromDate($fromDate)
    {
        // Fetch all transactions that could be affected by the recalculation
        $transactionsQuery = Transaction::where('date', '>=', $fromDate)
                                        ->orderBy('date', 'asc')
                                        ->orderBy('id', 'asc');

        // First, check if there are any transactions to recalculate to avoid the error
        if ($transactionsQuery->exists()) {
            $transactions = $transactionsQuery->get();

            // Now $transactions is guaranteed to be defined
            $firstTransactionId = $transactions->first()->id;

            $previousTransaction = Transaction::where('date', '<', $fromDate)
                                            ->orWhere(function ($query) use ($fromDate, $firstTransactionId) {
                                                $query->where('date', $fromDate)
                                                        ->where('id', '<', $firstTransactionId);
                                            })
                                            ->orderBy('date', 'desc')
                                            ->orderBy('id', 'desc')
                                            ->first();

            $balance = $previousTransaction ? $previousTransaction->balance : 0;

            foreach ($transactions as $transaction) {
                $balance += $transaction->deposit - $transaction->withdraw;
                $transaction->balance = $balance;
                $transaction->save();
            }
        }
    }

    /**
     * Remove the specified transaction from storage.
     */
    public function destroy(Transaction $transaction)
    {
        $dateOfDeletedTransaction = $transaction->date;
        $transaction->delete();

        // Recalculate balances starting from the deleted transaction's date
        $this->recalculateBalancesFromDate($dateOfDeletedTransaction);

        return redirect()->route('transactions.index')->with('success', 'Transaction deleted successfully.');
    }


    public function import(Request $request)
    {
        $request->validate(['transaction_file' => 'required|file']);

        $file = $request->file('transaction_file');
        $originalName = $file->getClientOriginalName();
        // Check if there is an extension to handle files without extension properly
        $extension = $file->getClientOriginalExtension();
        $filenameWithoutExtension = pathinfo($originalName, PATHINFO_FILENAME);
        $importedFileName = $extension ? $filenameWithoutExtension . '.' . $extension . '.imported' : $filenameWithoutExtension . '.imported';

        // Process file contents
        $contents = file_get_contents($file->getRealPath());
        $lines = explode(PHP_EOL, trim($contents));
        $rowCount = 0;

        foreach ($lines as $line) {
            $data = str_getcsv($line);
            if (!empty($data) && count($data) >= 5) {
                $this->insertTransaction($data);
                $rowCount++;
            }
        }

        // Use Laravel's storage system to save the file in the designated directory
        $path = 'public/uploads/' . $importedFileName;
        Storage::put($path, file_get_contents($file->getRealPath()));

        return $rowCount > 0
            ? back()->with('success', "Transactions imported successfully. Total rows imported: {$rowCount}. File saved as {$importedFileName}.")
            : back()->with('error', 'No transactions were imported.');
    }


    private function insertTransaction($data)
    {
        // Assuming $data[0] contains the date in MM/DD/YYYY format,
        // $data[1] contains the vendor,
        // $data[2] contains the withdraw amount,
        // $data[3] contains the deposit amount, and
        // $data[4] contains the balance.

        // Convert the date from MM/DD/YYYY to YYYY-MM-DD format
        $date = DateTime::createFromFormat('m/d/Y', $data[0])->format('Y-m-d');

        // Now, create the transaction with the correctly formatted date
        $transaction = Transaction::create([
            'date' => $date,
            'vendor' => $data[1],
            'withdraw' => $data[2] === '' ? null : $data[2],
            'deposit' => $data[3] === '' ? null : $data[3],
            'balance' => $data[4],
        ]);

        // After creating each transaction, it might be beneficial to recalculate balances,
        // especially if the imported transactions can be out of order or inserted between existing transactions.
        // Consider whether you need to call recalculateBalancesFromDate($date) here,
        // keeping in mind the potential performance implications.
    }


}


