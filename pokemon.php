<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados do Pokémon</title>
    <link rel="stylesheet" href="css/result.css"> <!-- Arquivo CSS -->
    <link rel="shortcut icon" href="img/masterball.png" type="image/png">
</head>
<body>
    <!-- Imagem do logotipo -->
    <img src="img/Pokemon Database Search.png" alt="Logo do site" class="logo">

    <?php
    if (isset($_GET['pokemon'])) {
        $pokemon = strtolower(trim($_GET['pokemon']));

        // Ajusta o nome para Mimikyu-Disguised se o nome for Mimikyu
        if ($pokemon === "mimikyu") {
            $pokemon = "mimikyu-disguised";
        }

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
        // Mantém o nome original do Pokémon para a busca, mas altera para "mimikyu" caso seja "mimikyu-disguised"
        $search_pokemon_tcg = $pokemon === 'mimikyu-disguised' ? 'mimikyu' : $pokemon;
        $pokemontcg_url = "https://api.pokemontcg.io/v2/cards?q=name:$search_pokemon_tcg";
        $pokemontcg_response = get_data_with_curl($pokemontcg_url);

        if ($pokeapi_response === FALSE) {
            echo "<p class='error'>Erro ao buscar informações do Pokémon. Verifique o nome e tente novamente.</p>";
        } else {
            $data = json_decode($pokeapi_response, true);
            $name = ucfirst($data['name']);
            
            // Verifica se o Pokémon é Mimikyu-Disguised e ajusta o nome para Mimikyu
            if ($name == 'Mimikyu-disguised') {
                $name = 'Mimikyu'; // Altere para o nome desejado
            }

            $id = $data['id'];
            $height = $data['height'] / 10;
            $weight = $data['weight'] / 10;
            $sprite = $data['sprites']['front_default'];

            echo "<div class='pokemon-info'>";
        
            // Seção de informações do Pokémon
            echo "<div class='pokemon-details'>";
            echo "<h4>Informações: $name</h4>";
            echo "<p>ID: $id</p>";
            echo "<p>Altura: {$height} m</p>";
            echo "<p>Peso: {$weight} kg</p>";
            echo "<img src='$sprite' alt='$name' class='pokemon-sprite'>";
            echo "</div>"; // Fecha a div pokemon-details

            // Seção de carta do TCG
            if ($pokemontcg_response !== FALSE) {
                $tcg_data = json_decode($pokemontcg_response, true);

                if (isset($tcg_data['data'][0])) {
                    $card = $tcg_data['data'][0];
                    $card_name = $card['name'];
                    $card_image = $card['images']['large'];

                    echo "<div class='pokemon-card'>";
                    echo "<h4>Carta no TCG: $card_name</h4>";
                    echo "<img id='card-image' src='$card_image' alt='Carta de $card_name'>";
                    echo "</div>"; // Fecha a div pokemon-card
                } else {
                    echo "<p>Carta no TCG $name não encontrada. Busque pelo nome!</p>";
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
    <button onclick="goBack()" class="back-button">Voltar</button>

    <script src="js/scripts.js"></script> <!-- Arquivo JavaScript -->

</body>
</html>