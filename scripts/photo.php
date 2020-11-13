<?php

/* This script uses a wikipedia page with list of links. It scrapes
 * the source link of the images in all those links.
 *
 * Be sure to change $url before executing.
 *
 * It prints all the links in the console. You can use the linux cmd
 * 		php photo.php > file
 * to get all the links
 *
 */
	
//change this link
$url = "http://en.wikipedia.org/wiki/List_of_female_billionaires";

$doc = new DOMDocument('1.0');
$doc->loadXML(file_get_contents($url));
$mw = $doc->getElementsByTagName("a");
foreach ($mw as $link ){
$href = $link->getAttribute("href");
if(substr($href,0,5)=="/wiki" & 
substr($href,6,4)!="File" & 
substr($href,6,4)!="Help" & 
substr($href,6,9)!="Wikipedia" & 
substr($href,6,6)!="Portal" & 
substr($href,6,7)!="Special" & 
substr($href,6,4)!="List" & 
substr($href,6,4)!="Main" & 
substr($href,6,4)!="Talk" & 
substr($href,6,8)!="Category"  
){
checkifimg($href);
}
}
body {
	font-family: Tahoma;
	margin: 0;
	padding: 0;
	text-align: center;
}
a {
	text-decoration: none;
	color: darkblue;
}
a:hover {
	text-decoration: underline;
}
img {
	width: 175px;
	height: 250px;
	border: 2px solid #aaa;
}
#header {
	background-color: #8C1B08;
	color: #fff;
	padding: 5px;
}
#header a{
	color: #fff;
	text-decoration: none;
}
#main table {
	margin: 0 auto;
}
#footer {
	font: 12px Tahoma;
	margin: 25px 0 50px 0;
}
#footer a {
	margin-right: 10px;
}
function checkifimg($in){
$page= new DOMDocument('1.0');
$page->loadXML(file_get_contents("http://en.wikipedia.org".$in));
$a = $page->getElementsByTagName("a");
foreach ($a as $l){
if($l->getAttribute("class")=="image"){
$img= $l->getElementsByTagName("img");
foreach ($img as $image)
echo $image->getAttribute("src")."\n";
//echo "http://en.wikipedia.org/wiki/".substr($l->getAttribute("href"),6)."\n";
break;
}
}
}


?>
