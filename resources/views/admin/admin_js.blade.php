let botonesEliminarProducto = document.getElementsByClassName('eliminarProducto')

for (const botonEP of botonesEliminarProducto) {
    botonEP.onclick = function() {
        let eliminar = confirm('¿Desea eliminar este producto?');
        if (!eliminar) {
            return false;
        }
    };
}

let botonesEliminarOrden = document.getElementsByClassName('eliminarOrden')

for (const botonEO of botonesEliminarOrden) {
    botonEO.onclick = function() {
        let eliminar = confirm('¿Desea eliminar esta orden?');
        if (!eliminar) {
            return false;
        }
    };
}

let mostrarOrdenesEnviadas = document.getElementById('mostrarEnviadas');

if (mostrarOrdenesEnviadas) {
    mostrarOrdenesEnviadas.onclick = function() {
        this.form.submit();
    };
}
