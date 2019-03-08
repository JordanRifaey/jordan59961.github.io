<?php

class FxDataModel {

    const iniFile = "fxCalc.ini";
    const keyFxRatesFile = "fx.rates.file";

    private static $iniArray;
    private static $FxCurrencies;
    private static $FxRate = array();

    function FxDataModel() {
        self::$iniArray = parse_ini_file(self::iniFile);

        $fileName = self::$iniArray[self::keyFxRatesFile];
        $file = fopen($fileName, "r");
        self::$FxCurrencies = fgetcsv($file);

        while (!feof($file)) {
            array_push(self::$FxRate, fgetcsv($file));
        }

        fclose($file);
    }

    public static function getFxCurrencies() {
        return self::$FxCurrencies;
    }

    public static function getFxRate($fromFX, $toFX) {
        return self::$FxRate[array_search($fromFX, self::$FxCurrencies)][array_search($toFX, self::$FxCurrencies)];
    }

    public static function getIniArray() {
        return self::$iniArray;
    }

}
