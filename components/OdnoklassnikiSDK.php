<?php
class OdnoklassnikiSDK{
    const PARAMETER_NAME_ACCESS_TOKEN = "access_token";
    const PARAMETER_NAME_REFRESH_TOKEN = "refresh_token";
    private static $app_id = "1266350080";
    private static $app_public_key = "CBAJPLHMEBABABABA";
    private static $app_secret_key = "4771BDCE1599D8C3BF58F5F9";
    private static $redirect_url = "http://bacpassed/accounts/ok";
    private static $TOKEN_SERVICE_ADDRESS = "http://api.odnoklassniki.ru/oauth/token.do";
    private static $API_REQUSET_ADDRESS = "http://api.odnoklassniki.ru/fb.do";
    private static $access_token;
    private static $refresh_token;
    
    public static function getAppId(){
        return self::$app_id;
    }

    public static function getAccessToken(){
        return self::$access_token;
    }

    public static function setAccessToken($access_token){
        self::$access_token = $access_token;
    }

    public static function getRefreshToken(){
        return self::$refresh_token;
    }

    public static function setRefreshToken($refresh_token){
        self::$refresh_token = $refresh_token;
    }

    public static function getRedirectUrl(){
        return self::$redirect_url;
    }
    
    public static function getCode(){
        if (!empty($_GET["code"])) {
            return $_GET["code"];
        }
        else {
            return null;
        }
    }
    
    public static function checkCurlSupport(){
        return function_exists('curl_init');
    }

    public static function authorizationOk()
    {
        $request_params = [
            'client_id' => self::$app_id,
            'scope' => 'VALUABLE_ACCESS,PHOTO_CONTENT,GROUP_CONTENT,VIDEO_CONTENT',
            'response_type' => 'code',
            'redirect_uri' => self::$redirect_url,
        ];
        return $url = 'https://connect.ok.ru/oauth/authorize?' . http_build_query($request_params);
    }

