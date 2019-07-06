<?php

namespace App\Http\Controllers\Frontend;

use App\Models\HistoryTransaction as Histrans;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Frontend\NaptheAPI;
use LRedis;
use Illuminate\Support\Facades\Log;
use App\User;
class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $user = User::find(Auth::id());
        $trans = array();
        if ($user->role == 2) {
           $trans = Histrans::all();
        }
        else
        {

            $trans = Histrans::where('user_id',Auth::id())->get();
        }
        return view('frontend.history',['trans' => $trans]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($data)
    {
        // add history
        $userid = 1;
        if (Auth::check()) {
            $userid = Auth::id();
        }

        $history = Histrans::create([
            'user_id' => $userid,
            'transid' => $data['request_id'],
            'telcode' => $data['telco'],
            'serial' => $data['serial'],
            'code' => $data['card_code'],
            'price' => $data['card_amount'],
            'status' => 0,
            'amount' => 0,
            'message' => 'Thẻ chờ duyệt',
            'donate_message' => $data['donate_message'],
            'donate_name' => $data['donate_name'],
            'streamer_id' => 1,

        ]);
    }

    public function addCard (Request $request) {
        $data = [
            'telco' => $request->telco,
            'serial' => $request->serial,
            'card_code' => $request->card_code,
            'card_amount' => $request->card_amount,
            'donate_message' => $request->donate_message,
            'donate_name' => $request->donate_name,
        ];

        $transaction = Histrans::Where('serial',$data['serial'])->first();   
        if(empty($data['telco'])){
            $error = 'Bạn phải chọn loại thẻ';
            return [
                'result' => false,
                'msg'    => $error
            ];
        }
        else if(empty($data['card_amount'])){
            $error = 'Bạn phải chọn mệnh giá';
            return [
                'result' => false,
                'msg'    => $error
            ];
        }
        else if(empty($data['serial'])){
            $error = 'Bạn phải nhập Serial thẻ';
            return [
                'result' => false,
                'msg'    => $error
            ];
        }
        else if(empty($data['card_code'])){
            $error = 'Bạn phải nhập mã thẻ';
            return [
                'result' => false,
                'msg'    => $error
            ];
        }
        else if(empty($data['donate_name'])){
            $error = 'Bạn phải nhập tên hiển thị';
            return [
                'result' => false,
                'msg'    => $error
            ];
        }
        else if(empty($data['donate_message'])){
            $error = 'Bạn phải nhập tin nhắn';
            return [
                'result' => false,
                'msg'    => $error
            ];
        }               
        else if($transaction){
            $error = 'Thẻ (serial) này đã tồn tại trong web vui lòng kiểm tra lại!';
            return [
                'result' => false,
                'msg'    => $error
            ];
        }

        $result = $this->card($data);
        if ($result['result']) {

        	$data['menhgia'] = intval($result['money']);
            $data['amount'] = intval($result['amount']);
            $data['request_id'] = $result['request_id'];
            $data['status'] = $result['status'];
            $data['message'] = "Thẻ chờ duyệt";
            if ($result['status'] == 1)
            {

                $data['message'] = "Thẻ đúng";
                $donate = array('name' => $request->donate_name, 
                           'message' => $request->donate_message,
                           'price' => $request->card_amount,
                             'streamer_id' => 1
                             );
                $redis = LRedis::connection();
                $redis->publish('message',  json_encode($donate));
                
               return [
                'result' => true,
                'msg' => 'Cám ơn bạn đã donate! Thẻ đang được xử lý, khi thẻ được xử lý xong sẽ có thông báo donate.<hr> Vui lòng <a href="/user/history" class="btn btn-success">bấm vào đây</a> để xem trạng thái thẻ!'
              ];
               
            }

            $this->store($data);

            return [
                'result' => true,
                'msg' => 'Cám ơn bạn đã donate! Thẻ đang được xử lý, khi thẻ được xử lý xong sẽ có thông báo donate.<hr> Vui lòng <a href="/user/history" class="btn btn-success">bấm vào đây</a> để xem trạng thái thẻ!'
            ];

        } else {
            return [
                'result' => false,
                'msg' => $result['msg']
            ];
        }
    }


    public function card($data)
    {

        $service = new NaptheAPI();
        $request_id = $service->get_transid();
        $sign = $service->signature_hash($request_id,$data);
        $dataPost = array(
            'partner_id' => $service->config['partner_id'],
            'partner_key' => $service->config['partner_key'],
            'request_id' => $request_id,
            'telco' => $data['telco'],
            'amount' => $data['card_amount'],
            'serial' => $data['serial'],
            'code' => $data['card_code'],
            'sign' => $sign
         
        );
        $response = $service->curl_card('https://tcr.vn/api/chargingws',$dataPost);
        // dd($response);
        if(isset($response)){
            $json = json_decode($response);
          
            if ($json->status == 1) {
                return [
                    'result' => true,
                    'status' => 1,
                    'request_id' => $request_id,
                    'money' => $data['card_amount'],
                    'amount' => $json->amount,
                    'msg'    => $json->status.'.'.$json->message.'.'
                ];

            } elseif ($json->status == 99) {
                return [
                    'result' => true,
                    'status' => 0,
                    'request_id' => $request_id,
                    'money' => $data['card_amount'],
                    'amount' => 0,
                    'msg'    => $json->status.'.'.$json->message.'.'
                ];

            }
            else {
                return [
                    'result' => false,
                    'msg'    => $json->message
                ];
            }
        }
        else{

            $error = 'Có lỗi trong quá trình thực hiện gao dịch. Mời bạn kiểu tra tham số cấu hình và enable các extendsion php cần thiết';
            return [
                'result' => false,
                'msg'    => $error
            ];
        }
    }

  public function giadonate()
    {
          $donate = array('name' => $_GET['name'], 
                           'message' => $_GET['message'],
                           'price' => $_GET['price'],
                             'streamer_id' => 1
                             );
                    $redis = LRedis::connection();
                    $redis->publish('message',  json_encode($donate));
                    return $donate;
    }

    public  function callback(Request $request)
    {
        $error  = "1";
        $transaction = Histrans::where('serial',$request->serial)->where('status',0)->first();        
        $service = new NaptheAPI();
        if (isset($request->callback_sign)) {
            $error  = "có data gửi đến!";
            $callback_sign = md5($service->config['partner_key'].$request->code.$request->serial);   
                
                if ($request->callback_sign == $callback_sign) {
                    $error  = "mã callback_sign  đúng!";
                    if ($request->status == 1) {   
                        $user = User::find($transaction->user_id);
                        $cash = $request->value + $user->price;    

                        $donate = array('name' => $transaction->donate_name, 
                                            'message' => $transaction->donate_message,
                                            'price' => $transaction->price,
                                            'streamer_id' => $transaction->streamer_id
                                        );

                         $transaction->update(['status'=> $request->status, 'message'=> 'Thẻ đúng.','amount' => $request->amount]);                
                    
                        $user->price = $cash;
                        $user->update();  
                        $redis = LRedis::connection();
                        $redis->publish('message',  json_encode($donate));                        
                        $error = "da update dung";

                    }
                    else
                    {
                            $transaction->update(['status'=> 2, 'message'=> 'Thẻ sai.']);                
                            $error =  "da update sai";
                    }
                    
                           
                }    
                else
                {
                    
                    $error  = "mã callback_sign không đúng! mã là: " .$callback_sign;
                }
                      
        }         
       Log::info('request : '.$request);
       Log::error('loine :'. $transaction);
       return  $error; 
    }

    // public  function testcallback(Request $request)
    // {
       
    //         $transaction = Histrans::Where('serial',$request->serial)->first();     
    //         // $user = User::find($transaction[0]->user_id);  
    //         dd($transaction);    

        
    // }
    
}
