<?php
function isAjax() {
    return request()->ajax();
}
function getAvailableLanguages() {
    $langPath = base_path('resources/lang/');
    $langs = array();
    if ($openDir = opendir($langPath)) {
        while($read = readdir($openDir)) {
            if ($read != '.') {
                $langs[$read] =  getLanguageName($read);
            }
        }
    }
    return $langs;
}
function getLanguageName($lang) {
    $language = array(
        'en' => 'English' ,
        'aa' => 'Afar' ,
        'ab' => 'Abkhazian' ,
        'af' => 'Afrikaans' ,
        'am' => 'Amharic' ,
        'ar' => 'Arabic' ,
        'as' => 'Assamese' ,
        'ay' => 'Aymara' ,
        'az' => 'Azerbaijani' ,
        'ba' => 'Bashkir' ,
        'be' => 'Byelorussian' ,
        'bg' => 'Bulgarian' ,
        'bh' => 'Bihari' ,
        'bi' => 'Bislama' ,
        'bn' => 'Bengali/Bangla' ,
        'bo' => 'Tibetan' ,
        'br' => 'Breton' ,
        'ca' => 'Catalan' ,
        'co' => 'Corsican' ,
        'cs' => 'Czech' ,
        'cy' => 'Welsh' ,
        'da' => 'Danish' ,
        'de' => 'German' ,
        'dz' => 'Bhutani' ,
        'el' => 'Greek' ,
        'eo' => 'Esperanto' ,
        'es' => 'Spanish' ,
        'et' => 'Estonian' ,
        'eu' => 'Basque' ,
        'fa' => 'Persian' ,
        'fi' => 'Finnish' ,
        'fj' => 'Fiji' ,
        'fo' => 'Faeroese' ,
        'fr' => 'French' ,
        'fy' => 'Frisian' ,
        'ga' => 'Irish' ,
        'gd' => 'Scots/Gaelic' ,
        'gl' => 'Galician' ,
        'gn' => 'Guarani' ,
        'gu' => 'Gujarati' ,
        'ha' => 'Hausa' ,
        'hi' => 'Hindi' ,
        'hr' => 'Croatian' ,
        'hu' => 'Hungarian' ,
        'hy' => 'Armenian' ,
        'ia' => 'Interlingua' ,
        'ie' => 'Interlingue' ,
        'ik' => 'Inupiak' ,
        'in' => 'Indonesian' ,
        'is' => 'Icelandic' ,
        'it' => 'Italian' ,
        'iw' => 'Hebrew' ,
        'ja' => 'Japanese' ,
        'ji' => 'Yiddish' ,
        'jw' => 'Javanese' ,
        'ka' => 'Georgian' ,
        'kk' => 'Kazakh' ,
        'kl' => 'Greenlandic' ,
        'km' => 'Cambodian' ,
        'kn' => 'Kannada' ,
        'ko' => 'Korean' ,
        'ks' => 'Kashmiri' ,
        'ku' => 'Kurdish' ,
        'ky' => 'Kirghiz' ,
        'la' => 'Latin' ,
        'ln' => 'Lingala' ,
        'lo' => 'Laothian' ,
        'lt' => 'Lithuanian' ,
        'lv' => 'Latvian/Lettish' ,
        'mg' => 'Malagasy' ,
        'mi' => 'Maori' ,
        'mk' => 'Macedonian' ,
        'ml' => 'Malayalam' ,
        'mn' => 'Mongolian' ,
        'mo' => 'Moldavian' ,
        'mr' => 'Marathi' ,
        'ms' => 'Malay' ,
        'mt' => 'Maltese' ,
        'my' => 'Burmese' ,
        'na' => 'Nauru' ,
        'ne' => 'Nepali' ,
        'nl' => 'Dutch' ,
        'no' => 'Norwegian' ,
        'oc' => 'Occitan' ,
        'om' => '(Afan)/Oromoor/Oriya' ,
        'pa' => 'Punjabi' ,
        'pl' => 'Polish' ,
        'ps' => 'Pashto/Pushto' ,
        'pt' => 'Portuguese' ,
        'qu' => 'Quechua' ,
        'rm' => 'Rhaeto-Romance' ,
        'rn' => 'Kirundi' ,
        'ro' => 'Romanian' ,
        'ru' => 'Russian' ,
        'rw' => 'Kinyarwanda' ,
        'sa' => 'Sanskrit' ,
        'sd' => 'Sindhi' ,
        'sg' => 'Sangro' ,
        'sh' => 'Serbo-Croatian' ,
        'si' => 'Singhalese' ,
        'sk' => 'Slovak' ,
        'sl' => 'Slovenian' ,
        'sm' => 'Samoan' ,
        'sn' => 'Shona' ,
        'so' => 'Somali' ,
        'sq' => 'Albanian' ,
        'sr' => 'Serbian' ,
        'ss' => 'Siswati' ,
        'st' => 'Sesotho' ,
        'su' => 'Sundanese' ,
        'sv' => 'Swedish' ,
        'sw' => 'Swahili' ,
        'ta' => 'Tamil' ,
        'te' => 'Tegulu' ,
        'tg' => 'Tajik' ,
        'th' => 'Thai' ,
        'ti' => 'Tigrinya' ,
        'tk' => 'Turkmen' ,
        'tl' => 'Tagalog' ,
        'tn' => 'Setswana' ,
        'to' => 'Tonga' ,
        'tr' => 'Turkish' ,
        'ts' => 'Tsonga' ,
        'tt' => 'Tatar' ,
        'tw' => 'Twi' ,
        'uk' => 'Ukrainian' ,
        'ur' => 'Urdu' ,
        'uz' => 'Uzbek' ,
        'vi' => 'Vietnamese' ,
        'vo' => 'Volapuk' ,
        'wo' => 'Wolof' ,
        'xh' => 'Xhosa' ,
        'yo' => 'Yoruba' ,
        'zh' => 'Chinese' ,
        'zu' => 'Zulu' ,
    );

    return isset($language[$lang]) ? $language[$lang] : '';
}

