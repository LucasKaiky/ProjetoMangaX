-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2022 at 10:02 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `loja_manga`
--

-- --------------------------------------------------------

--
-- Table structure for table `compras`
--

CREATE TABLE `compras` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `valor_total` double(9,2) NOT NULL,
  `status` varchar(40) NOT NULL,
  `data_status` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `data_compra` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `compras`
--

INSERT INTO `compras` (`id`, `id_cliente`, `valor_total`, `status`, `data_status`, `data_compra`) VALUES
(79, 4, 29.90, 'Seu pedido chegou!', '2022-12-05 20:21:13', '2022-12-05 16:02:57');

-- --------------------------------------------------------

--
-- Table structure for table `compras_produtos`
--

CREATE TABLE `compras_produtos` (
  `id` int(11) NOT NULL,
  `id_produto` int(10) NOT NULL,
  `id_compra` int(10) NOT NULL,
  `quantidade` int(10) NOT NULL,
  `valor_unitario` decimal(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `compras_produtos`
--

INSERT INTO `compras_produtos` (`id`, `id_produto`, `id_compra`, `quantidade`, `valor_unitario`) VALUES
(34, 10, 79, 1, '29.90');

-- --------------------------------------------------------

--
-- Table structure for table `lista_favoritos`
--

CREATE TABLE `lista_favoritos` (
  `id` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `autor` varchar(100) NOT NULL,
  `descricao` longtext NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `data_cadastro` datetime NOT NULL,
  `imagem` varchar(140) NOT NULL,
  `estoque` int(11) NOT NULL,
  `categoria` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `autor`, `descricao`, `valor`, `data_cadastro`, `imagem`, `estoque`, `categoria`) VALUES
(1, 'One Piece Vol. 100', 'Eichiiro Oda', 'Com todas as estrelas reunidas no topo da fortaleza, Luffy e os Piratas da Nova Geração desafiam Kaido e Big Mom! Será que há alguma chance de vitória contra essa aliança formada entre os dois mais poderosos piratas dos mares?! O que o futuro reserva para essa batalha extrema que está fazendo toda Onigashima tremer?!\r\n', '79.00', '2022-11-18 19:25:26', 'upload/op100.jpg', 99, 'destaque'),
(2, 'One Piece Vol. 101', 'Eichiiro Oda', 'Acreditando que Luffy voltará e não desistirá de derrubar Kaido, seus companheiros travam batalhas mortais e intensas contra os Oficiais do bando inimigo!! Enquanto isso, é no topo de Onigashima que Kaido e Yamato estão frente a frente dando início a um confronto fatídico entre pai e filha!!', '70.00', '2022-11-18 19:34:10', 'upload/op101.jpg', 0, 'destaque'),
(4, 'One Piece Vol. 98\r\n', 'Eichiiro Oda', 'Durante a batalha decisiva em Onigashima, que esquenta cada vez mais, Yamato, a filha de Kaido, surge diante de Luffy querendo lutar ao seu lado! Enquanto isso, Kaido revela em detalhes o \"Plano da Nova Onigashima\" e, junto de Big Mom, está prestes a mergulhar o mundo inteiro em caos!!', '50.00', '2022-11-18 20:07:11', 'upload/op98.jpg', 4, 'destaque'),
(8, 'Berserk Vol. 1', '', 'O misterioso Guts, o \"Espadachim Negro\", carrega em sua mão mecânica uma enorme espada, e em seu pescoço uma estranha marca que atrai forças demoníacas. Em sua busca por vingança contra um antigo inimigo, nem tudo sai a seu favor, e ele recebe ajuda de uma fantástica criatura.', '34.90', '2022-11-22 11:54:23', 'upload/637ce29fe1f9b.jpg', 4, 'lancamento'),
(9, 'Boku no Hero Vol. 29', '', 'Tudo ao redor do gigante está destruído! \"Devo ir até meu mestre\", e peraí, até o Shigaraki?! Nem pensar! Se ele chegar na cidade, não vai sobrar nada de pé! E os estudantes da U.A. também estão em perigo! O que está acontecendo no Hospital Jaku?! Mas que saco, paaaraaaaa!! ”Plus Ultra”!!', '29.90', '2022-11-22 12:23:24', 'upload/637ce96c533e2.jpg', 2, 'lancamento'),
(10, 'Boku no Hero Vol. 30', '', 'Ei, ei, por que as coisas ficaram assim?! O vilão colossal tá avançando cada vez mais, e ele não para de destruir tudo! Tenho que reportar a situação... Todos estão lutando com toda sua força! Tenho que proteger todas as pessoas que puder! Eu preciso passar pra frente o sentimento dos meus amigos que caíram! ”Plus Ultra”!!\r\n', '29.90', '2022-11-22 12:26:57', 'upload/637cea41216d6.jpg', 0, 'lancamento'),
(37, 'One Piece Vol. 99', 'Eichiiro Oda', 'Depois de seus companheiros conseguirem impedir a perseguição implacável dos Oficiais dos Piratas Bestiais, Luffy finalmente chega ao topo da fortaleza e está diante de Kaido!! Todos os atores reúnem-se neste palco grandioso onde um combate mais do que intenso está prestes a começar...! É o início do clímax da batalha final em Onigashima!!', '59.90', '2022-11-22 14:01:53', 'upload/637d0081e40a5.jpg', 4, 'destaque'),
(38, 'Haikyu - Volume 2', '', 'Shoyo Hinata quer provar que no vôlei você não precisa ser alto para voar!Desde que viu o lendário jogador conhecido como \"o Pequeno Gigante\" competir nas finais nacionais de voleibol, Shoyo Hinata almeja ser o melhor jogador de voleibol de todos os tempos! Quem disse que você precisa ser alto para jogar vôlei quando pode pular mais alto do que qualquer outra pessoa?Depois de provar ser a melhor combinação em sua partida de treino contra Kei Tsukishima, Kageyama e Hinata finalmente podem entrar no clube! O verdadeiro poder de Hinata - para cronometrar perfeitamente seus picos com os olhos fechados - é despertado, e nada pode parar esta dupla louca setter-spiker. Agora suas habilidades estão prestes a ser postas à prova em um jogo prático contra um dos ex-companheiros de equipe de Kageyama do ensino médio, Tohru Oikawa.', '40.00', '2022-11-28 19:31:31', 'upload/638536c3c0c06.jpg', 3, 'lancamento'),
(40, 'Bleach, Vol. 19', 'Tite Kubo', 'Part-time student, full-time Soul Reaper, Ichigo is one of the chosen few guardians of the afterlife.\r\nIchigo Kurosaki never asked for the ability to see ghosts--he was born with the gift. When his family is attacked by a Hollow--a malevolent lost soul--Ichigo becomes a Soul Reaper, dedicating his life to protecting the innocent and helping the tortured spirits themselves find peace. Find out why Tite Kubo\'s Bleach has become an international manga smash-hit!\r\n\r\nThe long-awaited showdown between Ichigo and Byakuya Kuchiki has finally begun. Has Ichigo succeeded in mastering bankai, the highest level of power that a Soul Reaper can attain, to face Byakuya as an equal?', '39.90', '2022-11-29 17:50:14', 'upload/6386708638f65.png', 9, 'destaque'),
(42, 'One-Punch Man 01', 'One', 'Com apenas um soco!! Saitama se tornou forte a ponto de derrotar criaturas monstruosas com um único soco.\r\nE o que não falta são monstros para serem derrotados na Cidade Z, onde eles surgem a todo momento, seja das profundezas da Terra ou dos confins do espaço, como resultado de uma experiência maluca ou de uma mutação genética.\r\nO problema é justamente que ele os derrota com um golpe só!\r\nobjetivo agora é encontrar a emoção de um verdadeiro desafio! A lenda do mais poderoso e pacato herói começa aqui!!', '22.90', '2022-11-29 18:04:02', 'upload/638673c288dc7.png', 4, 'destaque'),
(81, 'Berserk Vol. 1: Edição de Luxo', 'Kentaro Miura', 'O misterioso Guts, o \"Espadachim Negro\", carrega em sua mão mecânica uma enorme espada, e em seu pescoço uma estranha marca que atrai forças demoníacas. Em sua busca por vingança contra um antigo inimigo, nem tudo sai a seu favor, e ele recebe ajuda de uma fantástica criatura', '27.48', '2022-12-05 15:07:15', 'upload/638e335357163.png', 30, 'pre-venda'),
(82, 'Berserk Vol. 2: Edição de Luxo: 02', 'Kentaro Miura', 'Guts se depara com o Behelit, uma misteriosa pedra que pode invocar os God Hand, os terríveis senhores da escuridão, que ele deseja encontrar para completar sua vingança. Mas o Conde, senhor do feudo e tirano que ameaça o povo com a \"caça aos hereges\", também parece ter relação com a pedra e os God Hand. Guts declara guerra ao Conde e invade seu castelo, deixando um rastro de sangue por onde passa.', '24.90', '2022-12-05 15:08:51', 'upload/638e33b38c77f.png', 20, 'pre-venda'),
(83, 'Berserk Vol. 3: Edição de Luxo: 03', 'Kentaro Miura', 'A batalha contra o Conde continua e se encaminha para um final inesperado. O despertar do Behelit acarreta a aparição dos God Hand, e entre eles está Griffith, que invoca a ira de Guts por lembranças de seu passado! Qual será a relação entre eles?', '27.90', '2022-12-05 15:10:55', 'upload/638e342f2bc5a.png', 20, 'pre-venda'),
(84, 'Black Clover - 24', 'Yûki Tabata', 'O reino Spade começa a invadir tanto o reino de Clover quanto o reino Heart. Asta e seu grupo se desenvolvem com o treinamento dos lordes espirituais e partem para enfrentar as tropas de Spade, que ostentam o poder demoníaco e violam as pessoas!! Distante de tudo isso, uma pessoa que sabe o segredo de seu nascimento aparece diante de Yuno. Qual é a ligação com o reino Spade que estava oculta nesse passado?!', '28.80', '2022-12-05 15:12:41', 'upload/638e349984d29.png', 25, 'destaque'),
(85, 'Spy X Family Vol. 2', 'Tatsuya Endo', 'Com a missão de proteger a paz entre Ostania e Westalis, a família Forger encara o desafio do Exame de Admissão de um renomado colégio. Porém, para se aproximar de Desmond, o alvo, Anya precisa se tornar uma Aluna Excelente!! Twilight então põe em prática o \"Plano da Amizade\"...?!', '34.90', '2022-12-05 15:14:22', 'upload/638e34feb300b.png', 20, 'destaque'),
(86, 'Chainsaw Man Vol. 11', 'Tatsuki Fujim', 'O controle cruel e impiedoso de Makima segue perseguindo Denji! Mas é durante sua aflição por ter perdido inúmeras coisas e a sensação de ter seu coração afundado num vaso entupido de merda que Denji ouve os gritos de “Chainsaw Man” ecoando pelo mundo...!!Assim, Denji e Makima rumam para um campo sangrento prontos para o confronto final! É na conclusão desses sentimentos não correspondidos que esta série chega ao seu fim chocante e explosivo!!', '33.90', '2022-12-05 15:17:49', 'upload/638e35cd4831b.png', 0, 'pre-venda'),
(87, 'Jujutsu Kaisen: Batalha de Feiticeiros Vol. 20', 'Gege Akutami ', 'Fushiguro e Reggie estão prestes a serem esmagados até a morte por seus respectivos feitiços. Para vencer, Reggie entra em ação e o duelo mortal se aproxima do fim!! Enquanto isso, na Colônia de Sendai, Okkotsu destrói o domínio dos quatro jogadores mais poderosos, engajando-se em uma luta feroz contra feiticeiros Jujutsu do passado e um espírito amaldiçoado de nível especial!', '36.90', '2022-12-05 15:19:32', 'upload/638e3634e702f.png', 30, 'pre-venda'),
(88, 'One Piece 3 em 1 Vol. 9 ', 'Eiichiro Oda', 'Em busca de mais pistas sobre a Ilha do Céu, o Bando do Chapéu de Palha procura um recluso contador de histórias e acaba se envolvendo em um problemão!Após conseguir chegar ao tão desejado destino, Luffy e seus companheiros são perseguidos pelos Guardas de Deus, a polícia de Skypiea, e os habitantes por terem entrado de forma ilegal no local. Agora, a única forma de saírem dessa situação é passar por diversos desafios propostos pelos subordinados de Deus.Como será que o Bando vai lidar com esse obstáculo?! Nesse ínterim, Nico Robin faz uma incrível descoberta sobre a ilha!', '84.90', '2022-12-05 15:22:41', 'upload/638e36f1d3ce4.png', 0, 'pre-venda'),
(89, 'Dragon Ball Super Vol. 19', 'Akira Toriyama', 'Gas parece acuado com o feroz ataque de Granola, mas libera o seu instinto e desperta. Goku e seus amigos ficam impressionados com esse grande poder. Parece que a chave para derrotar Gas está nas lembranças do falecido pai do Goku, Bardock...', '37.90', '2022-12-05 15:28:47', 'upload/638e385f4e675.png', 19, 'pre-venda'),
(90, 'Chainsaw Man Vol. 10', 'Tatsuki Fujimoto', '“Eu matei o Aki...”Denji está desesperado e com a cabeça nos ares, então, resolve pedir ajuda à Makima.  Entretanto, o consolo temporário fornecido por ela não passou do prelúdio de um pesadelo ainda pior... Quando a porta proibida na mente de Denji se abre, as verdadeiras intenções de Makima e o segredo do Demônio da Motosserra se cruzam transformando tudo em um inferno sangrento!!', '28.80', '2022-12-05 15:38:14', 'upload/638e3a96ac140.png', 50, 'lancamento'),
(91, 'Tokyo Revengers - Vol. 03', 'Ken Wakui', 'Um salto no tempo de 12 anos no passado dá ao jovem Takemichi a oportunidade de salvar sua ex-namorada, vítima das regras de contas de uma gangue chamada Tokyo Manji-kai. Só que, enquanto ele tenta argumentar com Mikey para parar a guerra contra o clã Moebius e a divisão do Tokyo Manji-kai, ele cai em uma emboscada! Surpreso com as consequências inesperadas das intervenções, ele conseguirá impedir que a lâmina do destino caia sobre Draken?!', '27.10', '2022-12-05 15:40:02', 'upload/638e3b024a8a6.png', 40, 'lancamento'),
(92, 'Tokyo Revengers - Vol. 04', 'Ken Wakui', 'A sangrenta batalha de Halloween começa com dois confrontos repentinos e violentos entre os pesos pesados ​​de ambas as gangues: Mikey contra Kazutora e Draken contra Hanma. Testemunhando a situação horrível que se desenrola diante de seus olhos, Takemichi teme que Mikey acabe matando Kazutora, o que o levaria de volta ao futuro horrível que ele já conhece. Mikey cairá na escuridão depois que o sangrento Halloween terminar?', '27.10', '2022-12-05 15:40:35', 'upload/638e3b233f82c.png', 50, 'lancamento'),
(93, 'Blue Lock Vol. 2', 'Yusuke Nomura', 'Criem o maior egoísta do mundo!! O futebol estilo Blue Lock vai começar!Sob intensa crítica da população e da mídia e do olhar frio do genial e orgulhoso meio-campista do Japão, Itoshi Sae, o treinamento na Blue Lock finalmente começa. Na partida em sistema de liga, onde duas a cada cinco equipes sobrevivem, o Time Z de Isagi tem dificuldades no primeiro jogo disputado só com atacantes! ;Não querem ser o melhor do mundo?! Encontrem a “arma” que fará seu ego florescer e derrubem todos os seus rivais!\r\n', '26.69', '2022-12-05 15:43:17', 'upload/638e3bc51d415.png', 50, 'lancamento'),
(94, 'Blue Lock Vol. 3', 'Yusuke Nomura', 'Com o fim de 2 dos 4 jogos da 1ª Seletiva da Blue Lock, Isagi e o Time Z descobrem o prazer da vitória depois de terem derrotado o time adversário arriscando as suas carreiras como jogadores de futebol. A vitória deixa o time de moral alta para encararem o terceiro jogo contra o Time Y, mas uma inesperada divisão dentro do Time Z ameaça o seu futuro!  Além disso, com um dos jogadores ― Chigiri Hyoma ― sem vontade de continuar a lutar, será que nossos heróis poderão sobreviver aos ataques ferozes dos Irmãos Wanima, os craques do Time W?', '28.80', '2022-12-05 15:43:46', 'upload/638e3be2ebd09.png', 30, 'lancamento'),
(95, 'Record of Ragnarok: Volume 05', 'Azychika', 'O grande confronto entre o perdedor supremo, Kojirou Sasaki e o tirano dos mares, Poseidon finalmente chega ao fim!! E as cartas para a quarta batalha são: o assassino mais famoso em toda história da humanidade, Jack, o Estripador versus o indomável deus guerreiro, Hércules!! Um confronto direto entre o bem e o mal!!! Quem será o vencedor?! O mais terrível assassino versus o herói lendário!!!', '26.30', '2022-12-05 15:45:45', 'upload/638e3c59cd728.png', 19, 'lancamento'),
(96, 'Solo Leveling – Volume 02 (Full Color)', 'Chugong', 'Um grande fenômeno um dia aconteceu, portais desconhecidos surgiram ligando o mundo que conhecemos a uma realidade totalmente extraordinária de monstros e seres fantasiosos, cujo único objetivo era matar humanos. Em resposta a esse novo perigo, surgiram os “caçadores”, humanos que foram “despertados” e ganharam poderes capazes de bater de frente com essas criaturas. Dentre eles, há um conhecido por ser “a pior arma da humanidade”, sung jin-woo. Mas sua sorte irá mudar quando uma incursão que deveria ser fácil se torna um verdadeiro pesadelo. A versão imprensa do famoso webtoon.', '49.90', '2022-12-05 16:16:19', 'upload/638e43830be08.png', 50, 'destaque'),
(97, 'Fire Force Vol. 27', 'Atsushi Ōkubo', 'A verdade sobre o nascimento dos irmãos é revelada!! Enquanto investigava junto de Arrow os mistérios que cercam a Família Kusakabe, Shou acaba realizando um Adolla Link e se encontrando com sua mãe, que se tornou um Flamejante. Que decisão Shou tomará após saber a verdade sobre seu nascimento?! Enquanto isso, o oitavo pilar finalmente emerge na Baía de Tama e um Raffles I colossal aparece para mergulhar de vez o Império no desespero! É nesse momento que, diante dos gritos do povo assustado e da Tropa do Desastre, que Shinra mostrará seu verdadeiro valor como herói!', '33.90', '2022-12-05 16:19:15', 'upload/638e44561a387.png', 30, 'destaque'),
(98, 'Fire Force - 28', 'Atsushi Ohkubo', 'Com os pilares sendo levados para Adolla, o Grande Desastre se aproxima! Começa a batalha para proteger a Amaterasu e salvar o planeta da destruição!! Shinra e os outros pilares desapareceram rumo a Adolla. Os companheiros que permaneceram correm rumo a Amaterasu, a chave para a conclusão do Grande Desastre, para impedir a destruição do mundo e travar a batalha final contra os Trajes Brancos! Diante de Charon, Dragon e os Colossos Flamejantes de Ritsu, a Oitava Unidade e Ogun fazem de tudo para manter o perímetro defensivo e mantê-los longe da Amaterasu! Mas é dentro da usina que Vulcan, Lisa e Yuu topam com algo sinistro...!', '28.80', '2022-12-05 16:50:19', 'upload/638e4b7ba6ac0.png', 27, 'destaque'),
(99, 'Naruto Gold Vol. 42', 'Masashi Kishimoto', 'Pain, aquele que é chamado de Deus, é na verdade um sexteto de guerreiros detentores do Rinnegan. Jiraiya nota a presença de um antigo discípulo, Yahiko, entre os seis shinobis, mas já é tarde demais… Enquanto isso, um grande confronto de irmãos se inicia entre Sasuke e Itachi!', '22.90', '2022-12-05 16:58:25', 'upload/638e4d61f2e95.png', 21, 'destaque'),
(100, 'Fairy Tail - Vol. 6', 'Hiro Mashima', 'Gray e Natsu estão lutando contra Lyon e Zalty para impedir que o demônio da calamidade volte à vida. Mas, enquanto eles tentam derrotar os vilões, a cerimônia continua e o gelo em torno de Deliora começa a derreter.E o que os integrantes da Fairy Tail poderão fazer para libertar os habitantes da maldição da ilha Galuna?', '33.90', '2022-12-05 17:36:43', 'upload/638e565b2fb23.png', 2, 'pre-venda'),
(101, 'Kaiju N.° 8 Vol. 4', 'Naoya Matsumoto', 'A base das Forças de Defesa localizada em Tachikawa é atacada pelos céus por um bando de kaijus, porém, os soldados começam a fazer com que as criaturas-menores recuem através de seu enorme esforço. Hoshina libera todo o seu poder ofensivo e contra-ataca o grande kaiju. Enquanto o vice-comandante acreditava que a luta havia chegado ao fim, a criatura começa a se transformar e Kafka é capaz de perceber isso. Quem será que vai aparecer justamente nesse momento…?!Este é o quarto volume em que a ameaça continua!!!', '29.70', '2022-12-05 17:44:33', 'upload/638e58313b2d2.png', 60, 'lancamento'),
(102, 'Demon Slayer - Kimetsu No Yaiba Vol. 23', 'Koyoharu Gotouge', 'A batalha entre Muzan Kibutsuji, o progenitor dos Onis e Tanjirou e o Kisatsutai ruma para a sua conclusão!! Os quatro tipos de remédios que Tamayo conseguiu inocular no corpo de Muzan fizeram com que ele enfraquecesse e finalmente fosse encurralado! Qual será o destino de Tanjirou, Nezuko e do Kisatsutai?! O longo confronto contra os Onis finalmente está chegando ao seu fim!!', '26.90', '2022-12-05 17:46:29', 'upload/638e58a59fa23.png', 26, 'lancamento');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(256) NOT NULL,
  `data_cadastro` datetime NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0,
  `endereco1` varchar(100) DEFAULT NULL,
  `endereco2` varchar(100) DEFAULT NULL,
  `cidade` varchar(100) DEFAULT NULL,
  `bairro` varchar(100) DEFAULT NULL,
  `estado` varchar(100) DEFAULT NULL,
  `cep` varchar(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `data_cadastro`, `admin`, `endereco1`, `endereco2`, `cidade`, `bairro`, `estado`, `cep`) VALUES
(4, 'Administrador', 'admin@admin.com', '$2y$10$phnDfZaOtr06Mn7rIH3zT.mF1S72zzMD5Yv9K75nmiFunzaZPL1Xm', '2022-11-16 11:15:36', 1, 'Rua Diógenes Chianca, 100', 'Casa', 'João Pessoa', 'Água Fria', 'PB', '58053000'),
(5, 'Usuário', 'user@user.com', '$2y$10$jQXWFiSfF3x9.TNWxiQCveQWnMuXZNpfXVDs.q50h8SXQJUXVHt3y', '2022-11-16 11:19:16', 0, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'Deku', 'deku@email.com', '$2y$10$p.rO3J4EHF9sDCP9KweeBeaCcjBAZ0oBQeFfHXxmDqJWr.r2o0JnC', '2022-11-16 14:11:14', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 'João Victor Nunes de Moura', 'jotaven.moura@gmail.com', '$2y$10$120XN7P1s5qPfWqENXrVCuCCvqbnox/CllSUhIFLRTXi1YCrRSPtG', '2022-12-05 16:04:09', 0, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `compras_produtos`
--
ALTER TABLE `compras_produtos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lista_favoritos`
--
ALTER TABLE `lista_favoritos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `compras`
--
ALTER TABLE `compras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `compras_produtos`
--
ALTER TABLE `compras_produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `lista_favoritos`
--
ALTER TABLE `lista_favoritos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
