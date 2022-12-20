<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Download</title>
    <style type="text/css">
        ul { list-style: none; margin: 0; padding: 0; }
        li { margin: .2em 0; }
        
        #info label { 
            float: left; 
            width: 200px; 
            margin-right: 15px; 
            text-align: right; 
        }
    </style>
</head>
<body>
    <div>
        <h1>Nao<b>energy</b>SA</h1>
        <ul id="info">
            <li><label>NPA:</label> {{$fichierVT[0]->npa}}</li>
            <li><label>Date de Construction:</label> {{$fichierVT[0]->date_construction}}</li>
            <li><label>Nombre de Panneaux:</label> {{$fichierVT[0]->nbre_panneaux}}</li>
            <li><label>Puissance:</label> {{$fichierVT[0]->puissance}}</li>
            <li><label>Marque:</label> {{$fichierVT[0]->marque}}</li>
            <li><label>Type Onduleur:</label> {{$fichierVT[0]->type_onduleur}}</li>
            <li><label>Batteries:</label> {{$fichierVT[0]->batteries}}</li>
            <li><label>commentaires:</label> {{$fichierVT[0]->commentaire}}</li>
            <li><label>Rendez-vous VT:</label> {{$fichierVT[0]->rdv_vt}}</li>
            <li><label>Rendez-vous RBE:</label> {{$fichierVT[0]->rdv_rbe}}</li>
        </ul>
    </div>
</body>
</html>