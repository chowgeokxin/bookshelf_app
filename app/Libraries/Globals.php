<?php


namespace App\Libraries;


use Carbon\Carbon;
use Illuminate\Support\Facades\App;

class Globals
{
    /*****   GENDER   ******/
    const MALE = "male";
    const FEMALE = "female";

    /*****   LANGUAGE   ******/
    const LANG_EN = "en"; /*english*/
    const LANG_CN = "cn"; /*chinese*/
    const LANG_KO = "ko"; /*korea*/
    const LANG_VI = "vi"; /*vietname*/

    /*****   USER TYPE   ******/
    const SUPER_ADMIN = "super_admin";
    const ADMIN = "admin";
    const COMPANY = "company";
    const MERCHANT = "merchant";
    const MEMBER = "member";

    /*****   STATUS   ******/
    const STATUS_ACTIVE = "active";
    const STATUS_INACTIVE = "inactive";
    const STATUS_INCOMPLETE = "incomplete";
    const STATUS_COMPLETED = "completed";
    const STATUS_DELETED = "deleted";
    const STATUS_PENDING = "pending";
    const STATUS_APPROVED = "approved";
    const STATUS_REJECTED = "rejected";
    const STATUS_REFUNDED = "refunded";
    const STATUS_FAILED = "failed";
    const STATUS_SUCCESS = "success";
    const STATUS_ENABLE = "enable";
    const STATUS_DISABLE = "disable";
    const STATUS_AVAILABLE = "available";
    const STATUS_NA = "not_available";
    const STATUS_PROCESSING = "processing";
    const STATUS_CANCELLED = "cancelled";
    const STATUS_OPEN = "open";
    const STATUS_CLOSED = "closed";
    const STATUS_CONFIRMED = "confirmed";
    const STATUS_PAID = 'paid';
    const STATUS_USED = 'used';
    const STATUS_EXPIRED = 'expired';
    const STATUS_ACTIVATED = "activated";
    const STATUS_IN_PROGRESS = "in_progress";
    const STATUS_VOIDED = "voided";
    const STATUS_RESUBMIT = "resubmit";
    const STATUS_PENDING_SIGN = "pending_sign";
    const STATUS_WAITING_CONFIRM = "waiting_confirm";
    const STATUS_FOLLOW_UP = "follow_up";
    const STATUS_SURVEY_APPT = "survey_appt";
    const STATUS_SURVEY_FAILED = "survey_failed";
    const YES = "yes";
    const NO = "no";
    const ON = "on";
    const OFF = "off";

    /*****   LEAVE_TYPE   ******/
    const ANNUAL_LEAVE = "annual_leave";
    const COMPASSIONATE_LEAVE = "compassionate_leave";
    const EMERGENCY_LEAVE = "emergency_leave";
    const HOSPITALIZATION_LEAVE = "hospitalization_leave";
    const MARRIAGE_LEAVE = "marriage_leave";
    const MATERNITY_LEAVE = "maternity_leave";
    const PATERNITY_LEAVE = "paternity_leave";
    const SICK_LEAVE = "sick_leave";
    const UNPAID_LEAVE = "unpaid_leave";

    /*****   UPLOAD   ******/
    const UPLOAD_PROFILE_PICTURE = "profile_picture";
    const UPLOAD_MERCHANT_LOGO = "merchant_logo";
    const UPLOAD_MERCHANT_ALBUM = "merchant_album";
    const UPLOAD_MERCHANT_LOYALTY_PROGRAM = "merchant_loyalty_program";
    const UPLOAD_MERCHANT_BANK_STATEMENT = "merchant_bank_statement";
    const UPLOAD_ANNOUNCEMENT = "announcement";
    const UPLOAD_BANNER = "banner";
    const UPLOAD_RECEIPT = "receipt";
    const UPLOAD_MERCHANT_SSM = "merchant_ssm";
    const UPLOAD_LEGAL_IC= "merchant_legal_ic";
    const UPLOAD_CHARITY = "charity";
    const UPLOAD_ENQUIRY_PHOTO = "enquiry_photo";
    const UPLOAD_APPLICATION_LEAVE = "application_leave";
    const UPLOAD_SALES_ORDER_ATTACHMENT = "sales_order_attachment";
    const UPLOAD_STAFF_CLAIM = "staff_claim";

