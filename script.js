document.addEventListener('DOMContentLoaded', () => {
    const botonesAgregar = document.querySelectorAll('.agregar-carrito');
    const btnCarrito = document.getElementById('btn-carrito');
    const contenidoCarrito = document.getElementById('contenido-carrito');
    const btnPagar = document.getElementById('btn-pagar');

    botonesAgregar.forEach(boton => {
        boton.addEventListener('click', () => {
            const producto = boton.getAttribute('data-producto');
            const precio = parseFloat(boton.getAttribute('data-precio'));
            agregarAlCarrito(producto, precio);
        });
    });

    btnCarrito.addEventListener('click', () => {
        contenidoCarrito.classList.toggle('mostrar');
    });

    btnPagar.addEventListener('click', () => {
        limpiarCarrito();
    });

    function agregarAlCarrito(producto, precio) {
        const item = document.createElement('li');
        item.innerHTML = `${producto} - $${precio}`;
        document.getElementById('lista-carrito').appendChild(item);
    }

    function limpiarCarrito() {
        const listaCarrito = document.getElementById('lista-carrito');
        while (listaCarrito.firstChild) {
            listaCarrito.removeChild(listaCarrito.firstChild);
        }
    }
});
