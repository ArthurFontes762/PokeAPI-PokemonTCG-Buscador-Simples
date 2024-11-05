<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Pokémon</title>
    <link rel="stylesheet" href="css/main.css"> <!-- Arquivo CSS -->
</head>
<body>
    <!-- Imagem do logotipo -->
    <img src="img/Pokemon Database Search.png" alt="Logo do site" class="logo">

    <form id="pokemonForm" action="pokemon.php" method="GET">
        <label for="pokemon">Nome do Pokémon:</label>
        <input type="text" id="pokemon" name="pokemon" placeholder="Apenas o nome do Pokémon" required>
        <button type="button" id="submitButton" onclick="submitForm()" disabled>Buscar</button> <!-- Inicia desativado -->
    </form>

    <script src="js/scripts.js"></script> <!-- Arquivo JavaScript -->
</body>
</html>