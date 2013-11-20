<?php
/**
 * Clase Paginador.
 * Su responsabilidad es realizarnos el paginado de una consulta, es decir
 * proporcionar datos para realizar la barra de navegacion de la paginacion.
 * @package     varias creado en el projecto librerias
 * @copyright   2011 - ObjetivoPHP
 * @license     Gratuito (Free) http://www.opensource.org/licenses/gpl-license.html
 * @author      Marcelo Castro (ObjetivoPHP)
 * @link        objetivophp@gmail.com
 * @version     3.0.0 (16/06/2008 - 28/08/2011)
 */
class Paginador
{
    /**
     * Contiene los titulos que se mostraran en la barra de navegacion. O sea
     * primera, anteriror, .... , ultima, siguiente etc...
     * @var array 
     */
    private $_titulos = array('primero'           => array('vista'  => '| Primero ...',
                                                           'title'  => 'Ir a la primera Pagina',
                                                           'class'  => null,
                                                           'off'    => null),
                              'bloqueAnterior'    => array('vista'  => '<<',
                                                           'title'  => 'Bloque Anterior',
                                                           'class'  => null,
                                                           'off'    => null),
                              'anterior'          => array('vista'  => '<',
                                                           'title'  => 'Pagina Anterior',
                                                           'class'  => null,
                                                           'off'    => null),
                              'siguiente'         => array('vista'  => '>',
                                                           'title'  => 'Pagina Siguiente',
                                                           'class'  => null,
                                                           'off'    => null),
                              'bloqueSiguiente'   => array('vista'  => '>>',
                                                           'title'  => 'Bloque Siguiente',
                                                           'class'  => null,
                                                           'off'    => null),
                              'ultimo'            => array('vista'  => '... Ultimo |',
                                                           'title'  => 'Ir a la Ultima Pagina',
                                                           'class'  => null,
                                                           'off'    => null),
                              'numero'            => array('vista'  => null,
                                                           'title'  => 'Ir a la pagina ',
                                                           'class'  => null,
                                                           'off'    => null),
                              'actual'            => array('vista'  => null,
                                                           'title'  => 'Estas viendo esta pagina',
                                                           'class'  => null,
                                                           'off'    => null));

    /**
     * Contiene los marcadores que van antes y despues de la pagina actual,
     * para identificarla visualmente en la barra de navegacion del paginador.
     * @var array
     */
    private $_marcador = array('antes'      => '|',
                               'despues'    => '|');

    /**
     * Guarda el resultado de la paginacion por si es requrido mas tarde.
     * Formato array('vista' => 'primero', 'numero' => 0).
     * @var array
     */
    private $_paginacion = array();

    /**
     * Es la cantidad de registros, filas de la tabla que se mostraran por cada
     * pantalla.
     * @var integer
     */
    private $_cantidadDeRegistrosPorPagina = 10;

    /**
     * Es la cantidad de Enlaces o vinculos que contendra el paginador, sin contar
     * los especiales como ser primero, ultimo etc..
     * @var integer
     */
    private $_cantidadDeEnlacesDelPaginador = 10;

    /**
     * Contiene la cantidad total de paginas del paginador.
     * @var integer
     */
    private $_cantidadPaginas;
    
    /**
     * Contiene los enlaces que no se mostraran o no seran generados.
     * @var array 
     */
    private $_omitir    = array();
    
    /**
     * Contiene la Pagina Actual.
     * @var integer 
     */
    private $_pagActual;
    
    /**
     * Contiene el string que se debe propagar por URL.
     * @var string
     */
    private $_propagar;
    
    /**
     * Contiene la pagina a la cual debera apuntar los enlaces.
     * @var string
     */
    private $_urlDestino = null;
    
    /**
     * Metodo __construct.
     * Crea el objeto Paginador.
     * @param   integer $crpp   Cantidad de Registros a desplegarse en cada Pagina.
     * @param   integer $cepp   Cantidad de enlaces del paginador, sin especiales.
     * @return  void
     */
    public function  __construct($crpp = 10, $cep = 10)
    {
        $this->_cantidadDeRegistrosPorPagina    = ((int)$crpp > 0)? $crpp : 10;
        $this->_cantidadDeEnlacesDelPaginador   = ((int)$cep > 0)? $cep : 10;
    }

    /**
     * Metodo setCantidadRegistros.
     * Configura la cantidad de registros que se desplegan en la pantalla.
     * @param   integer $cantidad   Cantidad de Registros por pagina.
     * @return  void
     */
    public function setCantidadRegistros($cantidad = 10)
    {
        $this->_cantidadDeRegistrosPorPagina    = ((int)$cantidad > 0)? $cantidad : 10;
    }

