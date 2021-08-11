<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use  DB;
use App\Bill;
use App\Exports\BillExport;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PHPExcel_Style_Border;


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

    public function export($invoice_id){
   
    $bill=DB::table('bill')
    ->where('bill.id','=',$invoice_id)->get();
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $spreadsheet->getDefaultStyle()->getFont()->setName('MS PMincho');
    $spreadsheet->getDefaultStyle()->getFont()->setSize(10);

    $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(0.27, 'cm');
    $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(0.64, 'cm');
    $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(4.0, 'cm');
    $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(6.0, 'cm');
    $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(18.33, 'cm');
    $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(5.67, 'cm');
    $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(6.04, 'cm');
    $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(11.5, 'cm');
    $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(14.83, 'cm');
    $spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(13.17, 'cm');
    $spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(0.45, 'cm');
    $spreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(0.36, 'cm');

    $spreadsheet->getActiveSheet()->mergeCells('E3:K3')->setCellValue('E3', 'VAIX CO., LTD');
    $sheet->getStyle("E3")->getFont()->setBold(true)->setName('MS PMincho')->setSize(14);

    $sheet->setCellValue('E4','So 50, Go Soi, Hong Ky, Soc Son, Ha Noi, Viet Nam');
    
    $sheet->setCellValue('E5','Tel: +843-3384-6868');
    $sheet->getStyle("E5")->getFont()->setSize(11);
    $styleArray1 = [
        'font' => [
            'size' => 20,
            'bold' => true
        ],
        'alignment' => [
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
        ],
    ];
    $styleArray2 = [
        'font' => [
            'bold' => true
        ],
        'alignment' => [
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
        ],
    ];
    $sheet->setCellValue('C9','日付：');
    $sheet->setCellValue('G9','No：');
    $sheet->setCellValue('C10','お客様：');
    $sheet->setCellValue('C11','住所：');
    $sheet->setCellValue('C12','TEL：');
    $sheet->setCellValue('C13','見積番号：');
    $sheet->setCellValue('C15','製品・サービス：');
    $sheet->setCellValue('G12','FAX：　');
    $sheet->setCellValue('C28','お支払い期限：');
    $sheet->setCellValue('C29','銀行名：');
    $sheet->setCellValue('C30','支店名：');
    $sheet->setCellValue('C31','Swift コード：');
    $sheet->setCellValue('C32','口座番号：');
    $sheet->setCellValue('C33','口座名義：');
    $sheet->setCellValue('E29','NGAN HANG TMCP DAU TU VA PHAT TRIEN VIET NAM (BIDV)');
    $sheet->setCellValue('E30','DONG HA NOI');
    $sheet->setCellValue('E31','BIDVVNVX');
    $sheet->setCellValue('E32','21410410265442');
    $sheet->setCellValue('E33','CONG TY TNHH TRI TUE NHAN TAO VAIX VIET NAM');
    $spreadsheet->getActiveSheet()->getStyle('C7')->applyFromArray($styleArray1);
    $spreadsheet->getActiveSheet()->getStyle('C9:C15')->applyFromArray($styleArray2);
    $spreadsheet->getActiveSheet()->getStyle('E9:E15')->applyFromArray($styleArray2);
    $spreadsheet->getActiveSheet()->getStyle('G9')->applyFromArray($styleArray2);
    $spreadsheet->getActiveSheet()->getStyle('G12')->applyFromArray($styleArray2);
    $spreadsheet->getActiveSheet()->getStyle('H12')->applyFromArray($styleArray2);

    $spreadsheet->getActiveSheet()->mergeCells('C7:J7')->setCellValue('C7','請求書');
        $spreadsheet->getActiveSheet()->mergeCells('E9:F9')->setCellValue('E9',$bill[0]->today);//----today
        $spreadsheet->getActiveSheet()->mergeCells('E9:F9')->setCellValue('H9',$bill[0]->id);//----today
        $spreadsheet->getActiveSheet()->mergeCells('E9:F9')->setCellValue('E28',$bill[0]->expire_day);//----expire_day
        $spreadsheet->getActiveSheet()->mergeCells('E10:J10')->setCellValue('E10',$bill[0]->company_name);//name
        $spreadsheet->getActiveSheet()->mergeCells('E11:J11')->setCellValue('E11',$bill[0]->company_address);//address
        $spreadsheet->getActiveSheet()->mergeCells('E12:F12')->setCellValue('E12',$bill[0]->company_tel);//phone
        $spreadsheet->getActiveSheet()->mergeCells('H12:I12')->setCellValue('H12',$bill[0]->company_fax);//fax
        $spreadsheet->getActiveSheet()->mergeCells('E13:F13')->setCellValue('E13',$bill[0]->estimate_No);//estimate
    
    $styleArray = [
        'borders' => [
            'allBorders' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            ],
        ],
    ];
    $item_count = $bill->count()+24;
    $sheet->getStyle('C18:J'.$item_count)->applyFromArray($styleArray);        
    $sheet->setCellValue('C18','#');
    $sheet->setCellValue('D18','項目');
    $sheet->setCellValue('H18','数量');
    $sheet->setCellValue('I18','単価（円）');
    $sheet->setCellValue('J18','合計（円）');
    $sheet->setCellValue('I22','Giá hạng mục');
    $sheet->setCellValue('I23','Tiền thuế 10%');
    $sheet->setCellValue('I24','Tổng tiền');
    $sheet->getStyle('C18:J18')->getFont()->setBold(true);
    $spreadsheet->getActiveSheet()->getStyle('C18:J18')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('C18:J18')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('C18:J18')->getAlignment()->setWrapText(true);
   
    $rows = 19;
    $sub_total = 0;$tax=0.1;
    $count=0;
    for ( $i = 0; $i < $bill->count(); $i++ ) { 
        $sub_total += $bill[$i]->amout; 
        $spreadsheet->getActiveSheet()->mergeCells('D'.$rows.':G'.$rows);
        $spreadsheet->getActiveSheet()->getStyle('C'.$rows)->getNumberFormat()->setFormatCode('0');
        $spreadsheet->getActiveSheet()->getStyle('C'.$rows)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $spreadsheet->getActiveSheet()->getStyle('C'.$rows)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet()->getStyle('C'.$rows)->getAlignment()->setWrapText(true);
        $sheet->setCellValue('C' . $rows, $i+1);
        $sheet->setCellValue('D' . $rows, $bill[$i]->item_name);
        $sheet->setCellValue('H' . $rows, $bill[$i]->amout);
        $sheet->setCellValue('J'.(22+$count),$sub_total);
        $sheet->setCellValue('J'.(23+$count),$sub_tax=$sub_total*$tax);
        $sheet->setCellValue('J'.(24+$count),($sub_tax+$sub_total));
        $rows++;
    }
    $sheet->setCellValue('C' . $rows,$bill->count()+1);
    $sheet->setCellValue('D' . $rows, 'Tính tiền');

    $fileName = "emp.xlsx";
    $a = new Xlsx($spreadsheet);
    $a->save($fileName);
    header("Content-Type: application/vnd.ms-excel");;
    }
    public function show_invoice_detail($invoice_id){
        $invoice_detail=DB::table('bill')
        ->where('bill.id','=',$invoice_id)
        ->get();
        return view('admin.invoice_detail', ['invoice_details' => $invoice_detail]);
    }
}