function get_time_relative_format($time) {
    $timeStr = 'this week';
    switch ($time) {
        case 'this-month':
            $timeStr = 'first day of this month';
            break;
        case 'last-month':
            $timeStr = 'first day of last month';
            break;
        case 'last-week':
            $timeStr = 'last week';
            break;
        case 'this-year':
            $timeStr = 'first day of january this year';
            break;
    }
    return strtotime($timeStr);
}

function getCountries() {
    $countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
    return $countries;
}

function getMonths() {
    return array(
        'january',
        'february',
        'march',
        'april',
        'may',
        'june',
        'july',
        'august',
        'september',
        'october',
        'november',
        'december'
    );
}
if(!function_exists('perfectSerialize')) {
    function perfectSerialize($string) {
        return base64_encode(serialize($string));
    }
}

if(!function_exists('perfectUnserialize')) {
    function perfectUnserialize($string) {

        if(base64_decode($string, true) == true) {

            return @unserialize(base64_decode($string));
        } else {
            return @unserialize($string);
        }
    }
}

function hex2rgba($color, $opacity = false, $array = false) {

    $default = 'rgb(0,0,0)';

    //Return default if no color provided
    if(empty($color))
        return $default;

    //Sanitize $color if "#" is provided
    if ($color[0] == '#' ) {
        $color = substr( $color, 1 );
    }

    //Check if color has 6 or 3 characters and get values
    if (strlen($color) == 6) {
        $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
    } elseif ( strlen( $color ) == 3 ) {
        $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
    } else {
        return $default;
    }

    //Convert hexadec to rgb
    $rgb =  array_map('hexdec', $hex);

    //Check if opacity is set(rgba or rgb)
    if($opacity){
        if(abs($opacity) > 1)
            $opacity = 1.0;
        $output = 'rgba('.implode(",",$rgb).','.$opacity.')';
    } else {
        $output = 'rgb('.implode(",",$rgb).')';
    }

    //Return rgb(a) color string
    return (!$array) ? $output : $rgb;
}

