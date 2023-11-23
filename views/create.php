<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <title>Crear Producto</title>
</head>
<body class="bg-body-tertiary">
<div class="container">
    <div class="card mt-3">
        <div class="card-header fs-4">Crear Producto</div>
        <form action="/create" method="post">
            <div class="card-body d-flex flex-column row-gap-2">
                <div>
                    <label for="name" class="form-label">Nombre</label>
                    <input name="name" id="name" type="text" class="form-control" aria-label="Nombre" required>
                </div>
                <div>
                    <label for="description" class="form-label">Descripción</label>
                    <input name="description" id="description" type="text" class="form-control"
                           aria-label="Descripción" required>
                </div>
                <div>
                    <label for="stock" class="form-label">Stock</label>
                    <input name="stock" id="stock" type="text" class="form-control" aria-label="Stock" required>
                </div>
                <div>
                    <label for="price" class="form-label">Precio</label>
                    <input name="price" id="price" type="text" class="form-control" aria-label="Precio" required>
                </div>
                <div>
                    <label for="images" class="form-label">Imágenes</label>
                    <input name="images" id="images" type="file" class="form-control" aria-label="Imágenes">
                </div>
            </div>
            <div class="card-footer d-flex flex-column row-gap-1">
                <button type="submit" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                         class="bi bi-floppy-fill me-1" viewBox="0 0 16 16">
                        <path
                                d="M0 1.5A1.5 1.5 0 0 1 1.5 0H3v5.5A1.5 1.5 0 0 0 4.5 7h7A1.5 1.5 0 0 0 13 5.5V0h.086a1.5 1.5 0 0 1 1.06.44l1.415 1.414A1.5 1.5 0 0 1 16 2.914V14.5a1.5 1.5 0 0 1-1.5 1.5H14v-5.5A1.5 1.5 0 0 0 12.5 9h-9A1.5 1.5 0 0 0 2 10.5V16h-.5A1.5 1.5 0 0 1 0 14.5v-13Z"/>
                        <path
                                d="M3 16h10v-5.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5V16Zm9-16H4v5.5a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5V0ZM9 1h2v4H9V1Z"/>
                    </svg>
                    <span class="align-middle">GUARDAR</span>
                </button>
                <a href="/" class="btn btn-danger">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill"
                         viewBox="0 0 16 16">
                        <path
                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z" />
                    </svg>
                    <span class="align-middle">CANCELAR</span>
                </a>
            </div>
        </form>
    </div>
</div>
</body>
</html>