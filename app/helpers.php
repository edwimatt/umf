<?php


use http\Exception;
use Illuminate\Support\Facades\Config;

/**
 * Get App name with any special characters
 */
if (!function_exists('getAppName')) {
    function getAppName()
    {
        return ucwords(str_replace('_', ' ', env('APP_NAME')));
    }
}


/**
 * Find Hash tags
 */
if (!function_exists('findHashTags')) {
    function findHashTags($params)
    {
        preg_match_all("/(#\w+)/", $params, $matches);

        return isset($matches[1]) ? $matches[1] : NULL;
    }
}

/**
 * Mail helper
 * @param {string} $email
 * @param {array} $params
 * return send mail
 */

if (!function_exists('sendMail')) {
    function sendMail($to, $identifier, $params)
    {
        return \App\Helpers\MailHelper::sendMail($to, $identifier, $params);
    }
}

if (!function_exists("generateUserHash")) {
    function generateUserHash($email)
    {
        return md5(Config::get('constants.APP_SALT') . $email);
    }
}


/**
 * Upload Media
 * @param {string} $path
 * @param {array} $file
 * @param {string} $resize
 * return filename
 */
if (!function_exists('uploadMedia')) {
    function uploadMedia($path, $file, $resize = '')
    {
        return \App\Helpers\UploadMedia::uploadMedia($path, $file, $resize);
    }
}

/**
 * Upload Media
 * @param {string} $path
 * @param {array} $file
 * @param {string} $resize
 * return filename
 */
if (!function_exists('uploadMediaByPath')) {
    function uploadMediaByPath($path, $file, $resize = '')
    {
        return \App\Helpers\UploadMedia::uploadMediaByPath($path, $file, $resize);
    }
}

/**
 * App Setting
 * @param {string} $identifier
 * @param {string} $meta_key
 */
if (!function_exists('appSetting')) {
    function appSetting($identifier, $meta_key)
    {
        return \App\Helpers\AppSetting::getAppSetting($identifier, $meta_key);
    }
}

/**
 * User Meta
 * @param {array} usermeta
 * @param {string} $meta_key
 */
if (!function_exists('userMeta')) {
    function userMeta($metaKey)
    {
        return \App\Helpers\UserMeta::userMeta($metaKey);
    }
}

/**
 * This function is used for calculate distance from two location
 * @params {float} $lat1
 * @params {float} $lon1
 * @params {float} $lat2
 * @params {float} $lon2
 * @params {string} $unit | K=kilometers, M=Miles, N=Nautical Miles
 * @return {string} miles
 */
if (!function_exists('calculateDistance')) {
    function calculateDistance($lat1, $lon1, $lat2, $lon2, $unit)
    {
        if (($lat1 == $lat2) && ($lon1 == $lon2)) {
            return 0;
        } else {
            $theta = $lon1 - $lon2;
            $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;
            $unit = strtoupper($unit);

            if ($unit == "K") {
                return ($miles * 1.609344);
            } else if ($unit == "N") {
                return ($miles * 0.8684);
            } else {
                return $miles;
            }
        }
    }
}


/**
 * User For login by Username, Mobile or Email
 */
if (!function_exists('loginWithIdentify')) {
    function loginWithIdentify($identify)
    {
        if (preg_match("/^(\+?\d{1,3}[-])\d{10,12}$/", $identify)) {
            return "mobile_no";
        } elseif (preg_match("/^[A-Za-z][A-Za-z0-9]{5,31}$/", $identify)) {
            return "username";
        } elseif (filter_var($identify, FILTER_VALIDATE_EMAIL)) {
            return "email";
        } else {
            return "username";
        }
    }
}

/**
 * Use for get number of year Two dates difference
 *
 * @param $dob
 * @return int|string
 * @throws \Exception
 */
if (!function_exists('getDifferenceTwoDates')) {
    function getDifferenceTwoDates($dob)
    {
        $d1 = new DateTime();
        $d2 = new DateTime("{$dob}");
        try {
            $diff = $d2->diff($d1);
            return $diff->y;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}

function jsond($array, $title = "")
{
    echo "<pre>$title<br><br>";
    echo json_encode($array);
    echo "<br><br>";
    die;
}

function pd($array, $title = "")
{
    echo "<pre>$title<br><br>";
    print_r($array);
    echo "<br><br>";
    die;
}

function p($array, $title = "")
{
    echo "<pre>$title<br><br>";
    print_r($array);
    echo "<br><br>";
}

function vd($array, $title = "")
{
    echo "<pre>$title<br><br>";
    var_dump($array);
    echo "<br><br>";
    die;
}

function v($array, $title = "")
{
    echo "<pre>$title<br><br>";
    var_dump($array);
    echo "<br><br>";
}

function fileLogData($request, $file_name = 'event_data')
{
    file_put_contents(base_path($file_name . '.txt'), $request);
}


/**
 * @param $url
 * @return bool
 */
if (!function_exists('checkUrl')) {
    function checkUrl($url)
    {

        if (strpos($url, 'http') !== false) {
            return true;
        }

        return false;
    }
}