function adjustBrightness($hex, $steps) {
    // Steps should be between -255 and 255. Negative = darker, positive = lighter
    $steps = max(-255, min(255, $steps));

    // Normalize into a six character long hex string
    $hex = str_replace('#', '', $hex);
    if (strlen($hex) == 3) {
        $hex = str_repeat(substr($hex,0,1), 2).str_repeat(substr($hex,1,1), 2).str_repeat(substr($hex,2,1), 2);
    }

    // Split into three parts: R, G and B
    $color_parts = str_split($hex, 2);
    $return = '#';

    foreach ($color_parts as $color) {
        $color   = hexdec($color); // Convert to decimal
        $color   = max(0,min(255,$color + $steps)); // Adjust color
        $return .= str_pad(dechex($color), 2, '0', STR_PAD_LEFT); // Make two char hex code
    }

    return $return;
}

function format_bytes($bytes, $force_unit = NULL, $format = NULL, $si = TRUE)
{
// Format string
    $format = ($format === NULL) ? '%01.2f %s' : (string)$format;

    // IEC prefixes (binary)
    if ($si == FALSE OR strpos($force_unit, 'i') !== FALSE) {
        $units = array('B', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB');
        $mod = 1024;
    } // SI prefixes (decimal)
    else {
        $units = array('B', 'kB', 'MB', 'GB', 'TB', 'PB');
        $mod = 1000;
    }

    // Determine unit to use
    if (($power = array_search((string)$force_unit, $units)) === FALSE) {
        $power = ($bytes > 0) ? floor(log($bytes, $mod)) : 0;
    }

    return sprintf($format, $bytes / pow($mod, $power), $units[$power]);
}
function formatMoney($total, $symbol = '', $span = true) {

    if (!is_numeric($total) && $total != 0) {
        return $total;
    }

    $decimal_separator  = config('decimal-separator', '.');
    $thousand_separator = config('thousand-separator', ',');
    $currency_placement = config('currency-placement', 'before');
    $d                  = 3;
    $symbol = ($symbol) ? $symbol : getDefaultCurrencySymbol();

    if (config('remove-zero-decimals', true)) {
        if (!is_decimal($total)) {
            $d = 0;
        }
    }

    $total = number_format($total, $d, $decimal_separator, $thousand_separator);

    $split = explode($decimal_separator, $total);
    if (count($split) > 1) {
        if (substr($total, strlen($total) - 1, 1) == '0') {
            $total = substr($total, 0, strlen($total) - 1);
        }
    }
    //$total = Hook::getInstance()->fire('money_after_format_without_currency', $total);

    if ($currency_placement === 'after') {
        $_formatted = $total . '' . $symbol;
    } else {
        $_formatted = ($span) ? '<span class="symbol">'.$symbol . '</span>' . $total : $symbol.$total;
    }

    //$_formatted = Hook::getInstance()->fire('money_after_format_with_currency', $_formatted);

    return $_formatted;
}
function is_decimal($val)
{
    return is_numeric($val) && floor($val) != $val;
}
function getTimezones()
{
    $timezoneIdentifiers = DateTimeZone::listIdentifiers();
    $utcTime = new DateTime('now', new DateTimeZone('UTC'));

    $tempTimezones = array();
    foreach ($timezoneIdentifiers as $timezoneIdentifier) {
        $currentTimezone = new DateTimeZone($timezoneIdentifier);

        $tempTimezones[] = array(
            'offset' => (int)$currentTimezone->getOffset($utcTime),
            'identifier' => $timezoneIdentifier
        );
    }

    // Sort the array by offset,identifier ascending
    usort($tempTimezones, function($a, $b) {
        return ($a['offset'] == $b['offset'])
            ? strcmp($a['identifier'], $b['identifier'])
            : $a['offset'] - $b['offset'];
    });

    $timezoneList = array();

    foreach ($tempTimezones as $tz) {
        $sign = ($tz['offset'] > 0) ? '+' : '-';
        $offset = gmdate('H:i', abs($tz['offset']));
        if (!isset($timezoneList[$tz['identifier']])) $timezoneList[$tz['identifier']] = '(UTC ' . $sign . $offset . ') ' . $tz['identifier'];
    }
    return $timezoneList;
}
function isImage($ext) {
    return in_array(strtolower($ext), array('jpg','jpeg','png','gif'));
}

function getFileExtension($file) {
    if (preg_match('#png#i', $file)) return 'png';
    if (preg_match('#jpg#i', $file)) return 'jpg';
    if (preg_match('#gif#i', $file)) return 'gif';
    if (preg_match('#jpeg#i', $file)) return 'jpeg';

    return null;
}
function curl_get_content($url, $javascript_loop = 0, $timeout = 100)
{
    $url = str_replace("&amp;", "&", urldecode(trim($url)));

    $cookie = tempnam("/tmp", "CURLCOOKIE");
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; rv:1.7.3) Gecko/20041001 Firefox/0.10.1");
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
    //curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
    curl_setopt($ch, CURLOPT_ENCODING, "");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_AUTOREFERER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); # required for https urls
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
    $content = curl_exec($ch);
    $response = curl_getinfo($ch);
    curl_close($ch);

    return $content;
}

