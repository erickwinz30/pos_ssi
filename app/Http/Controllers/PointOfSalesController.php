<?php

namespace App\Http\Controllers;

use App\Models\Selling;
use App\Models\Products;
use App\Models\PosSession;
use Illuminate\Http\Request;
use App\Models\SellingDetail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\StockMovings;
use Illuminate\Support\Facades\Auth;

class PointOfSalesController extends Controller
{
    public function index(Request $request) {
        $q = $request->input('q');

        $products = Products::where(function($query) use ($q) {
            $query->where('is_have_stock', true)->where('stock', '>', 0);
        })->orWhere(function($query) use ($q) {
            $query->where('is_have_stock', false);
        })->where('name', 'like', '%'. $q . '%')->get();

        $session = PosSession::where('user_id', Auth::user()->id)->whereNull('end_at')->latest('created_at')->first();

        return view('point-of-sales.pos.index', compact('products', 'session'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $selling = Selling::create([
                'user_id' => auth()->user()->id,
                'pos_session_id' => $request->session_id,
                'code' => 'POS-DINAMIKA-' . rand(100000, 999999),
                'total' => $request->total_amount,
                'payment' => $request->pay_amount,
                'changes' => $request->changes ?? 0,
                'status' => 'Paid',
                'payment_method' => $request->payment_method,
            ]);
    
            $session = PosSession::find($request->session_id);
            $cashInCurrent = $session->cash_in ?? 0;
            $session->update([
                'cash_in' => $cashInCurrent + $request->total_amount
            ]);
            

            foreach ($request->cart as $product) {
                SellingDetail::create([
                    'selling_id' => $selling->id,
                    'product_id' => $product['productId'],
                    'qty' => $product['qty'],
                    'price' => $product['price'],
                    'subtotal' => $product['price'] * $product['qty'],
                ]);

                StockMovings::create([
                    'product_id' =>  $product['productId'],
                    'description' => 'Penjualan Barang',
                    'moving_stock' => -$product['qty'],
                    'moving_price' => $product['price'] * $product['qty'],
                ]);

                $getProduct = Products::find($product['productId']);
                if($getProduct->is_have_stock) {
                    $getProduct->update([
                        'stock' => $getProduct->stock - $product['qty']
                    ]);
                }
            }

            DB::commit();

            return $selling;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function endSession(Request $request)
    {
        DB::beginTransaction();
        try {
            $session = PosSession::find($request->session_id);

            $session->update([
                'ending_cash' => $request->ending_cash_system,
                'ending_cash_actual' => $request->ending_cash_system,
                'end_at' => now()->timezone('Asia/Jakarta')
            ]);

            DB::commit();

            return $session;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}
