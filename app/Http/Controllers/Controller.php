<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Storage;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Return Success Response Form APIs
     *
     */
    public function return_success($data = [], $code = 200){
        return response()->json($data)->setStatusCode($code);
    }

    /**
     * Return Error Error Form APIs
     *
     */
    public function return_error($debugger, $code, $message){
        $error['error'] = [];
        $error['error']['debugger'] = $debugger;
        $error['error']['code'] = $code;
        $error['error']['message'] = $message;

        return response()->json($error)->setStatusCode(400);
    }

    /**
     * Store date function
     *
     */
    public function store_date($request_date)
    {
        $date = $request_date;
        $date = explode('/', $date);
        $date = date('Y-m-d', strtotime($date[2]."-".$date[1]."-".$date[0]));

        return $date;
    }
    
    /**
     * Store file function
     *
     */
    public function store_file($link, $request_file)
    {
        $tmp_file = $request_file;
        $tmp_file_name = basename($tmp_file->getClientOriginalName(), '.'.$tmp_file->getClientOriginalExtension());
        $tmp_file_name = strtolower(str_replace(" ", "-", $tmp_file_name));
        $tmp_file_extension = $tmp_file->getClientOriginalExtension();
        $original_name = $tmp_file_name . "-" . rand() . "." . $tmp_file_extension;

        $file = $tmp_file->storeAs('public/'.$link, $original_name);
        $file_path = Storage::url($file);

        return $file_path;
    }
}