function  getFileViaCurl($url, $file){
    $output_filename = public_path($file);
    $host = $url; // <-- Source image url (FIX THIS)
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $host);
    curl_setopt($ch, CURLOPT_VERBOSE, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_AUTOREFERER, false);
    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); // <-- don't forget this
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); // <-- and this
    $result = curl_exec($ch);
    curl_close($ch);
    $fp = fopen($output_filename, 'wb');
    fwrite($fp, $result);
    fclose($fp);
}

function getRawCurriencies() {
    return json_decode('{"AFN":{"name":"Afghan Afghani","symbol":"\u060b"},"ALL":{"name":"Albanian Lek","symbol":"Lek"},"DZD":{"name":"Algerian Dinar","symbol":"DZD"},"AOA":{"name":"Angolan Kwanza","symbol":"AOA"},"ARS":{"name":"Argentine Peso","symbol":"$"},"AMD":{"name":"Armenian Dram","symbol":"AMD"},"AWG":{"name":"Aruban Florin","symbol":"\u0192"},"AUD":{"name":"Australian Dollar","symbol":"$"},"AZN":{"name":"Azerbaijani Manat","symbol":"\u043c\u0430\u043d"},"BSD":{"name":"Bahamian Dollar","symbol":"$"},"BDT":{"name":"Bangladeshi Taka","symbol":"BDT"},"BBD":{"name":"Barbadian Dollar","symbol":"$"},"BZD":{"name":"Belize Dollar","symbol":"BZ$"},"BMD":{"name":"Bermudian Dollar","symbol":"BMD"},"BOB":{"name":"Bolivian Boliviano","symbol":"$b"},"BAM":{"name":"Bosnia And Herzegovina Konvertibilna Marka","symbol":"KM"},"BWP":{"name":"Botswana Pula","symbol":"P"},"BRL":{"name":"Brazilian Real","symbol":"R$"},"GBP":{"name":"British Pound","symbol":"\u00a3"},"BND":{"name":"Brunei Dollar","symbol":"$"},"BGN":{"name":"Bulgarian Lev","symbol":"\u043b\u0432"},"BIF":{"name":"Burundi Franc","symbol":"BIF"},"KHR":{"name":"Cambodian Riel","symbol":"\u17db"},"CAD":{"name":"Canadian Dollar","symbol":"$"},"CVE":{"name":"Cape Verdean Escudo","symbol":"CVE"},"KYD":{"name":"Cayman Islands Dollar","symbol":"$"},"XAF":{"name":"Central African CFA Franc","symbol":"XAF"},"XPF":{"name":"CFP Franc","symbol":"XPF"},"CLP":{"name":"Chilean Peso","symbol":"$"},"CNY":{"name":"Chinese Yuan","symbol":"\u00a5"},"COP":{"name":"Colombian Peso","symbol":"$"},"KMF":{"name":"Comorian Franc","symbol":"KMF"},"CDF":{"name":"Congolese Franc","symbol":"CDF"},"CRC":{"name":"Costa Rican Colon","symbol":"\u20a1"},"HRK":{"name":"Croatian Kuna","symbol":"kn"},"CZK":{"name":"Czech Koruna","symbol":"K\u010d"},"DKK":{"name":"Danish Krone","symbol":"kr"},"DJF":{"name":"Djiboutian Franc","symbol":"DJF"},"DOP":{"name":"Dominican Peso","symbol":"RD$"},"XCD":{"name":"East Caribbean Dollar","symbol":"$"},"EGP":{"name":"Egyptian Pound","symbol":"\u00a3"},"ETB":{"name":"Ethiopian Birr","symbol":"ETB"},"EUR":{"name":"Euro","symbol":"\u20ac"},"FKP":{"name":"Falkland Islands Pound","symbol":"\u00a3"},"FJD":{"name":"Fijian Dollar","symbol":"$"},"GHS":{"name":"Ghana Cedis","symbol":"GH₵"},"GMD":{"name":"Gambian Dalasi","symbol":"GMD"},"GEL":{"name":"Georgian Lari","symbol":"GEL"},"GIP":{"name":"Gibraltar Pound","symbol":"\u00a3"},"GTQ":{"name":"Guatemalan Quetzal","symbol":"Q"},"GNF":{"name":"Guinean Franc","symbol":"GNF"},"GYD":{"name":"Guyanese Dollar","symbol":"$"},"HTG":{"name":"Haitian Gourde","symbol":"HTG"},"HNL":{"name":"Honduran Lempira","symbol":"L"},"HKD":{"name":"Hong Kong Dollar","symbol":"$"},"HUF":{"name":"Hungarian Forint","symbol":"Ft"},"ISK":{"name":"Icelandic Kr\u00f3na","symbol":"kr"},"INR":{"name":"Indian Rupee","symbol":"\u20b9"},"IDR":{"name":"Indonesian Rupiah","symbol":"Rp"},"ILS":{"name":"Israeli New Sheqel","symbol":"\u20aa"},"JMD":{"name":"Jamaican Dollar","symbol":"J$"},"JPY":{"name":"Japanese Yen","symbol":"\u00a5"},"KZT":{"name":"Kazakhstani Tenge","symbol":"\u043b\u0432"},"KES":{"name":"Kenyan Shilling","symbol":"KSh"},"KGS":{"name":"Kyrgyzstani Som","symbol":"\u043b\u0432"},"LAK":{"name":"Lao Kip","symbol":"\u20ad"},"LBP":{"name":"Lebanese Lira","symbol":"\u00a3"},"LSL":{"name":"Lesotho Loti","symbol":"LSL"},"LRD":{"name":"Liberian Dollar","symbol":"$"},"MOP":{"name":"Macanese Pataca","symbol":"MOP"},"MKD":{"name":"Macedonian Denar","symbol":"\u0434\u0435\u043d"},"MGA":{"name":"Malagasy Ariary","symbol":"MGA"},"MWK":{"name":"Malawian Kwacha","symbol":"MWK"},"MYR":{"name":"Malaysian Ringgit","symbol":"RM"},"MVR":{"name":"Maldivian Rufiyaa","symbol":"MVR"},"MRO":{"name":"Mauritanian Ouguiya","symbol":"MRO"},"MUR":{"name":"Mauritian Rupee","symbol":"\u20a8"},"MXN":{"name":"Mexican Peso","symbol":"$"},"MDL":{"name":"Moldovan Leu","symbol":"MDL"},"MNT":{"name":"Mongolian Tugrik","symbol":"\u20ae"},"MAD":{"name":"Moroccan Dirham","symbol":"MAD"},"MZN":{"name":"Mozambican Metical","symbol":"MZN"},"MMK":{"name":"Myanma Kyat","symbol":"MMK"},"NAD":{"name":"Namibian Dollar","symbol":"$"},"NPR":{"name":"Nepalese Rupee","symbol":"\u20a8"},"ANG":{"name":"Netherlands Antillean Gulden","symbol":"\u0192"},"TWD":{"name":"New Taiwan Dollar","symbol":"NT$"},"NZD":{"name":"New Zealand Dollar","symbol":"$"},"NIO":{"name":"Nicaraguan Cordoba","symbol":"C$"},"NGN":{"name":"Nigerian Naira","symbol":"\u20a6"},"NOK":{"name":"Norwegian Krone","symbol":"kr"},"PKR":{"name":"Pakistani Rupee","symbol":"\u20a8"},"PAB":{"name":"Panamanian Balboa","symbol":"B\/."},"PGK":{"name":"Papua New Guinean Kina","symbol":"PGK"},"PYG":{"name":"Paraguayan Guarani","symbol":"Gs"},"PEN":{"name":"Peruvian Nuevo Sol","symbol":"S\/."},"PHP":{"name":"Philippine Peso","symbol":"\u20b1"},"PLN":{"name":"Polish Zloty","symbol":"z\u0142"},"QAR":{"name":"Qatari Riyal","symbol":"\ufdfc"},"RON":{"name":"Romanian Leu","symbol":"lei"},"RUB":{"name":"Russian Ruble","symbol":"\u0440\u0443\u0431"},"RWF":{"name":"Rwandan Franc","symbol":"RWF"},"STD":{"name":"Sao Tome And Principe Dobra","symbol":"STD"},"SHP":{"name":"Saint Helena Pound","symbol":"\u00a3"},"SVC":{"name":"Salvadoran Col\u00f3n","symbol":"SVC"},"WST":{"name":"Samoan Tala","symbol":"WST"},"SAR":{"name":"Saudi Riyal","symbol":"\ufdfc"},"RSD":{"name":"Serbian Dinar","symbol":"\u0414\u0438\u043d."},"SCR":{"name":"Seychellois Rupee","symbol":"\u20a8"},"SLL":{"name":"Sierra Leonean Leone","symbol":"SLL"},"SGD":{"name":"Singapore Dollar","symbol":"$"},"SBD":{"name":"Solomon Islands Dollar","symbol":"$"},"SOS":{"name":"Somali Shilling","symbol":"S"},"ZAR":{"name":"South African Rand","symbol":"R"},"KRW":{"name":"South Korean Won","symbol":"\u20a9"},"LKR":{"name":"Sri Lankan Rupee","symbol":"\u20a8"},"SRD":{"name":"Surinamese Dollar","symbol":"$"},"SZL":{"name":"Swazi Lilangeni","symbol":"SZL"},"SEK":{"name":"Swedish Krona","symbol":"kr"},"CHF":{"name":"Swiss Franc","symbol":"Fr."},"TJS":{"name":"Tajikistani Somoni","symbol":"TJS"},"TZS":{"name":"Tanzanian Shilling","symbol":"TSh"},"THB":{"name":"Thai Baht","symbol":"\u0e3f"},"TOP":{"name":"Paanga","symbol":"TOP"},"TTD":{"name":"Trinidad and Tobago Dollar","symbol":"TT$"},"TRY":{"name":"Turkish New Lira","symbol":"TRY"},"UGX":{"name":"Ugandan Shilling","symbol":"USh"},"UAH":{"name":"Ukrainian Hryvnia","symbol":"\u20b4"},"AED":{"name":"UAE Dirham","symbol":"AED"},"USD":{"name":"United States Dollar","symbol":"$"},"UYU":{"name":"Uruguayan Peso","symbol":"$U"},"UZS":{"name":"Uzbekistani Som","symbol":"\u043b\u0432"},"VUV":{"name":"Vanuatu Vatu","symbol":"VUV"},"VND":{"name":"Vietnamese Dong","symbol":"\u20ab"},"XOF":{"name":"West African CFA Franc","symbol":"XOF"},"YER":{"name":"Yemeni Rial","symbol":"\ufdfc"},"ZMW":{"name":"Zambian Kwacha","symbol":"ZMW"}}', true);
}

