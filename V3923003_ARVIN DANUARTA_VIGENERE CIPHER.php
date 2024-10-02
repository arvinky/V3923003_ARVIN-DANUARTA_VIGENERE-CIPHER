<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vigenere Cipher - Manchester United Theme</title>
    <style>
        /* Warna dan font tema Manchester United */
        body {
            background-color: #DA291C; /* Warna merah khas MU */
            color: white; /* Teks berwarna putih */
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            font-size: 2.5em;
            color: #FFE500; /* Warna kuning untuk judul */
            margin-top: 20px;
        }

        form {
            background-color: #000000; /* Warna hitam untuk form */
            border: 2px solid #FFE500; /* Bingkai kuning */
            border-radius: 10px;
            width: 50%;
            margin: 20px auto;
            padding: 20px;
            box-shadow: 0px 0px 10px 5px rgba(0, 0, 0, 0.5);
        }

        label, input {
            font-size: 1.2em;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: none;
            margin-bottom: 15px;
        }

        input[type="submit"] {
            background-color: #FFE500; /* Tombol berwarna kuning */
            color: black;
            border: none;
            padding: 10px 20px;
            font-size: 1.2em;
            cursor: pointer;
            border-radius: 5px;
            margin-right: 10px;
        }

        input[type="submit"]:hover {
            background-color: #000000; /* Hover ke warna hitam */
            color: #FFE500;
            border: 2px solid #FFE500;
        }

        h3 {
            color: #FFE500; /* Warna kuning untuk hasil teks */
            text-align: center;
            margin-top: 30px;
        }

        p {
            text-align: center;
            font-size: 1.5em;
        }
    </style>
</head>
<body>
    <h2>Enkripsi dan Dekripsi</h2>
    
    <form method="POST" action="">
        <label for="plaintext">Plaintext:</label><br>
        <input type="text" id="plaintext" name="plaintext" required><br><br>
        
        <label for="key">Key:</label><br>
        <input type="text" id="key" name="key" required><br><br>
        
        <input type="submit" name="action" value="Encrypt">
        <input type="submit" name="action" value="Decrypt">
    </form>

    <?php
    function vigenere_encrypt($plaintext, $key) {
        $ciphertext = "";
        $key = strtoupper($key);
        $key_len = strlen($key);
        $key_index = 0;

        for ($i = 0; $i < strlen($plaintext); $i++) {
            $char = $plaintext[$i];

            if (ctype_alpha($char)) {
                $shift = ord($key[$key_index % $key_len]) - ord('A');

                if (ctype_lower($char)) {
                    $ciphertext .= chr(((ord($char) - ord('a') + $shift) % 26) + ord('a'));
                } else {
                    $ciphertext .= chr(((ord($char) - ord('A') + $shift) % 26) + ord('A'));
                }

                $key_index++;
            } else {
                $ciphertext .= $char;
            }
        }
        return $ciphertext;
    }

    function vigenere_decrypt($ciphertext, $key) {
        $plaintext = "";
        $key = strtoupper($key);
        $key_len = strlen($key);
        $key_index = 0;

        for ($i = 0; $i < strlen($ciphertext); $i++) {
            $char = $ciphertext[$i];

            if (ctype_alpha($char)) {
                $shift = ord($key[$key_index % $key_len]) - ord('A');

                if (ctype_lower($char)) {
                    $plaintext .= chr(((ord($char) - ord('a') - $shift + 26) % 26) + ord('a'));
                } else {
                    $plaintext .= chr(((ord($char) - ord('A') - $shift + 26) % 26) + ord('A'));
                }

                $key_index++;
            } else {
                $plaintext .= $char;
            }
        }
        return $plaintext;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $plaintext = $_POST['plaintext'];
        $key = $_POST['key'];

        if ($_POST['action'] == 'Encrypt') {
            $result = vigenere_encrypt($plaintext, $key);
            echo "<h3>Encrypted Text: </h3><p>$result</p>";
        } elseif ($_POST['action'] == 'Decrypt') {
            $result = vigenere_decrypt($plaintext, $key);
            echo "<h3>Decrypted Text: </h3><p>$result</p>";
        }
    }
    ?>
</body>
</html>
