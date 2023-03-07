<h3>Benvingut a la pàgina principal del framework picat a pedra!</h3>
<p>Dessitjo que sigui del teu gust</p>
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
            var btn_eliminar = document.createElement("button");
            btn_eliminar.innerHTML = "Eliminar lista y tareas";
            btn_eliminar.dataset.id = data[i].LISTA_ID;
            btn_eliminar.addEventListener("click", function(){
                eliminar_lista_tareas(this.dataset.id);
            });
            cell_accions.appendChild(btn_eliminar);
        }
    }

    function init(){
        fetch("http://localhost/frmk/tareas/")
            .then(response => response.json())
            .then(data => procesa_tareas(data));
    }

    function eliminar_lista_tareas(id_lista){
        fetch("http://localhost/frmk/listas/id/"+id_lista+"/", {
            method: "DELETE",
            headers: {
                "Content-Type": "application/json",
                "X-API-Key": "1234567890"
            }
        }).then(response => {
            if (response.status == 204){
                var filas = document.querySelectorAll("#tareas tr");
                filas.forEach(function(fila){
                    if (fila.cells[4].innerHTML == id_lista){
                        fila.remove();
                    }
                });
            }
        });
    }

    setTimeout(init, 1000);
</script>