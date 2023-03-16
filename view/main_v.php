<p id="editar_btn">Editar</p>
<h3>LLISTES</h3>
<input type="text" id="buscador_nombre" placeholder="Buscar">
<button id="buscar_btn">Buscar</button>
<table id="listas"></table>

<script> 
const table = document.getElementById('listas');

function procesa_listas(data){
    console.log(data);
    var rowHeader = table.insertRow(0); // Agregar una fila de encabezado (opcional)
    var rowCount = table.rows.length; // Obtener el número de filas en la tabla

    // Si la tabla está vacía, agregar una fila vacía
    if(rowCount === 0) {
        var row = table.insertRow(0);
    }

    for (var i=0;i < data.length; i++){
        var row = table.insertRow(1 + i);
        row.classList.add(i % 2 == 0 ? "fila_parell" : "fila_senar");
        row.setAttribute('data-list-id', data[i].ID);

        var cell_nom = row.insertCell(0);
        cell_nom.innerHTML = data[i].NOMBRE;

        var cell_modificar = row.insertCell(1);
        var modificar_btn = document.createElement("button");
        modificar_btn.innerHTML = "Modificar";
        modificar_btn.addEventListener("click", function() {
            var id = this.parentNode.parentNode.getAttribute('data-list-id');
            modificarLista(id);
        });
        cell_modificar.appendChild(modificar_btn);

        var cell_eliminar = row.insertCell(2);
            var eliminar_btn = document.createElement("button");
            eliminar_btn.innerHTML = "Eliminar";
            eliminar_btn.addEventListener("click", function() {
                var id = this.parentNode.parentNode.getAttribute('data-list-id');
                eliminarLista(id);
            });
            cell_eliminar.appendChild(eliminar_btn);
    }
}

function modificarLista(id) {
    var nombre = prompt("Introduce el nuevo nombre para la lista");
    if (nombre != null) {
        fetch(`http://localhost/frmk/listas/id/${id}`, {
            method: "PUT",
            body: JSON.stringify({ NOMBRE: nombre }),
            headers: {
                "Content-Type": "application/json"
            }
        })
        .then(response => {
            if (response.ok) {
                // Actualizar la fila correspondiente de la tabla con los nuevos datos de la lista
                var fila = document.querySelector(`[data-list-id="${id}"]`);
                fila.querySelector(".cell_titol").innerHTML = nombre;
            } else {
                console.error(`Error al modificar lista ${id}: ${response.statusText}`);
            }
        })
        .catch(error => console.error(error));
    }
}

function eliminarLista(id) {
    fetch(`http://localhost/frmk/listas/id/${id}`, { method: "DELETE" })
        .then(response => {
            if (response.ok) {
                // Eliminar la fila correspondiente de la tabla
                var fila = document.querySelector(`[data-list-id="${id}"]`);
                fila.parentNode.removeChild(fila);
            } else {
                console.error(`Error al eliminar lista ${id}: ${response.statusText}`);
            }
        })
        .catch(error => console.error(error));
}


function initListas(){
    fetch("http://localhost/frmk/listas/")
        .then(response => response.json())
        .then(data => procesa_listas(data));
}

setTimeout(initListas, 1000);

</script>