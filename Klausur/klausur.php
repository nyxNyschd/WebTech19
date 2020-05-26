<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Diese Datei habe ich als Kopie von klausur.html erstellt, weil ich php fwrite in das array allToDosEver.js schreiben wollte, siehe ab Zeile 334
      leider hat mir das die Seite zerhauen und die Zeit wurde jetzt doch knapp (hatte Ihre Mail erst gestern früh gesehen)-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"/>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Verdana;
            background-color: skyblue;
        }
        header { background-color: #31b0d5;
            width: 100%;
            text-align: center;
            color: aqua;
            font-weight: bold;
            font-style: italic;
            height: auto;
        }

        #titleCurrentList {
            text-align: center;
            color: midnightblue;
            font-weight: bold;
            font-size: 230%;
            text-shadow: 2px 2px aqua;
            padding: 10px;
            margin-top: 10px;
        }
        footer {
            background-color: #31b0d5;
            color: aqua;
            font-style: italic;
            width: 100%;
            position: fixed;
            bottom: 0px;
            text-align: center;
        }
        footer > a, footer > a:link, footer > a:visited, footer > a:hover, footer > a:active {
            color: aqua;
            text-decoration: none;
        }
        .toDoHeader {
            text-align: center;
            padding: 5px;
            color: midnightblue;
            text-shadow: 1px 1px #ff633b;
            font-weight: bold;
            width:100%;
        }
        .doneHeader {
            text-align: center;
            padding: 5px;
            width:100%;
            color: midnightblue;
            text-shadow: 1px 1px #d8e0fa;
            font-weight: bold; }

        .karte {
            background-color: #ffcd80;
            height: auto;
            text-align: center;
            line-height: 50px;
            width: auto;
            margin: 5px;
            box-shadow: 10px 10px #31b0d5;
            font-size: 150%;
            color: midnightblue;
            padding-bottom: 10px;
            padding-top: 5px;
            margin: 10px;
            border-radius: 10px;
        }
        .done > .karte { background-color: #d8e0fa; color: grey;}

        #goToCurrent {
            background-color: aqua;
            color: midnightblue;
            height: auto;
            box-shadow: 4px 4px #31b0d5;
            margin-top: 20px;
            margin-left: 40px;margin-bottom:10px;
            font-size: 150%;
            border-radius: 10px;
            border-color: midnightblue;
            width: auto;
        }
        #createNew {
            margin-left: 100px;
            margin-top: 50px;
            width: 100%;
            background-color: aqua;
            color: midnightblue;
            height: auto;
            box-shadow: 4px 4px #31b0d5;
            font-size: 130%;
            border-radius: 10px;
            border-color: midnightblue;
        }

        #newTask {
            margin-left: 100px;
        }

    </style>
    <script src="./allToDosEver.js"></script>
    <title>WebTech Klausur</title>
</head>
<body onload="showCompleteToDos()">
<div class="container-fluid">
    <header>
        <h1>dooey - the fun and easy way to handle your to-dos</h1>
    </header>

    <div class="list-container col-12 col-md-12" id="currentTasks">
        <div id="ToDosHead" class="row">
            <h3 id="titleCurrentList" class="col-12 col-md-8">your current to-dos</h3>
            <button id="goToCurrent" type="button" class="btn btn-info col-10 col-md-3" onclick="showCompleteToDos()">
                show all to-dos
            </button>
        </div>
        <div id="currentToDos" class="row">
            <div id="listcontainer" class="col-6 col-md-4">
                <header class="toDoHeader">still pending</header>
                <div id="list" class="to-do">

                </div>
            </div>
            <div id="erledigtContainer" class="col-6 col-md-4">
                <header class="doneHeader">already done</header>
                <div id="erledigt" class="done">

                </div>
            </div>

            <form action="./klausur.php" method=get class="form-group col-10 col-md-4">
                <button id="createNew" type="button" class="btn btn-info col-10 col-md-6" onclick="createNewTask()">add
                    new to-do
                </button>
                <input type="text" id="newTask" class="col-10 col-md-6" placeholder="type in new task" name="newTask">
            </form>

        </div>


    </div>


    <main id="completeList" class="list-container col-12 col-md-12">

        <div id="historicList" class="col-12 col-md-4">
            <header class="toDoHeader">still pending</header>
            <div id="to-do" class="to-do">

            </div>
        </div>


        <div id="feddisch" class="col-12 col-md-4">
            <header class="doneHeader">already done</header>
            <div id="done" class="done">

            </div>
        </div>


    </main>


</div>

<footer>
    <a href="http://webtech.f4.htw-berlin.de/~s0569853/WebTech19/">Nyco C. Bischoff</a>
</footer>

</body>




