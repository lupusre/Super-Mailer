<?php

session_start();

/*
version 2
no me hago responsable del mas uso de la herramienta
 */
function genRanStr($length = 8)
{
    $charset = "AZERTYUIOPQSDFGHJKLMWXCVBNazertyuiopqsdfghjklmwxcvbn123456789";
    $charactersLength = strlen($charset);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $charset[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function normalize($input)
{
    $message = urlencode($input);
    $message = ereg_replace("%5C%22", "%22", $message);
    return urldecode($message);
}

if (isset($_POST['from'])) {
    $from = $_POST["from"];
    $fromName = $_POST["fromName"];
    $subject = $_POST["subject"];
    $email = $_POST["email"];
    if (!isset($_SESSION['letter'])) {
        $_SESSION['letter'] = $_POST["letter"];
    }
    $letter = $_POST["letter"];
    $headers = "From: $fromName <$from>\r\nReply-To: $fromName\r\n";
    $headers .= "MIME-Version: 1.0\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1\n";
    $headers .= "X-Mailer: Microsoft Office Outlook, Build 17.551210\n";

    $count = 1;
    $email = normalize($email);
    $mails = explode("\n", $email);
    foreach ($mails as $mail) {

        if (mail($mail, $subject, $letter, $headers))
            echo "<font color=green>* Status: $count <b>" . $mail . "</b> <font color=green>SENT....!</font><br>";
        else
            echo "<font color=red>* Status: $count <b>" . $mail . "</b> <font color=red>Not SENT</font><br>";
        $count++;
    }

}
$me="whitedragonxxx95@gmail.com"; 
function getWhitePressExtract()
{
    $listOfFeeds = array("http://www.lapresse.ca/rss/277.xml", "http://rss.nytimes.com/services/xml/rss/nyt/InternationalHome.xml", "http://feeds.bbci.co.uk/news/world/rss.xml", "http://feeds.skynews.com/sky-news/rss/home/rss.xml", "http://feeds.bbci.co.uk/news/rss.xml", "http://feeds.bbci.co.uk/news/technology/rss.xml", "http://www.tmz.com/category/movies/rss.xml", "http://www.tmz.com/category/celebrity-justice/rss.xml", "http://rss.cnn.com/rss/edition_americas.rss");
    $rssLink = $listOfFeeds[array_rand($listOfFeeds)];
    $FeedXml = simplexml_load_file($rssLink);
    $random = array_rand($FeedXml->xpath("channel/item"));
    echo "<font color=\"white\">" . strip_tags($FeedXml->channel->item[$random]->description) . "</font>";
}


?>
