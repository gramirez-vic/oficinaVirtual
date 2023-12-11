<?php 
        $referencia = $infopedido['codigoPago'];
        // var_dump(base_url()."/application/controllers/");die();
    ?>
<div class="container"><br>
<center>
    <img src="<?php echo base_url('res/img/logo.png');?>" width="50%">
</center><br>
<h3 class="text-center"><strong>Pago de factura</strong></h3><br>
<table class="table table-striped">
    <thead>
        <tr>
            <th style="background:#000;color:#fff" width="50px"></th>
            <th style="background:#000;color:#fff">N° de factura</th>
            <th style="background:#000;color:#fff" class="text-center">N° de Matricula</th>
            <th style="background:#000;color:#fff" class="text-right">Valor</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td></td>
            <td><?php echo $infopedido["factura"];?></td>
            <td class="text-center"><?php echo $infopedido["matricula"];?></td>
            <td class="text-right"><?php echo number_format($infopedido['valor'],0,',','.')?></td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <th colspan='3'>Total a Pagar</th>
            <th  class="text-right">
                <?php echo number_format($infopedido['valor'],0,',','.')?>
            </th>
        </tr>
    </tfoot>
</table>
<!-- <div class="alert alert-primary text-center" role="alert">
<?php echo lang("text31")?>
</div> -->
</div>
<?php //if($proveedor == 'payu'){
    //“ApiKey~merchantId~referenceCode~amount~currency”.
    //$llave = md5($infoTienda['payu_apikey']."~".$infoTienda['payu_id_mercado']."~".$referencia."~".$infoPedido['valor']."~COP");
?>
    
    <div class="container">
        <?php //var_dump($infoPedido);?>
            <!-- <center>
            <form method="post" id="theForm" action="https://sandbox.checkout.payulatam.com/ppp-web-gateway-payu/"> -->
            <!--<form method="post" id="theForm" action="https://gateway.payulatam.com/ppp-web-gateway/">-->
                <!-- <input name="merchantId" id="merchantId"    type="hidden"  value="<?php echo $infoTienda['payu_id_mercado']?>">
                <input name="accountId"     type="hidden"  value="<?php echo $infoTienda['payu_id_cuenta']?>" >
                <input name="description"   type="hidden"  value="<?php echo $infoTienda['nombreTransaccion']?>"  >
                <input name="apKey" id="apKey"   type="hidden"  value="<?php echo $infoTienda['payu_apikey']?>"  >
                <input name="secret"                            type="hidden"   value="pRRXKOl8ikMmt9u">
                <input name="referenceCode" id="referenceCode" type="hidden"  value="<?php echo $referencia?>" >
                <input name="amount"        type="hidden"  value="<?php echo $infoPedido['valor']?>"   >
                <input name="tax"           type="hidden"  value="0"  >
                <input name="taxReturnBase" type="hidden"  value="0" >
                <input name="currency" id="currency"    type="hidden"  value="COP">
                <input name="signature"  id="signature"   type="hidden"  value="<?php echo $llave?>">
                <input name="test"          type="hidden"  value="<?php echo $infoTienda['payu_test'] ?>" >
                <input name="buyerEmail"    type="hidden"  value="<?php echo $infoPedido['email']?>" >
                <input name="responseUrl"    type="hidden"  value="<?php echo base_url()._PAYU_LINK_RESP?>" >
                <input name="confirmationUrl"    type="hidden"  value="<?php echo base_url()._PAYU_LINK_CONFIRM?>" > 
                <button type="submit" class="btn btn-primary" style="background:#000;color:#fff"><?php echo lang("text30")?></button>               
            </form><br><br> -->
        <!-- <img src="<?php echo base_url()?>/res/img/payuPagos.jpg" width="100%" alt=""> -->
        <!-- <a onclick="this.close()" class="btn btn-primary">CERRAR VENTANA</a> -->
        <!-- </center> -->
    </div>
<?php //}if($proveedor == 'wompi'){?>
    <div class="container">
        <center>
            <form action="https://checkout.wompi.co/p/" method="GET">
                <!-- OBLIGATORIOS -->
                <input type="hidden" name="public-key" value="<?php echo wompi_public_key;?>" />
                <input type="hidden" name="currency" value="COP" />
                <input type="hidden" name="amount-in-cents" value="<?php echo $infopedido['valor']?>00" />
                <input type="hidden" name="reference" value="<?php echo $referencia;?>" />
                <!-- OPCIONALES -->
                <input type="hidden" name="redirect-url" value="<?php echo base_url()._WOMPI_LINK_CONFIRM;?>" />
                <button type="submit" class="btn btn-primary" style="background:#000;color:#fff">PAGAR</button>
        </form><br><br>
        <img src="<?php echo base_url()?>/res/img/pagos-seguros-por-wompi.png" width="80%" alt="">
        <!-- <a onclick="this.close()" class="btn btn-primary">CERRAR VENTANA</a> -->
        </center>
    </div>
