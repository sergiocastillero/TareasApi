<h3>LLISTES</h3>
<table id="listas">
    <tr>
        <th>Id</th>
        <th>Nom</th>
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
    </tr>
</table>
<script>
    function procesa_tareas(data){
        console.log(data);
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
        }
    }

    function procesa_listas(data){
        console.log(data);
        for (var i=0;i < data.length; i++){
            var row = document.getElementById("listas").insertRow(1 + i);
            if (i%2==0){
                row.classList.add("fila_parell");
            }else{
                row.classList.add("fila_senar");
            }
            var cell_id = row.insertCell(0);
            cell_id.innerHTML = data[i].ID;
            var cell_nom = row.insertCell(1);
            cell_nom.innerHTML = data[i].NOMBRE;
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

    setTimeout(initTareas, 1000);
    setTimeout(initListas, 1000);

</script>
