<<<<<<< HEAD
<!-- <h3>LISTAS</h3>
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
                var id = data[i].ID;
                eliminarLista(id);
            });
            cell_eliminar.appendChild(eliminar_btn);
        }
    }

    function init(){
        fetch("http://localhost/frmk/listas/")
            .then(response => response.json())
            .then(data => procesa_listas(data));
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

    setTimeout(init, 1000);
</script> -->
=======
<?php
    header("Content-Type: application/json; charset=utf-8");
    echo json_encode($listas).PHP_EOL; 
?>
>>>>>>> d082575 (recuperado)
