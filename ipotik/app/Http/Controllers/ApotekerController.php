<?php

namespace App\Http\Controllers;

use App\Models\ApotekerCart;
use App\Models\Category;
use App\Models\Medicine;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Exception;
use Illuminate\Http\Request;

class ApotekerController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('user')->orderBy('updated_at', 'desc')->get();
        return view('apoteker.resep_index', compact('transactions'));
    }

    public function tolak(Transaction $transaction)
    {
        $transaction->status = 2;

        if ($transaction->save()) {
            return back()
                ->with('alert_type', 'success')
                ->with('alert_message', 'Status transaksi berhasil diubah');
        }

        return back()
            ->with('alert_type', 'error')
            ->with('alert_message', 'Status transaksi gagal diubah');
    }

    public function proses(Transaction $transaction)
    {
        $transaction->status = 3;

        if ($transaction->save()) {
            return back()
                ->with('alert_type', 'success')
                ->with('alert_message', 'Status transaksi berhasil diubah');
        }

        return back()
            ->with('alert_type', 'error')
            ->with('alert_message', 'Status transaksi gagal diubah');
    }

    public function dikirim(Transaction $transaction)
    {
        $transaction->status = 5;

        if ($transaction->save()) {
            return back()
                ->with('alert_type', 'success')
                ->with('alert_message', 'Status transaksi berhasil diubah');
        }

        return back()
            ->with('alert_type', 'error')
            ->with('alert_message', 'Status transaksi gagal diubah');
    }

    public function keranjang(Transaction $transaction)
    {
        $carts = ApotekerCart::with('medicine')->where('transaction_id', $transaction->id)->get();
        $total = $carts->sum('sub_total');
        return view('apoteker.cart', compact('carts', 'total', 'transaction'));
    }

    public function category(Transaction $transaction)
    {
        $categories = Category::all();
        return view('apoteker.medicine_category', compact('categories', 'transaction'));
    }

    public function medicine(Request $request, Transaction $transaction, Category $category)
    {
        if ($request->keyword != null) {
            $keyword = $request->keyword;
            $medicines = Medicine::where('category_id', $category->id)
                ->where('name', 'like', '%' . $keyword . '%')
                ->paginate(8);
        } else {
            $keyword = "";
            $medicines = Medicine::where('category_id', $category->id)->paginate(8);
        }
        return view('apoteker.medicine_list', compact('transaction', 'category', 'medicines', 'keyword'));
    }

    public function medicineDetail(Transaction $transaction, Medicine $medicine)
    {
        return view('apoteker.medicine_detail', compact('transaction', 'medicine'));
    }

    public function store(Request $request, Transaction $transaction, Medicine $medicine)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $apoteker_cart = new ApotekerCart();
        $apoteker_cart->transaction_id = $transaction->id;
        $apoteker_cart->user_id = $transaction->user_id;
        $apoteker_cart->medicine_id = $medicine->id;
        $apoteker_cart->quantity = $validated['quantity'];
        $apoteker_cart->sub_total = $validated['quantity'] * $medicine->price;

        if ($apoteker_cart->save()) {
            return redirect()->route('verifikasi.keranjang', $transaction->id)
                ->with('alert_type', 'success')
                ->with('alert_message', 'Obat berhasil ditambahkan ke keranjang.');
        }

        return back()
            ->with('alert_type', 'error')
            ->with('alert_message', 'Obat gagal ditambahkan ke keranjang.');
    }

    public function pesanan(Transaction $transaction)
    {
        $apoteker_carts = ApotekerCart::where('transaction_id', $transaction->id)->get();

        $transaction->status = 6;
        $transaction->save();

        try {
            $n_transaction = new Transaction();
            $n_transaction->file_name = $transaction->file_name;
            $n_transaction->user_id = $transaction->user_id;
            $n_transaction->type = "pembelian";
            $n_transaction->total = $apoteker_carts->sum('sub_total');
            $n_transaction->status = 0;
            $n_transaction->save();

            foreach ($apoteker_carts as $apoteker_cart) {
                $transaction_detail = new TransactionDetail();
                $transaction_detail->name = $apoteker_cart->medicine->name;
                $transaction_detail->price = $apoteker_cart->medicine->price;
                $transaction_detail->quantity = $apoteker_cart->quantity;
                $transaction_detail->sub_total = $apoteker_cart->quantity * $apoteker_cart->medicine->price;
                $transaction_detail->photo = $apoteker_cart->medicine->photo;
                $transaction_detail->user_id = $apoteker_cart->user_id;
                $transaction_detail->transaction_id = $n_transaction->id;
                $transaction_detail->save();

                $apoteker_cart->delete();
            }

            return redirect()->route('verifikasi.index')
                ->with('alert_type', 'success')
                ->with('alert_message', 'Transaksi berhasil dibuat.');
        } catch (Exception $e) {
            return back()
                ->with('alert_type', 'error')
                ->with('alert_message', 'Terjadi kesalahan: ' . $e);
        }
    }
}
