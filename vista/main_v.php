<h3>LLISTES</h3>
<table id="listas">
    <tr>
        <th>Id</th>
        <th>Nom</th>
        <th>Eliminar</th>
    </tr>
</table>
<h3>TASQUES</h3>
<table id="tareas">
    <tr>
        <th>Id</th>
        <th>Descripció</th>
        <th>Data venciment</th>
        <th>Realitzada</th>
        <th>Llista</th>
        <th>Eliminar</th>

    </tr>
</table>
<script>
    function procesa_tareas(data){
        console.log(data);
        var table = document.getElementById("tareas");
        for (var i=0;i < data.length; i++){
            var row = table.insertRow(1 + i);
            row.classList.add(i % 2 == 0 ? "fila_parell" : "fila_senar");

            var cell_id = row.insertCell(0);
            cell_id.innerHTML = data[i].ID;

            var cell_descripcio = row.insertCell(1);
            cell_descripcio.innerHTML = data[i].DESCRIPCION;
            cell_descripcio.classList.add("cell_descripcio");

            var cell_data_venciment = row.insertCell(2);
            cell_data_venciment.innerHTML = data[i].FECHA_VENCIMIENTO;

            var cell_realitzada = row.insertCell(3);
            cell_realitzada.innerHTML = data[i].REALIZADA;

            var cell_llista = row.insertCell(4);
            cell_llista.innerHTML = data[i].LISTA_ID;

            var cell_eliminar = row.insertCell(5);
            var eliminar_btn = document.createElement("button");
            eliminar_btn.innerHTML = "Eliminar";
            eliminar_btn.addEventListener("click", function() {
                var id = this.parentNode.parentNode.cells[0].textContent;
                eliminarTarea(id);
            });
            cell_eliminar.appendChild(eliminar_btn);
        }
    }

    function procesa_listas(data){
        console.log(data);
        var table = document.getElementById("listas");
        for (var i=0;i < data.length; i++){
            var row = table.insertRow(1 + i);
            row.classList.add(i % 2 == 0 ? "fila_parell" : "fila_senar");

            var cell_id = row.insertCell(0);
            cell_id.innerHTML = data[i].ID;

            var cell_nom = row.insertCell(1);
            cell_nom.innerHTML = data[i].NOMBRE;

            var cell_eliminar = row.insertCell(2);
            var eliminar_btn = document.createElement("button");
            eliminar_btn.innerHTML = "Eliminar";
            eliminar_btn.addEventListener("click", function() {
                var id = this.parentNode.parentNode.cells[0].textContent;
                eliminarLista(id);
            });
            cell_eliminar.appendChild(eliminar_btn);
        }
    }

    function initTareas(){
        fetch("http://localhost/frmk/tareas/")
            .then(response => response.json())
            .then(data => procesa_tareas(data));
    }

    function initListas(){
        fetch("http://localhost/frmk/listas/")
            .then(response => response.json())
            .then(data => procesa_listas(data));
    }

    function eliminarTarea(id) {
        fetch(`http://localhost/frmk/tareas/id/${id}`, { method: "DELETE" })
            .then(response => {
                if (response.ok) {
                    var fila = document.querySelector(`td:nth-child(1):contains('${id}')`).parentNode;
                    fila.parentNode.removeChild(fila);
                } else {
                    console.error(`Error al eliminar tarea ${id}: ${response.statusText}`);
                }
            })
            .catch(error => console.error(error));
    }

    function eliminarLista(id) {
        fetch(`http://localhost/frmk/listas/id/${id}`, { method: "DELETE" })
            .then(response => {
                if (response.ok) {
                    var fila = document.querySelector(`td:nth-child(1):contains('${id}')`).parentNode;
                    fila.parentNode.removeChild(fila);
                } else {
                    console.error(`Error al eliminar listas ${id}: ${response.statusText}`);
                }
            })
            .catch(error => console.error(error));
    }

    setTimeout(initTareas, 1000);
    setTimeout(initListas, 1000);

</script>
