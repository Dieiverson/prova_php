<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" href="{{BASE ~ '/public/css/aeroporto.css'}}" rel="stylesheet" /> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>    
    <title>Aeroporto</title>
</head>
{% include './partials/menu.php' %}
<body>
   <div class="container">        
        {% if aeroporto.nome is not empty %}
            <h3>{{aeroporto.nome}}</h3>
        {% else %}
            <h3>Cadastro de Aeroporto</h3>
        {% endif %}

        <form method="POST" action="{{BASE}}/Aeroporto/Salvar">
            <div class="form-group row">
                <label for="nome" class="col-4 col-form-label">Nome</label> 
                <div class="col-12">
                <input id="nome" name="nome" required placeholder="Nome do Aeroporto" value="{{aeroporto.nome}}" type="text" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="sigla" class="col-4 col-form-label">Sigla</label> 
                <div class="col-12">
                    <input id="sigla" required name="sigla" placeholder="Sigla do Aeroporto" value="{{aeroporto.sigla}}" type="text" class="form-control">
                </div>
            </div> 
            <input type="hidden" name="id" value="{{aeroporto.id}}">
            <div class="form-group row">
                <div class="offset-4 col-8">    
                     <a href="{{BASE}}/Aeroporto/Excluir/{{aeroporto.id}}" class="btn btn-danger">Excluir</a>               
                    <button name="submit" type="submit" class="btn btn-primary">Salvar</button>
                   
                </div>
            </div>
        </form>
   </div>    
</body>
</html>