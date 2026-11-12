# Suh & Lele

Contador de dias juntos, nas duas vidas.

Online: https://leandrobatissta.github.io/siteSuh/

## Como adicionar um vídeo de fundo

O fundo do site sorteia os vídeos `suhNN.mp4`: todos tocam uma vez, em ordem aleatória, antes de qualquer um repetir. Para incluir um novo, siga este padrão.

### 1. Converter (preto e branco, leve, sem áudio)

Padrão de saída: **preto e branco**, vertical **1080×1920**, H.264, **sem áudio**, 30 fps, com `faststart`. Não coloque o arquivo original (`.mov` do iPhone) no repositório: ele é grande demais.

Vídeo comum (SDR), como gravação de tela:

```bash
ffmpeg -i ORIGINAL.mov -an \
  -vf "fps=30,format=gray,format=yuv420p" \
  -c:v libx264 -preset veryslow -crf 30 -maxrate 1500k -bufsize 3000k \
  -profile:v high -level 4.2 -g 60 -keyint_min 30 \
  -colorspace bt709 -color_primaries bt709 -color_trc bt709 \
  -movflags +faststart suhNN.mp4
```

Vídeo do iPhone em **HDR** (`.MOV` com HLG/BT.2020): trocar o `-vf` por este, senão o preto e branco sai lavado:

```bash
-vf "fps=30,scale=in_color_matrix=bt2020:out_color_matrix=bt709,format=gbrp10le,eq=contrast=1.15:gamma=1.1:saturation=0,format=gray,format=yuv420p"
```

Para saber se é HDR: `ffprobe -show_entries stream=color_transfer ORIGINAL.mov` (`arib-std-b67` = HDR). Gravação de tela em tela cheia (`yuvj420p`): acrescentar `scale=in_range=full:out_range=tv` antes de `format=gray`.

### 2. Regra dos 15 segundos

**Não é preciso cortar** o vídeo. O site já cuida disso:

- Vídeo de **até 15 s** toca inteiro.
- Vídeo **com mais de 15 s** toca **15 s**, pausa e passa para o próximo. Quando for sorteado de novo, **continua de onde parou**. Ao chegar ao fim, volta ao começo.
- Isso é automático. Os limites estão em `SEG_MAX` e `LONG_MIN` no `index.html`.
- O ponto onde parou fica guardado na sessão do navegador.

Isso evita ficar muito tempo no mesmo vídeo e o travamento por vídeo grande. Se o fundo ficar parado por 8 s, o site também pula sozinho para o próximo.

### 3. Registrar no `index.html`

1. Copie o arquivo para a raiz do repositório com o próximo número (`suh25.mp4`...).
2. Inclua o nome na lista `videoSources`.
3. Para o vídeo aparecer **inteiro, sem cortar** (padrão para os verticais completos), inclua também na lista `noCrop`. Fora dela, o vídeo preenche a tela e corta as bordas.

### 4. Conferir antes de publicar

- Peso: bem abaixo de 20 MB (um vídeo de 15 s costuma ficar entre 1 e 3 MB).
- Veja um quadro do resultado: preto e branco, na posição certa, sem barras do app em volta. Em gravação de tela, corte a interface (`crop=`) antes de converter.
- Teste abrindo o site: o vídeo toca e troca para o próximo.

## Vídeo surpresa (`surpresa.mp4`)

O **coração** (que cai) e o **presente** 🎁 (que sobe) são easter eggs sorteados **de tempos em tempos, sem limite**, enquanto o site está aberto depois da charada: a cada 20 s há um sorteio, com 15% de soltar o coração e 15% de soltar o presente (70% de não aparecer nada). Só um por vez, e nunca durante a surpresa nem o jogo Flap. Se a pessoa **tocar** no presente, toca o `surpresa.mp4` em tela cheia, com som; ao terminar (ou no ✕) o fundo volta. Se ninguém tocar, ele some. O vídeo **só é baixado no toque**.

- Para testar sem esperar a sorte: abra o site com `?surpresa=1` na URL e responda a charada.
- O intervalo e as chances ficam no topo do bloco de easter eggs do `index.html`: `EGG_INTERVALO_MS`, `EGG_CHANCE_CORACAO` e `EGG_CHANCE_PRESENTE`.
- `?surpresa=1` solta o presente já na entrada.
- Padrão do arquivo: preto e branco, vertical 1080×1920, H.264, **com áudio** (AAC 96 kbps), `faststart`. Vídeo do iPhone em HDR usa o `-vf` HDR da seção acima. Ele **não entra** em `videoSources` (não é fundo) e não segue a regra dos 15 s: toca inteiro.

## Sair e senha mestra

- O botão **Sair** (canto superior direito) apaga a sessão e volta para a charada.
- Além das charadas, o portão aceita uma **senha mestra**. Só o hash SHA-256 dela fica no código (a frase não aparece no repositório).

## Jogo Flap (`flapsuh.html`)

- O jogo abre sobre a tela e o canvas (320×480) é ampliado para caber, sem cortar.
- **Desistir** é uma brincadeira: pergunta "Você quer mesmo desistir do nosso amor?". **Não** volta para o jogo; **Sim** chora por 30 segundos (`CHORO_MS` no `flapsuh.html`) e sai, deixando um botão "Voltar ao jogo" bem apagado no site (some em 20 s).