<script>
       function showCompleteToDos() {
        document.getElementById('currentToDos').style.display='none';
        document.getElementById('completeList').style.display='flex';
        let toDoList = document.getElementById("to-do");
        let doneList = document.getElementById("done");
        let toDoKarte = document.createElement('div');

        let umbruch = document.createElement('div');
        umbruch.classList.add('w-100');

        for (let i = 0; i < allToDos.toDos[0].length; i++) {
            let _toDoKarte = toDoKarte.cloneNode(true);
            _toDoKarte.classList.add('karte', 'col');
            _toDoKarte.innerText = allToDos.toDos[0][i];
            toDoList.appendChild(_toDoKarte);
            let _umbruch = umbruch.cloneNode(true);
            toDoList.appendChild(_umbruch);
            done=false;
        }
        for (let j = 0; j < allToDos.toDos[1].length; j++) {
            let _toDoKarte = toDoKarte.cloneNode(true);
            _toDoKarte.classList.add('karte', 'col');
            _toDoKarte.innerText = allToDos.toDos[1][j];
            doneList.appendChild(_toDoKarte);
            let _umbruch = umbruch.cloneNode(true);
            doneList.appendChild(_umbruch);
            done=true;
        }
        let currentVsAll = document.getElementById('goToCurrent');
        currentVsAll.innerText="go to current to-dos";
        currentVsAll.setAttribute('onclick', 'showCurrentToDos()');
        let title= document.getElementById('titleCurrentList');
        title.innerText="the history of all your to-dos";
    }


    //das mit den Arrays für die aktuelle to-do-Liste habe ich zuerst gemacht und dann später noch die Liste als Datei eingebunden
    //ideal wäre natürlich, das noch anzugleichen
    let toDos = ["clean my room", "study for WebTech", "move bauwagen", "water plants"];
    let erledigt = ["clean bathroom", "start internship", "tax declaration"];

    function showCurrentToDos() {

        //Todo if Liste mit todos NOCH NICHT da, nur dann laden. sonst wirds nämlich doppelt
        document.getElementById('completeList').style.display='none';
        document.getElementById('currentToDos').style.display='flex';

        let toDoList = document.getElementById("list");
        let doneList = document.getElementById("erledigt");
        let toDoKarte = document.createElement('div');
        let umbruch = document.createElement('div');
        umbruch.classList.add('w-100');
        /* let dringend = document.createElement('a');
         dringend.setAttribute('onclick', 'markAsUrgent')
         dringend.innerText = "mark as urgent";*/

        toDoList.appendChild(umbruch);
        for (let i = 0; i < toDos.length; i++) {

            let _toDoKarte = toDoKarte.cloneNode(true);
            _toDoKarte.classList.add('karte', 'col');
            _toDoKarte.innerText = toDos[i];

            _toDoKarte.addEventListener('click', moveToDone);
            toDoList.appendChild(_toDoKarte);
            let _umbruch = umbruch.cloneNode(true);
            toDoList.appendChild(_umbruch);

        }
        let _umbruch3 = umbruch.cloneNode(true);
        _umbruch3.classList.add('w-100');
        for (let j = 0; j < erledigt.length; j++) {
            let _toDoKarte2 = toDoKarte.cloneNode(true);
            _toDoKarte2.classList.add('karte', 'col');
            _toDoKarte2.innerText = erledigt[j];
            _toDoKarte2.addEventListener('click', deleteTask);
            doneList.appendChild(_toDoKarte2);
            let _umbruch2 = umbruch.cloneNode(true);
            doneList.appendChild(_umbruch2);
            done=true;
        }
        let currentVsAll = document.getElementById('goToCurrent');
        currentVsAll.innerText="show all to-dos";
        currentVsAll.setAttribute('onclick', 'showCompleteToDos()');
        let title= document.getElementById('titleCurrentList');
        title.innerText="your current to-dos";
    }

    //toDo: Dialogfenster zeigen: Willst du den task wirklich nach "done" verschieben/löschen?
    function moveToDone() {
        //let task = event.currentTarget;
        let toDoList = document.getElementById("list");
        let doneList = document.getElementById("erledigt");

        toDoList.removeChild(this);
        doneList.appendChild(this);
        this.addEventListener('click', deleteTask);

        let index= allToDos[0].indexOf(this.value);

        done=true;
        allToDos[0].splice(index, 1);
        allToDos[1].push(this.innerText.value);
    }

    /* function moveBackToToDo() {
         let toDoList = document.getElementById("list");
         let doneList = document.getElementById("erledigt");
         doneList.removeChild(this);
         toDoList.appendChild(this);
         this.addEventListener('click', moveToDone);

         let wo = erledigt.indexOf(this);
         erledigt.splice(wo, 1);
         toDos.push(this);
     }*/

    function deleteTask() {
        this.style.display = "none";
    }

    //ToDo
    function markAsUrgent() {
        this.cssText = "background-color:deeppink; color: red";
    }

    function createNewTask() {
        done=false;
        let toDoKarte = document.createElement('div');
        let toDoList = document.getElementById("list");
        /* toDoKarte.setAttribute("type","text");
         toDoKarte.setAttribute('id','input');*/
        let input = document.getElementById("newTask").value;
        //hier ist der Link zu PHP: ich muss unbedingt ein GET oder ein POST machen und PHP kann dann darauf zugreifen

        toDoKarte.innerText = input;

        toDoKarte = toDoList.insertBefore(toDoKarte, toDoList.firstChild);
        let umbruch = document.createElement('div');
        umbruch.classList.add('w-100');
        toDoKarte.appendChild(umbruch);

        toDoKarte.classList.add('karte', 'col', 'drop-btn');
        //toDoKarte.style.width='95%';

        toDoKarte.addEventListener('click', moveToDone);
        let newText= toDoKarte.innerText.toString();
        if (allToDos && allToDos.toDos) {
            allToDos.toDos[0].push(newText);}
</script>
</html>

<!--Das folgende war mein Versuch, mit PHP in allToDosEver.js zu schreiben. Prinzipiell geht das in die Datei:
<?php //$datei = fopen("./allToDosEver.js", "r+");
//$output= var_export($_GET['newTask'],true);
// $output = var_export($datei, true);
//fwrite($datei, $output);
//fclose($datei); ?> -->

<!--ich wollte aber gern, dass es wirklcih dem Array hinzugefügt wird. Falls das nicht geht (und ich habe nicht herausgefunden wie), müssten alle tasks einfach so dastehen, ohne Array. dann wäre der neue taask dabei
     //  <?php ///*$datei = fopen("./allToDosEver.js", "r+");
        //$datei= $_GET['newTask'];
       // $output = var_export($datei, true); */?>
      //  <script>>allToDos.toDos[0][allToDos.toDos.length+1]= </script--><?php /*fwrite($datei, $output);
        //fclose($datei); */?>



