<?php

/**
 * Description of scrapper
 *
 * @author akhil
 */
include_once('simple_html_dom.php');

class scrapper {

    public function scrapContent($finalKey) {
        $url = 'http://play.google.com/store/apps/details?id=' . $finalKey;
        $user_agent = 'Mozilla/5.0 (Windows NT 6.1; rv:8.0) Gecko/20100101 Firefox/8.0';

        $html = file_get_html($url);
        $imageHtml = $html->find(".cover-container",0)->innertext;
        
        $ratingBox = $html->find(".rating-box",0)->innertext;
        
        
        $imageHtmlObj = str_get_html($imageHtml);
        $imgSrcObj = $imageHtmlObj->find("img");
        $imgSrc = $imgSrcObj[0]->getAttribute('src');
        //details-section-contents show-more-container
        
        
        $whatsNweHtml = $html->find(".whatsnew",0)->innertext;
        
//        $aditionalInfoHtml = $html->find(".apps-secondary-color",0)->innertext;
        
        //details-wrapper apps-secondary-color
                
        $options = array(
            CURLOPT_RETURNTRANSFER => true, // return web page
            CURLOPT_HEADER => false, // don't return headers
            CURLOPT_FOLLOWLOCATION => true, // follow redirects
            CURLOPT_ENCODING => "", // handle all encodings
            CURLOPT_USERAGENT => $user_agent, // set user agent
            CURLOPT_AUTOREFERER => true, // set referer on redirect
            CURLOPT_CONNECTTIMEOUT => 120, // timeout on connect
            CURLOPT_SSL_VERIFYPEER => false, // connect to https
            CURLOPT_TIMEOUT => 120, // timeout on response
            CURLOPT_MAXREDIRS => 10, // stop after 10 redirects
        );

        $ch = curl_init($url);
        curl_setopt_array($ch, $options);
        $content = curl_exec($ch);
        curl_close($ch);


        //Matches for fkin display
        preg_match_all('/<div class=\"cover-container(.*?)<\/div>/s', $content, $appHeadImage);
        preg_match_all('/<h1 class=\"document-title(.*?)<\/h1>/s', $content, $appHeadTitle);
        preg_match_all('/<div jsname=\"C4s9Ed(.*?)<\/div>/s', $content, $appDiscription);
        preg_match_all('/<div\s*class="rating\-box"\s*>(?P<content>.*)<\/div>/', $content, $appRatings);
        preg_match_all('/<div\s*class="recent\-change"\s*>(?P<content>.*)<\/div>/', $content, $appWhatsNew);
        preg_match_all('/<div\s*class="details\-section metadata"\s*>(?P<content>.*)<\/div>/', $content, $appAditionalInfo);


        //Matches for fkin form
        preg_match_all('/<div class=\"id-app-title(.*?)<\/div>/s', $content, $appFormName);
        preg_match_all('/<span itemprop=\"genre(.*?)<\/span>/s', $content, $appFormCatagory);
        preg_match_all('/<div class=\"content\" itemprop=\"numDownloads(.*?)<\/div>/s', $content, $appFormUserInstals);
        preg_match_all('/<span class=\"rating\-count(.*?)<\/span>/s', $content, $appFormUserRating);
        preg_match_all('/<div class=\"score\" aria-label=\"(.*?)<\/div>/s', $content, $appFormStarRating);
        
        
        $aditionalInfoObj = str_get_html($appAditionalInfo[0][0]);
        $aditionalInfo = $aditionalInfoObj->find(".details-section-contents",0)->innertext;


        $formName = strip_tags($appFormName[0][0]);
        $formCatagory = strip_tags($appFormCatagory[0][0]);
        $formTotalReviews = (int) str_replace(',', '', strip_tags($appFormUserRating[0][0]));
        $formStarRatings = (float) str_replace(' ', '', strip_tags($appFormStarRating[0][0]));

        if (count($appFormUserInstals[0]) == 0) {
            $formTotalInstals = "";
        } else {
            $formTotalInstalsInitials = str_replace(' ', '', strip_tags($appFormUserInstals[0][0]));
            $formInstalsString = str_replace(',', '', $formTotalInstalsInitials);
            $formInstalsArray = explode("-", $formInstalsString);
            $formInstalsFrom = (int) $formInstalsArray[0];
            $formInstalsTo = (int) $formInstalsArray[1];
            $formTotalInstalsFromRound = round(($formInstalsFrom / 1000), 1) . 'K';
            $formTotalInstalsToRound = round(($formInstalsTo / 1000), 1) . 'K';
            $formTotalInstals = $formTotalInstalsFromRound . " to " . $formTotalInstalsToRound;
        }

        if (count($appWhatsNew[0]) == 0) {
            $appWhatsNew[0][0] = "<i>Nill</i>";
        }

        $formArray = array(
            'formName' => $formName,
            'formCatagory' => $formCatagory,
            'formTotalReviews' => $formTotalReviews,
            'formStarRatings' => $formStarRatings,
            'formTotalInstals' => $formTotalInstals);

        $resultData = array(
            'appHeadImage' => $imageHtml,
            'test'=>$ratingBox,
            'appHeadTitle' => $appHeadTitle[0][0],
            'appDiscription' => $appDiscription[0][0],
            'appRatings' => $appRatings[0][0],
//            'appWhatsNew' => $appWhatsNew[0][0],
            'appWhatsNew' => $whatsNweHtml,
//            'appAditionalInfo' => $appAditionalInfo[0][0],
            'appAditionalInfo' => $aditionalInfo,
            'formArray' => $formArray
        );
        return $resultData;
    }

//    Not being used
    protected function getData($html) {
        $img = $imgSrc = $title = $link = $price = array();
        preg_match('/<img[^>]+>/i', $html, $img);
        preg_match_all('/src=\"(.*?)\"/s', $img[0], $imgSrc);
        preg_match_all('/title=\"(.*?)\"/s', $html, $title);
        preg_match_all('/s-price(.*?)<\/span>/s', $html, $price);
        preg_match_all('/href=\"(.*?)\"/s', $html, $link);
        $priceDet = '';
        if (!empty($price)) {
            if (isset($price[1][0])) {
                $isFree = strpos($price[1][0], 'Free');
                $priceDet = ($isFree) ? 'Free' : substr($price[1][0], strpos($price[1][0], '$'));
            }
        }
        $imgSr = isset($imgSrc[1][0]) ? $imgSrc[1][0] : '';
        $titleN = isset($title[1][0]) ? $title[1][0] : '';
        $linkN = isset($link[1][0]) ? $link[1][0] : '';
        if (!$priceDet || !$imgSr || !$titleN) {
            return false;
        }
        $data = array('img' => $imgSr, 'title' => $titleN, 'price' => $priceDet, 'link' => $linkN);
        return $data;
    }

    public function purify($input) {
        return strip_tags(filter_var(htmlspecialchars($input), FILTER_SANITIZE_STRING));
    }

}
