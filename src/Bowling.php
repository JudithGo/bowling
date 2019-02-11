<?php

class Bowling
{

    public function convert(string $param) 
    {   
        $results = 0;
        $rolls = $this->convertFrames($param);

        foreach ($rolls as $key => &$elem){
            $results += $this->checkType($elem, $key, $rolls); 
        }
        return $results;
        
    }

    public function convertFrames(string $param){

        $arrayRolls = [];

        for($i=0;$i<strlen($param);$i++){ 
            if($i === (strlen($param)-1)){
                array_push($arrayRolls, $param{$i});
                return $arrayRolls;
            }

            if($param{$i} === 'x'){
                array_push($arrayRolls, 'x');
            }

            if($param{$i} !== 'x' && isset($param{$i+1})){
                $param0 = $param{$i} === '-' ? 0 : $param{$i};
                $param1 = $param{$i+1} === '-' ? 0 : $param{$i+1};
                             
                array_push($arrayRolls, $param0 . $param1);
 
                $i++;
            }
            
        }

        return $arrayRolls;
    }

    public function checkType(string $elem, int $key, array $rolls){
        if($this->isStrike($elem)){ 
            return $this->calculateStrike($elem, $key, $rolls);
        }
        if($this->isSpare($key, $rolls)){
            return $this->calculateSpare($key, $rolls);
        }
        if($this->isNumeric($key, $rolls)){
            return $this->calculateNumeric($key, $rolls);
        }


    }

    public function calculateStrike(string $elem, int $key, array $rolls){
        if(isset($rolls[$key+1]) && $this->isStrike($rolls[$key+1])){
            if(isset($rolls[$key+2])){
                return  $this->isStrike($rolls[$key+2]) ? 30 : 20 + $rolls[$key+2][0];
            }    
        }

        if(isset($rolls[$key+1]) && strlen($rolls[$key+1]) === 2){
            return $rolls[$key+1][1] === '/' ? 20 : 10 + $rolls[$key+2][0] + $rolls[$key+2][1];
        }


    }

    public function isStrike(string $elem){
        return $elem === 'x' ? true : false;

    }

    public function isSpare(string $key, array $rolls){
        return strlen($rolls[$key]) === 2 && $rolls[$key][1] === '/' ? true : false;

    }

    public function isNumeric(string $key, array $rolls){
        return strlen($rolls[$key]) === 2 ? true : false;

    }

    public function calculateSpare(int $key, array $rolls){
        if(isset($rolls[$key+1]) && $this->isStrike($rolls[$key+1])){
                return  20;   
        }

        if(isset($rolls[$key+1])){
            return 10 + $rolls[$key+1][0];
        }

    }

    public function calculateNumeric(int $key, array $rolls){

        if(isset($rolls[$key][1]) && $rolls[$key][1] === '/'){
                if(isset($rolls[$key+1]) && $this->isStrike($rolls[$key+1])){
                    return 20;
                }
                if(isset($rolls[$key+1])){
                   return 10 +  $rolls[$key][0];
                }
        }
        if(isset($rolls[$key][1])){
            return $rolls[$key][0] + $rolls[$key][1];
        }
    }


    // Primera iteración

    // public function convert(string $param) 
    // {   
    //     $turn = false;
    //     $acum = 0;
    //     $result = 0;
    //     $spare = false;

    //     $stringLength = strlen($param);

    //     for($i=0;$i<$stringLength;$i++){ 
            
    //         if(($param{$i} === 'x') && $i === 9){                
    //             if(($param{$i+1} ==='x') && ($param{$i+2}==='x')) {
    //                 $acum = 30;
    //             }
    //             if(($param{$i+2} ==='/')){
    //                 $acum = 20;
    //             }
    //             if(($param{$i+2} ==='-')){
    //                 $acum = $param{$i+1};
    //             }
    //             $i = $stringLength-1;
    //         }
    //         if(($param{$i} === 'x') && $i < 9){
    //             if(($param{$i} === 'x') && ($param{$i+1} === 'x') && ($param{$i+2} === 'x')){
    //                 $acum = 30;
    //             }
    //             if(($param{$i} === 'x') && (is_numeric($param{$i+1})) && (is_numeric($param{$i+2}))){
    //             $acum = 10 + $param{$i+1} +$param{$i+2};
    //             }

    //             if(($param{$i} === 'x') && (is_numeric($param{$i+1})) && ($param{$i+2}==='-')){
    //                 $acum = 10 + $param{$i+1};
    //             }
    //             if(($param{$i} === 'x') && (is_numeric($param{$i+1})) && ($param{$i+2}==='/')){
    //                 $acum = 10 + 10;
    //             }
    //         }

    //        if(is_numeric($param{$i})){
    //             $turn = !$turn;
    //             $acum += $param{$i};

    //             if($spare === true){
    //                 $result += $param{$i} +10;
    //                 $spare = false;
    //             }
                
    //        }

    //        if($param{$i} === '-'){
    //             $turn = !$turn;
    //        }
    //        if($param{$i} === '/'){
    //             $turn = !$turn;
    //             $acum = 0;
    //             $spare = true;
    //        }

    //        if(!$turn){
    //             $result += $acum;
    //             $acum = 0;
    //        }
    //    }
    //     return $result;
    // }


    // public function convert(string $param) 
    // {   
    //     $results = 0;
    //     $rolls = [];
    //     for($i=0;$i<strlen($param);$i++){ 
    //         if($param{$i} === 'x'){
    //             array_push($rolls, [10]);
    //         }
    //         if($param{$i} !== 'x'){
    //             array_push($rolls, [$param{$i}, $param{$i+1}]);
    //             $i++;
    //         }
    //     }

    //     foreach ($rolls as $key => &$elem){
    //         if($elem[0] === 'x'){ 
    //             $acum = 10;           
    //             if((count($rolls[$key+1])) === 1){
    //                 $acum += 10;
    //                 if((count($rolls[$key+2])) === 1){
    //                     $acum += 10;
    //                 }
    //                 if(count($rolls[$key+2]) === 2){
    //                     $acum += $rolls[$key+2][0];
    //                 }
    //             }
    //             if(count($rolls[$key+1]) === 2){
                    
    //             }
    //             $results += $acum;
    //             $acum = 0;
    //         }
    //     }
            
    //     return $results;
    // }    

}
