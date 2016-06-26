<?php

/**
 * Format date convert Europe format to MySql Format
 * @param  DateTime $originalDate 
 * @param  string $separator 
 * @return string        
 */
function dateEuropeToMySql($originalDate, $separator = '/', $withTime = true)
{
    $chunkOriginalDateTime  = explode(" ", $originalDate);
    $chunkOriginalDate      = explode($separator, $chunkOriginalDateTime[0]);

    $mysqlDate = $chunkOriginalDate[2] ."-".$chunkOriginalDate[1]."-".$chunkOriginalDate[0];

    if($withTime && isset($chunkOriginalDateTime[1])) {
        $mysqlDate .= ' '.$chunkOriginalDateTime[1];
    }

    return $mysqlDate;
}

/**
 * Format date convert MySql Format to Europe format
 * @param  DateTime $originalDate 
 * @param  string $separator 
 * @return string        
 */
function dateMysqlToEurope($originalDate, $separator = '/', $withTime = true)
{
    $chunkOriginalDateTime  = explode(" ", $originalDate);
    $chunkOriginalDate      = explode("-", $chunkOriginalDateTime[0]);

    $mysqlDate = $chunkOriginalDate[2] .$separator.$chunkOriginalDate[1].$separator.$chunkOriginalDate[0];

    if($withTime && isset($chunkOriginalDateTime[1])) {
        $mysqlDate .= ' '.$chunkOriginalDateTime[1];
    }

    return $mysqlDate;
}


function doubleToMySql($value)
{
    return (double)str_replace(',', '.', $value);
}

/**
 * Format price
 * @param  float $price    
 */
function formatePrice($price)
{
    return '$'.number_format($price, 2, ',', '.');
}

/**
 * show image and if not exist show a no-image.png
 * @param  string $image    
 * @param  string $pathConfig    
 */
function showImage($image, $pathConfig = '')
{
	if($image) {
		$image = Config::get($pathConfig) . $image;
	} else {
		$image = Config::get('app.image.no-avatar');
	}

	return cdn($image);
}
/**
 * show image and if not exist show a no-avatar.png
 * @param  string $image
 * @param  string $pathConfig
 */
function showAvatarImage($image, $pathConfig = '')
{
	if($image) {
		$image = Config::get($pathConfig) . $image;
	} else {
		$image = Config::get('app.image.no-avatar');
	}

	return cdn($image);
}

/**
 * Use Cdn for files
 * @param  string $asset    
 */
function cdn( $asset )
{
    //Check if we added cdn's to the config file
    if( ! Config::get('app.image.cdn') ) {
        return asset( $asset );
    }

    //Get file name & cdn's
    $cdns 		= Config::get('app.image.cdn');
    $assetName 	= basename( $asset );

    //remove any query string for matching
    $assetName = explode("?", $assetName);
    $assetName = $assetName[0];

    //Find the correct cdn to use
    foreach( $cdns as $cdn => $types ) {
        if( preg_match('/^.*\.(' . $types . ')$/i', $assetName) ) {
            return cdnPath($cdn, $asset);
        }
    }

    //If we couldnt match a cdn, use the last in the list.
    end($cdns);

    return cdnPath( key( $cdns ) , $asset);
}

/**
 * Create a cdn path
 * @param  string $cdn    
 * @param  string $asset    
 */
function cdnPath($cdn, $asset) 
{
    return  "//" . rtrim($cdn, "/") . "/" . ltrim( $asset, "/");
}