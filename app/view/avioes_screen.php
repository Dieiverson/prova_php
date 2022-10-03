<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" href="{{BASE ~ '/public/css/avioes.css'}}" rel="stylesheet" /> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>    
    <title>Aviões</title>
</head>
{% include './partials/menu.php' %}
<body>
    <div class="wrapper">
        <h1>Listagem de Aviões</h1>
        <div style="display:table;margin:auto;margin-bottom:10px;">
            <a class="btn btn-success" href="{{BASE}}/Aviao/Cadastrar">+ Novo Avião</a>
        </div>
        <table class="c-table">
            <thead class="c-table__header">
                <tr>               
                <th class="c-table__col-label">Marca</th>
                <th class="c-table__col-label">Modelo</th>
                <th class="c-table__col-label">Companhia</th> 
                <th class="c-table__col-label">#</th>              
                </tr>
            </thead>
            <tbody class="c-table__body">
                {% for aviao in avioes %}                  
                    <tr>                   
                        <td class="c-table__cell">{{ aviao.marca }}</td>
                        <td class="c-table__cell">{{ aviao.modelo }}</td>
                        <td class="c-table__cell">{{ aviao.cia }}</td>
                        <td class="c-table__cell"><a href="{{BASE}}/Aviao/Atualizar/{{aviao.id}}">Editar</a></td>                        
                    </tr> 
                {% endfor %}               
            </tbody>
        </table>
    </div>   
</body>
</html>