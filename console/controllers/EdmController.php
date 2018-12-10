<?php
namespace app\controllers;


use Yii;
use yii\console\Controller;
use app\models\EdmSendHistory;
use app\models\EdmMails;
use app\models\EdmUsers;
use app\models\EdmSendHistoryCallback;

class EdmController extends Controller
{

    //操作系统上的执行命令：
    ///-----/usr/bin/php E:/www/pro_tongwei/trunk/code/console/yii edm/sendmail
    public function actionSendmail(){
         $email= EdmSendHistory::find()->where(['status'=>1])->one();
         if($email){
            $mail_id=intval($email->mail_id);
            $user_id=intval($email->user_id);


            $mail= Yii::$app->mailer->compose();   
            $mail->setTo($email->email_to);  
            $mail->setSubject($email->subject);  
            //$mail->setTextBody('zheshisha ');   //发布纯文字文本
            $mail->setHtmlBody($email->content);    //发布可以带html标签的文本
            $falg=$mail->send();
            


            /*$mailobj = new PHPMailer\PHPMailer\PHPMailer();   
            $mailobj->isMail();
            $mailobj->IsHTML(true);  // send as HTML
            $mailobj->CharSet = "utf-8";   // 这里指定字符集！  
            $mailobj->From = $email->email_from;      // 发件人邮箱   
            $mailobj->AddAddress($email->email_to);  // 收件人邮箱和姓名   
            $mailobj->Subject = $email->subject;  
            $mailobj->Body = $email->content;
            $falg=$mailobj->Send();*/
            if($falg){
                $emailmodel=EdmMails::findOne($mail_id);
                $emailmodel->send_num +=1;
                $emailmodel->send_s_num +=1;
                $emailmodel->save();

                $usermodel=EdmUsers::findOne($user_id);
                $usermodel->send_num +=1;
                $usermodel->send_s_num +=1;
                $usermodel->save();
                $email->status =2;
                $email->save();

                $res="success";
            }else{
                $emailmodel=EdmMails::findOne($mail_id);
                $emailmodel->send_num +=1;
                $emailmodel->send_f_num +=1;
                $emailmodel->save();

                $usermodel=EdmUsers::findOne($user_id);
                $usermodel->send_num +=1;
                $usermodel->send_f_num +=1;
                $usermodel->save();


                $email->status =3;
                $email->save();

                $res="false";
            }
         }else{
            $res="no mails";
         }

         echo $res;
    }

}
