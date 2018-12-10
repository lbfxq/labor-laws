<?php
/**
 * Created by PhpStorm.
 * User: zn
 * Date: 2017/5/18
 * Time: 16:29
 */

namespace common\services;


use common\models\UserInfo;
use Yii;
use yii\base\Model;
use yii\base\UserException;
use yii\web\Application;
use yii\web\Response;

/**
 * 处理客户端或网页调试发送过来的数据
 * 处理返回给客户端的数据
 * Class ParseClientParam
 * @package common\models
 */
class ClientMessageServices extends Model
{
    public function __construct(array $config = [])
    {
        parent::__construct($config);

        //注册事件
        Yii::$app->on(Application::EVENT_BEFORE_REQUEST, [$this, 'beforeRequestAction']);
        Yii::$app->response->on(Response::EVENT_BEFORE_SEND, [$this, 'beforeSendAction']);
    }


    /**
     * 接收到请求前
     * @param $event
     * @return bool
     * @throws UserException
     */
    public function beforeRequestAction($event)
    {
        $params = Yii::$app->request->get();

        //解析客户端数据
        $receiveData = Yii::$app->request->post('msg');
        if ($receiveData) {
            //设置数据是不是从客户端过来的标志
            $params['isFromClient'] = true;

            //解析
            $receiveData = json_decode(base64_decode($receiveData), true);
            if (!$receiveData) {
                //数据解析错误，抛出异常，由错误处理代码处理
                throw new UserException(ResultStatusServices::RS_PARSE_PARAM_ERROR);
            }

            //缓存数据
            $params = array_merge($params, $receiveData);
        }

        //保存数据
        Yii::$app->request->setQueryParams($params);

        //初始化用户信息
        $this->__initLoginInfo();

        return true;
    }

    /**
     * 初始化用户登录信息
     */
    private function __initLoginInfo()
    {
        $params = Yii::$app->request->get();

        $token = Yii::$app->request->get('token');
        if (!$token) return;

        //获取用户ID
        $userInfo = UserInfo::loadByToken($token);
        if (empty($userInfo)) return;

        $params['user_id'] = $userInfo->userID;

        //保存数据
        Yii::$app->request->setQueryParams($params);
    }

    /**
     * 发送消息前
     * @param $event
     * @return bool
     */
    public function beforeSendAction($event)
    {
        if (Yii::$app->controller->id == 'web')
            return true;

        Yii::$app->response->format = Response::FORMAT_JSON;

        //是否有异常退出，按照和客户端约定的方式输出异常信息
        $exception = Yii::$app->getErrorHandler()->exception;
        if ($exception) {
            if ($exception instanceof StatusException) {
                Yii::$app->response->data = ['status' => $exception->status, 'info' => $exception->info, 'data' => null];
                Yii::$app->response->statusCode = 200;
            } else {
                Yii::$app->response->data = ['status' => ResultStatusServices::RS_SERVER_ERROR, 'info' => $exception->getMessage(), 'data' => null];
                Yii::$app->response->statusCode = 500;
            }
        }
    }

    /**
     * 发送数据
     * @param $status
     * @param null $data
     * @return array
     */
    public static function sendMessage($status, $data = null)
    {
        //请求方为网页调试，返回数据不进行编码
        $sendData = $data;
        if (Yii::$app->request->get('isFromClient') && isset($data)) {
            $sendData = base64_encode(json_encode($data));
            if (!$sendData) $status = ResultStatusServices::RS_SEND_DATA_ENCODING_ERROR;
        }

        return ['status' => $status, 'server_time' => time(), 'data' => $sendData];
    }

    public static function sendDebugInfo($info = "")
    {
        throw new StatusException(1, $info);
    }


}