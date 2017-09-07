<?php namespace App\Views;


class Filters
{


public static function localizednumber($number, $style = 'decimal', $type = 'default', $locale = null):string
{
   
	self::raiseExceptionIfIntlExtensionNotAvailable();

    static $typeValues = array(
        'default' => \NumberFormatter::TYPE_DEFAULT,
        'int32' => \NumberFormatter::TYPE_INT32,
        'int64' => \NumberFormatter::TYPE_INT64,
        'double' => \NumberFormatter::TYPE_DOUBLE,
        'currency' => \NumberFormatter::TYPE_CURRENCY,
    );

    
    $formatter = self::getNumberFormatter($locale, $style);
    if (!isset($typeValues[$type])) {
        throw new \Exception('syntax error');
        //todo: raise mor appropriate /specific exception
    }

    return $formatter->format($number, $typeValues[$type]);
}

public static function localizeddate( $date, $dateFormat = 'medium', $timeFormat = 'medium', $locale = null, $timezone = null, $format = null, $calendar = 'gregorian')
{
    //$date = twig_date_converter($env, $date, $timezone);
    $formatValues = array(
        'none' => \IntlDateFormatter::NONE,
        'short' => \IntlDateFormatter::SHORT,
        'medium' => \IntlDateFormatter::MEDIUM,
        'long' => \IntlDateFormatter::LONG,
        'full' => \IntlDateFormatter::FULL,
    );

    //todo: fetch default locale if not provided 
    $locale= $locale ?? 'en-US';

    //todo: fetch default timezone if not provided 
    $timezone= $timezone ?? 'America/Los_Angeles';

     //todo: fetch default timezone if not provided 
    $format= $format ?? '"MM/dd/yyyy';

    $formatter = \IntlDateFormatter::create(
        $locale,
        $formatValues[$dateFormat],
        $formatValues[$timeFormat],
        $timezone,
        'gregorian' === $calendar ? \IntlDateFormatter::GREGORIAN : \IntlDateFormatter::TRADITIONAL,
        $format
    );
    return $formatter->format(strtotime($date));//todo:something fishy
}

public static function localizedcurrency($number, $currency = null, $locale = null)
{
     //todo: fetch default locale if not provided 
    $locale= $locale ?? 'en-US';
    
    $formatter = self::getNumberFormatter($locale, 'currency');
    return $formatter->formatCurrency($number, $currency);
}


private static function getNumberFormatter($locale , $style):\NumberFormatter
{
    static $formatter, $currentStyle;

    //todo: fetch default locale if not provided 
    $locale= $locale ?? 'en-US';

    if ($formatter && $formatter->getLocale() === $locale && $currentStyle === $style) {
        // Return same instance of NumberFormatter if parameters are the same
        // to those in previous call
        return $formatter;
    }
    static $styleValues = array(
        'decimal' => \NumberFormatter::DECIMAL,
        'currency' => \NumberFormatter::CURRENCY,
        'percent' => \NumberFormatter::PERCENT,
        'scientific' => \NumberFormatter::SCIENTIFIC,
        'spellout' => \NumberFormatter::SPELLOUT,
        'ordinal' => \NumberFormatter::ORDINAL,
        'duration' => \NumberFormatter::DURATION,
    );

    if (!isset($styleValues[$style])) {
        throw new \Exception('syntax error');
        //todo: raise more appropriate /specific exception
    }
    $currentStyle = $style;
    $formatter = \NumberFormatter::create($locale, $styleValues[$style]);
    return $formatter;
}

private static function raiseExceptionIfIntlExtensionNotAvailable()
    {
         if (!class_exists('IntlDateFormatter')) {
             throw new \RuntimeException('The intl extension is needed to use intl-based filters.');
        }
    }


}
