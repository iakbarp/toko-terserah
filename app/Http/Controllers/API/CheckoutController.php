<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Alamat;
use App\Models\Keranjang;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Midtrans\Config;
use Midtrans\Snap;
use Tymon\JWTAuth\Facades\JWTAuth;

class CheckoutController extends Controller
{
    public $channels;

    public function __construct()
    {
        Config::$serverKey = env('MIDTRANS_SERVER_KEY'); // Set your Merchant Server Key
        Config::$isProduction = false; // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        Config::$isSanitized = true; // Set sanitization on (default)
        Config::$is3ds = true; // Set 3DS transaction for credit card to true

        // Uncomment for append and override notification URL
        // Config::$appendNotifUrl = "https://example.com";
        // Config::$overrideNotifUrl = "https://example.com";

        // Optional, remove this to display all available payment methods
        $this->channels = ["credit_card", "bca_va", "echannel", "bni_va", "permata_va", "other_va", "gopay", "indomaret", "alfamart"];
    }

    public function snap(Request $request)
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

            app()->setLocale('id');

            $code = strtoupper(uniqid('PYM') . now()->timestamp);
            $user = User::find($request->user_id);
            $split_name = explode(" ", $user->name);
            $address = Alamat::where('user_id', $user->id)->where('isUtama', true)->first();
            $main_address = $address != "" ? $address->alamat . ' - ' . $address->kode_pos . ' (' . $address->getOccupancy->name . ').' : null;
            $shipping = Alamat::find($request->pengiriman_id);
            $split_shipping_name = explode(" ", $shipping->nama);
            $billing = Alamat::find($request->penagihan_id);
            $split_bill_name = explode(" ", $billing->nama);

            $carts = Keranjang::whereIn('id', explode(',', $request->cart_ids))
                ->orderByRaw('FIELD (id, ' . $request->cart_ids . ') ASC')->get();

            $arr_items = [];
            foreach ($carts as $i => $cart) {
                if ($cart->getProduk->isGrosir == true) {
                    $price = ceil($cart->getProduk->isDiskonGrosir == true ? $cart->getProduk->harga_diskon_grosir : $cart->getProduk->harga_grosir);
                } else {
                    $price = ceil($cart->getProduk->is_diskon == true ? $cart->getProduk->harga_diskon : $cart->getProduk->harga);
                }

                $arr_items[$i] = [
                    'id' => strtoupper($cart->getProduk->kode_barang),
                    'price' => $price,
                    'quantity' => $cart->qty,
                    'name' => Str::limit($cart->getProduk->nama, 50),
                    'category' => Str::limit($cart->getProduk->getSubkategori->nama, 50)
                ];
            }

            $arr_ship_disc = [];
            if (!is_null($request->discount_price)) {
                $arr_ship_disc[count($arr_items)] = [
                    'id' => 'DISC-' . $code,
                    'price' => ceil($request->discount_price * -1),
                    'quantity' => 1,
                    'name' => 'Diskon'
                ];
            }

            $arr_ship_disc[!is_null($request->discount_price) ? count($arr_items) + 1 : count($arr_items)] = [
                'id' => 'SHIP-' . $code,
                'price' => ceil($request->ongkir),
                'quantity' => 1,
                'name' => 'Ongkir'
            ];

            return Snap::getSnapToken([
                'enabled_payments' => $this->channels,
                'transaction_details' => [
                    'order_id' => $code,
                    'gross_amount' => $request->total,
                ],
                'customer_details' => [
                    'first_name' => array_shift($split_name),
                    'last_name' => implode(" ", $split_name),
                    'phone' => $user->getBio->phone,
                    'email' => $user->email,
                    'address' => $main_address,
                    'billing_address' => [
                        'first_name' => array_shift($split_bill_name),
                        'last_name' => implode(" ", $split_bill_name),
                        'address' => $billing->alamat,
                        'city' => $billing->getKecamatan->getKota->getProvinsi->nama . ', ' . $billing->getKecamatan->getKota->nama,
                        'postal_code' => $billing->kode_pos,
                        'phone' => $billing->telp,
                        'country_code' => 'IDN'
                    ],
                    'shipping_address' => [
                        'first_name' => array_shift($split_shipping_name),
                        'last_name' => implode(" ", $split_shipping_name),
                        'address' => $shipping->alamat,
                        'city' => $shipping->getKecamatan->getKota->getProvinsi->nama . ', ' . $shipping->getKecamatan->getKota->nama,
                        'postal_code' => $shipping->kode_pos,
                        'phone' => $shipping->telp,
                        'country_code' => 'IDN'
                    ],
                ],
                'item_details' => array_merge($arr_items, $arr_ship_disc),
            ]);

        } catch (\Exception $exception) {
            return response()->json([
                'error' => true,
                'data' => [
                    'message' => $exception->getMessage()
                ]
            ]);
        }
    }

    public function snapWebview(Request $request)
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

            $data = [
                'snap_token' => $request->snap_token,
                'cart_ids' => $request->cart_ids,
                'pengiriman_id' => $request->pengiriman_id,
                'penagihan_id' => $request->penagihan_id,
                'ongkir' => $request->ongkir,
                'durasi_pengiriman' => $request->durasi_pengiriman,
                'weight' => ceil($request->weight * 1000),
                'total' => $request->total,
                'note' => $request->note,
                'promo_code' => $request->promo_code,
                'discount_price' => $request->discount_price,
                'kode_kurir' => $request->kode_kurir,
                'nama_kurir' => $request->nama_kurir,
                'layanan_kurir' => $request->layanan_kurir,
                'opsi' => $request->opsi,
            ];

            return view('pages.webviews.snap-midtrans', compact('data'));

        } catch (\Exception $exception) {
            return response()->json([
                'error' => true,
                'data' => [
                    'message' => $exception->getMessage()
                ]
            ]);
        }
    }
}
