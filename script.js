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

    btnPagar.addEventListener('click', (event) => {
        event.preventDefault(); // Detener el envío predeterminado del formulario
    
        // Obtener los elementos del carrito y convertirlos a un array
        const listaCarrito = Array.from(document.getElementById('lista-carrito').getElementsByTagName('li'));
        const productos = [];
        listaCarrito.forEach(item => {
            productos.push(item.textContent);
        });
    
        // Crear un formulario oculto para enviar los datos
        const form = document.createElement('form');
        form.setAttribute('method', 'post');
        form.setAttribute('action', 'pago.php');
    
        // Agregar cada elemento del carrito como un campo oculto al formulario
        productos.forEach(producto => {
            const input = document.createElement('input');
            input.setAttribute('type', 'hidden');
            input.setAttribute('name', 'productos[]');
            input.setAttribute('value', producto);
            form.appendChild(input);
        });
    
        // Agregar el formulario al cuerpo del documento y enviarlo
        document.body.appendChild(form);
        form.submit();
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
