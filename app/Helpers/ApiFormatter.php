<?php
namespace App\Helpers;
// namespace : wajib disimpan dipaling atas setekah pembuka php
//namespace : mendefinisikan alamat ketika file akan diimport/dipanggil
// helpers : untuk menyimpan function/variavle yg akan dipanggil/digunakan di beberapa/banyak function controller
// untuk apip, biasanya helpers digunakan untuk mengatur format bentuk respponse

class ApiFormatter {
    // membuat variable format untuk response api nya
    protected static $response = [
        // menyimpan http status code : 200 (ok), 400 (err di codingan/proses validasi input), 500 (err server, laravel file env)
        'code' => null,
        //arti sari http status code nya
        'status' => null,
        // desc lebih detail dari http status code
        'message' => null,
        //response dari database ( data yg diambil)
        'data' => null,
    ];
    // func yg dipanggil jika ingin menampilkan response proses success
    public static function success($code = null, $message = null, $data = null)
    {
        // memanggil variable yg ada di class ini yg namanya response
        // key array yg isinya masih null di var, disi dari argument parameternya
        self::$response['code'] = $code;
        self::$response['status'] = 'success';
        self::$response['message'] = $message;
        self::$response['data'] = $data;
        // dikembalikan dalam bentuk json
        //fungsi json memerlukan 2 argument json(format_yg_mau_ditampilkan, http_status_code)
        return response()->json(self::$response, self::$response['code']);
    }

    // func yg dipanggil jika ingin menampilkan response proses gagal
    public static function error($code = null, $message = null, $data = null)
    {
        self::$response['code'] = $code;
        self::$response['status'] = 'error';
        self::$response['message'] = $message;
        self::$response['data'] = $data;

        return response()->json(self::$response, self::$response['code']);
    }

}
?>