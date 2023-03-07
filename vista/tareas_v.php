<?php
    /*     
    header("Content-Type: application/json; charset=utf-8");
    echo json_encode($tareas).PHP_EOL; 
    */
?>
<h3>LLISTAS</h3>
<button id="delete-all-button">Eliminar todas las tareas</button>
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
                fetch("http://localhost/frmk/tareas/" + data[i].ID, {
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

    document.getElementById("delete-all-button").addEventListener("click", function(){
        if(confirm("¿Estás seguro de que deseas eliminar todas las tareas?")){
            fetch("http://localhost/frmk/tareas/", {
                method: "DELETE"
            }).then(() => location.reload());
        }
    });

    setTimeout(init, 1000);
</script>
