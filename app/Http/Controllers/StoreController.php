<?php

namespace App\Http\Controllers;

use App\Models\Store;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    //
    public function store() {
        return view('/store');
    }
    public function storeRegister(Request $request) {
        $store = new Store();

        $store->store = $request->input('store');
        $store->address = $request->input('address');
        $store->save();
        //return redirect()->route('store');
        return response()->json(['message' => '店舗登録しました']);
    }
}
