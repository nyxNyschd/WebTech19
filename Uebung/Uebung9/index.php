<!DOCTYPE html>
<html lang="de">

    <?php
    require_once "./player.php";
    ?>
    <style>
        header{width:100%; background-color: #888888; text-align:center; height: 80px }
        h1{color:white; padding: 10px}
        footer{position: absolute; bottom:0px;background-color:#888888; width:100%; text-align:center }
        footer>a, footer>a:visited, footer>a:hover, footer>a:link{ text-decoration:none; color:white; text:bold}
        #butt{background-color:#0082D1; color: white; border-radius: 5px; padding: 5px; margin: 5px}
        #in {width:80%; padding: 5px; margin: 5px}

        @media screen and (max-width: 768px){
            #mitte{display: none};
        }
        #main {width:100%}

    </style>
    <title>Uebung 9</title>

</head>
<div class="container-fluid">

    <header>
        <h1 id="ueberschrift">Ein Spiel</h1>

    </header>
    <body>

    <div id="main" class= "row" >
        <div id="links" class="col-sm-12 col-md-3">
            <!-- wenn kleiner view: eine ganze Spalte allein -->
            <h3> Auswahl Spielerin</h3>
            <ul class="list-group">
                <?php
                for($i=0; $i<count($player);$i++){
                    echo '<li> <a href="index.php? id='.$i.'"> '.$player[$i]["name"].'('.$player[$i]["moves"].')</a> </li>';
                }
                if (isset($_GET))
                {

                }
                ?>

        </div>

        <div id="mitte" class="col-md-2"   >

            <h3> oder</h3>
        </div>

        <div id="rechts" class="col-sm-12 col-md-7"  >
            <h3> Neue Spielerin anlegen</h3>
            <form action="index.php" method="post">
               <!-- <label for #newPlayer></label> -->
                <input type="text" placeholder="Name" name="spielerin" id="in">
                <button id="butt" type="submit">Neue Spielerin anlegen</button>
            </form>
        </div>
    </div>
</div>

<script>
    function createFocus(event){
        let plays = event.currentTarget[name];
        document.getElementById("ueberschrift").innerHTML= plays+" spielt";
    }

</script>

</body>

<footer>
    <a href="http://webtech.f4.htw-berlin.de/~s0569853/WebTech19/Uebung/">Nyco C.Bischoff</a>
</footer>
</html>