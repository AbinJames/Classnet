<?php
ob_start();
session_start();
require_once 'dbconnect.php';

  // it will never let you open index(login) page if session is set
if ( !isset($_SESSION['user']) ) {
  header("Location: classNET.html");
  exit;
}
else{
  $id=$_SESSION['user'];
  $query = "SELECT * FROM users WHERE id = $id";
  $result = $conn->query($query);
}
?>
<!DOCTYPE html><html class=''>
<head><style >
.btn-group button {
  background-color: #4CAF50; /* Green background */
    border: 1px solid green; /* Green border */
    color: white; /* White text */
    padding: 10px 24px; /* Some padding */
    cursor: pointer; /* Pointer/hand icon */
    float: left; /* Float the buttons side by side */
  }

  .red {
      -moz-box-sizing:    border-box;
      -webkit-box-sizing: border-box;
      box-sizing:        border-box;
    }

    .red {
      width:100%;
      overflow: hidden;
      padding: 1% 0 0 1%;
    }

  /* Add a background color on hover */
  .btn-group button:hover {
    background-color: #3e8e41;
  }

.article{
  background-color: #fff;
  box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
  margin: 10px 0;
  padding: 15px;
}
.article img{
  max-width: 100%;
}


</style></head><body>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css">
<div class="red">
<div class="btn-group">
 <?php
      $query = "SELECT * FROM notes where id = $id";
      $result = $conn->query($query);
      
      while( $row = mysqli_fetch_assoc( $result) )
      {     
        $tid=$row['tid'];
        echo "<button onclick=\"myFunction("; echo $tid;echo") \">";
        echo $row['ntitle'];
        echo "</button>";

      }
      ?>
</div>
</div>
<div class="red">
<div class="textcontainer" id="display">

</div>
</div>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js'></script>

<script>

//save to var and display below

  function myFunction(tr){
    $.post('inote2.php',{str:tr},function(data){ 
      var savecontent = "Your saved text<div class='article'>" + data + "</div>"+"<a href=\"text.php?id="+tr+"\">Edit</a><br><button id=\"summarise\">Summarize</button><br><br><div>5 Sentence Summary</div><span></span>";
      $("#display").html(savecontent);
      console.log(savecontent);
    });
  }
    $('#summarise').click(function(){
    var text = $('#display').text();
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
    
if(document.length >= 5){  $('span').text(sents[0] + " - " + document[1].sentence + " - " + document[2].sentence + " - " + document[3].sentence + " - " + document[4].sentence);
}
else
  alert("Please enter atleast 5 sentences");
})

      </script>
    </body></html>