@extends('layouts.app')
@section('content')

<div class="container text-center">
            <h1 class="h3 mb-0 text-gray-800">User Infomation</h1>
    <p class="mb-4"> Chỉnh sửa thông tin cá nhân của bạn.</p>
</div>

 <div class="container">
    <div class="row">

        <div class="col-lg-4">

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

        <div class="col-lg-8">

            <!-- Roitation Utilities -->
            <div class="card shadow mb-4 text-center">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Chỉnh sửa thông tin cá nhân</h6>
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
                    <form action="{{ route('updateinfo',Auth::user()->id) }}" method="POST">
                        @method('POST')
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Email</label>
                                <input type="email" name="email" class="form-control" value="{{ @old('email',$user->email )}}" id="inputEmail4" placeholder="Email" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Mật khẩu mới</label>
                                <input type="password" name="password" class="form-control" id="inputPassword4" placeholder="Để trống nếu không muốn thay đổi">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputFullname">NickName</label>
                                <input type="text" name="name" class="form-control" value="{{ @old('name',$user->name )}}" id="inputFullname" placeholder="Nickname">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputAddress">Địa chỉ</label>
                                <input type="text" name="address" class="form-control" id="inputAddress" value="{{ @old('address',$user->address )}}" placeholder="Địa chỉ của bạn">

                            </div>
                        </div>
                        {{--<div class="form-row">--}}

                            {{--<div class="form-group col-md-4">--}}
                                {{--<label for="inputBankname">Ngân hàng</label>--}}
                                {{--<select id="inputBankname" name="bank_id" class="form-control">--}}
                                    {{--@foreach($banklist as $bank)--}}
                                        {{--<option value="{{ $bank->id }}"@if ($user->bank_id == $bank->id) selected @endif>{{ $bank->shortname }}-{{ $bank->name }}</option>--}}
                                    {{--@endforeach--}}
                                {{--</select>--}}
                            {{--</div>--}}
                            {{--<div class="form-group col-md-4">--}}
                                {{--<label for="inputBankAcountName">Tên chủ thẻ</label>--}}
                                {{--<input type="text" name="bank_account_name" class="form-control" value="{{ @old('bank_account_name',$user->bank_account_name )}}" id="inputBankAcountName">--}}
                            {{--</div>--}}
                            {{--<div class="form-group col-md-4">--}}
                                {{--<label for="inputBankAcount">Số Tài khoản</label>--}}
                                {{--<input type="text" name="bank_account_id" class="form-control" value="{{ @old('bank_account_id',$user->bank_account_id )}}" id="inputBankAcount">--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="veryfyinfo" id="gridCheck">
                                <label class="form-check-label" for="gridCheck">
                                    Xác nhận thông tin đã nhập là chính xác!
                                </label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Cập nhật thông tin</button>
                    </form>
                </div>
            </div>

        </div>

    </div>
</div>

@endsection
