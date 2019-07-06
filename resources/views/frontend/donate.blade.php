@extends('layouts.app')
@section('content')

    <div class="container text-center">
        <h1 class="h3 mb-0 text-gray-800">Donate cho Henry</h1>
        <p class="mb-4">Donate cho henry bằng thẻ cào.</p>
    </div>

    <div class="container">
        <div class="row">

            <div class="col-md-12">

                <!-- Roitation Utilities -->
                <div class="card shadow mb-4 text-center">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Donate bằng thẻ cào</h6>
                    </div>
                    <div class="card-body text-center">
                        @if(session('Message'))
                            <div class="alert alert-success" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="notika-icon notika-close"></i></span></button>
                                {{session('Message')}}
                            </div>
                        @elseif($errors->any())
                            <div class="alert alert-warning" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="notika-icon notika-close"></i></span></button>
                                <ul>

                                    @foreach ($errors->all() as $error)
                                        <p>{{ $error }}</p>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form id="topup-card">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="inputTelco">Loại thẻ</label>
                                    <select id="inputTelco" name="telco" class="form-control">
                                        <option value="VIETTEL">Viettel</option>
                                        <option value="VINAPHONE">Vinaphone</option>
                                        <option value="MOBIFONE">Mobifone</option>
                                        <option value="GARENA">Garena</option>
                                        <option value="GATE">Gate</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inputCode">Mã thẻ</label>
                                    <input type="text" name="card_code" class="form-control" id="inputCode" value="{{ @old('card_code')}}" placeholder="Mã thẻ" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inputSerial">Serial Thẻ</label>
                                    <input type="text" name="serial" class="form-control" value="{{ @old('serial')}}" id="inputSerial" placeholder="Serial Thẻ" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inputAmount">Mệnh giá thẻ</label>
                                    <select id="inputAmount" name="card_amount" class="form-control" required>
                                        <option value="10000" >10K</option>
                                        <option value="20000" >20K</option>
                                        <option value="30000" >30K</option>
                                        <option value="50000" >50K</option>
                                        <option value="100000" >100K</option>
                                        <option value="200000" >200K</option>
                                        <option value="500000" >500K</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row text-center">
                                <div class="form-group col-md-12">
                                    <label for="inputNick">Nick name hiển thị</label>
                                    <input type="text" name="donate_name" class="form-control" value="{{ @old('donate_name',Auth::user()->name)}}" id="inputNick" placeholder="Nickname(VD: Dũng đẹp trai)" maxlength="20" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputAddress">Tin nhắn</label>
                                    <textarea class="form-control" name="donate_message" required maxlength="150">{{ @old('donate_message') }}</textarea>
                                </div>
                            </div>
                        </form>
                            <button id="btn-topup" class="btn btn-primary has-spinner" >Donate Luôn</button>
                    </div>
                </div>

            </div>

        </div>
    </div>

@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script>
        $("#btn-topup").click(function() {
            var $btn = $(this);
            $btn.buttonLoader('start');

            req = $.ajax({
                url: "/donateac",
                type: "POST",
                data: $('#topup-card').serialize()
            });
            req.done(function (response, textStatus, jqXHR){
                $btn.buttonLoader('stop');
                if (response.result) {
                    Swal.fire({
                        type: 'success',
                        title: 'Thành Công..',
                        html: response.msg,
                    });
                } else {
                    Swal.fire({
                        type: 'error',
                        title: 'Có lỗi..',
                        text: response.msg,
                    });
                    // notifyTopCenter(response.msg, 'danger', 'fa fa-times');
                }
            });
            req.error(function (response, a, b, c) {
                $btn.buttonLoader('stop');

                data = JSON.parse(response.responseText);
                Swal.fire({
                    type: 'error',
                    title: 'Có lỗi..',
                    text: data.error,
                });
                // notifyTopCenter(data.error, 'danger', 'fa fa-times');
            });
            event.preventDefault();

        });
    </script>
@stop