    /**
     * Metodo setCantidadEnlaces.
     * Configura la cantidad de enlaces que contendra el paginador sin considerar los
     * enlaces especiales.
     * @param   integer $cantidad   Cantidad de Enlaces que se quieren mostrar.
     * @return  void
     */
    public function setCantidadEnlaces($cantidad = 10)
    {
        $this->_cantidadDeEnlacesDelPaginador   = ((int)$cantidad > 0)? $cantidad : 10;
    }

    /**
     * Propaga variables por el metodo GET, solo para ser usado con la funcion
     * getHtmlPaginacion.
     * @param array $variables Variables a propagar.
     * @return void
     */
    public function setPropagar(Array $variables)
    {
        $getUrl = '&';
        foreach ($variables as $valor) {
            $valorUrl= isset($_GET[$valor])? $_GET[$valor] : null;
            $getUrl .= urlencode($valor) . '=' . $valorUrl . '&';
        }
        $getUrl = substr($getUrl, 0, strlen($getUrl)-1);
        $this->_propagar = $getUrl;
    }
    
    
    /**
     * Metodo paginar.
     * Realiza el paginado, generando todos los bloques.
     * @param   integer $pagina Contiene desde que pagina se desplegara.
     * @param   integer $cantidadDeResultados  total de resutados de la consulta.
     * @return  array
     */
    public function paginar($pagina,$cantidadDeResultados)
    {
        $pagina = ((int)$pagina < 0)? 0 : $pagina;
        $this->_pagActual = $pagina;
        if ($cantidadDeResultados < 1) { // No hay resultados que paginar
            return false;
        }
        // Aqui significa que tenemos resultados y vamos a paginar
        // Preparo las variables que se utilizaran
        $paginaInicial  = $paginaFinal    = 0;
        $paginacion     = array();
        $totalPaginas	= ceil($cantidadDeResultados / $this->_cantidadDeRegistrosPorPagina);

        if ($totalPaginas < 2) { // Si es menor a 2 es una pagina por lo tanto no pagino.
            $this->_cantidadPaginas = 1;
            return false;
        }

        if ($totalPaginas <= $this->_cantidadDeEnlacesDelPaginador) {
            $paginaInicial		= 1;
            $paginaFinal		= $totalPaginas;
        } else {
            $centroPaginador 	= floor($this->_cantidadDeEnlacesDelPaginador / 2);
            $paginaInicial      = ($pagina+1) - $centroPaginador;
            $paginaFinal        = $paginaInicial + $this->_cantidadDeEnlacesDelPaginador - 1;

            if ($paginaFinal > $totalPaginas) {
                $paginaFinal    = $totalPaginas;
                $paginaInicial  = $paginaFinal - ($this->_cantidadDeEnlacesDelPaginador -1);
            }

            if ($paginaInicial < 1) {
                $paginaInicial	= 1;
                $paginaFinal	= $this->_cantidadDeEnlacesDelPaginador;
            }
        }

        $ajuste         = floor($this->_cantidadDeEnlacesDelPaginador / 2);
        $ajuste2        = 1 - ($this->_cantidadDeEnlacesDelPaginador % 2);
        $blockInicio	= $paginaInicial - $this->_cantidadDeEnlacesDelPaginador + $ajuste  - 1;
        $blockFinal     = $paginaFinal + $this->_cantidadDeEnlacesDelPaginador - $ajuste  + $ajuste2;
        $paginaInicial	= $paginaInicial - 1;
        $paginaFinal	= $paginaFinal - 1;
        
        /* Configuro Los sectores de la paginacion */
        $this->_primera($paginaInicial);
        $this->_bloqueAnterior($blockInicio, $ajuste);
        $this->_anterior($pagina);
        $this->_paginacion($pagina, $paginaInicial, $paginaFinal);
        $this->_siguiente($pagina, $totalPaginas);
        $this->_bloqueSiguiente($paginaFinal, $totalPaginas, $blockFinal);
        $this->_ultima($paginaFinal, $totalPaginas);
        
        $this->_cantidadPaginas = $totalPaginas;
        return $this->_paginacion;
    }

    /**
     * Metodo setTitulosVista.
     * Configura los simbolos que se usaran para el enunciado de bloques,
     * primero, ultimo, anterior, siguiente etc...
     * @param   string  $titulo Titulo que se desea cambiar. primero, ultimo etc.
     * @param   string  $valor  Valor que tendra la etiqueta.
     * @return  void
     */
    public function setTitulosVista($titulo, $valor)
    {
        if (array_key_exists($titulo, $this->_titulos)) {
           $this->_titulos[$titulo]['vista'] = htmlspecialchars($valor) ;
        }
    }

    /**
     * Configura la propiedad title del enlace.
     * @param   string  $titulo Etiqueta a la que se desea cambiar la propiedad title.
     * @param   string  $valor  Valor que tendra la etiqueta.
     * @return  void
     */
    public function setTitulosTitle($titulo, $valor)
    {
        if (array_key_exists($titulo, $this->_titulos)) {
           $this->_titulos[$titulo]['title'] = htmlspecialchars($valor);
        }
    }
    
