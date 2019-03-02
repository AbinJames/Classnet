<?php
session_start();

	require_once 'dbconnect.php';
	
	// it will never let you open index(login) page if session is set
	if ( !isset($_SESSION['user']) ) {
		header("Location: classNET.html");
		exit;
	}
	else{
		$id=$_SESSION['user'];
		$tid=$_GET['tid'];
	}
?>

<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="css/note.css">
  <body>
  	
  			

	  		<form  align = "left" action="" method="post">
	   <?php
		 $query = "SELECT * FROM notes where tid = $tid";
		 $result = $conn->query($query);
	
		 $row = mysqli_fetch_assoc( $result);
		 echo '<div class="note">
            <div class="off">
            <div>
            <div  contenteditable="true" spellcheck="false">
            <span>';echo $row['ntitle'];echo '</span><br />';
            echo'<span id="text">';echo $row['ncontent'];
    echo '</span></div></div></div></div>';
		 	echo "<a href=\"texteditor.php?tid=";echo $tid;echo"\"target=\"_parent\">Edit</a>";
      ?>
      		</form>
      		<button>Summarize</button>
          <button><a href="#" id="downloadLink">Download</a></button>
<br><br><div>5 Sentence Summary</div><span></span>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script type="text/javascript">
function downloadInnerHtml(filename, elId, mimeType) {
    var elHtml = document.getElementById(elId).innerHTML;
    var link = document.createElement('a');
    mimeType = mimeType || 'text/plain';

    link.setAttribute('download', filename);
    link.setAttribute('href', 'data:' + mimeType + ';charset=utf-8,' + encodeURIComponent(elHtml));
    link.click(); 
}

var fileName =  'note.txt'; // You can use the .txt extension if you want

$('#downloadLink').click(function(){
    downloadInnerHtml(fileName, 'text','text/html');
});
</script>
<script type="text/javascript">
	$('button').click(function(){
    var text = $('#text').text();
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script >$('button').click(function(){
    var text = $('#text').text();
    var document = [];
    var stoplist = ["","a", "about", "above", "above", "across", "after", "afterwards", "again", "against", "all", "almost", "alone", "along", "already", "also","although","always","am","among", "amongst", "amoungst", "amount", "an", "and", "another", "any","anyhow","anyone","anything","anyway", "anywhere", "are", "around", "as", "at", "back","be","became", "because","become","becomes", "becoming", "been", "before", "beforehand", "behind", "being", "below", "beside", "besides", "between", "beyond", "bill", "both", "bottom","but", "by", "call", "can", "cannot", "cant", "co", "con", "could", "couldnt", "cry", "de", "describe", "detail", "do", "done", "down", "due", "during", "each", "eg", "eight", "either", "eleven","else", "elsewhere", "empty", "enough", "etc", "even", "ever", "every", "everyone", "everything", "everywhere", "except", "few", "fifteen", "fify", "fill", "find", "fire", "first", "five", "for", "former", "formerly", "forty", "found", "four", "from", "front", "full", "further", "get", "give", "go", "had", "has", "hasnt", "have", "he", "hence", "her", "here", "hereafter", "hereby", "herein", "hereupon", "hers", "herself", "him", "himself", "his", "how", "however", "hundred", "ie", "if", "in", "inc", "indeed", "interest", "into", "is", "it", "its", "itself", "keep", "last", "latter", "latterly", "least", "less", "ltd", "made", "many", "may", "me", "meanwhile", "might", "mill", "mine", "more", "moreover", "most", "mostly", "move", "much", "must", "my", "myself", "name", "namely", "neither", "never", "nevertheless", "next", "nine", "no", "nobody", "none", "noone", "nor", "not", "nothing", "now", "nowhere", "of", "off", "often", "on", "once", "one", "only", "onto", "or", "other", "others", "otherwise", "our", "ours", "ourselves", "out", "over", "own","part", "per", "perhaps", "please", "put", "rather", "re", "same", "see", "seem", "seemed", "seeming", "seems", "serious", "several", "she", "should", "show", "side", "since", "sincere", "six", "sixty", "so", "some", "somehow", "someone", "something", "sometime", "sometimes", "somewhere", "still", "such", "system", "take", "ten", "than", "that", "the", "their", "them", "themselves", "then", "thence", "there", "thereafter", "thereby", "therefore", "therein", "thereupon", "these", "they", "thickv", "thin", "third", "this", "those", "though", "three", "through", "throughout", "thru", "thus", "to", "together", "too", "top", "toward", "towards", "twelve", "twenty", "two", "un", "under", "until", "up", "upon", "us", "very", "via", "was", "we", "well", "were", "what", "whatever", "when", "whence", "whenever", "where", "whereafter", "whereas", "whereby", "wherein", "whereupon", "wherever", "whether", "which", "while", "whither", "who", "whoever", "whole", "whom", "whose", "why", "will", "with", "within", "without", "would", "yet", "you", "your", "yours", "yourself", "yourselves", "the"];
    var sents = text.replace(/\.+/g,'.|').replace(/\?/g,'?|').replace(/\!/g,'!|').split("|");
    sents.pop();
    var i = 0;
    
    //Index sentences in document
    sents.forEach(function(sentencz){
        var wordz = sentencz.split(' ').filter(function(n){return $.inArray(n, stoplist) == -1 });
        document.push(
           {
               sentence : sentencz,
               words: wordz,
               score: 0
           }
       );
       i++;
    });
    
    //Assign word frequencies
    document.forEach(function(arrayItem){    
               var count = 0;
        arrayItem.words.forEach(function(word){
           var match = word;
           document.forEach(function(arrayItem2){
                arrayItem2.words.forEach(function(word2){
                  if(word2 === match)
                      count++;
                });
            });
        });
        count = count/arrayItem.words.length;
        arrayItem.frequency = count;
    });
    
    document.sort(function(a, b) {
      return b.frequency - a.frequency;
    });
    
    //console.log(document);
    
if(document.length >= 6){  $('span').html(document[1].sentence + " " + document[2].sentence + " " + document[3].sentence + " " + document[4].sentence+ " " + document[5].sentence);
}
else
  alert("Please enter atleast 5 sentences");
})</script>
</script></body>
</html>