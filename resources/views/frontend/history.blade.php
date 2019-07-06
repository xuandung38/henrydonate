@extends('layouts.app')
@section('content')
          <!-- Page Heading -->

 <div class="row">


  <div class="col-lg-3">

            <!-- Overflow Hidden -->
            <div class="card shadow mb-4 text-center">
                <div class="card-header py-3">
                    <h4 class="m-0 font-weight-bold text-primary">{{ Auth::user()->name }}</h4>
                </div>
                <div class="card-body">
                    <p> Tham gia từ <strong class="text-danger"> {{ Auth::user()->created_at->diffForHumans() }}</strong>  ({{ Auth::user()->created_at->format('d/m/Y') }}) </p>
                    <p> Tổng số tiền đã donate: <strong class="text-danger"> {{ number_format(Auth::user()->price) }} </strong><sup>vnđ</sup></p>
                </div>
            </div>

        </div>

  <div class="col-lg-9">
          <div class="card shadow mb-8">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">LỊCH SỬ GIAO DỊCH</h6>
            </div>
            <div class="card-body">
              <div class="table">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="1">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Seri</th>
                      <th>Nhà Mạng</th>
                      <th>Mệnh giá</th>
                      <th>Name</th>
                      <th>Nội Dung donate</th>
                      <th>Streamer</th>                      
                      <th>Trạng thái</th>                    
                      <th>Ngày donate</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>ID</th>
                      <th>CardSeri</th>
                      <th>Nhà Mạng</th>
                      <th>Mệnh giá</th>
                      <th>Name</th>
                      <th>Nội Dung donate</th>
                      <th>Streamer</th>                   
                      <th>Trạng thái</th>                  
                      <th>Ngày donate</th>
                    </tr>
                  </tfoot>
                  <tbody>
                  @foreach ($trans as $key => $tran )                    
                    <tr>
                      <td>{{ $key+1 }}</td>
                      <td>{{ $tran->serial }}</td>
                      <td>{{ $tran->telcode }}</td>
                      <td>{{ $tran->price }}</td>
                      <td>{{ $tran->donate_name }}</td>
                      <td>{{ $tran->donate_message }}</td>
                      <td>{{ $tran->streamer->name }}</td>
                      <td>{{ $tran->message }}</td>
                      <td>{{ $tran->created_at->diffForHumans() }}</td>
                    </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
</div>
</div>
@endsection
@section('script')
<script>
$(document).ready(function() {
  $('#dataTable').DataTable( {
        "order": [[ 0, "desc" ]]
    });
});
</script>
@endsection