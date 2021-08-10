<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trainning VAIX-Ninh Laravel</title>
    <style>
        body{
            background-color: #F6F6F6; 
            margin: 0;
            padding: 0;
            font-family: "Time New Roman";
        }
        h1,h2,h3,h4,h5,h6{
            margin: 0;
            padding: 0;
        }
        p{
            margin: 0;
            padding: 0;
        }
        .container{
            width: 80%;
            margin-right: auto;
            margin-left: auto;
        }
        .brand-section{
           background-color: #0d1033;
           padding: 10px 40px;
        }
        .logo{
            width: 50%;
        }

        .row{
            display: flex;
            flex-wrap: wrap;
        }
        /* .col-6{
            width: 50%;
            flex: 0 0 auto;
        } */
        .text-white{
            color: #fff;
        }
        .company-details{
            float: right;
            text-align: right;
        }
        .body-section{
            padding: 16px;
            border: 1px solid gray;
        }
        .heading{
            font-size: 20px;
            margin-bottom: 08px;
        }
        .sub-heading{
            color: #262626;
            margin-bottom: 05px;
        }
        table{
            background-color: #fff;
            width: 100%;
            border-collapse: collapse;
        }
        table thead tr{
            border: 1px solid #111;
            background-color: #f2f2f2;
        }
        table td {
            vertical-align: middle !important;
            text-align: center;
        }
        table th, table td {
            padding-top: 08px;
            padding-bottom: 08px;
        }
        .table-bordered{
            box-shadow: 0px 0px 5px 0.5px gray;
        }
        .table-bordered td, .table-bordered th {
            border: 1px solid #dee2e6;
        }
        .text-right{
            text-align: end;
        }
        .w-20{
            width: 20%;
        }
        .float-right{
            float: right;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="brand-section">
            <div class="row">
                <div class="col-6">
                    <h1 class="text-white">Invoice Export</h1>
                </div>
                <div class="col-6">
                    <div class="company-details">
                        <p class="text-white">VAIX CO ., LTD </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="body-section">
            <div class="">
                <div class="">
                    <h2 class="heading">Mã hóa đơn: {{$bill->id}}</h2>
                    <p class="sub-heading">Tên danh mục: {{$bill->item_name}} </p>
                    <p class="sub-heading">Giá danh mục: {{number_format($bill->amount,0)}} VNĐ</p>
                    <p class="sub-heading">Ngày tạo hóa đơn:{{\Carbon\Carbon::parse($bill->today)->format('d/m/Y')}}</p>
                    <p class="sub-heading">Thời hạn trả:{{\Carbon\Carbon::parse($bill->expire_day)->format('d/m/Y')}}</p>
                </div>
                <div class="">
                    <p class="sub-heading">Tên công ty: {{$bill->company_name}}</p>
                    <p class="sub-heading">Địa chỉ công ty: {{$bill->company_address}}</p>
                    <p class="sub-heading">Số điện thoại: {{$bill->company_tel}}</p>
                    <p class="sub-heading">Số fax: {{$bill->company_fax}}</p>
                    <p class="sub-heading">Estimate No: {{$bill->estimate_No}}</p>
                </div>
            </div>
        </div>

        <div class="body-section">
            <h3 class="heading">Danh mục hóa đơn</h3>
            <br>
            <table class="">
                <thead>
                    <tr>
                        <th>Tên danh mục</th>
                        <th>Giá danh mục</th>
                        <th>Tên dự án</th>
                        <th>Ngày tạo hóa đơn</th>
                        <th>Thời hạn thanh toán</th>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <td>{{$bill->items->item_name}}</td>
                        <td>{{number_format($bill->items->amount,0)}} VNĐ</td>
                        <td>{{$bill->items->project->project_name}}</td>
                        <td>{{\Carbon\Carbon::parse($bill->today)->format('d/m/Y')}}</td>
                        <td>{{\Carbon\Carbon::parse($bill->expire_day)->format('d/m/Y')}}</td>
                    </tr>
                    <?php $total =$bill->items->amount ?>
                    <br>
                    <tr>
                        <td colspan="3" class="text-right">Giá sản phẩm</td>
                        <td>{{number_format($total,0)}} VNĐ</td>
                    </tr>
                    @if(isset($bill->items->amount))
                        <?php
                            $ship= $bill->items->amount;
                            $ship_total= $ship*0.1;
                        ?>
                    @endif
                    <tr>
                        <td colspan="3" class="text-right">Tiền thuế 10%</td>
                        <td>{{number_format($ship_total,0)}} VNĐ</td>
                    </tr>
                    @if(isset($bill->items->amount))
                        <?php
                            $ship= $bill->items->amount;
                            $ship_total= $ship*0.1;
                            $all_price= $ship+ $ship_total
                        ?>
                    @endif
                    <tr>
                        <td colspan="3" class="text-right">Giá thực tế</td>
                        <td>{{number_format($all_price,0)}} VNĐ</td>
                    </tr>
                </tbody>
            </table>
        </div>      
    </div>      

</body>
</html>