<html>
    <head>
        <title>Framework picat a pedra</title>
        <link rel="stylesheet" type="text/css" href="estils.css">
    </head>
    <body>
        <h3>Benvingut a la pàgina principal del framework picat a pedra!</h3>
        <p>Dessitjo que sigui del teu gust</p>
        <div>
            <label for="list-id">ID de la llista:</label>
            <input type="text" id="list-id" name="list-id">
            <button id="delete-list-button">Eliminar llista i tasques</button>
        </div>
        <table id="tareas">
            <tr>
                <th>Id</th>
                <th>Descripció</th>
                <th>Data venciment</th>
                <th>Realitzada</th>
                <th>Llista</th>
                <th>Accions</th>
            </tr>
        </table>
        <script>
            function procesa_tareas(data){
                for (var i=0;i < data.length; i++){
                    var row = document.getElementById("tareas").insertRow(1 + i);
                    if (i%2==0){
                        row.classList.add("fila_parell");
                    }else{
                        row.classList.add("fila_senar");
                    }
                    var cell_id = row.insertCell(0).innerHTML = data[i].ID;
                    var cell_descripcio = row.insertCell(1);
                    cell_descripcio.innerHTML = data[i].DESCRIPCION;
                    cell_descripcio.classList.add("cell_descripcio");
                    var cell_data_venciment = row.insertCell(2).innerHTML = data[i].FECHA_VENCIMIENTO;
                    var cell_realitzada = row.insertCell(3).innerHTML = data[i].REALIZADA;
                    var cell_llista = row.insertCell(4).innerHTML = data[i].LISTA_ID;
                    var cell_accions = row.insertCell(5);
                    var delete_button = document.createElement("button");
                    delete_button.innerHTML = "Eliminar";
                    delete_button.addEventListener("click", function(){
                        var tarea_id = row.cells[0].innerHTML;
                        fetch("http://localhost/frmk/tareas/" + tarea_id, {
                            method: "DELETE"
                        }).then(() => location.reload());
                    });
                    cell_accions.appendChild(delete_button);
                }
            }
            function init(){
            fetch("http://localhost/frmk/tareas/")
                .then(response => response.json())
                .then(data => procesa_tareas(data));
            }
            setTimeout(init, 1000);

            document.getElementById("delete-list-button").addEventListener("click", function(){
                var list_id = document.getElementById("list-id").value;
                if (list_id){
                    fetch("http://localhost/frmk/llistes/" + list_id, {
                        method: "DELETE"
                    }).then(() => location.reload());
                }
            });
        </script>
    </body>
</html>