    public static function changeCodeToToken($code){
        $curl = curl_init(self::$TOKEN_SERVICE_ADDRESS);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, 'code=' . $code . '&redirect_uri=' . self::$redirect_url . '&grant_type=authorization_code&client_id=' . self::$app_id . '&client_secret=' . self::$app_secret_key);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $s = curl_exec($curl);
        curl_close($curl);
        $a = json_decode($s, true);
        if (!empty($a[self::PARAMETER_NAME_ACCESS_TOKEN])){
            self::$access_token = $a[self::PARAMETER_NAME_ACCESS_TOKEN];
        }
        if (!empty($a[self::PARAMETER_NAME_REFRESH_TOKEN])){
            self::$refresh_token = $a[self::PARAMETER_NAME_REFRESH_TOKEN];
        }
        return !empty($a[self::PARAMETER_NAME_ACCESS_TOKEN]) && !empty($a[self::PARAMETER_NAME_REFRESH_TOKEN]);
    }
    
    public static function updateAccessTokenWithRefreshToken(){
        $curl = curl_init(self::$TOKEN_SERVICE_ADDRESS);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, 'refresh_token=' . self::$refresh_token . '&grant_type=refresh_token&client_id=' . self::$app_id . '&client_secret=' . self::$app_secret_key);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $s = curl_exec($curl);
        curl_close($curl);
        $a = json_decode($s, true);
        if (empty($a[self::PARAMETER_NAME_ACCESS_TOKEN])) {
            return false;
        } else {
            self::$access_token = $a[self::PARAMETER_NAME_ACCESS_TOKEN];
            return true;
        }
    }
    
    public static function makeRequest($methodName, $parameters = null){
        if (is_null(self::$app_id) || is_null(self::$app_public_key) || is_null(self::$app_secret_key) || is_null(self::$access_token) || !(is_null($parameters) || is_array($parameters))){
            return "error";
        }
        if (!is_null($parameters)) {
            if (!self::isAssoc($parameters)){
                return null;
            }
        } else {
            $parameters = array();
        }
        $parameters["application_key"] = self::$app_public_key;
        $parameters["method"] = $methodName;
        $parameters["sig"] = self::calcSignature($methodName, $parameters);
        $parameters[self::PARAMETER_NAME_ACCESS_TOKEN] = self::$access_token;
        $requestStr = "";
        foreach($parameters as $key=>$value){
            $requestStr .= $key . "=" . urlencode($value) . "&";
        }
        $requestStr = substr($requestStr, 0, -1);
        $curl = curl_init(self::$API_REQUSET_ADDRESS . "?" . $requestStr);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $s = curl_exec($curl);
        curl_close($curl);
        return json_decode($s, true);
    }
    
    private static function calcSignature($methodName, $parameters = null){
        if (is_null(self::$app_id) || is_null(self::$app_public_key) || is_null(self::$app_secret_key) || is_null(self::$access_token) || !(is_null($parameters) || is_array($parameters))){
            return null;
        }
        if (!is_null($parameters)) {
            if (!self::isAssoc($parameters)){
                return null;
            }
        } else {
            $parameters = array();
        }
        $parameters["application_key"] = self::$app_public_key;
        $parameters["method"] = $methodName;
        if (!ksort($parameters)){
            return null;
        } else {
            $requestStr = "";
            foreach($parameters as $key=>$value){
                $requestStr .= $key . "=" . $value;
            }
            $requestStr .= md5(self::$access_token . self::$app_secret_key);
            return md5($requestStr);
        }
    }
    
    private static function isAssoc($arr){
        return array_keys($arr) !== range(0, count($arr) - 1);
    }

    /**
     *  Запрос
     * @param $url
     * @param string $type
     * @param array $params
     * @param int $timeout
     * @param bool $image
     * @param bool $decode
     * @return mixed|string
     */
    public static function getUrl($url, $type = "GET", $params = array(), $timeout = 30, $image = false, $decode = true)
    {
        if ($ch = curl_init())
        {
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HEADER, false);

            if ($type == "POST")
            {
                curl_setopt($ch, CURLOPT_POST, true);

                // Картинка
                if ($image) {
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);

                }
                // Обычный запрос
                elseif($decode) {
                    curl_setopt($ch, CURLOPT_POSTFIELDS, urldecode(http_build_query($params)));
                }
                // Текст
                else {
                    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
                }
            }

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
            curl_setopt($ch, CURLOPT_USERAGENT, 'PHP Bot');
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

            $data = curl_exec($ch);

            curl_close($ch);

            // Еще разок, если API завис
            if (isset($data['error_code']) && $data['error_code'] == 5000) {
                $data = getUrl($url, $type, $params, $timeout, $image, $decode);
            }

            return $data;

        }
        else {
            return "error";
        }
    }

    /** Првевращает массив аргументов в строку
     * @param $array
     * @return string
     */
    public static function arInStr($array)
    {
        ksort($array);

        $string = "";

        foreach($array as $key => $val) {
            if (is_array($val)) {
                $string .= $key."=".arInStr($val);
            } else {
                $string .= $key."=".$val;
            }
        }

        return $string;
    }

    public static function getUploadServerOk($group_id, $count_photo){
        $params = array(
            "application_key"   =>  self::$app_public_key,
            "method"            => "photosV2.getUploadUrl",
            "count"             => $count_photo,  // количество фото для загрузки
            "gid"               => $group_id,
            "format"            =>  "json"
        );
        $sig = md5( self::arInStr($params) . md5(self::$access_token.self::$app_secret_key) );
        $params['access_token'] = self::$access_token;
        $params['sig']          = $sig;
        $step1 = json_decode(self::getUrl("https://api.ok.ru/fb.do", "POST", $params), true);
        return $step1;
    }

    public static function getPhoto(array $step1,$params,$step1_photo_ids){
        $photo_id = $step1['photo_ids'][0];
        $photo_id = $step1_photo_ids;
        $step = json_decode( OdnoklassnikiSDK::getUrl( $step1['upload_url'], "POST", $params, 30, true), true);
        $token = $step['photos'][$photo_id]['token'];
        return $token;
    }

    public static function PostOk($attachment,$group_id){

        $params = array(
            "application_key"   =>  self::$app_public_key,
            "method"            =>  "mediatopic.post",
            "gid"               =>  $group_id,
            "type"              =>  "GROUP_THEME",
            "attachment"        =>  $attachment,
            "format"            =>  "json",
        );

// Подпишем
        $sig = md5( OdnoklassnikiSDK::arInStr($params) . md5(self::$access_token.self::$app_secret_key ));

        $params['access_token'] = self::$access_token;
        $params['sig']          = $sig;

        $step = json_decode( OdnoklassnikiSDK::getUrl("https://api.ok.ru/fb.do", "POST", $params, 30, false, false ), true);

        return $step;
    }
}
?>
