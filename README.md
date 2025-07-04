# Site-APEHAS
Dimensões para as Imagens do Carrossel
Proporção (Aspect Ratio):

Recomendo usar uma proporção widescreen, como 16:9. Esta é uma proporção comum para vídeos e apresentações e se adapta bem a layouts de sites modernos.
A altura do seu carrossel está definida no CSS para ser 70vh (70% da altura da janela do navegador). Como a largura do carrossel é 100% da largura do container, a proporção exata da área visível pode variar um pouco dependendo da tela do usuário. O object-fit: cover; no CSS cuidará para que sua imagem preencha esse espaço, cortando o mínimo necessário.
Resolução Recomendada:

Para garantir boa qualidade em telas grandes (como desktops e TVs), sugiro criar suas imagens com 1920 pixels de largura por 1080 pixels de altura (que é a resolução Full HD, na proporção 16:9).
Se você quiser ainda mais detalhes para telas de altíssima resolução, poderia ir para 2560x1440 pixels, mas 1920x1080px geralmente é um excelente equilíbrio entre qualidade e tamanho do arquivo.
Considerações Importantes:

Conteúdo Principal Centralizado: Como o CSS usa object-fit: cover; e a altura é relativa (70vh), partes da imagem (principalmente nas bordas superior/inferior ou laterais, dependendo da tela) podem ser cortadas. Por isso, é crucial que o assunto principal da sua foto esteja relativamente centralizado para garantir que ele sempre apareça.
Otimização para Web: Depois de criar suas imagens com alta qualidade, lembre-se de otimizá-las para a web antes de fazer o upload. Use ferramentas como TinyPNG, Squoosh, ou as opções "Salvar para Web" do seu editor de imagens para reduzir o tamanho do arquivo sem perder muita qualidade visual. Isso é vital para a velocidade de carregamento da página.
Em resumo para as imagens: Crie-as com 1920x1080 pixels, mantenha o foco no centro e otimize-as para a web.