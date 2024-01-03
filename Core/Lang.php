<?
namespace Core;

class Lang {
    protected static $langData = [];

    public static function loadLanguage() {
        self::$langData = require base_path('Lang/' . $_SESSION['lang'] . '.php');
    }

    public static function get($key) {
        $keys = explode('.', $key);
        $value = self::$langData;

        foreach ($keys as $subKey) {
            if (isset($value[$subKey])) {
                $value = $value[$subKey];
            } else {
                return $key; // Returnăm cheia originală dacă traducerea nu este găsită
            }
        }

        return $value;
    }
}
