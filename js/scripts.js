// Garantir que o DOM foi carregado antes de rodar o script
document.addEventListener('DOMContentLoaded', function() {
    // Obter a imagem pelo ID
    const image = document.getElementById('project1');
    
    // Verifique se o elemento realmente existe
    if (image) {
      image.addEventListener('click', function() {
        // Redirecionar para a URL externa
        window.open('https://arthurfontes762.github.io/Sonic-Memory-Game-JavaScript-2024_08_29/', '_blank');
      });
    }
});

// Função para enviar o formulário
function submitForm() {
    const form = document.getElementById('pokemonForm');
    form.submit();
}

// Função para enviar o formulário
function submitForm() {
    const form = document.getElementById('pokemonForm');
    form.submit();
}

// Função para ativar o botão quando houver 3 caracteres ou mais
function checkInput() {
    const inputField = document.getElementById('pokemon');
    const submitButton = document.getElementById('submitButton');

    // Adicione logs para depuração
    console.log("Input value:", inputField.value); // Verifica o valor do input
    console.log("Button disabled status before check:", submitButton.disabled); // Verifica o estado do botão

    if (inputField.value.length >= 3) {
        submitButton.disabled = false; // Ativa o botão
    } else {
        submitButton.disabled = true; // Desativa o botão
    }

    // Adicione um log para o estado do botão após a verificação
    console.log("Button disabled status after check:", submitButton.disabled); // Verifica o estado do botão
}

// Inicializa o botão como desativado ao carregar a página
document.addEventListener('DOMContentLoaded', (event) => {
    const submitButton = document.getElementById('submitButton');
    submitButton.disabled = true; // Define o botão como desativado inicialmente

    // Adiciona o evento de entrada no campo de texto
    document.getElementById('pokemon').addEventListener('input', checkInput);
    
    // Chama checkInput para configurar o botão inicialmente
    checkInput(); 
});

// Função para voltar à página principal
function goBack() {
    history.back(); // Volta à página anterior
}