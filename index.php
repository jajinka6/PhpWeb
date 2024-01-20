<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Oběšenec</title>
</head>
<body>
 
    <?php
    
        $won = false;
        $letters = " ";
        $tries = 0;
        $triesCount = "";
        $win = "";
        $triesDiv = "";
        $panel="";
        parseTries();
    
        if(isset($_POST['a'])) { 
			IsInWord("a");
		} 
		else if(array_key_exists('b', $_POST)) { 
			IsInWord("b"); 
		}
		else if(array_key_exists('c', $_POST)) { 
		    IsInWord("c"); 
		}
		else if(array_key_exists('d', $_POST)) { 
			IsInWord("d"); 
		}
		else if(array_key_exists('e', $_POST)) { 
			IsInWord("e"); 
		} 
		else if(array_key_exists('f', $_POST)) { 
			IsInWord("f"); 
		} 
		else if(array_key_exists('g', $_POST)) { 
			IsInWord("g");
		} 
		else if(array_key_exists('h', $_POST)) { 
			IsInWord("h"); 
		} 
		else if(array_key_exists('i', $_POST)) { 
			IsInWord("i"); 
		} 
		else if(array_key_exists('j', $_POST)) { 
			IsInWord("j"); 
		} 
		else if(array_key_exists('k', $_POST)) { 
			IsInWord("k"); 
		} 
		else if(array_key_exists('l', $_POST)) { 
			IsInWord("l"); 
		} 
		else if(array_key_exists('m', $_POST)) { 
			IsInWord("m"); 
		} 
		else if(array_key_exists('n', $_POST)) { 
			IsInWord("n"); 
		} 
		else if(array_key_exists('o', $_POST)) { 
			IsInWord("o"); 
		} 
		else if(array_key_exists('p', $_POST)) { 
			IsInWord("p");; 
		} 
		else if(array_key_exists('q', $_POST)) { 
			IsInWord("q"); 
		} 
		else if(array_key_exists('r', $_POST)) { 
			IsInWord("r"); 
		}
		else if(array_key_exists('s', $_POST)) { 
			IsInWord("s"); 
		}
		else if(array_key_exists('t', $_POST)) { 
			IsInWord("t"); 
		}
		else if(array_key_exists('u', $_POST)) { 
			IsInWord("u"); 
		}
		else if(array_key_exists('v', $_POST)) { 
			IsInWord("v"); 
		}
		else if(array_key_exists('w', $_POST)) { 
			IsInWord("w");
		}
		else if(array_key_exists('x', $_POST)) { 
			IsInWord("x"); 
		}
		else if(array_key_exists('y', $_POST)) { 
			IsInWord("y"); 
		}
		else if(array_key_exists('z', $_POST)) { 
			IsInWord("z"); 
		}
		
		 if(array_key_exists('newg', $_POST)) { 
		        selectWord(); 
		    }
		
        fillLetters();
		
		if($won){
		    file_put_contents('letterFile.txt', '');
		    file_put_contents('tries.txt', '12');
		    $panel = "<form class=\"panel\" method=\"post\">
            <div class=\"textHolder\">Vyhrál jste :)</div>
            <div class=\"textHolder\"> Zbylé pokusy: " . $tries . "</div>
            <button class=\"newGame\" name=\"newg\">Nová hra?</button>
            </form>";
		}
		
		if ($tries == 0) {
		    file_put_contents('letterFile.txt', '');
		    file_put_contents('tries.txt', '12');
		    $curr = fopen("current.txt", "r");
		    $word = fgets($curr);
		    $panel = "<form class=\"panel\" method=\"post\">
            <div class=\"textHolder\">Prohrál jste.</div>
            <div class=\"textHolder\">Neuhádl jste slovo: $word</div>
            <button class=\"newGame\" name=\"newg\">Nová hra?</button>
            </form>";
            fclose($curr);
		}
		
		function selectWord() {
		    $word;
		    $wordsFile = fopen("words.txt", "r");
            $randomNum = rand(1,22);
            
            for ($i = 1; $i <= $randomNum; $i++) {
                $word = fgets($wordsFile);
            }
            
            $currWordFile = fopen("current.txt", "w");
            fwrite($currWordFile, trim($word,"\n"));
            fclose($wordsFile);
            fclose($currWordFile);
		}
		
		function isInWord($letter) {
		    global $tries;
		    $word = fopen("current.txt", "r");
		    $letterFile = fopen("letterFile.txt", "r+");
		    
		    if(substr_count(fgets($word), $letter)) {
		        if(!substr_count(fgets($letterFile), $letter)) {
		            fwrite($letterFile, $letter);
		        }
		    }
		    else{
		        $tries--;
		        $myfile = fopen("tries.txt", "w") or die("tries");
		        fwrite($myfile, $tries);
		        fclose($myfile);
		    }
		    
		    global $triesCount;
		    $triesCount = "<div class = \"tries\">Pokusy: $tries /12</div>";
		    fclose($letterFile);
		    fclose($word);
		}
		

		function fillLetters(){
		    global $letters;
		    $wordFile = fopen("current.txt", "r");
		    $word = fgets($wordFile);
		    $wordLength = strlen($word);
		    fclose($wordFile);
		    
            $letterFile = fopen("letterFile.txt", "r");
            $letter = fgets($letterFile);
            fclose($letterFile);
            
            $howMany = 0;
            for($i = 0; $i < $wordLength; $i++) {
                if(substr_count($letter, $word[$i])){
                    $letters = $letters . "<div class = \"letter\">". $word[$i] ."</div>";
                    $howMany = $howMany + 1;
                } 
                else {
                    $letters = $letters . "<div class = \"letter\"></div>";
                } 
                     
            }
            if($howMany == $wordLength){
                global $won;
                $won = true;
            }     
		}
		function parseTries(){
		    global $tries;
		    $triesFile = fopen("tries.txt", "r") or die("tries");
		    $tries = intval(fgets($triesFile));
		    fclose($triesFile);
		}
		
    ?>
