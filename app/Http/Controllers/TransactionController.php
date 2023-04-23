<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Category;
use App\Models\Transaction;
use App\Models\Type_transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with(['User', 'Type_transaction', 'Category'])->get();
        return response()->json($transactions);
    }

    public function show($id)
    {
        $transaction = Transaction::with(['User', 'Type_transaction'])->find($id);

        if (!$transaction) {
            return response()->json(['message' => 'Transaccion no existe'], 404);
        }

        return response()->json($transaction, 200);
    }

    public function store(Request $request)
    {
        // Cuenta del usuario que esta creando la transaccion
        $accountUser = Account::find(Auth::user()->id);
        $userId = Auth::user()->id;

        // Si el tipo de transaccion es deposito
        if ($request['type_transaction_id'] === 1) {

            $transaction = Transaction::create([
                'amount' => $request['amount'],
                'account_id' => $accountUser['id'],
                'user_id' => $userId,
                'type_transaction_id' => 1,
                'category_id' => null
            ]);

            $accountUser['available'] += $request['amount'];
        } else {

            $request->validate(['category_id' => 'required']);

            // Retiro
            $available = $accountUser['available'];
            $available -= $request['amount'];

            $category = Category::find($request['category_id']);

            if (!$category) {
                return response()->json([
                    'message' => 'Esta categoria no existe'
                ]);
            }

            if ($available < 0) {
                return response()->json([
                    'message' => 'No dispone de saldo suficiente'
                ]);
            }

            $transaction = Transaction::create([
                'amount' => $request['amount'],
                'account_id' => $accountUser['id'],
                'user_id' => $userId,
                'type_transaction_id' => 2
            ]);
            $transaction['category_id'] = $category['id'];
            $accountUser['available'] -= $request['amount'];
        }

        $accountUser->save();
        $transaction->save();

        return response()->json([
            'message' => 'Transaccion realizada correctamente'
        ]);
    }

    public function getForCategory($type_transaction_id)
    {

        $transactions = Transaction::where('type_transaction_id', $type_transaction_id)->get();
        return response()->json($transactions);
    }
}
