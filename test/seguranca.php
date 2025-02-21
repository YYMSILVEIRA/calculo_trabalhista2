<?php
class AESKeyGenerator {
    public static function generateKey() {
        return base64_encode(random_bytes(32)); // 32 bytes (256 bits)
    }
}

class AESCrypt {
    public static function encrypt($plaintext, $key="") {
        if ($key == ""){
            $filePath = 'E:\\keyfile.enc';  // Ajuste conforme necessário
            // Ler o arquivo de chave criptografada
            $key = file_get_contents($filePath);
        }

        $iv = random_bytes(12); // IV de 12 bytes (96 bits)
        $tag = '';

        $ciphertext = openssl_encrypt(
            $plaintext,
            'aes-256-gcm',
            base64_decode($key),
            OPENSSL_RAW_DATA,
            $iv,
            $tag
        );

        // Concatena IV + TAG + TEXTO CRIPTOGRAFADO
        return base64_encode($iv . $tag . $ciphertext);
    }
}

class AESDecrypt {
    public static function decrypt($ciphertext, $key="") {
        $decoded = base64_decode($ciphertext);

        if ($key == ""){
            $filePath = 'E:\\keyfile.enc';  // Ajuste conforme necessário
            // Ler o arquivo de chave criptografada
            $key = file_get_contents($filePath);
            
        }

        // Extrai IV (12 bytes), Tag (16 bytes) e o texto criptografado
        $iv = substr($decoded, 0, 12);
        $tag = substr($decoded, 12, 16);
        $encryptedText = substr($decoded, 28);

        return openssl_decrypt(
            $encryptedText,
            'aes-256-gcm',
            base64_decode($key),
            OPENSSL_RAW_DATA,
            $iv,
            $tag
        );
    }
}


function criptografar($txt){
    $filePath = 'E:\\keyfile.enc';
    if (file_exists($filePath)){
    
        $Cript = new AESCrypt();
    
        $filePath = 'E:\\keyfile.enc';  // Ajuste conforme necessário
        // Ler o arquivo de chave criptografada
        $key = file_get_contents($filePath);
    
        return $Cript -> encrypt($txt, $key);
    }
    return "Chave não encontrada!";
}


function descriptografar($txt){
    $filePath = 'E:\\keyfile.enc';
    if (file_exists($filePath)){
        $DesCript = new AESDecrypt();
        $filePath = 'E:\\keyfile.enc';  // Ajuste conforme necessário
        // Ler o arquivo de chave criptografada
        $key = file_get_contents($filePath);
        
        return $DesCript -> decrypt($txt, $key);
    }
    return "Chave não encontrada!";
}



//$txt = criptografar("Olá mundo!");
//echo $txt."<br>";

//echo descriptografar("v+ecJ1QacvoLEgbHlYhykWujLmPvd0d+6mjyeCgnmINOzMgYgSKN");


?>
