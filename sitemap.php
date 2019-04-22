<html>
<head>
<title>Site Map</title>
<!-- A php script from UrgentClick.com -->
<style>
body {font-family: verdana; line-height: 1.2 }
/* Indent Styles */
.0 { text-indent: 0px;  font-size: 12pt; font-weight: bold }
.1 { text-indent: 20px; font-size: 11pt }
.2 { text-indent: 40px; font-size: 10pt }
.3 { text-indent: 50px; font-size: 8pt }
.4 { text-indent: 60px; font-size: 8pt }
.5 { text-indent: 70px; font-size: 8pt }
</style>
</head>
<body>
<?php 
// starting directory. Dot means current directory
$basedir = ".";

// function to count depth of directory 
function getdepth($fn){
  return (($p = strpos($fn, "/")) === false) ? 0 : (1 + getdepth(substr($fn, $p+1)));
}

// function to print a line of html for the indented hyperlink
function printlink($fn){
  $indent = getdepth($fn); // get indent value
  echo "<li class=\"$indent\"><a href=\"$fn\">"; //print url
	$handle = fopen($fn, "r"); //open web page file
	$filestr = fread($handle, 1024); //read top part of html
	fclose($handle); //clos web page file
	if (preg_match("/<title>.+<\/title>/i",$filestr,$title)) { //get page title
	    echo substr($title[0], 7, strpos($title[0], '/')-8); //print title
	} else {
	    echo "No title";
	}
  echo "</a></li><br>\n"; //finish html
}

// main function that scans the directory tree for web pages 
function listdir($basedir){
    if ($handle = @opendir($basedir)) { 
        while (false !== ($fn = readdir($handle))){ 
            if ($fn != '.' && $fn != '..'){ // ignore these
                $dir = $basedir."/".$fn; 
                if (is_dir($dir)){ 
                    listdir($dir); // recursive call to this function
                } else { //only consider .html etc. files
                    if (preg_match("/[^.\/].+\.(htm|html|php)$/",$dir,$fname)) {
                       printlink($fname[0]); //generate the html code
                    }
								} 
            } 
        } 
        closedir($handle); 
    } 
} 
// function call 
listdir($basedir); //this line starts the ball rolling
?>
</body>
</html>