    /**
     * Configura la clase a aplicar a cada tipo de enlace.
     * @param   string  $titulo     tipo de enlace al que se le quiere poner un estilo.
     * @param   string  $clase      nombre de la clase de estilo a aplicar.
     * @param   string  $claseOff   
     * @return  void  
     */
    public function setClass($titulo, $clase = null, $claseOff = null)
    {
        if (array_key_exists($titulo, $this->_titulos)) {
           $this->_titulos[$titulo]['class']    = $clase;
           $this->_titulos[$titulo]['off']      = $claseOff;
        }
    }

    /**
     * Configura el marcador para la pagina en visualizacion.
     * @param   string  $antes      Simbolo que va antes del enlace de pagina actual.
     * @param   string  $despues    Simbolo que va despues del enlace de la pagina actual.
     * @return  void
     */
    public function setMarcador($antes, $despues)
    {
        $this->_marcador['antes']   = htmlspecialchars($antes);
        $this->_marcador['despues'] = htmlspecialchars($despues);
    }

    /**
     * Configura los enlaces que no seran mostrados.
     * @param   array   $omitir arreglo que contiene los enlaces a omitirse.
     * @return  void
     */
    public function setOmitir($omitir = array())
    {
        if (is_array($omitir)) {
            $this->_omitir = $omitir;
        }
    }
    
    /**
     * Configura a que pagina deberan apuntar los enlaces de la barra de navegacion.
     * @param   string    $url    Url destino
     * @return  void
     */
    public function setUrlDestino($url = null)
    {
        $this->_urlDestino = empty ($url)? $_SERVER['PHP_SELF'] : $url;
    }
    
    /**
     * Nos retorna el arreglo de paginacion.
     * @return array
     */
    public function getPaginacion()
    {
        return $this->_paginacion;
    }

    /**
     * Retorna una coleccion de enlaces HTML.
     * @param   string  $varGet Variable utilizada para paginar.
     * @param   string  $cont   Tag HTML usado como contenedor y el cual lleva los estilos.
     * @return  array           Contiene cada uno de los enlaces.
     */
    public function getHtmlPaginacion($varGet = 'pagina', $cont = 'li')
    {
        $paginador = array();
        foreach ($this->_paginacion as $enlace) {
            $htmlPag    = '';
            if ($enlace['class']) {
                $htmlPag   .= '<' . $cont;
                if ($enlace['class'] != '<>' ) {
                    $htmlPag   .=  ' class="' . $enlace['class'] . '" ';
                }
                $htmlPag   .= '>';
            }
            
            if ($enlace['numero'] != $this->_pagActual && empty ($enlace['off'])) {
            $htmlPag   .= '<a href="' . $this->_urlDestino . '?' . $varGet . '=' 
                        . $enlace['numero'] 
                        . $this->_propagar . '" '
                        . 'title="' . $enlace['title'] . '" '
                        . '>' . $enlace['vista'] . '</a>'; 
            } else {
                $htmlPag   .= $enlace['vista'] ;
            }
            
            if ($enlace['class']) {
                $htmlPag   .= '</' . $cont . '>';
            }
            $paginador[]= $htmlPag;
        }
        
        return $paginador;
    }
    
    /**
     * Metodo getCantidadPaginas.
     * Nos retorna la cantidad de paginas que tiene el paginador.
     * @return integer
     */
    public function getCantidadPaginas()
    {
        return $this->_cantidadPaginas;
    }
    
    private function _primera($paginaInicial)
    {
        if ($paginaInicial != 0 && !in_array('primero', $this->_omitir)) {
            $this->_paginacion[]    = array('numero'   => 0,
                                            'vista'    => $this->_titulos['primero']['vista'],
                                            'title'    => $this->_titulos['primero']['title'],
                                            'class'    => $this->_titulos['primero']['class']);
        } elseif ($this->_titulos['primero']['off']) {
            $this->_paginacion[]    = array('numero'   => 0,
                                            'vista'    => $this->_titulos['primero']['vista'],
                                            'title'    => $this->_titulos['primero']['title'],
                                            'class'    => $this->_titulos['primero']['off'],
                                            'off'      => true);
        }
	}
    
    private function _bloqueAnterior($blockInicio, $ajuste)
    {
        if ($blockInicio >= $ajuste && !in_array('bloqueAnterior', $this->_omitir)) {
            $this->_paginacion[]    = array('numero'    => $blockInicio,
                                            'vista'     => $this->_titulos['bloqueAnterior']['vista'],
                                            'title'     => $this->_titulos['bloqueAnterior']['title'],
                                            'class'     => $this->_titulos['bloqueAnterior']['class']);
        } elseif ($this->_titulos['bloqueAnterior']['off']) {
            $this->_paginacion[]    = array('numero'   => 0,
                                            'vista'    => $this->_titulos['bloqueAnterior']['vista'],
                                            'title'    => $this->_titulos['bloqueAnterior']['title'],
                                            'class'    => $this->_titulos['bloqueAnterior']['off'],
                                            'off'      => true);
        }
    }
    
