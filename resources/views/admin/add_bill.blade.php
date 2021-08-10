@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm hóa đơn 
            </header>
            <div class="panel-body">
                <div class="position-center">
                        @if(count($errors)>0)
                               <div class="alert alert-danger">
                                   @foreach($errors->all() as $err)
                                       {{$err}}<br>
                                   @endforeach
                               </div>
                        @endif
                        @if(session('thongbao'))
                           <div class="alert alert-success">
                               {{session('thongbao')}}
                           </div>
                        @endif
                    <form role="form" action="{{URL::to('/save-bill')}}" method="post">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên công ty</label>
                            <input type="text" class="form-control" name="company_name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Địa chỉ công ty</label>
                            <input type="text" class="form-control" name="company_address">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Số ĐT công ty</label>
                            <input type="text" class="form-control" name="company_tel">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Số fax công ty</label>
                            <input type="text" class="form-control" name="company_fax">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Estimate ID</label>
                            <input type="text" class="form-control" name="estimate_No" >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên dự án</label>
                            <input type="text" class="form-control" name="project_name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hạng mục dự án</label>
                            <input type="text" class="form-control" name="item_name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Giá tiền</label>
                            <input type="text" class="form-control" name="amout">
                        </div>
                        <?php
                            $today=date("Y/m/d");
                            $expire_date=date("Y/m/t",strtotime("+ 1 month"))
                        ?>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Ngày tạo hóa đơn</label>
                            <input class="form-control" name="today" value="<?php echo $today?>"/>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Hạn thanh toán</label>
                            <input class="form-control" name="expire_day" value="<?php echo $expire_date?>"/>
                        </div>
                        
                        <button type="submit" name="add_bill" class="btn btn-info">Thêm mới</button>
                    </form>
                </div>

            </div>
        </section>

    </div>
</div>
@endsection