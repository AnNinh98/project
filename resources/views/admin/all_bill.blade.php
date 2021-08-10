@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Danh sách hóa đơn
        </div>

        <div class="table-responsive">
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th>Tên công ty</th>
                        <th>Địa chỉ công ty</th>
                        <th>Số điện thoại</th>
                        <th>Số fax</th>
                        <th>Estimate ID</th>
                        <th>Tên dự án</th>
                        <th>Tên hạng mục dự án</th>
                        <th>Giá tiền</th>
                        <th>Ngày tạo hóa đơn</th>
                        <th>Thời hạn thanh toán</th>
                        <th>Tùy chọn</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($all_bill as $key => $bill)
                    <tr>
                        <td>{{$bill->company_name}}</td>
                        <td>{{$bill->company_address}}</td>
                        <td>{{$bill->company_tel}}</td>
                        <td>{{$bill->company_fax}}</td>
                        <td>{{$bill->estimate_No}}</td>
                        <td>{{$bill->project_name}}</td>
                        <td>{{$bill->item_name}}</td>
                        <td>{{number_format($bill->amout,0)}}</td>
                        <td>{{\Carbon\Carbon::parse($bill->today)->format('d/m/Y')}}</td>
                        <td>{{\Carbon\Carbon::parse($bill->expire_day)->format('d/m/Y')}}</td>
                        <td><a href="{{URL::to('/export-invoice/'.$bill->id)}}">Export invoice</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-sm-5 text-center">
                    <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
                </div>
                <div class="col-sm-7 text-right text-center-xs">
                    <ul class="pagination pagination-sm m-t-none m-b-none">
                        <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
                        <li><a href="">1</a></li>
                        <li><a href="">2</a></li>
                        <li><a href="">3</a></li>
                        <li><a href="">4</a></li>
                        <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
                    </ul>
                </div>
            </div>
        </footer>
    </div>
</div>
@endsection