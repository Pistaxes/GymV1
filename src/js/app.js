document.addEventListener('DOMContentLoaded', function(){
    iniciarApp();
});

function iniciarApp(){
    consultarApi();
    
}

async function consultarApi(){
    try {
        const url = '/api/productos';
        const resultado = await fetch(url);
        const productos = await resultado.json();
        console.log(productos);
        mostrarServicios(productos);
    } catch (error) {
        console.log(error);
    }
}

function mostrarServicios(productos){
    productos.forEach(producto => {
        const {id,nombre,precio,imagen,categoriaId} = producto;


        const nombreProducto = document.createElement('h3');
        nombreProducto.classList.add('nombre-producto');
        nombreProducto.textContent = nombre;

        const precioProducto = document.createElement('p');
        precioProducto.classList.add('nombre-producto');
        precioProducto.textContent = precio;
        
        const imagenNombre= imagen;
        const imagenProducto= document.createElement('img');
        imagenProducto.src = `../build/img/${imagenNombre}.jpg`;
        

        const productoDiv = document.createElement('DIV');
        productoDiv.classList.add('producto');
        productoDiv.dataset.idProducto= id;

        const botones = document.createElement('DIV');
        botones.classList.add('botones');

        const carrito = document.createElement('BUTTON');
        carrito.classList.add('boton-carrito');
        carrito.textContent = 'Agregar al carrito';
        carrito.id = id;

        
        carrito.addEventListener ('click', async ()=>{
            const productoCarrito = {id: id,nombre:nombre,precio:precio, imagen:imagen}
            const response = await fetch('/api/carrito',{
            method:"POST",
            headers: {'Content-Type': 'application/json',}, body: JSON.stringify(productoCarrito)
        });
        
        if(response.ok){
            const data = await response.json();
            console.log(data);
        }


        });
        productoDiv.appendChild(nombreProducto);
        productoDiv.appendChild(imagenProducto);
        productoDiv.appendChild(precioProducto);
        productoDiv.appendChild(botones);
        productoDiv.appendChild(carrito);
        
        

        document.querySelector('#productos').appendChild(productoDiv);
    });

    function addProduct(){
        
    }
}