    /*****   WALLET TYPE   ******/
    const WALLET_USD = "usd";
    const WALLET_MKT = "mkt";
    const WALLET_MLC = "mlc";
    const WALLET_MYR = "myr";
    const WALLET_MUSD = "musd";
    const MKT_CHARITY = "mkt_charity";
    const MKT_BONUS = "mkt_bonus";
    const MKT_BONUS_2 = "mkt_bonus_2";
    const WALLET_POINTS = "points";

    /*****   MONTH   ******/
    const JANUARY = "january";
    const FEBRUARY = "february";
    const MARCH = "march";
    const APRIL = "april";
    const MAY = "may";
    const JUNE = "june";
    const JULY = "july";
    const AUGUST = "august";
    const SEPTEMBER = "september";
    const OCTOBER = "october";
    const NOVEMBER = "november";
    const DECEMBER = "december";

    /*****   DAY   ******/
    const MONDAY = "monday";
    const TUESDAY = "tuesday";
    const WEDNESDAY = "wednesday";
    const THURSDAY = "thursday";
    const FRIDAY = "friday";
    const SATURDAY = "saturday";
    const SUNDAY = "sunday";

    /*****   UNIT TYPE   ******/
    const TYPE_SQFT = "sqft";
    const TYPE_PCS = "pcs";
    const TYPE_BOX = "box";
    const TYPE_PACKAGE = "package";

    /*****   OTHERS TYPE   ******/
    const API = "api";
    const FACEBOOK = "facebook";
    const GOOGLE = "google";
    const WECHAT = "wechat";
    const TOPUP = "topup";
    const CREDIT = "credit";
    const DEBIT = "debit";
    const VIDEO = "video";
    const IMAGE = "image";
    const FIX = "fix";
    const FIXED_AMOUNT = "fixed_amount";
    const PERCENTAGE = "percentage";
    const DISTANCE = "distance";
    const SCAN_TO_PAY = "scan_to_pay";
    const SETTLEMENT = "settlement";
    const PROFIT = "profit";
    const ADJUSTMENT = "adjustment";
    const WITHDRAWAL = "withdrawal";
    const SETTING = "setting";
    const WEB_VIEW = "webview";
    const IN_APP = "in_app";
    const TRANSFER = "transfer";
    const TRANSFER_FEE = "transfer_fee";
    const BALANCE_TRANSFER = "balance_transfer";
    const PAYMENT = "payment";
    const WITHDRAWAL_FEE = "withdrawal_fee";
    const CHARITY = "charity";
    const BONUS = "bonus";
    const FIXED_DEPOSIT = "fixed_deposit";
    const DAY = "day";
    const DAILY = "daily";
    const MONTH = "month";
    const YEAR = "year";
    const MONTHLY = "monthly";
    const HOURLY = "hourly";
    const ONE_TIME = "one_time";
    const REPEATABLE = "repeatable";
    const VOUCHER = "voucher";
    const MISSION_HISTORY = "mission_history";
    const MISSION_FEE = "mission_fee";
    const MISSION_REWARD = "mission_reward";
    const MISSION_LOCKED_AMOUNT = "mission_locked_amount";
    const MISSION_ACTIVE = "mission_active";
    const TYPE_GENERAL = "general";
    const TYPE_PAYMENT = "payment";
    const TYPE_COMPLAINTS = "complaints";
    const TYPE_FEEDBACK = "feedback";
    const TYPE_MISSION = "mission";
    const TYPE_OTHER = "other";
    const MLC = "mlc";
    const MLC_TRANSFER = "mlc_transfer";
    const DONATION = "donation";
    const CANCEL_PAYMENT = "cancel_payment";
    const TYPE_IN = "in";
    const TYPE_OUT = "out";
    const TYPE_ALL = "all";
    const CASH = "cash";
    const BANK = "bank";
    const CREDIT_CARD = 'credit_card';
    const CASH_REBATE = "cash_rebate";
    const BONUS_POOL = "bonus_pool";
    const COMPANY_POOL = "company_pool";
    const LOYALTY_REWARD = "loyalty_reward";
    const TYPE_LOYALTY_PROGRAM = "loyalty_program";
    /**
     * @param string $key
     * @param string|bool $default
     * @param string $langFile
     * @return string
     */
    public static function lang($key, $lang = "en", $langFile = "m", $param = [])
    {
        App::setLocale($lang);
        if (strlen($key) < 1) {
            $key = "";
        } elseif (trans()->has($langFile . "." . $key)) {
            return trans($langFile . "." . $key, $param);
        }

        return $key;
    }