<style>
@import url('https://fonts.googleapis.com/css2?family=Nunito:wght@700&display=swap');

body {
    margin:0;
	background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
	background-size: 400% 400%;
	animation: gradient 15s ease infinite;
	height: 100vh;
	font-family: 'Nunito', sans-serif;
	font-size: 50px;
	overflow: hidden;
}

@keyframes gradient {
	0% {
		background-position: 0% 50%;
	}
	50% {
		background-position: 100% 50%;
	}
	100% {
		background-position: 0% 50%;
	}
}

    img {
        visibility: hidden;
    }

    .klavesnice {
        z-index:1;
        -webkit-user-select: none;
        margin:auto;
        margin-top: 20%;
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        align-items: center;
        width: 820px;
        height: 300px;
        background-color: rgba(39, 38, 53, .8);
        border-radius: 25px;
        padding-left: 55px;
        border: solid rgba(232, 233, 243, .5);
        box-shadow: 1px 1px 40px black;
    }
    .klavesy {
        -webkit-user-select: none;
        font-family: 'Nunito', sans-serif;
        border: outset #CECECE;
        cursor: pointer;
        height: 60px;
        width: 60px;
        background-color: rgba(141, 158, 198, 0.5);
        color: white;
        border-radius: 10px;
        text-align: center;
        font-size: 40px;
        transition: 0.5s;
        text-shadow: 1px 1px 1px black;
    }
    .klavesy:hover {
        transform: scale(1.2);
    }
    .d {
        cursor: auto;
        visibility: none;
        border: none;
    }
    
    .word_holder {
        z-index:1;
        -webkit-user-select: none;
        display: flex;
        align-items: center;
        height: 100px;
        width: fit-content;
        gap: 30px;
        margin: auto;
        margin-top:70px;
        background-color: rgba(39, 38, 53, .7);
        border: solid rgba(232, 233, 243, .5);
        border-radius: 25px;
        padding-left: 30px;
        padding-right:30px;
        box-shadow: 1px 1px 40px black;
    }
    
    .letter {
        height: 60px;
        width: 60px;
        border-bottom:solid #CECECE;
        text-align:center;
        color:white;
        text-shadow: 1px 1px 1px black;
    }
    
    .panel {
        height: 300px;
        width: 500px;
        box-shadow: 1px 1px 40px black;
        z-index = 3;
        border-radius: 10px;
        position:absolute;
        margin-left: 700px;
        margin-top:40px;
        background-color: rgba(39, 38, 53, .8);
        border: solid rgba(232, 233, 243, .5);
        opacity:0; 
        animation: popUp .5s linear 0s 1 forwards;
    }
    
    .textHolder {
        height: 60px;
        width: 400px;
        margin: auto;
        margin-top: 20px;
        text-align: center;
        color: white;
        font-size: 35px;
        text-shadow: 1px 1px 2px red, 0 0 1em blue, 0 0 0.2em blue;
    }
    
    .tries {
        position:absolute;
        z-index: 3;
        font-size: 50px;
        top: 20px;
        left: 20px;
        color:white;
        text-shadow: 1px 1px 2px #e73c7e, 0 0 1em #23a6d5, 0 0 0.2em #23a6d5;
    }
    
    .newGame {
        height: 50px;
        width: 300px;
        background-color: black;
        margin-left: 100px;
        margin-top: 50px;
        text-align: center;
        border-radius: 10px;
        color: white;
        background: linear-gradient(-45deg,#e73c7e, #23a6d5);
        transition: 0.5s;
        cursor: pointer;
        font-family: 'Nunito', sans-serif;
        font-size: 25px;
       
    }
    
    .newGame:hover {
        transform: scale(1.2);
    }
    
    @keyframes popUp {
        0%{
            transform: scale(0.5);
            opacity: 0;
        }
        100%{
            transform: scale (1);
            opacity: 1;
        }
    }
    
    
</style>




</body>
<?php echo $triesCount; ?>
<div class="word_holder">
    <?php echo $letters; ?>
</div>
        <?php echo $panel; ?>
    <form class="klavesnice" method="post"> 
        <button class="klavesy" type="submit" method="post" name="a">a</button>
        <button class="klavesy" name="b">b</button>
        <button class="klavesy" name="c">c</button>
        <button class="klavesy" name="d">d</button>
        <button class="klavesy" name="e">e</button>
        <button class="klavesy" name="f">f</button>
        <button class="klavesy" name="g">g</button>
        <button class="klavesy" name="h">h</button>
        <button class="klavesy" name="i">i</button>
        <button class="klavesy" name="j">j</button>
        <button class="klavesy" name="k">k</button>
        <button class="klavesy" name="l">l</button>
        <button class="klavesy" name="m">m</button>
        <button class="klavesy" name="n">n</button>
        <button class="klavesy" name="o">o</button>
        <button class="klavesy" name="p">p</button>
        <button class="klavesy" name="q">q</button>
        <button class="klavesy" name="r">r</button>
        <button class="klavesy" name="s">s</button>
        <button class="klavesy" name="t">t</button>
        <button class="klavesy" name="u">u</button>
        <div class="klavesy d" style="background-color:rgba(0,0,0, 0);"></div>
        <button class="klavesy" name="v">v</button>
        <button class="klavesy" name="w">w</button>
        <button class="klavesy" name="x">x</button>
        <button class="klavesy" name="y">y</button>
        <button class="klavesy" name="z">z</button>
    </form>
</html>