function getDefaultCurrencySymbol() {
    return getCurrencySymbol(config('currency', 'USD'));
}
function getCurrencySymbol($currency) {
    $curnencies = getRawCurriencies();
    return $curnencies[$currency]['symbol'];
}

function reformatDate($date) {
    if (!$date) return date('m/d/Y');
    list($month,$day,$year) = explode('/', $date);
    return $month.'/'.$day.'/'.$year;
}

function getSelectedDateFormat() {
    return config('admin-date-format', 1);
}
function getAdminDateFormat($double = false) {
    $config = getSelectedDateFormat();
    switch($config) {
        case 1:
            return ($double) ? "mm/dd/yyyy" : "m/d/Y";
            break;
        case 2:
            return ($double) ? "dd/mm/yyyy" : "d/m/Y";
            break;
        case 3:
            return ($double) ? "yyyy/mm/dd" : "Y/m/d";
            break;
        case 4:
            return ($double) ? "yyyy/dd/mm" : "Y/d/m";
            break;
        case 5:
            return ($double) ? "mm-dd-yyyy" : "m-d-Y";
            break;
        case 6:
            return ($double) ? "dd-mm-yyyy" : "d-m-Y";
            break;
        case 7:
            return ($double) ? "mm.dd.yyyy" : "m.d.Y";
            break;
        case 8:
            return ($double) ? "dd.mm.yyyy" : "d.m.Y";
            break;
    }
}
function uniqueKey($minlength = 20, $maxlength = 20, $uselower = true, $useupper = true, $usenumbers = true, $usespecial = false) {
    $charset = '';
    if ($uselower) {
        $charset .= "abcdefghijklmnopqrstuvwxyz";
    }
    if ($useupper) {
        $charset .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    }
    if ($usenumbers) {
        $charset .= "123456789";
    }
    if ($usespecial) {
        $charset .= "~@#$%^*()_+-={}|][";
    }
    if ($minlength > $maxlength) {
        $length = mt_rand($maxlength, $minlength);
    } else {
        $length = mt_rand($minlength, $maxlength);
    }
    $key = '';
    for ($i = 0; $i < $length; $i++) {
        $key .= $charset[(mt_rand(0, strlen($charset) - 1))];
    }
    return $key;
}

