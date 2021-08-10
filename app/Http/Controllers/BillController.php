<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use  DB;
use App\Bill;
use App\Exports\BillExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ClassSubject;


class BillController extends Controller
{
    public function add_bill(){
        return view('admin.add_bill');
    }
    public function save_bill(Request $request){
        $this->validate($request,
        [
            'company_name'=>'required',
            'company_address'=>'required',
            'company_tel'=>'required',
            'company_fax'=>'required',
            'estimate_No'=>'required',
            'project_name'=>'required',
            'item_name'=>'required',
            'amout'=>'required',
        ],
        [
            'company_name.required'=>'Chưa nhập tên công ty',
            'company_address.required'=>'Chưa nhập địa chỉ công ty',
            'company_tel.required'=>'Chưa nhập số điện thoại công ty',
            'company_fax.required'=>'Chưa nhập số fax công ty',
            'estimate_No.required'=>'Chưa nhập Estimate ID',
            'project_name.required'=>'Chưa nhập tên dự án',
            'item_name.required'=>'Chưa nhập danh mục dự án',
            'amout.required'=>'Chưa nhập giá danh mục dự án',
        ]);
        $bill = new Bill;
        $bill->company_name=$request->company_name;
        $bill->company_address=$request->company_address;
        $bill->company_tel=$request->company_tel;
        $bill->company_fax=$request->company_fax;
        $bill->estimate_No=$request->estimate_No;
        $bill->project_name=$request->project_name;
        $bill->item_name=$request->item_name;
        $bill->amout=$request->amout;
        $bill->today=$request->today;
        $bill->expire_day=$request->expire_day;
        $bill->save();
        return Redirect::to('add-bill')->with('thongbao','Thêm mới hóa đơn thành công');

    }

    public function all_bill(){
        $all_bill= DB::table('bill')->get();
        $manager_bill=view('admin.all_bill')->with('all_bill',$all_bill);
        return view('admin_layout')->with('admin.all_bill',$manager_bill);
    }

    public function export_invoice($id){
        $bill= Bill::findOrFail($id);
        $file = Excel::download(new BillExport($id), $bill->id.'.xlsx');
        return $file;
    }

    
}
