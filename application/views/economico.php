<div class="container">
    <form id="form">
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="date1">Fecha 1</label>
                <input type="date" class="form-control" id="date1" >
            </div>
            <div class="form-group col-md-5">
                <label for="date2">Fecha 2</label>
                <input type="date" class="form-control" id="date2" >
            </div>
            <div class="form-group col-md-2">
                <label for="">Verificar</label>
                <button type="submit" class="btn btn-primary btn-block"> <i class="fa fa-check"></i> Consultar</button>
            </div>
        </div>
    </form>
    <table class="table">
        <thead class="bg-primary">
        <tr>
            <td>#</td>
            <td>title</td>
            <td>Fecha</td>
            <td>Monto</td>
        </tr>
        </thead>
        <tbody id="contenido">
        </tbody>
        <tfood>
            <tr>
                <td></td>
                <td></td>
                <td>TOTAL</td>
                <td id="total">00</td>
            </tr>
        </tfood>
    </table>
</div>
<script>
    window.onload=function (e) {
        $('#date1').val(moment().format('YYYY-MM-DD'));
        $('#date2').val(moment().format('YYYY-MM-DD'));
        $('#form').submit( function (e) {
            $.ajax({
                url:'Economico/consulta',
                type:'POST',
                data:'dat1='+$('#date1').val()+'&dat2='+$('#date2').val(),
                success:function (e) {
                    // console.log(e);
                    // return false;
                    let dat=JSON.parse(e);
                    let cont=0;
                    let suma=0;
                    $('#contenido').html('');
                    dat.forEach(e=>{
                        cont++;
                        $('#contenido').append('<tr>' +
                            '<td>'+cont+'</td>' +
                            '<td>'+e.title+'</td>' +
                            '<td>'+e.created_at+'</td>' +
                            '<td>'+e.monto+'</td>' +
                            '</tr>');
                        suma=suma+parseFloat(e.monto);
                    });
                    // console.log(suma);
                    $('#total').html(suma+'BS');
                }
            });
            e.preventDefault();
            return false;
        });
    }
</script>
