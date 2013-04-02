<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ConverterEstiloMoeda
 *
 * @author HP
 */
class ConverterEstiloMoeda {
    //put your code here
    
    /*Pega valor e caso não eixtita casas decimais acresneta
    *caso existam verifa de seprador e um ponto
     * 
     */
    public function converterToMoedaPonto($stringValor){
        if(stripos($stringValor,".")!= false){
            return $stringValor;
        }else{
            //se xiste 
            if(stripos($stringValor,",") != false){
                $tempString = str_replace(",", ".",$stringValor);
                return $tempString;
            }else{
                $stringValor = $stringValor . ".00";
                return $stringValor;
            }
        }
        
    }
    
    public function converterToMoedaVirgula($stringValor){
        if(stripos($stringValor,",")!= false){
            return $stringValor;
        }else{
            //se xiste 
            if(stripos($stringValor,".") != false){
                $tempString = str_replace(".", ",",$stringValor);
                return $tempString;
            }else{
                $stringValor = $stringValor . ",00";
                return $stringValor;
            }
        }
    }
}

?>
