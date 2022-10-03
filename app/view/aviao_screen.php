<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" href="{{BASE ~ '/public/css/aviao.css'}}" rel="stylesheet" /> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>    
    <title>Aviões</title>
</head>
{% include './partials/menu.php' %}
<body>
   <div class="container">        
        {% if aviao.marca is not empty %}
            <h3>{{cia.marca}}</h3>
        {% else %}
            <h3>Cadastro de Avião</h3>
        {% endif %}

        <form method="POST" action="{{BASE}}/Aviao/Salvar">
            <div class="form-group row">
                <label for="marca" class="col-4 col-form-label">Marca</label> 
                <div class="col-12">
                <input id="marca" name="marca" required placeholder="Marca" value="{{aviao.marca}}" type="text" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="modelo" class="col-4 col-form-label">Modelo</label> 
                <div class="col-12">
                    <input id="modelo" required name="modelo" placeholder="Modelo" value="{{aviao.modelo}}" type="text" class="form-control">
                </div>
            </div> 
            <div class="form-group row">
                <label for="tipo" class="col-4 col-form-label">Companhia</label> 
                <div class="col-12">
                    <select class="form-control" name="companhia" id="companhia">
                        {% for cia in cias %}    
                            <option value="{{cia.id}}">{{cia.nome}}</option>
                        {% endfor %}
                    </select>
                </div>
            </div> 
            <input type="hidden" name="id" value="{{aviao.id}}">
            <div class="form-group row">
                <div class="offset-4 col-8">                           
                    <button name="submit" type="submit" class="btn btn-primary">Salvar</button>
                    <a href="{{BASE}}/Aviao/Excluir/{{aviao.id}}" class="btn btn-danger">Excluir</a>            
                </div>
            </div>
        </form>
   </div>    
</body>
</html>