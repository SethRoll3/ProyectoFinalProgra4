<h1>Nueva importación</h1>
<p>Selecciona un archivo CSV en UTF-8, separado por comas y de hasta 5 MB.</p>
<p>Los encabezados deben ser exactamente: <code>codigo,nombre,categoria,precio,existencia</code>.</p>
<form method="post" action="?page=cargar" enctype="multipart/form-data">
    <input type="hidden" name="csrf" value="<?= e($_SESSION['csrf']) ?>">
    <label for="archivo">Archivo CSV</label>
    <input id="archivo" name="archivo" type="file" accept=".csv,text/csv" required>
    <button type="submit">Importar productos</button>
</form>
