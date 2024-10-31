<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PokémonAPI: Buscador de Pokémons feito por Arthur/Juan</title>
</head>
<body>
  <!-- Barra de Pesquisa -->
  <form action="search.php" method="post">
    <input type="text" name="search_input" placeholder="Insira o nome do Pokémon">
    <button type="submit">Search</button>
  </form>
<?php

$poke_api_url = 'https://pokeapi.co/api/v2/pokemon?limit=9&offset=0';

// Lendo o arquivo JSON
$json_data = file_get_contents($poke_api_url);

// Decodando dados JSON em uma array PHP
$response_data = json_decode($json_data);

// Armazenamento de todos os resultados de Pokémon em uma variável
$poke_objects = $response_data->results;

// Busque dados do Pokémon um por um
foreach ($poke_objects as $pokemon) {
  // Armazene cada URL e nome de Pokémon em variáveis
  $name = $pokemon->name;
  $url = $pokemon->url;
  echo "<br />";
  echo $name;
  echo "<br />";
  // Lendo o arquivo JSON do URL do Pokémon
  $poke_json_data = file_get_contents($url);
  // Decodificando dados JSON em uma array PHP
  $poke_response_data = json_decode($poke_json_data);
  // Extraindo o URL da primeira imagem de sprite
  $poke_image_url = $poke_response_data->sprites->front_default;
  echo "<image src='$poke_image_url' alt='$name' />";
}

?>
</body>
</html>