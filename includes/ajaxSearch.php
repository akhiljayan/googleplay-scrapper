<?php
/**
 * Description of scrapper
 *
 * @author akhil
 */

ini_set('display_errors', 1);
include_once '../classes/scrapper.cls.php';
$scrpr = new scrapper();
//$result = $scrpr->scrapContent();

$key = $scrpr->purify(filter_input(INPUT_POST, 'search_text', FILTER_SANITIZE_STRING));

$finalKeyArray = explode('https://play.google.com/store/apps/details?id=',$key);
$count = count($finalKeyArray);
$countToUse = ($count - 1);
$finalKey = html_entity_decode($finalKeyArray[$countToUse]);

$sortOrder = $scrpr->purify(filter_input(INPUT_POST, 'so', FILTER_SANITIZE_STRING));
if (!$key) {
    echo json_encode(array('error' => true, 'msg' => 'Search data not valid', 'datas' => ''));
    die;
}
$result = $scrpr->scrapContent($finalKey, $sortOrder);
if (count($result) > 0) {
    echo json_encode(array('error' => false, 'msg' => '', 'datas' => $result));
} else {
    echo json_encode(array('error' => true, 'msg' => 'No data', 'datas' => ''));
}
die;
