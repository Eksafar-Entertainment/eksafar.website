<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{
    public function inlineEdit(Request $request)
    {
        $table = $request->table;
        $field = $request->field;
        $value = $request->value;
        $where = $request->where;

        try {
            $result = DB::statement("UPDATE $table SET `$field`= '$value' WHERE $where");
            

            return response()->json([
                "resultCode" => 200,
                "message" => "Successfully updated",
            ], 200);
        } catch (Exception $err) {
            return response()->json([
                "resultCode" => 500,
                "message" => "Error while executing query"
            ], 500);
        }
    }
}
