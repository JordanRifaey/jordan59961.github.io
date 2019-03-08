<!DOCTYPE html>
<!--
Author: Jordan Rifaey
Date:   started on 3/7/2019
Project: Midterm
-->
<?php
require_once("FxDataModel.php");
$dm = new FxDataModel();
$FxCurrencies = FxDataModel::getFxCurrencies();

if (array_key_exists(FxDataModel::getIniArray()["src.amt"], $_POST) && is_numeric($_POST[FxDataModel::getIniArray()["src.amt"]])) {
    $fromVal = $_POST[FxDataModel::getIniArray()["src.amt"]];
    $fromFX = $_POST[FxDataModel::getIniArray()["src.cucy"]];
    $toFX = $_POST[FxDataModel::getIniArray()["dst.cucy"]];
    $toVal = FxDataModel::getFxRate($fromFX, $toFX) * $fromVal;
} else {
    $fromVal = "";
    $fromFX = $FxCurrencies[0];
    $toFX = $FxCurrencies[0];
    $toVal = "";
}
?>

<html>
    <body style="text-align:center">
        <header>
            <h1>Money Banks F/X Calculator</h1>
            <hr>
            <br>
        </header>
        <form name="fxCalc" action="fxCalc.php" method="post">
            <select name="<?php echo FxDataModel::getIniArray()["src.cucy"]?>">
                <?php
                $arr = FxDataModel::getFxCurrencies();
                $len = sizeof($arr);
                for ($i = 0; $i < $len; $i++) {
                    echo "\t\t\t\t<option value=\"$arr[$i]\"";
                    if ($fromFX == $arr[$i]) {
                        echo " selected";
                    }
                    echo ">$arr[$i]</option>\n";
                }
                ?>
            </select>
            <input type="text" name="<?php echo FxDataModel::getIniArray()["src.amt"]?>" value="<?php echo $fromVal ?>">
            <select name="<?php echo FxDataModel::getIniArray()["dst.cucy"]?>">
                <?php
                $arr = FxDataModel::getFxCurrencies();
                for ($i = 0; $i < $len; $i++)  {
                    echo "\t\t\t\t<option value=\"$arr[$i]\"";
                    if ($toFX == $arr[$i]) {
                        echo " selected";
                    }
                    echo ">$arr[$i]</option>\n";
                }
                ?>
            </select>
            <input name="<?php echo FxDataModel::getIniArray()["dst.amt"]?>" type="text" value ="<?php echo $toVal ?>" disabled>
            <br>
            <br>
            <button type="submit">Convert</button>
            <button type="reset">Reset</button>
        </form>
    </body>
</html>