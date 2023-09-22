document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('login_error').style.display = 'none';
    
    document.getElementById('login').addEventListener('click', function() {
        enviarLogin();
    });
    
    document.getElementById('salir').addEventListener('click', function() {
        window.location.href = 'http://127.0.0.1/prueba/Index/logout';
    });
});
    
function enviarLogin() {
    var url = "http://127.0.0.1/prueba/Index/login";
    document.getElementById('login_error').style.display = 'none';
    var data = new FormData();
    data.append('documento', document.getElementById('documento').value);
    data.append('password', document.getElementById('password').value);
    
    fetch(url, {
        method: "POST",
        body: data
    }).then(function (response) {
        if (response.ok) {
            return response.json();
        } else {
            console.log('Respuesta de red OK pero respuesta HTTP no OK');
            return response.json();
        }
    }).then(function (data) {
        if(typeof(data.documento) == "undefined") {
            document.getElementById('login_error').innerText = data.mensaje;
            document.getElementById('login_error').style.display = 'block';
        } else {
            window.location.href = 'http://127.0.0.1/prueba/Index/verificarUsuario';
        }
        console.log(data);
    }).catch(function (error) {
        console.log('Hubo un problema con la petición Fetch:' + error.message);
    });
}