    public static function null($string = "", $default = "-")
    {
        if ((strlen($string) <= 0) || !$string || is_null($string)) {
            return $default;
        }

        return $string;
    }

    public static function month_string($month) {
        if ($month == "01") {
            $month_string = Globals::JANUARY;
        } elseif ($month == "02") {
            $month_string = Globals::FEBRUARY;
        } elseif ($month == "03") {
            $month_string = Globals::MARCH;
        } elseif ($month == "04") {
            $month_string = Globals::APRIL;
        } elseif ($month == "05") {
            $month_string = Globals::MAY;
        } elseif ($month == "06") {
            $month_string = Globals::JUNE;
        } elseif ($month == "07") {
            $month_string = Globals::JULY;
        } elseif ($month == "08") {
            $month_string = Globals::AUGUST;
        } elseif ($month == "09") {
            $month_string = Globals::SEPTEMBER;
        } elseif ($month == "10") {
            $month_string = Globals::OCTOBER;
        } elseif ($month == "11") {
            $month_string = Globals::NOVEMBER;
        } else {
            $month_string = Globals::DECEMBER;
        }

        return $month_string;
    }

    /**
     * @param int $size
     * @return string
     */
    public static function fileSize($size)
    {
        if ($size > 1024 * 1024 * 1024) {
            return number_format(($size / 1024 / 1024 / 1024), 2) . " GB";
        } elseif ($size > 1024 * 1024) {
            return number_format(($size / 1024 / 1024), 2) . " MB";
        } elseif ($size > 1024) {
            return number_format(($size / 1024), 2) . " KB";
        } else {
            return $size . " Bytes";
        }
    }

    /**
     * @param string $title
     * @param bool $translate
     * @return string
     */
    public static function getPageTitle($title, $translate = true)
    {
        if ($translate && trans()->has($title)) {
            return config('app.name') . " | " . trans($title);
        }

        return config('app.name') . " | " . $title;
    }

    /**
     * @param \Illuminate\Validation\Validator $validator
     * @param string $prependMessage
     * @return string
     */
    public static function validatorToMessage($validator, $prependMessage = "")
    {
        $str = "";

        if ($validator->errors()->count() > 0) {

            foreach ($validator->errors()->all() as $m) {
                $str .= '<li>' . $m . '</li>';
            }

            $str = trans("m.problems_with_inputs") . '<br><br><ul>' . $str . '</ul>';
        }

        if (strlen($prependMessage) > 0) {
            if ($str != "") {
                $str = $prependMessage . '<br><br>' . $str;
            } else {
                $str = $prependMessage;
            }
        }

        return $str;
    }

    public static function humanFormattedDateTime($datetime)
    {
        return Carbon::parse($datetime)->format('d/m/y h:i A');
    }
}
