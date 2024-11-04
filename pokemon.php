<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados do Pokémon</title>
    <link rel="stylesheet" href="css/result.css"> <!-- Arquivo CSS -->
</head>
<body>
    <!-- Imagem do logotipo -->
    <img src="img/Pokemon Database Search.png" alt="Logo do site" class="logo">

    <?php
    if (isset($_GET['pokemon'])) {
        $pokemon = strtolower(trim($_GET['pokemon']));

        // API da PokéAPI
        $pokeapi_url = "https://pokeapi.co/api/v2/pokemon/$pokemon/";
        
        // Função para obter dados usando cURL
        function get_data_with_curl($url) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10); // Timeout de 10 segundos
            $response = curl_exec($ch);
            curl_close($ch);
            return $response;
        }

        // Requisição à PokéAPI usando cURL
        $pokeapi_response = get_data_with_curl($pokeapi_url);

        // Requisição à Pokémon TCG API usando cURL
        $pokemontcg_url = "https://api.pokemontcg.io/v2/cards?q=name:$pokemon";
        $pokemontcg_response = get_data_with_curl($pokemontcg_url);

        if ($pokeapi_response === FALSE) {
            echo "<p class='error'>Erro ao buscar informações do Pokémon. Verifique o nome e tente novamente.</p>";
        } else {
            $data = json_decode($pokeapi_response, true);
            $name = ucfirst($data['name']);
            $id = $data['id'];
            $height = $data['height'] / 10;
            $weight = $data['weight'] / 10;
            $sprite = $data['sprites']['front_default'];

            echo "<div class='pokemon-info'>";
            echo "<h1>Informações do Pokémon: $name</h1>";
            echo "<p>ID: $id</p>";
            echo "<p>Altura: {$height} m</p>";
            echo "<p>Peso: {$weight} kg</p>";
            echo "<img src='$sprite' alt='$name' class='pokemon-sprite'>"; // Classe adicionada para aumentar o tamanho do Pokémon no PokéAPI

            if ($pokemontcg_response !== FALSE) {
                $tcg_data = json_decode($pokemontcg_response, true);

                if (isset($tcg_data['data'][0])) {
                    $card = $tcg_data['data'][0];
                    $card_name = $card['name'];
                    $card_image = $card['images']['large'];

                    echo "<h2>Carta do Pokémon TCG: $card_name</h2>";
                    echo "<img src='$card_image' alt='Carta de $card_name'>";
                } else {
                    echo "<p>Não foram encontradas cartas de TCG para $name.</p>";
                }
            } else {
                echo "<p class='error'>Erro ao buscar cartas na Pokémon TCG API.</p>";
            }
            echo "</div>"; // Fecha a div pokemon-info
        }
    } else {
        echo "<p class='error'>Por favor, forneça o nome de um Pokémon.</p>";
    }
    ?>

    <!-- Botão para voltar à página anterior -->
    <button onclick="history.back()" class="back-button">Voltar</button>

</body>
</html>