if(!function_exists('perfectSerialize')) {
    function perfectSerialize($string) {
        return base64_encode(serialize($string));
    }
}

if(!function_exists('perfectUnserialize')) {
    function perfectUnserialize($string) {

        if(base64_decode($string, true) == true) {

            return @unserialize(base64_decode($string));
        } else {
            return @unserialize($string);
        }
    }
}
function getDateFormats() {
    $year = date('Y');
    $month = date('m');
    $day = date('d');
    return array(
        '1' => "m/d/Y ({$month}/{$day}/{$year})",
        '2' => "d/m/Y ({$day}/{$month}/{$year})",
        '3' => "Y/m/d ({$year}/{$month}/{$day})",
        '4' => "Y/d/m ({$year}/{$day}/{$month})",
        '5' => "m-d-Y ({$month}-{$day}-{$year})",
        '6' => "d-m-Y ({$day}-{$month}-{$year})",
        '7' => "m.d.Y ({$month}.{$day}.{$year})",
        '8' => "d.m.Y ({$day}.{$month}.{$year})",
    );
}
function choosenDateFormat() {
    $formats = getDateFormats();
    return $formats[config('admin-date-format', 1)];
}

function isImageName($source) {
    $name = pathinfo($source);
    $ext = strtolower($name['extension']);
    return in_array($ext, array('jpg','jpeg','png','gif'));
}

