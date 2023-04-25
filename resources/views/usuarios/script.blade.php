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
    function exportTableToExcel(tableID, filename = ''){
        var downloadLink;
        var dataType = 'application/vnd.ms-excel';
        var tableSelect = document.getElementById(tableID);
        var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
        // Specify file name
        filename = filename?filename+'.xls':'excel_data.xls';
        // Create download link element
        downloadLink = document.createElement("a");
        document.body.appendChild(downloadLink);
        if(navigator.msSaveOrOpenBlob){
            var blob = new Blob(['ufeff', tableHTML], {
                type: dataType
            });
            navigator.msSaveOrOpenBlob( blob, filename);
        }else{
            // Create a link to the file
            downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
            // Setting the file name
            downloadLink.download = filename;
            //triggering the function
            downloadLink.click();
        }
    }
    function validar(){
        var tipo_user = document.getElementById('id_tipo_user').value;
        if(tipo_user==3){
            const url = '{{ route('usuarios.cargarsupervisores') }}';
            fetch(url)
            .then(response => response.json())
            .then(data => {
                document.getElementById('mostrarsupervisor').innerHTML = data.html;
            });
        }
    }
</script>
