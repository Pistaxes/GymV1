document.addEventListener('DOMContentLoaded', function(){
    iniciarApp();
});

function iniciarApp(){
    console.log('Hola'); 
    consultarApi();
    
}

async function consultarApi(){
    try {
        const productos = localStorage.getItem('carrito');
        if(productos===null){
            mostrarServicios([]);
        }else{
            mostrarServicios(JSON.parse(productos));
        }
        
    } catch (error) {
        console.log(error);
    }
}

function mostrarServicios(productos){
    console.log(productos);
    productos.forEach((producto,index) => {
        const {id,nombre,precio,imagen} = producto;

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
        

        
        const cantidad = document.createElement('INPUT');
        cantidad.placeholder = 'Cantidad';

        cantidad.classList.add('cantidad');
        
        const eliminar = document.createElement('button');
        eliminar.textContent= 'Eliminar';
        eliminar.classList.add('boton');
        eliminar.addEventListener('click',()=>{
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
              }).then((result) => {
                if (result.isConfirmed) {
                    var local = JSON.parse(localStorage.getItem('carrito'));
                    local.splice(index,1);
                    localStorage.setItem('carrito',JSON.stringify(local));
                    document.querySelector('#productos').innerHTML='';
                    consultarApi();
                  Swal.fire({
                    title: "Deleted!",
                    text: "Your file has been deleted.",
                    icon: "success"
                  });
                }
              });
           
        });


        productoDiv.appendChild(nombreProducto);
        productoDiv.appendChild(imagenProducto);
        productoDiv.appendChild(precioProducto);
        productoDiv.appendChild(cantidad);
        productoDiv.appendChild(eliminar);
        
        
        document.querySelector('#productos').appendChild(productoDiv);
    });
}