<script>


    function calcularTotal() {
        //Definiciones de Objetos
        var txtMonto = document.getElementById('monto')
        var txtTasa = document.getElementById('tasa')
        var txtCuota = document.getElementById('cuota')
        var txtFrecuencia = document.getElementById('frecuencia')
        var txtTotal = document.getElementById('total')
        var txtPeriodo = document.getElementById('periodo')
        var monto=0;
        var tasa=0;
        var cuota=0;
        var total=0;
        var periodo=30;
        monto = txtMonto.value;
        tasa = parseFloat(txtTasa.value) / 100;
        if(txtFrecuencia.value=="Diario"){
            periodo=30;
            document.getElementById('periodotxt').innerHTML='30 Dias'
        }else if(txtFrecuencia.value=="Semanal"){
            periodo=4;
            document.getElementById('periodotxt').innerHTML='4 Semanas'
        }else{
            periodo=2;
            document.getElementById('periodotxt').innerHTML='2 Quincenas'
        }
        total = parseFloat(monto* (1+tasa)).toFixed(2);
        cuota = (total/periodo).toFixed(2);
        txtTotal.value=total
        txtCuota.value=cuota
        txtPeriodo.value=periodo
    }
    function cargarVista(ruta_vista){
        fetch(ruta_vista, { method: 'GET' })
            .then(response => response.json())
            .then(data => {
                document.getElementById('mostrar').innerHTML = data.html; // carga la vista en el div
            })
            .catch(error => {
                console.log(error)
            });
    }
    // function abrirModal() {
    //     document.getElementById('miModal').classList.remove('hidden');
    //     document.getElementsByTagName('body')[0].classList.add('overflow-y-hidden');
    // }

    function cerrarModal() {
        document.getElementById('miModal').classList.add('hidden');
        document.getElementsByTagName('body')[0].classList.remove('overflow-y-hidden');
    }
    function calcularmontopagar(nrocuotas){
        var cuota = document.getElementById('cuota').value;
        var monto = nrocuotas.value*cuota
        document.getElementById('monto').value=monto
    }
    function exportTableToExcel(tableID, filename = ''){
        console.log('asdasasdads')
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
</script>
