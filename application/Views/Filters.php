<?php namespace App\Views;


class Filters
{

public static function test($value): string
	{
		return $value."--tested";
	}

	private static function isIntlAvalable()
    {
        // if (!class_exists('IntlDateFormatter')) {
        //     throw new \RuntimeException('The intl extension is needed to use intl-based filters.');
        // }
    }

public static function localizednumber($number, $style = 'decimal', $type = 'default', $locale = null):string
{
   
	self::isIntlAvalable();

    static $typeValues = array(
        'default' => \NumberFormatter::TYPE_DEFAULT,
        'int32' => \NumberFormatter::TYPE_INT32,
        'int64' => \NumberFormatter::TYPE_INT64,
        'double' => \NumberFormatter::TYPE_DOUBLE,
        'currency' => \NumberFormatter::TYPE_CURRENCY,
    );

    
    $formatter = getNumberFormatter($locale, $style);
    if (!isset($typeValues[$type])) {
        throw new \Exception('syntax error');
        //todo: raise mor appropriate /specific exception
    }

    return $formatter->format($number, $typeValues[$type]);
}

private static function getNumberFormatter($locale , $style)
{
    static $formatter, $currentStyle;

    //todo: fetch default locale if not provided 
    $locale= $locale ?? 'en-us';

    if ($formatter && $formatter->getLocale() === $locale && $currentStyle === $style) {
        // Return same instance of NumberFormatter if parameters are the same
        // to those in previous call
        return $formatter;
    }
    static $styleValues = array(
        'decimal' => NumberFormatter::DECIMAL,
        'currency' => NumberFormatter::CURRENCY,
        'percent' => NumberFormatter::PERCENT,
        'scientific' => NumberFormatter::SCIENTIFIC,
        'spellout' => NumberFormatter::SPELLOUT,
        'ordinal' => NumberFormatter::ORDINAL,
        'duration' => NumberFormatter::DURATION,
    );

    if (!isset($styleValues[$style])) {
        throw new \Exception('syntax error');
        //todo: raise mor appropriate /specific exception
    }
    $currentStyle = $style;
    $formatter = \NumberFormatter::create($locale, $styleValues[$style]);
    return $formatter;
}

}
