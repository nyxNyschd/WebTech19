<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"/>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Verdana

        }

        header {
            background-color: #f5f5f5;
            width: 100%;
            text-align: center;
            color: #A9A9A9;
            font-weight: bold;
            position: absolute;
            top: 0px;
            z-index: 1000;
        }

        footer {
            background-color: #f5f5f5;
            width: 100%;
            position: fixed;

            bottom: 0px;
            text-align: center;

        }

        footer > a, footer > a:link, footer > a:visited, footer > a:hover, footer > a:active {
            color: #A9A9A9;
            text-decoration: none;
        }

        #loadFile {
            text-align: center;
            color: white;
            background-color: #31b0d5;
            width: 90%;
            margin-left: 10px;
        }

        #kopie {
            height: 50px;
            background-color: lightgray;
            width: 100%;
            margin-left: 10px;
        }

        h5 {
            font-weight: bold
        }

        #original {
            width: 90%;
            margin-left: 10px;
        }

        #main1 {
            padding-top: 70px
        }

        #copy {
            margin-right: 10px;
            margin-top: 10px;
            color: white;
            background-color: red;
        }

        #save {
            margin-left: 10px;
            margin-top: 10px;
            color: white;
            background-color: #31b0d5;
        }


    </style>


    <title>Probeklausur 3</title>
</head>
<body>
<div class="container-fluid">
    <header>
        <h1>WebTech-Klausur</h1>

    </header>

    <main id="main1" class="row">
        <div id="links" class="col-12 col-md-6">
            <form class="form-group">
                <div class="row">
                    <a href="#" class="btn btn-info btn-block" id="loadFile" onclick="loadText()">Datei
                        laden</a>
                </div>

                <div class="row">
                    <label for="original"><h5>Original: </h5></label>
                    <textarea id="original" type="text" name="original" rows="15">
                    </textarea>
                </div>

                <div class="row col-12 col-md-12">
                    <button class="btn btn-group btn-block col-4 col-md-4" type="submit" method="GET" name="copy" id="copy" onclick="copyThis()">Kopieren</button>
                    <button class="btn btn-group btn-block col-7 col-md-7 " type="submit" method="POST" action="./sources/text.txt"name="save" id="save">Text speichern
                    </button>
                </div>

            </form>
            <h5>Suchbegriffe : </h5>
            <div class="row" id="suchWords"></div>

        </div>

        <div id="rechts" class="col-12 col-md-6">
            <div class="row">
                <input type="text" id="suche" class="form-control" name="suche"placeholder="Suche">

                <h5 class=" col-12">Kopie : </h5>
                <div class="row col-12 " id="kopie">
                    <div id="main2" class="row"></div>
            </div>

        </div>


    </main>

    </div>




</div>

<footer>
    <a href="http://webtech.f4.htw-berlin.de/~s0569853/WebTech19/">Nyco C. Bischoff</a>
</footer>

</body>

<script>
    let text;
    function loadText() {
        let textfeld = document.getElementById('original');

        //AJAX-request mit XMLHttpRequest (klappt :) )
        let file = new XMLHttpRequest();
        file.open("GET", "./sources/text.txt", true);
        file.onload = function () {
            let text = file.responseText;
            textfeld.innerHTML = text;
        };
        file.send(null);

        //AJAX-request mit fetch() API
        //fetch('./sources/text.txt')
        //  .then(response => response.json()) --> es gibt keine .txt() Methode und das Ergebnis von .json() ist undefined
        // .then(result => text = `${result}`); // leider wird hier ein Object als result zurückgegeben, das Ergebnis ist also
        //  textfeld.innerHTML=text;       // immer noch undefined bzw [object response], wenn ich´s loggen will - auch mit ${}


        //Versuch mit file-Reader (klappt nicht)
        /* let reader = new FileReader();
          reader.onload = function (e){
              let output =e.target.result;
              textfeld.innerHTML =output;
          }
        let output = reader.readAsText();
        textfeld.innerHTML = output;
*/
        //Versuch mit jQuery (klappt auch nicht)
        /* jQuery.get('./sources/text.txt', function(data){
             textfeld.innerText= alert(data);

         })*/
    }

    function copyThis(){
        let textfeld = document.getElementById('original');
        let kopie = document.getElementById('kopie');

       /* <?php if(isset($_POST["copy"])) ?>{

           let _text = textfeld.cloneNode(true);
          document.createTextNode(_text);
           kopie.appendChild(_text);  }*/

      //  let copy = event.currentTarget;
        let _text= textfeld.cloneNode(true);
            kopie.appendChild(_text);
        }



</script
</html>