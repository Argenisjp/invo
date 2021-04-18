
{{ content() }}

<div class="row">

    <div class="col-md-6">
        <div class="page-header">
            <h2>Iniciar sesión</h2>
        </div>
        {{ form('session/start', 'role': 'form') }}
            <fieldset>
                <div class="form-group">
                    <label for="email">Usuario/Email</label>
                    <div class="controls">
                        {{ text_field('email', 'class': "form-control") }}
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="controls">
                        {{ password_field('password', 'class': "form-control") }}
                    </div>
                </div>
                <div class="form-group">
                    {{ submit_button('Ingresar', 'class': 'btn btn-primary btn-large') }}
                </div>
            </fieldset>
        </form>
    </div>

    <div class="col-md-6">

        <div class="page-header">
            <h2> ¿Aún no tienes una cuenta?</h2>
               
        </div>

        <p>Crear una cuenta ofrece las siguientes ventajas:</p>
        <ul>
            <li>Cree, rastree y exporte sus facturas en línea</li>
            <li>Obtenga información crítica sobre cómo le está yendo a su negocio</li>
            <li>Manténgase informado sobre promociones y paquetes especiales</li>
        </ul>

        <div class="clearfix center">
            {{ link_to('register', 'Sign Up', 'class': 'btn btn-primary btn-large btn-success') }}
        </div>
    </div>

</div>
