<h3>Benvingut a la página principal del framework cassola!</h3>
<p>Dessitjo que sigui del teu gust</p>
<table id="tareas">
    <tr>
        <th>Id</th>
        <th>Descripció</th>
        <th>Data de venciment</th>
        <th>Realitzada</th>
    </tr>
</table>
<form method="POST" action="afegir_tarea.php">
    <label for="descripcio">Nova tasca:</label>
    <input type="text" id="descripcio" name="descripcio">
    <label for="data_venciment">Data de venciment:</label>
    <input type="date" id="data_venciment" name="data_venciment">
    <button type="submit">Afegir</button>
</form>
<form method="POST" action="eliminar_tarea.php">
    <label for="id_tarea">Id de la tasca a eliminar:</label>
    <input type="number" id="id_tarea" name="id_tarea">
    <button type="submit">Eliminar</button>
</form>
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
            var cell_data_venciment = row.insertCell(2).innerHTML = data[i].FECHA_VENCIMIENTO;
            var cell_realitzada = row.insertCell(3);
            var checkbox = document.createElement("input");
            checkbox.type = "checkbox";
            checkbox.checked = data[i].REALIZADA;
            checkbox.disabled = true;
            cell_realitzada.appendChild(checkbox);
        }
    }

    function init(){
        fetch("http://localhost/frmk/tareas/")
            .then(response => response.json())
            .then(data => procesa_tareas(data));
    }
    setTimeout(init, 1000);
</script>
</body>
</html>

