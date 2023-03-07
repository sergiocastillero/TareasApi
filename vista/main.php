<!-- <h3>Benvingut a la pàgina principal del framework picat a pedra!</h3>
<p>Dessitjo que sigui del teu gust</p>
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
            var cell_eliminar = row.insertCell(5);
            var eliminar_btn = document.createElement("button");
            eliminar_btn.innerHTML = "Eliminar";
            eliminar_btn.setAttribute("onclick", "eliminarLista(" + data[i].ID + ")");
            cell_eliminar.appendChild(eliminar_btn);
        }
    }

    function init(){
        fetch("http://localhost/frmk/tareas/")
            .then(response => response.json())
            .then(data => procesa_tareas(data));
    }

    function eliminarLista(id) {
        fetch("http://localhost/frmk/listas/id/" + id, {method: "DELETE"})
            .then(response => {
                if (response.status === 204) {
                    var fila = document.querySelector("td:nth-child(1):contains('" + id + "')").parentNode;
                    fila.parentNode.removeChild(fila);
                } else {
                    console.error("Error al eliminar lista " + id + ": " + response.statusText);
                }
            });
    }

    setTimeout(init, 1000);
</script> -->
