@extends('admin_layout')
@section('admin_content')
<div class="container mt-5">
    <div class="d-flex justify-content-center row">
        <div class="col-md-8">
            <div class="p-3 bg-white rounded">
                <div class="row">
                    <div class="col-md-8">
                            <h1 class="text-uppercase">Hoá Đơn</h1>                                                    
                            <div class="billed"><span class="font-weight-bold text-uppercase">Ngày tạo: </span><span class="ml-1"><?php echo date_format(new DateTime($invoice_details[0]->today),'Y/m/d');?></span></div>
                            <div class="billed"><span class="font-weight-bold text-uppercase">Công ty: </span><span class="ml-1">{{$invoice_details[0]->company_name}}</span></div>
                            <div class="billed"><span class="font-weight-bold text-uppercase">Địa chỉ: </span><span class="ml-1">{{$invoice_details[0]->company_address}}</span></div>
                            <div class="billed"><span class="font-weight-bold text-uppercase">Số điện thoại: </span><span class="ml-1">{{$invoice_details[0]->company_tel}}</span></div>
                            <div class="billed"><span class="font-weight-bold text-uppercase">Fax:</span><span class="ml-1"> {{$invoice_details[0]->company_fax}}</span></div>
                            <div class="billed"><span class="font-weight-bold text-uppercase">Estimate No: </span><span class="ml-1">{{$invoice_details[0]->estimate_No}}</span></div>                            
                            <div class="billed"><span class="font-weight-bold text-uppercase">Project: </span><span class="ml-1">{{$invoice_details[0]->project_name}}</span></div>                                                   
                    </div>
                    <div class="col-md-4 text-right mt-3">
                        <h4 class="text-danger mb-0">VAIX CO., LTD</h4><span>Tel: +843-3384-6868</span>
                    </div>
                </div>
                <div class="mt-3">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Số TT</th>
                                    <th>Sản Phẩm</th>
                                    <th>Đơn Giá</th>
                                    <th>Thành Tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                $stt = 0;  
                                $sub_total = 0;
                            ?>
                            @for ($y = 0; $y < $invoice_details->count();$y++)
                                <?php $sub_total += $invoice_details[$y]->amout; ?>
                                <tr>
                                    <td>{{++$stt}}</td>
                                    <td>{{$invoice_details[$y]->item_name}}</td>
                                    <td><?php echo number_format($invoice_details[$y]->amout); ?></td>
                                </tr>
                            @endfor
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>Tổng:</td>
                                    <td><?php echo number_format($sub_total); ?></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>Thuế tiêu thụ 10%</td>
                                    <td><?php echo number_format($sub_total*0.1);?></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><b>Thành tiền:</b></td>
                                    <td><?php echo number_format($sub_total+$sub_total*0.1);?></td>

                                </tr>
                            </tbody>
                        </table>
                        <i><div class="billed"><span class="font-weight-bold">Hạn thanh toán:</span><span class="ml-1"><?php echo date_format(new DateTime($invoice_details[0]->expire_day),'Y/m/d');?></span></div></i>
                        <!--#Check invoice status-->
                        </div>
                </div>
                <a href="{{ url('/') }}/export{{$invoice_details[0]->id}}=xlsx" class="btn btn-success">Export invoice</a>
            </div>
        </div>
    </div>
</div>
@endsection