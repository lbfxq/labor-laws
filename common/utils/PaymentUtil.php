<?php
/**
 * 支付验证
 * 
 */
namespace common\utils;


class PaymentUtil
{

    /*返回数据参照样例
        array (
          'status' => 0,
          'environment' => 'Sandbox',
          'receipt' => 
          array (
            'receipt_type' => 'ProductionSandbox',
            'adam_id' => 0,
            'app_item_id' => 0,
            'bundle_id' => 'com.abcde.www',
            'application_version' => '0.0.9',
            'download_id' => 0,
            'version_external_identifier' => 0,
            'receipt_creation_date' => '2016-07-13 18:22:19 Etc/GMT',
            'receipt_creation_date_ms' => '1468434139000',
            'receipt_creation_date_pst' => '2016-07-13 11:22:19 America/Los_Angeles',
            'request_date' => '2016-07-13 18:22:22 Etc/GMT',
            'request_date_ms' => '1468434142143',
            'request_date_pst' => '2016-07-13 11:22:22 America/Los_Angeles',
            'original_purchase_date' => '2013-08-01 07:00:00 Etc/GMT',
            'original_purchase_date_ms' => '1375340400000',
            'original_purchase_date_pst' => '2013-08-01 00:00:00 America/Los_Angeles',
            'original_application_version' => '1.0',
            'in_app' => 
            array (
              0 => 
              array (
                'quantity' => '1',
                'product_id' => 'price_1',//去看$this->product里对应的价格，就是你的充值额
                'transaction_id' => '1000000223463280',
                'original_transaction_id' => '1000000223463280',
                'purchase_date' => '2016-07-13 18:22:19 Etc/GMT',
                'purchase_date_ms' => '1468434139000',
                'purchase_date_pst' => '2016-07-13 11:22:19 America/Los_Angeles',
                'original_purchase_date' => '2016-07-13 18:22:19 Etc/GMT',
                'original_purchase_date_ms' => '1468434139000',
                'original_purchase_date_pst' => '2016-07-13 11:22:19 America/Los_Angeles',
                'is_trial_period' => 'false',
              ),
            ),
          ),
        )
  */
  public static function applePay($receipt, $isSandbox = false)  
  {  
      if ($isSandbox) {
          $endpoint = 'https://sandbox.itunes.apple.com/verifyReceipt';//沙箱地址
      } else {
          $endpoint = 'https://buy.itunes.apple.com/verifyReceipt';//真实运营地址
      }

      $postData = json_encode(
          array('receipt-data' => $receipt)
      );
      $ch = curl_init($endpoint);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);  //这两行一定要加，不加会报SSL 错误
      curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
      $response = curl_exec($ch);
      $errno    = curl_errno($ch);
      curl_close($ch);

      \Yii::info("errormsg:".$response,'payment');
      



      if ($errno != 0) {//curl请求有错误
          return [
              'errNo' => 1,
              'errMsg' => '请求超时，请稍后重试',
          ];
      }else{
          $data = json_decode($response, true);
          if (!is_array($data)) {
              return [
                  'errNo' => 2,
                  'errMsg' => '苹果返回数据有误，请稍后重试',
              ];
          }
          //判断购买时候成功
          if (!isset($data['status']) || $data['status'] != 0) {
              return [
                  'errNo' => 3,
                  'errMsg' => '购买失败',
              ];
          }
          //返回产品的信息
          $order = $data['receipt']['in_app'][0];
          $order['errNo'] = 0;
          return $order;
      }
  }

  /**
  * 验证goole支付
  */
  public static function googlePay($receipt,$signature,$google_pay_public_key){

      $google_public_key=$google_pay_public_key;
      $public_key = "-----BEGIN PUBLIC KEY-----\n" . chunk_split($google_public_key, 64, "\n") . "-----END PUBLIC KEY-----";
      $public_key_handle = openssl_get_publickey($public_key);
      $result = openssl_verify($receipt,base64_decode($signature),$public_key_handle,OPENSSL_ALGO_SHA1);
      if(1==$result){
        return true;
      }else{
        return false;
      }

  } 
}