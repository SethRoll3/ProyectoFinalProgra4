<div class="page-intro"><div><span class="eyebrow">ENTRADA DE DATOS</span><h1>Nueva importación.</h1><p>Sube un archivo y revisa exactamente qué productos entraron y cuáles necesitan atención.</p></div></div>
<div class="upload-layout">
    <section class="panel upload-panel">
        <div class="section-head"><div><span class="eyebrow">PASO 01 / 01</span><h2>Selecciona tu archivo</h2></div><span class="file-pill">CSV · UTF-8</span></div>
        <form class="upload-form" method="post" action="?page=cargar" enctype="multipart/form-data">
            <input type="hidden" name="csrf" value="<?= e($_SESSION['csrf']) ?>">
            <label class="file-drop" for="archivo"><span class="file-drop-icon" aria-hidden="true">↑</span><strong>Elige un archivo CSV</strong><span>Máximo 5 MB · separado por comas</span></label>
            <input id="archivo" name="archivo" type="file" accept=".csv,text/csv" required>
            <button class="button button-primary submit-button" type="submit">Importar productos <span aria-hidden="true">→</span></button>
            <div class="import-progress" role="status" aria-label="Procesando importación">
                <?php require __DIR__ . '/truck.php'; ?>
                <strong>Procesando tu archivo</strong><span>Revisando filas y registrando productos…</span>
            </div>
        </form>
    </section>
    <aside class="info-panel"><span class="eyebrow">ANTES DE CONTINUAR</span><h2>Un archivo claro,<br>un resultado claro.</h2><p>La primera fila debe contener estos encabezados, en este orden:</p><code>codigo,nombre,categoria,precio,existencia</code><p>Después de enviarlo verás cuántas filas fueron aceptadas y el motivo de cada rechazo.</p><span class="info-index">CSV / 001</span></aside>
</div>
