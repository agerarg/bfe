transactionOK=(data)=>{
    if(!data['error'])
    {
        jAlert('Compra realizada satrisfactoriamente!', 'Compra');
        goldChange(data['gold']);
    }
    else
        jAlert(data['error'], 'Compra Error');
} 
 

comprar=()=>{
    let monedaselect = $("#MonedaSelected").val();
    let CantidadMonedC = $("#CantidadMonedC").val();
    let precio = $("#MonedaSelected option:selected").attr('precio');
    jConfirm("Desea comprar "+CantidadMonedC+" "+monedaselect+" a "+(precio*CantidadMonedC)+" de oro?", 'Comprar '+monedaselect, function(r) 
    {
        if(r)
        {
            $.ajax({
                data: "dame="+monedaselect+"&cant="+CantidadMonedC,
                type: "GET",
                dataType: "json",
                url: "json/bancoComprar.php",
                success: function(data){
                transactionOK(data);
              }
              });
        }
    });

}