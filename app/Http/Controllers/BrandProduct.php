<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Brand;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Redirect;

class BrandProduct extends Controller
{
    // Kiểm tra đăng nhập admin
    public function AuthLogin()
    {
        $admin_id = session()->get('admin_id');
        if (!$admin_id) {
            return redirect('admin')->send();
        }
    }

    // Trang thêm thương hiệu
    public function add_brand_product()
    {
        $this->AuthLogin();
        return view('admin.add_brand_product');
    }

    // Hiển thị tất cả thương hiệu
    public function all_brand_product()
    {
        $this->AuthLogin();
        $all_brand_product = Brand::orderBy('brand_id', 'DESC')->get();
        $manager_brand_product = view('admin.all_brand_product')->with('all_brand_product',$all_brand_product);
        return view('layouts.admin_layout')->with('admin.all_brand_product',
        $manager_brand_product);
    }

    // Lưu thương hiệu mới
    public function save_brand_product(Request $request)
    {
        $this->AuthLogin();

        // Validate dữ liệu đầu vào
        $request->validate([
            'brand_product_name' => 'required|max:255',
            'brand_slug' => 'required|unique:tbl_brand,brand_slug|max:255',
            'brand_product_desc' => 'required',
            'brand_product_status' => 'required|boolean',
        ]);

        // Tạo mới thương hiệu
        $brand = new Brand();
        $brand->brand_name = $request->brand_product_name;
        $brand->brand_slug = $request->brand_slug;
        $brand->brand_desc = $request->brand_product_desc;
        $brand->brand_status = $request->brand_product_status;
        $brand->save();

        session()->put('message', 'Thêm thương hiệu sản phẩm thành công');
        return redirect('add-brand-product');
    }

    // Ẩn thương hiệu
    public function unactive_brand_product($brand_product_id)
    {
        $this->AuthLogin();
        $brand = Brand::find($brand_product_id);
        if ($brand) {
            $brand->update(['brand_status' => 0]);
            session()->put('message', 'Ẩn thương hiệu sản phẩm thành công');
        } else {
            session()->put('message', 'Không tìm thấy thương hiệu cần ẩn');
        }
        return redirect('all-brand-product');
    }

    // Kích hoạt thương hiệu
    public function active_brand_product($brand_product_id)
    {
        $this->AuthLogin();
        $brand = Brand::find($brand_product_id);
        if ($brand) {
            $brand->update(['brand_status' => 1]);
            session()->put('message', 'Kích hoạt thương hiệu sản phẩm thành công');
        } else {
            session()->put('message', 'Không tìm thấy thương hiệu cần kích hoạt');
        }
        return redirect('all-brand-product');
    }

    // Trang chỉnh sửa thương hiệu
    public function edit_brand_product($brand_product_id)
    {
        $this->AuthLogin();
        $edit_brand_product = Brand::find($brand_product_id);
        if (!$edit_brand_product) {
            session()->put('message', 'Không tìm thấy thương hiệu cần chỉnh sửa');
            return redirect('all-brand-product');
        }
        return view('admin.edit_brand_product', compact('edit_brand_product'));
    }

    public function update_brand_product(Request $request,$brand_product_id){
        $this->AuthLogin();
        $data = $request->all();
        $brand = Brand::find($brand_product_id);
        $brand->brand_name = $data['brand_product_name'];
        $brand->brand_slug = $data['brand_product_slug'];
        $brand->brand_desc = $data['brand_product_desc'];
        $brand->brand_status = $data['brand_product_status'];
        $brand->save();
        Session::put('message','Cập nhật thương hiệu sản phẩm thành công');
        return Redirect::to('all-brand-product');
    }

    public function delete_brand_product($brand_product_id){
        $this->AuthLogin();
        DB::table('tbl_brand')->where('brand_id',$brand_product_id)->delete();
        Session::put('message','Xóa thương hiệu sản phẩm thành công');
        return Redirect::to('all-brand-product');
    }
}
