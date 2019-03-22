let botones = document.getElementsByClassName('eliminarProducto');

for (const boton of botones) {
    boton.onclick = function() {
        let eliminar = confirm('¿Desea eliminar este producto?');
        if (!eliminar) {
            return false;
        }
    };
}
