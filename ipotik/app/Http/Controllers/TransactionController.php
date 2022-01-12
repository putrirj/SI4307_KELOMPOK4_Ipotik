<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        return view('transaction.index', compact('transactions'));
    }

    public function create()
    {
    }

    public function receipt()
    {
        return view('transaction.receipt');
    }

    public function receiptStore(Request $request)
    {
        $validated = $request->validate([
            'file' => 'required|file|mimes:pdf,jpg,png'
        ]);

        $transaction = new Transaction();
        $transaction->user_id = Auth::user()->id;
        $transaction->type = "resep";
        $transaction->file_name = $validated['file']->getClientOriginalName();
        if ($validated['file']->getClientMimeType() == 'image/jpeg' || $validated['file']->getClientMimeType() == 'image/png') {
            $transaction->file_type = "image";
        } elseif ($validated['file']->getClientMimeType() == 'application/pdf') {
            $transaction->file_type = "pdf";
        }
        $transaction->file = $validated['file']->store('receipts', 'public');
        $transaction->status = 1;

        if ($transaction->save()) {
            return redirect()->route('transaction.show', $transaction->id)
                ->with('alert_type', 'success')
                ->with('alert_message', 'Transaksi berhasil dibuat.');
        }

        return back()
            ->with('alert_type', 'error')
            ->with('alert_message', 'Terjadi kesalahan.');
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Transaction $transaction)
    {
        if (Auth::user()->role == 'user' && $transaction->user_id != Auth::user()->id) {
            return back()
                ->with('alert_type', 'error')
                ->with('alert_message', 'Tidak memiliki akses.');
        }

        $transaction_details = TransactionDetail::where('transaction_id', $transaction->id)->get();
        if ($transaction->type == 'pembelian') {
            return view('transaction.show.pembelian', compact('transaction', 'transaction_details'));
        } else {
            return view('transaction.show.resep', compact('transaction'));
        }
    }

    public function selesai(Transaction $transaction)
    {
        $transaction->status = 6;

        if ($transaction->save()) {
            return back()
                ->with('alert_type', 'success')
                ->with('alert_message', 'Status transaksi berhasil diubah');
        }

        return back()
            ->with('alert_type', 'error')
            ->with('alert_message', 'Status transaksi gagal diubah');
    }

    public function bayar(Transaction $transaction)
    {
        $carts = TransactionDetail::where('transaction_id', $transaction->id)->get();
        $total = $transaction->total;
        return view('transaction.bayar', compact('transaction', 'carts', 'total'));
    }

    public function proses(Request $request, Transaction $transaction)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'address' => 'required|string',
            'courier' => 'required|string'
        ]);

        $transaction->name = $validated['name'];
        $transaction->phone = $validated['phone'];
        $transaction->address = $validated['address'];
        $transaction->courier = $validated['courier'];
        $transaction->status = 3;

        if ($transaction->save()) {
            return redirect()->route('transaction.index')
                ->with('alert_type', 'success')
                ->with('alert_message', 'Transaksi telah dibayar');
        }

        return back()
            ->with('alert_type', 'error')
            ->with('alert_message', 'Status transaksi gagal diubah');
    }
}
