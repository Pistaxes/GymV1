<section class="video-container">
            <video src="build/img/video.mp4" class="video-slider active" autoplay muted loop id="bg-video"></video>
            <div class="content">
                <h1 class="titulo-contacto">Contacto.</h1>
                <form name="sentMessage" id="contactForm" novalidate="">
            <div class="row">
              <div class="col-md-6">
              <label for="correo"> Nombre </label>
                <div class="campo">
                  <input type="text" class="form-control" placeholder="Your Name *" id="name" required="" data-validation-required-message="Please enter your name.">
                  <p class="help-block text-danger"></p>
                </div>
                <label for="correo"> Correo </label>
                <div class="campo">
                
                  <input type="email" class="form-control" placeholder="Your Email *" id="email" required="" data-validation-required-message="Please enter your email address.">
                  <p class="help-block text-danger"></p>
                </div>
                <label for="correo"> Numero Telefonico </label>
                <div class="campo">
                
                  <input type="tel" class="form-control" placeholder="Your Phone *" id="phone" required="" data-validation-required-message="Please enter your phone number.">
                  <p class="help-block text-danger"></p>
                </div>
              </div>
              <div class="col-md-6">
              <label  class="label" for="correo"> Comentario </label>
                <div class="campo">
                
                  <textarea class="form-control" placeholder="Your Message *" id="message" required="" data-validation-required-message="Please enter a message."rows="10" cols="80"></textarea>
                  <p class="help-block text-danger"></p>
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="col-lg-12 text-center">
                <div id="success"></div>
                <button type="submit" class="boton">Enviar</button>
              </div>
            </div>
          </form>
            </div>
            
            <div class="media-icons">
                <a href=""><i class="fab fa-facebook-f"></i></a>
                <a href=""><i class="fab fa-instagram"></i></a>
                <a href=""><i class="fab fa-twitter"></i></a>
            </div>
           
        </section>