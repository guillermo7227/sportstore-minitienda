let mostrarOrdenesEnviadas = document.getElementById('mostrarEnviadas');

if (mostrarOrdenesEnviadas) {
    mostrarOrdenesEnviadas.onclick = function() {
        this.form.submit();
    };
}
