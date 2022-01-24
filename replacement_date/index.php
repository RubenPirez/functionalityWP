<?php

add_action( 'woocommerce_single_product_summary', "rp_fecha_prevista_stock", 30);	

function rp_fecha_prevista_stock(){

// Reemplazamos el formato de la fecha actual para que se el mismo que el de la fecha prevista de disponibilidad
// No es necesario y depende del formato en que nos manden los datos de los productos, pero así se trabaja con el mismo formato
	$fecha_ctual = str_replace('-', '/', date('d-m-Y'));
	global $product;
	$cant_stock = $product->get_stock_quantity();
	$url_product = rawurlencode("Hola, me gustaría recibir información sobre la disponibilidad de este producto: ".get_permalink($product->get_id()));
	$subject = "Información disponibilidad de procucto";
// Se comprueba que el campo personalizado existe
  	if (function_exists('get_field')){
	// Se comprueba que no hay stock del producto
		if ( ($cant_stock == 0 && $cant_stock !== null) || $product->get_stock_status() !== 'instock' ){
		// Esta función transforma tanto la fecha prevista de disponibilidad como la fecha actual a fecha juliana, para poder trabajar de forma fácil
		// con operaciones matemáticas 			
				function compararFechas($fc_disp, $fc_act) {

					$val_fc_disp = explode ("/", $fc_disp);   
					$val_fc_act = explode ("/", $fc_act); 

					$d_fc_disp = $val_fc_disp[0];  
					$m_fc_disp = $val_fc_disp[1];  
					$a_fc_disp = $val_fc_disp[2]; 

					$d_fc_act = $val_fc_act[0];  
					$m_fc_act = $val_fc_act[1];  
					$a_fc_act = $val_fc_act[2];

					$ds_fc_disp_jul = gregoriantojd($m_fc_disp, $d_fc_disp, $a_fc_disp);  
					$ds_fc_act_jul = gregoriantojd($m_fc_act, $d_fc_act, $a_fc_act);     

					if(!checkdate($m_fc_disp, $d_fc_disp, $a_fc_disp)){
						// "La fecha ".$fc_disp." no es válida";
						return -1;

					}else if(!checkdate($m_fc_act, $d_fc_act, $a_fc_act)){
						// "La fecha ".$fc_act." no es válida";
						return -1;

					}else{
						return ($ds_fc_disp_jul - $ds_fc_act_jul);
					} 

				}
		// si no está vacío el campo personalizado de "fecha prevista de disponibilidad" 
		// y si la función que hemos creado cumple con los requisitos establecidos, mostrará la fecha prevista de disponibilidad	
			if ( !empty(get_field('disp-stock')) ){
				if (compararFechas(get_field('disp-stock'), $fecha_ctual) >= 0 && compararFechas(get_field('disp-stock'), $fecha_ctual) < 365){
					echo "<p><strong>Fecha prevista de disponibilidad: </strong> " .get_field('disp-stock') ."</p>";
				}
			}
		// muestra por pantalla los 2 enlaces para contactar con el ecommerce, por WhatsApp o por Email, con texto y/o asunto predeterminado (url producto)
			echo "<p> Si necesitas más información sobre la disponibilidad de este producto, contacta con nosotros a través de: <br>
			<a class = \"btn-info\" target=\"_blank\" href=\"https://api.whatsapp.com/send?phone=***********&text=$url_product\"> WhatsApp </a>
			<a class = \"btn-info\" target=\"_blank\" href=\"mailto:info@rpnformatica.es?subject=$subject&body=$url_product\"> Email </a></p>";
		}
 	}	
}