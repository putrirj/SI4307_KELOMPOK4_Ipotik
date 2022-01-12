<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Medicine;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function index()
    {
        $carts = Cart::with('medicine')->where('user_id', Auth::user()->id)->get();
        $total = Cart::where('user_id', Auth::user()->id)->sum('sub_total');
        return view('cart.index', compact('carts', 'total'));
    }

    public function create()
    {
        $carts = Cart::where('user_id', Auth::user()->id)->get();
        $total = Cart::where('user_id', Auth::user()->id)->sum('sub_total');
        return view('cart.create', compact('carts', 'total'));
    }

    public function checkout(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'address' => 'required|string',
            'courier' => 'required|string',
            'bukti' => 'required|file|mimes:pdf,jpg,png'
        ]);

        $carts = Cart::with('medicine')->where('user_id', Auth::user()->id)->get();

        try {
            $transaction = new Transaction();
            $transaction->name = $validated['name'];
            $transaction->phone = $validated['phone'];
            $transaction->address = $validated['address'];
            $transaction->courier = $validated['courier'];
            $transaction->bukti = $validated['bukti']->getClientOriginalName();
            $transaction->buktifile = $validated['bukti']->store('bukti', 'public');
            $transaction->user_id = Auth::user()->id;
            $transaction->type = "pembelian";
            $transaction->total = $carts->sum('sub_total');
            $transaction->status = 1;
            $transaction->save();

            foreach ($carts as $cart) {
                $transaction_detail = new TransactionDetail();
                $transaction_detail->name = $cart->medicine->name;
                $transaction_detail->price = $cart->medicine->price;
                $transaction_detail->quantity = $cart->quantity;
                $transaction_detail->sub_total = $cart->quantity * $cart->medicine->price;
                $transaction_detail->photo = $cart->medicine->photo;
                $transaction_detail->user_id = Auth::user()->id;
                $transaction_detail->transaction_id = $transaction->id;
                $transaction_detail->save();

                $cart->delete();
            }

            return redirect()->route('cart.index')
                ->with('alert_type', 'success')
                ->with('alert_message', 'Transaksi berhasil dibuat.');
        } catch (Exception $e) {
            return back()
                ->with('alert_type', 'error')
                ->with('alert_message', 'Terjadi kesalahan: ' . $e);
        }
    }

    public function store(Request $request, Medicine $medicine)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = new Cart();
        $cart->user_id = Auth::user()->id;
        $cart->medicine_id = $medicine->id;
        $cart->quantity = $validated['quantity'];
        $cart->sub_total = $validated['quantity'] * $medicine->price;

        if ($cart->save()) {
            return redirect()->route('cart.index')
                ->with('alert_type', 'success')
                ->with('alert_message', 'Obat berhasil ditambahkan ke keranjang.');
        }

        return back()
            ->with('alert_type', 'error')
            ->with('alert_message', 'Obat gagal ditambahkan ke keranjang.');
    }

    public function show(Cart $cart)
    {
        //
    }

    public function edit(Cart $cart)
    {
        //
    }

    public function update(Request $request, Cart $cart)
    {
        //
    }

    public function destroy(Cart $cart)
    {
        //
    }
}
