<h3>Benvingut a la pàgina principal del framework picat a pedra!</h3>
<p>Dessitjo que sigui del teu gust</p>
<table id="listas">
    <tr>
        <th>Id</th>
        <th>Nombre</th>
        <th>Eliminar</th>
    </tr>
</table>
<script>
    function procesa_listas(data){
        for (var i=0;i < data.length; i++){
            var row = document.getElementById("listas").insertRow(1 + i);
            if (i%2==0){
                row.classList.add("fila_parell");
            }else{
                row.classList.add("fila_senar");
            }
            var cell_id = row.insertCell(0).innerHTML = data[i].ID;
            var cell_nom = row.insertCell(1);
            cell_nom.innerHTML = data[i].NOMBRE;
            var cell_eliminar = row.insertCell(2);
            var eliminar_btn = document.createElement("button");
            eliminar_btn.innerHTML = "Eliminar";
            eliminar_btn.setAttribute("onclick", "eliminarLista(" + data[i].ID + ")");
            cell_eliminar.appendChild(eliminar_btn);
        }
    }

    function init(){
        fetch("http://localhost/frmk/listas/")
            .then(response => response.json())
            .then(data => procesa_listas(data));
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
</script>
