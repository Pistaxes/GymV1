document.addEventListener('DOMContentLoaded', function(){
    iniciarApp();
});

function iniciarApp(){
     
    consultarApi();
    pagar();
                                                
}

async function consultarApi(){
    try {
      const url = '/api/carrito';
      const resultado = await fetch(url);
        const productos = await resultado.json();
        console.log(productos);
        mostrarServicios(productos);
    } catch (error) {
        console.log(error);
    }
}

function mostrarServicios(productos){
    

    productos.forEach((productoz,index) => {
        const {id,producto,cantidad,precio,imagen,usuario,total} = productoz;

        const nombreProducto = document.createElement('h3');
        nombreProducto.classList.add('nombre-producto');
        nombreProducto.textContent = producto;

        const precioProducto = document.createElement('p');
        precioProducto.classList.add('precio-producto');
        precioProducto.textContent = precio;
  
        
        const imagenNombre= imagen;
        const imagenProducto= document.createElement('img');
        imagenProducto.src = `../build/img/${imagenNombre}.jpg`;

        const cantidadProducto = document.createElement('p');
        cantidadProducto.classList.add('cantidad');
        cantidadProducto.textContent = cantidad;

        const totalProducto = document.createElement('p');
        totalProducto.classList.add('total');
        totalProducto.textContent = total;
        

        const productoDiv = document.createElement('DIV');
        productoDiv.classList.add('producto');
        

        const botones = document.createElement('DIV');
        botones.classList.add('botones');
        
        
        
        
        const eliminar = document.createElement('button');
        eliminar.textContent= 'Eliminar';
        eliminar.classList.add('boton');
        eliminar.dataset.id = id;
        eliminar.addEventListener('click', async ()=>{

          const resp= await AlertConfirm({title:'Quieres eliminar este producto?'});
          if(resp){
            const response = await fetch('/api/carrito/eliminar?id='+ id, {
              method: 'POST'
            });
            if(response.ok){
              const data = await response.json();
              console.log(data);
              const div = document.querySelector('#productos');
              div.innerHTML='';
              consultarApi();
            }
          }
        });

        const resumenCantidad = document.createElement('P');
        resumenCantidad.textContent = precio;

        productoDiv.appendChild(nombreProducto);
        productoDiv.appendChild(imagenProducto);
        productoDiv.appendChild(precioProducto);
        productoDiv.appendChild(cantidadProducto);
        productoDiv.appendChild(totalProducto);
        productoDiv.appendChild(eliminar);
        
        
        document.querySelector('#productos').appendChild(productoDiv);

    });
    
    
    const comprar = document.createElement('button');
    comprar.textContent= 'Resumen';
    comprar.classList.add('boton');
    
    comprar.addEventListener('click',()=>{
          //Datos del resumen
          const costos = [];
          productos.forEach((producto) => {
             costos.push(Number(producto.total));
          });
          
          let suma = costos.reduce((total, numero) => {
            return total + numero;
          }, 0);
          
          comprarProductos(suma);

          
        
    });
    document.querySelector('#productos').appendChild(comprar);
    

}

const AlertConfirm = ({ icon = 'warning', title, text }) => {
  const result =  Swal.fire({
      title: title,
      text: text,
      icon: icon,
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Aceptar',
      cancelButtonText: 'Cancelar',
      customClass: {
          popup: 'border-radius-2',
        }
  }).then((result) => {
      if (result.isConfirmed) {
          return true
      } else {
          return false
      }
  })
  return result
}

function comprarProductos(resultado){

    const texto =document.createElement('H1');
            texto.textContent = 'Tu total a pagar es de: ';
            const Total = document.createElement('H2');
            Total.classList.add('precio-Final');
            Total.textContent = resultado;
            
            const inputMonto = document.getElementById('monto');
            inputMonto.value = resultado;
            texto.appendChild(Total);
            
            document.querySelector('#productos').appendChild(texto);

    
}

function pagar(){
    var stripe = Stripe('pk_test_51OKXdZG1jX1oNbL4usgBwI4qDOmG8mrhJuzWoJ482vbbnw476aGJDUOSQIpmamFrMjkL6KrYrPqBRAljL4xBkGWU004rOEojgO');
  var elements = stripe.elements();

  // Estilo del elemento de tarjeta de Stripe
  var style = {
    base: {
      fontSize: '16px',
      fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
    }
  };

 
  var card = elements.create('card', {style: style});
  card.mount('#card-element');

  
  card.addEventListener('change', function(event) {
    var displayError = document.getElementById('card-errors');
    if (event.error) {
      displayError.textContent = event.error.message;
    } else {
      displayError.textContent = '';
    }
  });

  
  var form = document.getElementById('payment-form');
  form.addEventListener('submit', function(event) {
    event.preventDefault();
    stripe.createToken(card).then(function(result) {
      if (result.error) {
        var errorElement = document.getElementById('card-errors');
        errorElement.textContent = result.error.message;
      } else {
        var tokenInput = document.createElement('input');
        tokenInput.setAttribute('type', 'hidden');
        tokenInput.setAttribute('name', 'stripeToken');
        tokenInput.setAttribute('value', result.token.id);
        form.appendChild(tokenInput);
        form.submit();
      }
    });
  });
}