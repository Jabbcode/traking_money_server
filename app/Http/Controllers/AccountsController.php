<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\User;
use Illuminate\Http\Request;

class AccountsController extends Controller
{
    public function index()
    {
        $accounts = Account::with(['User', 'Transactions'])->get();
        return response()->json($accounts);
    }

    public function show($id)
    {
        $account = Account::with(['User', 'Transactions'])->find($id);

        if (!$account) {
            return response()->json(['message' => 'Cuenta no existe'], 404);
        }

        return response()->json([$account], 200);
    }

    //Dar de baja la cuenta de un usuario - Desvincular una cuenta afiliada a un usuario
    public function ToUnsubscribe($account_id, $user_id)
    {
        $user = User::find($user_id);

        if (!$user) {
            return response()->json(['message' => 'Usuario no existe'], 404);
        }

        $account = Account::find($account_id);

        if (!$account) {
            return response()->json(['message' => 'Cuenta no existe'], 404);
        }

        $user['account_id'] = NULL;
        $user->save();

        return response()->json([
            'message' => 'Su cuenta se a dado de baja correctamente'
        ]);
    }
}
