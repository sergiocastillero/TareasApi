<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }
        ul li {
            float: left;
        }

        ul li a{
            display: block;
            padding: 2px 6px;
            margin: 15px 15px 15px 0px;
            background-color: #555555;
            text-decoration: none;
            text-align: center;
            border-radius: 3px;
            font-weight: bold;
            color: white;
        }
        
        ul li a:hover {
            background-color: #222222;
        }
        table{
            width: 100%;
        }
        th {
            padding: 0px 6px;
            background-color: black;
            color: white;
            text-align: center;
            border-radius: 6px;
        }
        td {
            text-align: center;
            border-radius: 6px;
        }
        .cell_titol{
            text-align: left;
        }
        .fila_parell td{
            background-color: #f0eeee;
        }
        .fila_parell td:hover{
            background-color: #f0e0e0;
        }
        .fila_senar td{
            background-color: #d0cccc;
        }
        .fila_senar td:hover{
            background-color: #d0c0c0;
        }
        h3 {
            clear: both;
        }
        .formAddList{
            background-color: none;
        }
        .formAddList input{
            width: 100%;
            text-align: center;
            border-radius: 6px;
        }
    </style>
    <title>El meu framework</title>
</head>
<body>
    <nav>
        <ul>
            <li><a href="http://localhost/frmk/main/" >Inici</a></li>
            <li><a href="http://localhost/frmk/listas/" >Llistes JSON</a></li>
            <li><a href="http://localhost/frmk/tareas/" >Tasques JSON</a></li>
        </ul>
    </nav>
