<?php

namespace App\Http\Controllers\Frontend;

Class NaptheAPI
{
    public $config;

    function __construct()
    {
        $this->config  = array('partner_id' => '1338815385' , 'partner_key' => 'q1qi6wyajvjab04ulkcnm8t18y7abpz0');
    }

//    public function ChargingAPIServices($config)
//    {
//        $this->config = $config;
//    }

    public function charging($info)
    {
        $project_id = $this->config['PROJECT_ID'];
        $trans_id = $project_id . date("YmdHis") . rand(1, 99999);
        $payment_data = array(
            'serial' => $info['serial'],
            'mpin' => $info['card_code'],
            'transid' => $trans_id,
            'telcocode' => $info['type'],
            'username' => $this->config['USER_NAME'],
            'account' => $this->config['ACCOUNT'],
            'payment_channel' => $this->config['PAYMENT_CHANNEL']
        );
        $send_payment_info = array(
            'processing_code' => $this->config['PROCESSING_CODE'],
            'project_id' => $this->config['PROJECT_ID'],
            'data' => json_encode($payment_data));
        $url = $this->config['URLPAYMENT'];
        $url = $url . urlencode('request=' . json_encode($send_payment_info));



        $response = $this->get_curl($url);
        //$response = file_get_contents($json_url);
        //print_r($response);die;

        //$data = $json['data'];
        if($response){
            $json = json_decode($response, true);
            $status = $json['status'];
            //$datajson = json_decode($data, true);
            // echo $datajson['status'];die;
            if($status){
                return $response;
            }else{
                return json_encode(['message' => 'Tham số truyền về không đúng định dạng. Mời bạn liên hệ với nhà cung cấp dịch vụ để biết thêm chi tiết']);
            }
        }else{
            //print_r($response);
            return  json_encode(['message' => 'Gạch thẻ không thành công. Mời bạn kiểm tra lại đường truyền và bật các extendsion cần thiết.']);
        }
    }

    /*
     * function mã hóa chữ ký
     * author: Vu Dinh Phuong
     * date: 13/12/2016
     */
    public function signature_hash($transId, $data)
    {
        return md5($this->config['partner_id'].$this->config['partner_key'].$data['telco'].$data['card_code'].$data['serial'].$data['card_amount'].$transId);

    }

    /*
     * function tạo mã giao dịch (transid) theo partner
     * author: Vu Dinh Phuong
     * date: 13/12/2016
     */
    public function get_transid()
    {
        return $this->config['partner_id'].'_'.date('YmdHis').'_'.rand(0, 999);
    }

    /*
     * function parse string response to Array
     * it make developer to easy to process
     * author: Vu Dinh Phuong
     * date: 27/03/2014
     */
    private function parseArray($response)
    {
        $return = array();
        $response = explode('&', $response);
        if(!empty($response)){
            foreach($response as $key => $value){
                $data = explode('=', $value);
                if(!empty($data[1])){
                    $return[$data[0]] = $data[1];
                }
            }
            return $return;
        }else{
            return array();
        }
    }

    /*
     * function get curl
     * author: Vu Dinh Phuong
     * date: 13/12/2016
     */
    private function get_curl($url)
    {
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);

        $str = curl_exec($curl);
        if(empty($str)) $str = $this->curl_exec_follow($curl);
        curl_close($curl);

        return $str;
    }
    /*
     * function dùng curl gọi đến link
     * author: Vu Dinh Phuong
     * date: 13/12/2016
     */
    public  function curl_card($url, $data) {
        $dataPost = '';

        if(is_array($data))
            $dataPost = http_build_query($data);
        else
            $dataPost = $data;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataPost);
        $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        curl_setopt($ch, CURLOPT_REFERER, $actual_link);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }

    private function curl_exec_follow($ch, &$maxredirect = null)
    {
        $user_agent = "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.7.5)".
            " Gecko/20041107 Firefox/1.0";
        curl_setopt($ch, CURLOPT_USERAGENT, $user_agent );

        $mr = $maxredirect === null ? 5 : intval($maxredirect);

        if (ini_get('open_basedir') == '' && ini_get('safe_mode' == 'Off')) {

            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, $mr > 0);
            curl_setopt($ch, CURLOPT_MAXREDIRS, $mr);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        } else {

            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);

            if ($mr > 0)
            {
                $original_url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
                $newurl = $original_url;

                $rch = curl_copy_handle($ch);

                curl_setopt($rch, CURLOPT_HEADER, true);
                curl_setopt($rch, CURLOPT_NOBODY, true);
                curl_setopt($rch, CURLOPT_FORBID_REUSE, false);
                do
                {
                    curl_setopt($rch, CURLOPT_URL, $newurl);
                    $header = curl_exec($rch);
                    if (curl_errno($rch)) {
                        $code = 0;
                    } else {
                        $code = curl_getinfo($rch, CURLINFO_HTTP_CODE);
                        if ($code == 301 || $code == 302) {
                            preg_match('/Location:(.*?)\n/', $header, $matches);
                            $newurl = trim(array_pop($matches));

                            if(!preg_match("/^https?:/i", $newurl)){
                                $newurl = $original_url . $newurl;
                            }
                        } else {
                            $code = 0;
                        }
                    }
                } while ($code && --$mr);

                curl_close($rch);

                if (!$mr)
                {
                    if ($maxredirect === null)
                        trigger_error('Too many redirects.', E_USER_WARNING);
                    else
                        $maxredirect = 0;

                    return false;
                }
                curl_setopt($ch, CURLOPT_URL, $newurl);
            }
        }
        return curl_exec($ch);
    }

}
