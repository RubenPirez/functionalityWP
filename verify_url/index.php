<?php

add_action( 'woocommerce_single_product_summary', "rp_ficha_producto_url", 23 );

function rp_ficha_producto_url(){
   
    if ( function_exists('get_field') ){
        $url = get_field('ficha');
		
	// si el campo ficha tiene datos, lo muestra, si está vacío no muestra nada
		if ( !empty(get_field('ficha')) ){
		// controlará que la url resultante siempre comience por "https"
		// si la url que llega ya empieza por "https"
			if ( strpos($url, 'https') !== false ){   
				echo '<button class="boton-ficha" id="abrir-pop-up">Ficha Completa</button>';   
				$url = $url; 
			}
		// si la url que llega comienza por "http"
			else if ( stristr($url, 'http') !== false ){
				$url = str_replace('http', 'https', $url);
				echo '<button class="boton-ficha" id="abrir-pop-up"> Ficha Completa </button>';
			}
		// si la url que llega no comienza ni por "http" ni "https"
			else if ( strpos($url, 'https') == false && strpos($url, 'http') == false ){
				echo '<button class="boton-ficha" id="abrir-pop-up"> Ficha Completa </button>';
				$url = 'https://'.$url;
			}
		}
    }
	
  echo '
    <div id="fondo">
		<div id="pop-up">
			<button id="cerrar-pop-up">
				<span>×</span> 
			</button>             
			<iframe src="'.$url.'" frameborder="2" width="100%" height="600px"></iframe>
		</div>
	</div>';

} 