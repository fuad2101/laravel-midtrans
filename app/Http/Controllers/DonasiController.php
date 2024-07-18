<?php

namespace App\Http\Controllers;

use App\Models\Donasi;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DonasiController extends Controller
{

    public function __construct()
    {
        \Midtrans\Config::$serverKey = config('services.midtrans.serverKey');
        \Midtrans\Config::$isProduction = config('services.midtrans.isProduction');
        \Midtrans\Config::$isSanitized = config('services.midtrans.isSanitized');
        \Midtrans\Config::$is3ds = config('services.midtrans.is3ds');
    }

    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        return view('donation');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        DB::transaction(function() use($request) {
            $donasi = Donasi::create([
                'donor_name'=>$request->donor_name,
                'donor_email'=>$request->donor_email,
                'donation_type'=>$request->donation_type,
                'amount'=>$request->amount,
                'status'=>$request->status,
                'note'=>$request->note,
                ]);

            $payload =  [

                'transactionDetails' => [
                    'order_id' => uniqid('SANDBOX-'),
                    'gross_amount'=>$request->amount,
                    ],
                'customer_details'=>[
                    'first_name'=>$request->donor_name,
                    'email'=>$request->donor_email,
                    ],
                'item_details'=>[
                    'id'=>$donasi->donation_type,
                    'price'=>$donasi->amount,
                    'quantity'=>1,
                    'name'=>ucwords(str_replace('_',' ',$donasi->donation_type))
                    ]
                ];

                $snap_token = \Midtrans\Snap::getSnapToken($payload);
                $donasi->snap_token = $snap_token;
                $donasi->save();

                $this->response['snap_token'] = $snap_token;
        });

        return response()->json($this->response);

    }

    /**
     * Display the specified resource.
     */
    public function show(Donasi $donasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Donasi $donasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Donasi $donasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Donasi $donasi)
    {
        //
    }
}