function getIpInfo($ip = NULL, $purpose = "location", $deep_detect = TRUE) {
    $output = NULL;
    if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
        $ip = $_SERVER["REMOTE_ADDR"];
        if ($deep_detect) {
            if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
    }
    $purpose    = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
    $support    = array("country", "countrycode", "state", "region", "city", "location", "address");
    $continents = array(
        "AF" => "Africa",
        "AN" => "Antarctica",
        "AS" => "Asia",
        "EU" => "Europe",
        "OC" => "Australia (Oceania)",
        "NA" => "North America",
        "SA" => "South America"
    );
    if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
        $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
        if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
            switch ($purpose) {
                case "location":
                    $output = array(
                        "city"           => @$ipdat->geoplugin_city,
                        "state"          => @$ipdat->geoplugin_regionName,
                        "country"        => @$ipdat->geoplugin_countryName,
                        "country_code"   => @$ipdat->geoplugin_countryCode,
                        "continent"      => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
                        "continent_code" => @$ipdat->geoplugin_continentCode
                    );
                    break;
                case "address":
                    $address = array($ipdat->geoplugin_countryName);
                    if (@strlen($ipdat->geoplugin_regionName) >= 1)
                        $address[] = $ipdat->geoplugin_regionName;
                    if (@strlen($ipdat->geoplugin_city) >= 1)
                        $address[] = $ipdat->geoplugin_city;
                    $output = implode(", ", array_reverse($address));
                    break;
                case "city":
                    $output = @$ipdat->geoplugin_city;
                    break;
                case "state":
                    $output = @$ipdat->geoplugin_regionName;
                    break;
                case "region":
                    $output = @$ipdat->geoplugin_regionName;
                    break;
                case "country":
                    $output = @$ipdat->geoplugin_countryName;
                    break;
                case "countrycode":
                    $output = @$ipdat->geoplugin_countryCode;
                    break;
            }
        }
    }
    return $output;
}
