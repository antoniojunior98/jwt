<?php
 class JWT{
    public function __construct(){
        $this->secret = "AJ8012";
    }

    public function create($data){

        $header = json_encode(array("typ"=>"JWT", "alg"=>"HS256"));
        $payload = json_encode($data);

        $header = $this->base64url_encode($header);
        $payload = $this->base64url_encode($payload);

        $signature = hash_hmac("sha256", $header.".".$payload,$this->secret, true);
        $signature = $this->base64url_encode($signature);

        return $jwt = $header.".".$payload.".".$signature;

    }

    public function validate($token){

            $jwt_parts = explode('.',$token);

            if(count($jwt_parts) === 3){
                
            
                $signature = hash_hmac("sha256",$jwt_parts[0].".".$jwt_parts[1],$this->secret, true);
                $bSignature = $this->base64url_encode($signature);

                if($bSignature === $jwt_parts[2])
                {
                    $data = json_decode($this->base64url_decode($jwt_parts[1])); 
                    return $data;
                } else{
                    return false;
                }
            }else{
                echo "o jwt deve ter header, payload e signature. ";
            }

    }

    private function base64url_encode( $data ){
        return rtrim( strtr( base64_encode( $data ), '+/', '-_'), '=');
      }
      
    private function base64url_decode( $data ){
        return base64_decode( strtr( $data, '-_', '+/') . str_repeat('=', 3 - ( 3 + strlen( $data )) % 4 ));
    }
 }
?>