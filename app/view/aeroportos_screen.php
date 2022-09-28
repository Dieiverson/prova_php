<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" href="{{BASE ~ '/public/css/aeroportos.css'}}" rel="stylesheet" /> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>    
    <title>Aeroportos</title>
</head>
{% include './partials/menu.php' %}
<body>
    <div class="wrapper">
        <h1>Listagem de Aeroportos</h1>
        <div style="display:table;margin:auto;margin-bottom:10px;">
            <a class="btn btn-success" href="{{BASE}}/Aeroporto/Cadastrar">+ Novo Aeroporto</a>
        </div>
        <table class="c-table">
            <thead class="c-table__header">
                <tr>               
                <th class="c-table__col-label">Nome</th>
                <th class="c-table__col-label">Sigla</th>
                <th class="c-table__col-label">#</th>              
                </tr>
            </thead>
            <tbody class="c-table__body">
                {% for aeroporto in aeroportos %}                  
                    <tr>                   
                        <td class="c-table__cell">{{ aeroporto.nome }}</td>
                        <td class="c-table__cell">{{ aeroporto.sigla }}</td>
                        <td class="c-table__cell"><a href="Aeroporto/Atualizar/{{aeroporto.id}}">Editar</a></td>                        
                    </tr> 
                {% endfor %}               
            </tbody>
        </table>
    </div>   
</body>
</html>