    private function _anterior($pagina)
    {
        if($pagina > 0 && !in_array('anterior', $this->_omitir)) {
            $this->_paginacion[]    = array('numero'    => $pagina-1,
                                            'vista'     => $this->_titulos['anterior']['vista'],
                                            'title'     => $this->_titulos['anterior']['title'],
                                            'class'     => $this->_titulos['anterior']['class']);
        } elseif($this->_titulos['anterior']['off']) {
            $this->_paginacion[]    = array('numero'   => 0,
                                            'vista'    => $this->_titulos['anterior']['vista'],
                                            'title'    => $this->_titulos['anterior']['title'],
                                            'class'    => $this->_titulos['anterior']['off'],
                                            'off'      => true);    
        }
    }
    
    private function _paginacion($pagina, $paginaInicial, $paginaFinal)
    {
        for ( $f = $paginaInicial; $f <= $paginaFinal; $f++) {
            if ($f != $pagina && !in_array('numero', $this->_omitir)) {
                $this->_paginacion[]    = array('numero'    => $f,
                                                'vista'     => $this->_titulos['numero']['vista'] . ($f+1),
                                                'title'     => $this->_titulos['numero']['title'] . ($f+1),
                                                'class'     => $this->_titulos['numero']['class']);
            } elseif (!in_array('actual', $this->_omitir)) {
            $this->_paginacion[]    = array('numero'    => $f,
                                            'vista'     => $this->_titulos['actual']['vista']
                                                        . $this->_marcador['antes']
                                                        . ($f+1) . $this->_marcador['despues'],
                                                        'title'     => $this->_titulos['actual']['title'],
                                                        'class'     => $this->_titulos['actual']['class']);
            }
        }
    }
    
    private function _siguiente($pagina, $totalPaginas)
    {
        if ($pagina < ($totalPaginas-1) && !in_array('siguiente', $this->_omitir)) {
            $this->_paginacion[]    = array('numero'    => $pagina+1,
                                            'vista'     => $this->_titulos['siguiente']['vista'],
                                            'title'     => $this->_titulos['siguiente']['title'],
                                            'class'     => $this->_titulos['siguiente']['class']);
        } elseif($this->_titulos['siguiente']['off']) {
            $this->_paginacion[]    = array('numero'   => 0,
                                            'vista'    => $this->_titulos['siguiente']['vista'],
                                            'title'    => $this->_titulos['siguiente']['title'],
                                            'class'    => $this->_titulos['siguiente']['off'],
                                            'off'      => true);    
        }
    }
    
    private function _bloqueSiguiente($paginaFinal, $totalPaginas, $blockFinal)
    {
        if ($paginaFinal <= ($totalPaginas - $this->_cantidadDeEnlacesDelPaginador - 1) && !in_array('bloqueSiguiente', $this->_omitir)) {
            $this->_paginacion[]    = array('numero'    => $blockFinal-1,
                                            'vista'     => $this->_titulos['bloqueSiguiente']['vista'],
                                            'title'     => $this->_titulos['bloqueSiguiente']['title'],
                                            'class'     => $this->_titulos['bloqueSiguiente']['class']);
        } elseif($this->_titulos['bloqueSiguiente']['off']) {
            $this->_paginacion[]    = array('numero'   => 0,
                                            'vista'    => $this->_titulos['bloqueSiguiente']['vista'],
                                            'title'    => $this->_titulos['bloqueSiguiente']['title'],
                                            'class'    => $this->_titulos['bloqueSiguiente']['off'],
                                            'off'      => true);    
        }
    }
    
    private function _ultima($paginaFinal, $totalPaginas)
    {
        if ( $paginaFinal != ($totalPaginas - 1) && !in_array('ultimo', $this->_omitir)) {
            $this->_paginacion[]    = array('numero'    => $totalPaginas-1,
                                            'vista'     => $this->_titulos['ultimo']['vista'],
                                            'title'     => $this->_titulos['ultimo']['title'],
                                            'class'     => $this->_titulos['ultimo']['class']);
        } elseif ($this->_titulos['ultimo']['off']) {
            $this->_paginacion[]    = array('numero'   => 0,
                                            'vista'    => $this->_titulos['ultimo']['vista'],
                                            'title'    => $this->_titulos['ultimo']['title'],
                                            'class'    => $this->_titulos['ultimo']['off'],
                                            'off'      => true);
        }
    }
}