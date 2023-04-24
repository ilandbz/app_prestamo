<script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    function cargarTabla(texto) {
        const descripcion = texto;
        const url = '{{ route('usuarios.cargarlista') }}';
        const opciones = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({ descripcion: descripcion })
        };

        fetch(url, opciones)
        .then(response => response.json())
            .then(data => {
                document.getElementById('mostrar').innerHTML = data.html;
            })
        .catch(error => console.error('Error:', error));
    }
    function cargarTabla(texto) {
        const descripcion = texto;
        const url = '{{ route('caja.cargarlista') }}';
        const opciones = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({ descripcion: descripcion })
        };

        fetch(url, opciones)
        .then(response => response.json())
            .then(data => {
                document.getElementById('mostrar').innerHTML = data.html;
            })
        .catch(error => console.error('Error:', error));
    }
</script>
