<!doctype html>

<html lang="en">



<head>

    <!-- Required meta tags -->

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">



    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
     <link rel="stylesheet" href="style2.css">


    <title>Hello, world!</title>

</head>



<body>

     <header>
          <nav class="navbar justify-content-center">
               <a href="#">logo-atom</a>
               <a href="#">meta</a>
               <a href="#">deck</a>
               <a href="#">event</a>
               <a href="#">carte</a>
          </nav>
     </header>
     <main>

    <h1 id="carte">Rechercher une carte</h1>
     <div class="container">

          <form class="form-control"  id="inscForm">

               <label>nom de la carte</label>

               <input type="text" name="recherche" id="recherche" autocomplete="off">

               <!--<button class="btn btn-primary" type="submit" id="sub">rechercher une carte</button>-->

          </form>
     </div>
<div id="infoCard">
     <p id="nameCard"></p>
     <img src="" id="imgCard">
     <p id="descCard"></p>
     <p id="atkCard"></p>
     <p id="defCard"></p>
     <p id="typeCard"></p>
     <p id="levelCard"></p>
     <p id="raceCard"></p>
     <p id="attributeCard"></p>
     <p id="archetypeCard"></p>
</div>
<button type="button" id="fr">fr</button>
    <!-- Optional JavaScript -->

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

</main>
    <script
			  src="https://code.jquery.com/jquery-1.12.4.js"
			  integrity="sha256-Qw82+bXyGq6MydymqBxNPYTaUXXq7c8v3CwiYwLLNXU="
			  crossorigin="anonymous"></script>
    <script
			  src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"
			  integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30="
			  crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <!--<script src="js/ajax.js"></script>-->

    <script>

$(document).ready(function(){
    $('#recherche').autocomplete({
         minLength : 3 ,
         position : {
              at : 'top; left:-100px',

   },
         select:function( event, ui){
              //alert(ui.item.name);
              var regex = /:/gi;
              var regex2 = /\./gi;
              var regex3 = /;/gi;
              document.getElementById("nameCard").innerHTML = ui.item.name;
              document.getElementById("descCard").innerHTML = ui.item.desc.replace(regex, ":<br>").replace(regex2, ".<br>").replace(regex3, ";<br>");
              document.getElementById("imgCard").src = "https://ygoprodeck.com/pics/"+ ui.item.id +".jpg";
              document.getElementById("atkCard").innerHTML = ui.item.atk;
               document.getElementById("defCard").innerHTML = ui.item.def;
               document.getElementById("typeCard").innerHTML = ui.item.type;
               document.getElementById("levelCard").innerHTML = ui.item.level;
               document.getElementById("raceCard").innerHTML = ui.item.race;
               document.getElementById("attributeCard").innerHTML = ui.item.attribute;
               document.getElementById("archetypeCard").innerHTML = ui.item.archetype;
               document.getElementById("fr").style.display = "inline";

               $("#fr").click(function(){
               $.ajax({

                      url : 'https://db.ygoprodeck.com/api/v2/cardinfo.php?name=' + ui.item.id + '&la=french', // on appelle le script JSON

                      //dataType : 'json', // on spécifie bien que le type de données est en JSON

                      success : function(objet){
                      document.getElementById("nameCard").innerHTML = objet[0][0].name;
                      document.getElementById("descCard").innerHTML = objet[0][0].desc.replace(regex, ":<br>").replace(regex2, ".<br>").replace(regex3, ";<br>");
                      document.getElementById("typeCard").innerHTML = objet[0][0].type;
                      document.getElementById("raceCard").innerHTML = objet[0][0].race;
                      document.getElementById("attributeCard").innerHTML = objet[0][0].attribute;
                      document.getElementById("archetypeCard").innerHTML = objet[0][0].archetype;

                 }})
            });
         },


        source : function(requete, reponse){ // les deux arguments représentent les données nécessaires au plugin

        $.ajax({

                url : 'https://db.ygoprodeck.com/api/v2/cardinfo.php?fname='+$('#recherche').val(), // on appelle le script JSON

                //dataType : 'json', // on spécifie bien que le type de données est en JSON

                data : {

                    name_startsWith : $('#recherche').val(), // on donne la chaîne de caractère tapée dans le champ de recherche

                    maxRows : 15

                },



                success : function(donnee){

                    reponse(donnee[0]);
               //console.log(function(objet){
                   //return objet.name; // on retourne cette forme de suggestion


                }

            });

        }

    })
    .autocomplete('instance')._renderItem = function (ul, item) {
         return $('<li>')
         .append('<img src=https://ygoprodeck.com/pics_small/'+item.id+'.jpg> ')
         .append(item.name)
         .appendTo('ul');
    }

});

/*
var liste = [

    { value : 'Draggable', label : 'Draggable', desc : 'L\'interaction Draggable permet de déplacer un élément.' },

    { value : 'Droppable', label : 'Droppable', desc : 'L\'interaction Droppable permet de recevoir un élément.' },

    { value : 'Resizable', label : 'Resizable', desc : 'L\'interaction Resizable permet de redimensionner un élément.' }

];


$('#recherche').autocomplete({

    source : liste,



    select : function(event, ui){ // lors de la sélection d'une proposition
    var descr = document.getElementById('desc');
    var desk = document.createElement("p");
     desk.textContent = ui.item.desc;
     descr.appendChild(desk);
          console.log(descr);
          //return ui.item.desc;


    }

});
*/
    </script>





</body>



</html>
