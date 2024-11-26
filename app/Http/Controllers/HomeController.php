<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

session_start();
class HomeController extends Controller
{
    public function index()
{
    // Lấy danh sách danh mục sản phẩm
    $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_id', 'desc')->get();

    // Lấy danh sách thương hiệu sản phẩm
    $brand_product = DB::table('tbl_brand')->where('brand_status', '1')->orderby('brand_id', 'desc')->get();

    // Truyền dữ liệu vào View
    return view('layouts.home')->with('category', $cate_product)->with('brand', $brand_product);
}

}
