-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 16-Set-2022 às 16:53
-- Versão do servidor: 10.4.22-MariaDB
-- versão do PHP: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `news`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `first_name` varchar(600) NOT NULL,
  `last_name` varchar(600) NOT NULL,
  `email` varchar(600) NOT NULL,
  `password` varchar(600) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `admins`
--

INSERT INTO `admins` (`id`, `first_name`, `last_name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Gabriel', 'Gomes', 'gabrielgomess@hotmail.com', '$2y$10$W1VpXXRh0eyCrhEtWhs21uQbZ4KNy.6WaXQCQlXpMZn9ZJNK1J1Fi', '2022-07-30 12:12:48', '2022-08-04 21:08:15'),
(14, 'Gabriel', 'Gomes', 'gabrielgomessdasilva13@gmail.com', '$2y$10$r7qgx2GmceUKx.vDVjUjFOBBFnxnPDR.UGXfTS3SEjoOaLbjDcKwG', '2022-08-04 20:46:00', '2022-08-04 20:46:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ads`
--

CREATE TABLE `ads` (
  `id` int(11) NOT NULL,
  `name` varchar(600) NOT NULL,
  `email` varchar(600) NOT NULL,
  `owner` varchar(600) NOT NULL,
  `image` varchar(600) NOT NULL,
  `type` varchar(600) NOT NULL,
  `link` varchar(600) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `ads`
--

INSERT INTO `ads` (`id`, `name`, `email`, `owner`, `image`, `type`, `link`, `status`, `created_at`, `updated_at`) VALUES
(4, 'Coca-cola', 'gabrielgomessdasilva13@gmail.com', 'Dinos', 'images/2022/08/e65ebb2c5ef97c331a50b2150a7d4486.jpg', 'Curta', 'https://www.coca-cola.com.br/', 1, '2022-08-13 01:56:04', '2022-08-20 01:29:05'),
(5, 'Magazine e Luiza', 'gabrielgomessdasilva13@gmail.com', 'Dinos', 'images/2022/08/3095a0c5c3a6cc98837158f349b4935b.jpg', 'Longa', 'https://www.magazineluiza.com.br/', 1, '2022-08-13 21:40:14', '2022-08-20 01:26:56'),
(6, 'MC Donald&#39;s', 'mac@email.com', 'Donalds', 'images/2022/08/28208a08a460d3906f3f7bdf8b71c73d.jpg', 'Curta', 'https://www.mcdonalds.com.br/', 1, '2022-08-20 01:04:17', '2022-08-21 22:09:45'),
(7, 'Aliexpress', 'ali@email.com', 'Ali', 'images/2022/08/a1aebe5a1b88a07a6121f455b77d8a01.jpg', 'Longa', 'https://pt.aliexpress.com/', 1, '2022-08-20 01:09:38', '2022-08-20 01:24:57');

-- --------------------------------------------------------

--
-- Estrutura da tabela `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(600) NOT NULL,
  `color` varchar(600) NOT NULL,
  `author_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `categories`
--

INSERT INTO `categories` (`id`, `name`, `color`, `author_id`, `created_at`, `update_at`) VALUES
(3, 'Fitness', '#8e1fad', 1, '2022-08-03 21:09:50', '2022-08-03 21:09:50'),
(12, 'Politica', '#4644a7', 14, '2022-08-13 01:57:09', '2022-08-13 01:57:09'),
(13, 'Economia', '#2e56b2', 14, '2022-08-13 01:57:20', '2022-08-13 01:57:20'),
(14, 'Saúde', '#1a90b7', 14, '2022-08-13 01:57:38', '2022-08-13 01:57:38'),
(15, 'Esporte', '#27b464', 14, '2022-08-13 02:01:48', '2022-08-13 02:01:48'),
(16, 'Historia', '#8c4091', 14, '2022-08-15 02:36:57', '2022-08-15 02:36:57');

-- --------------------------------------------------------

--
-- Estrutura da tabela `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(600) NOT NULL,
  `subject` varchar(600) NOT NULL,
  `content` varchar(600) NOT NULL,
  `email` varchar(600) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `contact`
--

INSERT INTO `contact` (`id`, `name`, `subject`, `content`, `email`, `status`, `created_at`, `update_at`) VALUES
(5, 'Politica', 'Fale Conosco', 'Fale Conosco', 'gabrielgomessdasilva13@gmail.com', 0, '2022-08-13 21:22:43', '2022-08-13 21:22:43'),
(7, 'Esporte', 'Fale Conosco', 'Fale Conosco', 'gabriel@email.com', 1, '2022-08-13 21:23:03', '2022-08-13 21:23:03'),
(8, 'Gabriel', 'Fale Conosco', 'Fale Conosco', 'gabrielgomessdasilva12@gmail.com', 2, '2022-08-15 02:21:13', '2022-08-15 02:21:13'),
(9, 'Gab', 'Fale Conosco', 'TESTE de envio', 'gabrielgomessdasilva13@gmail.com', 0, '2022-09-15 18:47:06', '2022-09-15 18:47:06'),
(12, 'Politica', 'Fale Conosco', 'TESTE', 'gabrielgomess@hotmail.com', 0, '2022-09-15 19:05:36', '2022-09-15 19:05:36'),
(13, 'Saúde', 'Fale Conosco', 'fakr', 'dev@digitalv8.com.br', 0, '2022-09-16 12:01:55', '2022-09-16 12:01:55'),
(14, 'Gab', 'Fale Conosco', 'ESTE', 'gabrielgomessdasilva13@gmail.com', 0, '2022-09-16 12:05:51', '2022-09-16 12:05:51'),
(15, 'Politica', 'Fale Conosco', 'Mensagem', 'gabrielgomessdasilva13@gmail.com', 1, '2022-09-16 12:31:11', '2022-09-16 12:31:11');

-- --------------------------------------------------------

--
-- Estrutura da tabela `inscriptions`
--

CREATE TABLE `inscriptions` (
  `id` int(11) NOT NULL,
  `email` varchar(600) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `inscriptions`
--

INSERT INTO `inscriptions` (`id`, `email`, `status`, `created_at`, `updated_at`) VALUES
(1, 'dev@digitalv8.com.br', 1, '2022-08-15 00:50:50', '2022-08-15 02:17:40'),
(2, 'dev@digitalv8.com.br', 1, '2022-08-15 00:50:51', '2022-08-16 00:35:26'),
(3, 'dev@digitalv8.com.br', 0, '2022-08-15 00:50:57', '2022-08-15 02:17:32'),
(4, 'vinicios.oliveira2030@gmail.com', 0, '2022-08-15 01:08:20', '2022-08-15 02:17:38'),
(5, 'gabriel@email.com', 0, '2022-08-15 01:08:41', '2022-08-20 01:24:54'),
(7, 'gabriel.gomes@v4company.com', 0, '2022-08-15 02:21:28', '2022-08-20 01:24:54');

-- --------------------------------------------------------

--
-- Estrutura da tabela `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(600) NOT NULL,
  `image` varchar(600) NOT NULL,
  `content` text NOT NULL,
  `uri` varchar(600) NOT NULL,
  `author_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  `views` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `news`
--

INSERT INTO `news` (`id`, `title`, `image`, `content`, `uri`, `author_id`, `category_id`, `position`, `views`, `status`, `created_at`, `update_at`) VALUES
(11, 'Bolsonaro edita decreto que regulamenta crédito consignado a quem ganha Auxílio Brasil', 'images/2022/08/0f686e65720837574e965add1632ae15.jpg', '<div>O governo regulamentou o processo de empréstimo consignado vinculado ao Auxílio Brasil. O presidente Jair Bolsonaro e o ministro da Cidadania, Ronaldo Bento, assinaram decreto que foi publicado na edição desta sexta-feira (12) do \"Diário Oficial da União (DOU)\". O início da liberação, entretanto, depende de regulamentação de normas complementares do Ministério da Cidadania, que ainda não foi publicada.</div><div>Quem recebe o Auxílio Brasil, assim como outros benefícios de transferência de renda do governo, poderá fazer empréstimo consignado (com desconto direto na fonte). O governo sancionou lei que permite descontar até 40% do valor do benefício para pagamento de empréstimos e financiamentos.</div>\r\n                                            ', 'bolsonaro-edita-decreto-que-regulamenta-credito-consignado-a-quem-ganha-auxilio-brasil', 14, 13, 1, 32, 1, '2022-08-13 13:57:19', '2022-08-13 13:57:19'),
(12, 'Uma Conquista dos Brasileiros: nova série mostra por que cidade ', 'images/2022/08/0cfa1b65e7a933ab27c04b52646aa557.jpg', '                                                <div>Há 200 anos, o famoso grito dado por Dom Pedro no Rio Ipiranga, em São Paulo, decretou a Independência do Brasil, mas este não foi um fato isolado. A separação de Portugal foi um processo que durou vários anos - uma articulação entre os mais poderosos e também o resultado do esforço de brasileiros e brasileiras que se envolveram em revoltas e em batalhas. Veja a reportagem completa acima.</div><div><br></div><div>Negros, brancos e indígenas de várias partes do país lutaram e arriscaram a própria vida em sonhos e ideais de liberdade. É por isso que a Independência é celebrada em datas diferentes em várias partes do Brasil.</div><div><div>Na cidade de Cachoeira, na Bahia, por exemplo, o bicentenário foi festejado no dia 25 de junho, data em que, em 1822, em uma sessão na Câmara Municipal, os vereadores da cidade decidiram reconhecer um governo chefiado pelo então príncipe Dom Pedro, no Rio de Janeiro - ou seja, não iriam mais obedecer às ordens que vinham de Portugal.</div><div><br></div><div>Saiba mais sobre essa história com a repórter Mônica Sanches, na estreia de \"1822 - Uma Conquista dos Brasileiros\", nova série do Fantástico.</div></div>\r\n                                                                                        ', 'uma-conquista-dos-brasileiros-nova-serie-mostra-por-que-cidade-', 14, 16, 6, 6, 1, '2022-08-15 02:40:02', '2022-08-15 02:40:02'),
(13, 'Aneurisma cerebral: cerca de 3% a 5% das pessoas têm o problema', 'images/2022/08/9626f07b2212aba48f1b93caa8169546.jpg', '<div>Há poucas semanas a atriz britânica Emilia Clarke, da série de televisão Game of Thrones, revelou que passou por duas cirurgias para remover dois aneurismas cerebrais há cerca de dez anos, quando ainda trabalhava na série. Ela contou ter sentido uma “dor excruciante” e ressaltou que é uma das poucas pessoas que conseguem sobreviver ao rompimento de um aneurisma sem nenhum tipo de sequela. Mas afinal, o que é um aneurisma? Existe alguma maneira de prevenir?</div><div><br></div><div>Assintomático na grande maioria dos casos, o aneurisma cerebral é uma dilatação anormal da parede de alguma artéria cerebral. Essa dilatação forma uma espécie de “bexiga” que pode ir aumentando com o passar dos anos e, por conta da pressão sanguínea, pode se romper e provocar um AVC (acidente vascular cerebral) hemorrágico. Em diversos estudos, a prevalência de aneurismas saculares detectados por radiografias ou necrópsias em pessoas sem comorbidades por volta de 50 anos é de cerca de 3% a 5%.</div><div><br></div><div>No momento da ruptura, o paciente apresenta dor de cabeça intensa e que se inicia de maneira súbita – diferente das dores de cabeça mais comuns, onde a dor aumenta gradativamente. Segundo Gisele Sampaio Silva, neurologista e pesquisadora clínica do Hospital Israelita Albert Einstein, quando o aneurisma se rompe a taxa de mortalidade gira em torno de 30% a 40% dos casos. Entre os pacientes que sobrevivem ao rompimento, cerca de metade terão sequelas importantes – por isso a atriz Emília Clarke é um caso tão significativo.</div>\r\n                                            ', 'aneurisma-cerebral-cerca-de-3-a-5-das-pessoas-tem-o-problema', 14, 14, 3, 1, 1, '2022-08-15 02:43:01', '2022-08-15 02:43:01'),
(14, 'Oito em cada nove influenciadores fitness dão maus conselhos, aponta estudo', 'images/2022/08/6ca7a40d06d208d23beb8fff9cb52551.jpg', '                                                <p>Foram estudados os perfis de figuras com foco em dieta e condicionamento físico populares no Reino Unido. O critério de avaliação era se as informações passadas por cada um deles eram transparentes, confiáveis, nutricionalmente sólidas e se possuíam referências baseadas em evidências.</p><p>“Descobrimos que a maioria dos blogs não pode ser considerada uma fonte confiável de informações sobre o controle de peso. Isso porque, muitas vezes, apresentam opiniões como se fossem fatos. Eles também não cumprem os critérios nutricionais do Reino Unido”, disse Christina Sabbagh, cientista e responsável pela pesquisa, ao jornal britânico “The Independent”.<br></p><p>\r\n                                            </p>                                            ', 'oito-em-cada-nove-influenciadores-fitness-dao-maus-conselhos-aponta-estudo', 14, 3, 4, 0, 1, '2022-08-15 02:44:17', '2022-08-15 02:44:17'),
(18, 'Rayssa Leal é campeã pela 5 vez de uma etapa da Liga Mundial de skate street', 'images/2022/08/e10883cff0001b7235dce6ece0675ac3.jpg', '                                                <div>Rayssa Leal, a Fadinha, foi campeã neste domingo (14) da 2ª etapa da Liga Mundial de skate street, em Seattle, nos Estados Unidos.</div><div><div>Esta é a quinta vez que ela vence uma etapa da SLS, se tornando a maior vencedora entre as mulheres da competição.</div><div><br></div><div>A brasileira Pâmela Rosa ficou sem segundo lugar, tendo liderado a final por quase toda a prova.</div><div><br></div><div>Fechando o pódio, a japonesa Momiji Nishiya, medalhista de Ouro em Tóquio 2020, ficou com a terceira colocação.</div></div>\r\n                                                                                        ', 'rayssa-leal-e-campea-pela-5-vez-de-uma-etapa-da-liga-mundial-de-skate-street', 14, 15, 5, 0, 1, '2022-08-15 02:46:23', '2022-08-15 02:46:23'),
(19, 'Ucrânia e Rússia voltam a se acusar de ataques à usina nuclear de Zaporizhzhia', 'images/2022/08/79ce94e88a99be1b14243904eee3ea8e.jpg', '                                                                                                                                                                                                <p><font color=\"#212529\" face=\"Merriweather, serif\">Ucrânia e Rússia se acusaram mutuamente, neste sábado (13), de ataques contra a central nuclear de Zaporizhzhia, a maior da Europa, que está ocupada pelas tropas de Moscou e tem sido palco de enfrentamentos há uma semana</font></p><p><font color=\"#212529\" face=\"Merriweather, serif\">“Reduzam sua presença nas ruas de Enerhodar! Recebemos notícias de novas provocações por parte dos ocupantes” russos, escreveu no Telegram a agência nuclear ucraniana Energoatom, que publicou uma mensagem de um dirigente local da cidade de Enerhodar (controlada por Kiev), próxima da central de Zaporizhzhia.</font></p><p><font color=\"#212529\" face=\"Merriweather, serif\">“Segundo os depoimentos dos moradores, há novos bombardeios em direção da central nuclear de Zaporizhzhia […] O intervalo entre a saída e a queda dos projéteis é de 3 a 5 segundos”, acrescentou a agência na mensagem.</font></p><p><font color=\"#212529\" face=\"Merriweather, serif\">Por sua vez, as autoridades de ocupação instaladas pela Rússia em partes do sul da Ucrânia acusaram Kiev de estar por trás dos ataques.</font></p>                                                                                                                                                                                ', 'ucrania-e-russia-voltam-a-se-acusar-de-ataques-a-usina-nuclear-de-zaporizhzhia', 14, 12, 2, 2, 1, '2022-08-15 02:48:12', '2022-08-16 01:52:39'),
(21, 'Na propaganda eleitoral, Lula fala do avanço da fome no país, e Bolsonaro ressalta Auxílio Brasil de R$ 600', 'images/2022/08/893042207037e41a3719c022d24ff26d.jpg', '<h3>Lula</h3><div>Na abertura de seu programa, o ex-presidente Lula afirmou que sente prazer em conversar sobre o futuro do país. Alegria que, segundo ele, só não é maior em razão das pessoas que estão passando fome.</div><div>\"Meus amigos, minhas amigas. Peço a Deus que ilumine esta nação e nos ajude a reconstruir o Brasil. É um grande prazer encontrar vocês aqui para conversar sobre o futuro do país. A alegria só não é completa porque, neste momento milhões não têm o que comer\", disse Lula.</div><div><br></div><h3>Bolsonaro</h3><div>O programa de Bolsonaro usou trechos do discurso dele no lançamento oficial da candidatura, em evento no ginásio Maracanãzinho, no fim de julho.</div><div>No trecho, o presidente diz que substituiu o Bolsa Família pelo Auxílio Brasil e subiu o valor para R$ 600. Atualmente, a lei prevê esse valor só até dezembro, mas Bolsonaro afirma que vai estender para o ano que vem.</div><div>\"Dentro da responsabilidade fiscal, extingui o Bolsa Família, que pagava em média R$ 190. Tinha mulheres ganhando R$ 80. Passaram a ganhar R$ 600. Conversei com o Paulo Guedes. Esse valor será mantido no ano que vem\", afirmou Bolsonaro no discurso.</div><div><br></div><h3>Ciro</h3><div>O programa do candidato do PDT disse que Ciro é o único candidato que propõe renda mínima de R$ 1 mil para famílias carentes, Lei Antiganância (que limita o pagamento de juros ao dobro do valor original da dívida) e tirar o nome dos brasileiros da lista dos devedores. Todas essas são propostas tradicionais de Ciro, repetidas por ele em suas agendas de campanha.</div><div>\"O que eu quero é isso. Criar um Brasil onde ninguém fica para trás e coloca os mais pobres na frente. Criar renda mínima, colocar a educação brasileira entre as 10 melhores do mundo e criar 5 milhões de empregos\", disse Ciro.</div>\r\n                                            ', 'na-propaganda-eleitoral-lula-fala-do-avanço-da-fome-no-pais-e-bolsonaro-ressalta-auxilio-brasil-de-r-600', 14, 12, 4, 0, 1, '2022-08-27 13:37:03', '2022-08-27 13:37:03'),
(22, 'Lewandowski faz dois, e Barcelona goleia o Valladolid no Camp Nou', 'images/2022/08/a1c18de6bad8df8b2c25d2dc5c9656d3.jpg', '                                                <p><span style=\"color: rgb(51, 51, 51); font-family: opensans-regular; font-size: 20px; letter-spacing: -0.5px;\">O Barcelona não tomou conhecimento do Valladolid neste domingo, pela terceira rodada do Campeonato Espanhol, e venceu a primeira partida em casa pela competição em 2022/23. Não só venceu, como goleou: com dois de Lewandowski e boas atuações de Dembélé e Raphinha, a equipe comandada por Xavi fez 4 a 0. Pedri e Sergi Roberto também marcaram no dia da estreia de Koundé.</span></p><p><span style=\"color: rgb(51, 51, 51); font-family: opensans-regular; font-size: 20px; letter-spacing: -0.5px;\">O polonês chegou a quatro gols em três jogos e agora divide a artilharia do Espanhol com Borja Iglesias, do Betis. Bom início para o camisa 9 no novo clube!</span><span style=\"color: rgb(51, 51, 51); font-family: opensans-regular; font-size: 20px; letter-spacing: -0.5px;\"><br></span>\r\n                                            </p>                                            ', 'lewandowski-faz-dois-e-barcelona-goleia-o-valladolid-no-camp-nou', 14, 15, 6, 0, 1, '2022-08-28 21:38:26', '2022-08-28 21:38:26'),
(26, 'Dorival afirma que Flamengo jogou pelo resultado e diz: Pode ser um divisor para nós', 'images/2022/08/85863eece329420349087c0de9807833.png', '                                                                                                <div>O Flamengo venceu o clássico contra o Botafogo, no Nilton Santos, na noite deste domingo. A vitória rubro-negra - por 1 a 0 - deixa o time novamente na segunda colocação, com 43 pontos - a sete do líder Palmeiras. O gol foi marcado por Vidal, o segundo dele pelo Flamengo.</div><div>Dorival Júnior afirmou que o Flamengo jogou \"em razão do resultado\" e destacou que a vitória pode colocar o time de vez numa briga mais intensa pelo eneacampeonato brasileiro.</div><div>Vitória realmente muito importante e que nos mantém vivos numa competição aonde até 11 rodadas atrás tínhamos 13 pontos de diferença para o líder. A diferença caiu consideravelmente. Estamos fazendo um trabalho muito consciente junto com diretoria e jogadores sobre o que é necessário para uma partida ou outra.</div>\r\n                                                                                                                                    ', 'dorival-afirma-que-flamengo-jogou-pelo-resultado-e-diz-pode-ser-um-divisor-para-nos', 14, 15, 5, 1, 1, '2022-08-29 02:35:56', '2022-08-31 01:06:14'),
(27, 'Pesquisa Ipec com eleitores de São Paulo: Lula tem 40% e Bolsonaro, 31% no estado', 'images/2022/08/87fc46c6819eebb0e56358326bfe421d.jpg', '<div>Pesquisa Ipec (ex-Ibope) divulgada nesta terça-feira (30) e encomendada pela Globo revela os índices de intenção de voto para presidente da República entre os eleitores de São Paulo. O ex-presidente Lula (PT) lidera a disputa no estado, com 40%, contra 31% do presidente Jair Bolsonaro(PL).</div><div>Os resultados revelam um cenário de estabilidade, na comparação com a pesquisa anterior, de 15 de agosto. Lula está estável em relação à última rodada, quando obteve 43%, assim como Bolsonaro, com 31%. Já Ciro Gomes (PDT) variou de 7% para 9%, e permanece tecnicamente empatado com Simone Tebet (MDB), cujas menções passam de 3% para 4%.</div><div>A pesquisa ouviu 1.504 pessoas entre os dias 27 e 29 de agosto em 65 municípios paulistas. A margem de erro é de três pontos percentuais para mais ou para menos, considerando um nível de confiança de 95%. A pesquisa foi registrada no Tribunal Superior Eleitoral (TSE) sob o número SP-00761/2022.</div>\r\n                                            ', 'pesquisa-ipec-com-eleitores-de-sao-paulo-lula-tem-40-e-bolsonaro-31-no-estado', 14, 12, 0, 8, 1, '2022-08-31 02:11:59', '2022-08-31 02:11:59');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `inscriptions`
--
ALTER TABLE `inscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `ads`
--
ALTER TABLE `ads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `inscriptions`
--
ALTER TABLE `inscriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
