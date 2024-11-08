<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Pokémon</title>
    <link rel="stylesheet" href="css/main.css"> <!-- Arquivo CSS -->
    <link rel="shortcut icon" href="img/masterball.png" type="image/png">
</head>
<body>
    <!-- Imagem do logotipo -->
    <img src="img/Pokemon Database Search.png" alt="Logo do site" class="logo">

 <form id="pokemonForm" action="pokemon.php" method="GET">
    <label for="pokemon">Nome do Pokémon:</label>
    <div style="position: relative; width: 100%;"> <!-- Contêiner que alinha o dropdown -->
        <input type="text" id="pokemon" name="pokemon" placeholder="Apenas o nome do Pokémon" oninput="fetchPokemonSuggestions()" required>
        <div id="suggestions" class="suggestions-dropdown"></div>
    </div>
    <button type="button" id="submitButton" onclick="submitForm()" disabled>Buscar</button>
</form>

    <div class="projects">
        <p class="projects-text">Veja meus outros projetos:</p>
        <div class="project-item">
            <img src="img/Sonic Memory Game.png" alt="Projeto 1" class="project1" id="project1">
        </div>
    </div>

    <script src="js/scripts.js"></script> <!-- Arquivo JavaScript -->
</body>
</html>