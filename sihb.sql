-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 08/12/2021 às 21:44
-- Versão do servidor: 10.4.22-MariaDB
-- Versão do PHP: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sihb`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `acesso`
--

CREATE TABLE `acesso` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_registro` int(11) NOT NULL,
  `nickname` varchar(250) NOT NULL,
  `senha` varchar(250) NOT NULL,
  `confirmado` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `acesso`
--

INSERT INTO `acesso` (`id`, `id_registro`, `nickname`, `senha`, `confirmado`) VALUES
(2, 1, 'majoryanzinho', '5d75fde1a62b2a92985f0648f44c608b7df8f61b0abcd3d5d39d4253e5deac02f30dac4ba573614168353732f24689b1181b1827bfa9c673c18255bf24999735', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `adv`
--

CREATE TABLE `adv` (
  `id` int(11) NOT NULL,
  `id_registro` int(11) NOT NULL,
  `motivo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `bugs`
--

CREATE TABLE `bugs` (
  `id` int(11) UNSIGNED NOT NULL,
  `local` varchar(250) NOT NULL,
  `msg` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `cartao`
--

CREATE TABLE `cartao` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_registro` int(11) NOT NULL,
  `tipo` tinyint(1) NOT NULL DEFAULT 0,
  `inicio` datetime NOT NULL,
  `fim` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `confianca_voto`
--

CREATE TABLE `confianca_voto` (
  `id` int(11) UNSIGNED NOT NULL,
  `data_voto` datetime NOT NULL,
  `por` varchar(250) NOT NULL DEFAULT '',
  `tipo` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `cursos`
--

CREATE TABLE `cursos` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_area` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `imagem` varchar(37) NOT NULL DEFAULT 'https://i.imgur.com/emN1tEu.png',
  `descricao` mediumtext DEFAULT NULL,
  `cor` varchar(13) NOT NULL DEFAULT '54, 217, 0',
  `modulo_nome` varchar(250) NOT NULL DEFAULT 'Modulo Único',
  `valor` smallint(6) NOT NULL DEFAULT 0,
  `vip` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Estrutura para tabela `cursos_alunos`
--

CREATE TABLE `cursos_alunos` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_curso` int(11) NOT NULL,
  `id_registro` int(11) NOT NULL,
  `completo` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Estrutura para tabela `cursos_area`
--

CREATE TABLE `cursos_area` (
  `id` int(11) UNSIGNED NOT NULL,
  `nome` varchar(250) CHARACTER SET utf8 NOT NULL,
  `cor` varchar(250) NOT NULL,
  `imagem` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `cursos_area`
--

INSERT INTO `cursos_area` (`id`, `nome`, `cor`, `imagem`) VALUES
(1, 'de Majoryanzinho', '#4D4DFF', 'https://i.imgur.com/LeRvm21.png');

-- --------------------------------------------------------

--
-- Estrutura para tabela `cursos_aulas`
--

CREATE TABLE `cursos_aulas` (
  `id` int(11) UNSIGNED NOT NULL,
  `nome` varchar(250) NOT NULL,
  `id_modulo` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `ordem` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Estrutura para tabela `cursos_historico`
--

CREATE TABLE `cursos_historico` (
  `id` int(11) UNSIGNED NOT NULL,
  `data_viewed` datetime NOT NULL,
  `id_registro` int(11) NOT NULL,
  `id_aula` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Estrutura para tabela `cursos_modulos`
--

CREATE TABLE `cursos_modulos` (
  `id` int(11) UNSIGNED NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Despejando dados para a tabela `cursos_modulos`
--

INSERT INTO `cursos_modulos` (`id`, `nome`) VALUES
(1, 'Modulo Ãšnico'),
(2, 'Intermediário'),
(3, 'Avançado');

-- --------------------------------------------------------

--
-- Estrutura para tabela `cursos_videos`
--

CREATE TABLE `cursos_videos` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_aula` int(11) NOT NULL,
  `url` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Estrutura para tabela `destaques`
--

CREATE TABLE `destaques` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_registro` int(11) NOT NULL,
  `nickname` varchar(250) NOT NULL,
  `qualidades` longtext NOT NULL,
  `patente_id` tinyint(3) NOT NULL,
  `data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `destaques`
--

INSERT INTO `destaques` (`id`, `id_registro`, `nickname`, `qualidades`, `patente_id`, `data`) VALUES
(1, 2, 'majoryanzinho', 'Agilidade;Treinamentos;Atendimento;etica', 2, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `emblemas`
--

CREATE TABLE `emblemas` (
  `id` int(11) UNSIGNED NOT NULL,
  `img` varchar(250) NOT NULL,
  `nome` varchar(250) NOT NULL,
  `descricao` text NOT NULL,
  `quarto` varchar(250) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `emblemas`
--

INSERT INTO `emblemas` (`id`, `img`, `nome`, `descricao`, `quarto`, `status`) VALUES
(1, 'https://www.habbo.com.br/habbo-imaging/badge/b23124s36147s01144s09134s961149df9f8fa6483a18a3951f28e2e3bb9dc.gif', 'Majoryanzinho', 'Grupo destinado <strong>aos membros e admiradores</strong> do ServiÃ§o de InteligÃªncia Habbiano.', 'https://www.habbo.com.br/hotel?room=r-hhbr-37a584ae570c1ec33efd46d40770cfb0', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `externos`
--

CREATE TABLE `externos` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_registro` int(11) NOT NULL,
  `id_externo` int(11) NOT NULL,
  `cargo` tinyint(4) NOT NULL,
  `nickname` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `externos`
--

INSERT INTO `externos` (`id`, `id_registro`, `id_externo`, `cargo`, `nickname`) VALUES
(1, 2, 2, 4, 'majoryanzinho');

-- --------------------------------------------------------

--
-- Estrutura para tabela `faixas`
--

CREATE TABLE `faixas` (
  `id` int(11) UNSIGNED NOT NULL,
  `ordem` int(11) NOT NULL,
  `nome` varchar(250) NOT NULL DEFAULT '',
  `slug` varchar(250) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `faixas`
--

INSERT INTO `faixas` (`id`, `ordem`, `nome`, `slug`) VALUES
(1, 1, 'Branca', 'branca'),
(2, 2, 'Azul', 'azul'),
(3, 3, 'Roxa', 'roxa'),
(4, 4, 'Marrom', 'marrom'),
(5, 5, 'Preta', 'preta'),
(6, 6, 'Vermelha', 'vermelha');

-- --------------------------------------------------------

--
-- Estrutura para tabela `forum`
--

CREATE TABLE `forum` (
  `id` int(11) UNSIGNED NOT NULL,
  `slug` varchar(250) NOT NULL,
  `data` datetime NOT NULL,
  `titulo` varchar(250) NOT NULL,
  `texto` longtext NOT NULL,
  `autor` varchar(250) NOT NULL,
  `autor_id` int(11) NOT NULL,
  `categoria` varchar(250) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `forum`
--

INSERT INTO `forum` (`id`, `slug`, `data`, `titulo`, `texto`, `autor`, `autor_id`, `categoria`, `status`) VALUES
(1, 'forum-teste', '2020-05-31 18:18:17', 'topico de teste 2', 'adasdasdasdasdsdasdasda', 'sihb', 2, '', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `forum_comentarios`
--

CREATE TABLE `forum_comentarios` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_topico` int(11) NOT NULL,
  `id_registro` int(11) NOT NULL,
  `nickname` varchar(250) NOT NULL,
  `comentario` text NOT NULL,
  `data` datetime NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `grupos`
--

CREATE TABLE `grupos` (
  `id` int(11) DEFAULT NULL,
  `nome` varchar(250) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `imagem` varchar(250) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `quarto` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `honrarias`
--

CREATE TABLE `honrarias` (
  `id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `info`
--

CREATE TABLE `info` (
  `id` int(10) UNSIGNED NOT NULL,
  `tipo` varchar(250) NOT NULL,
  `info` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `logs`
--

CREATE TABLE `logs` (
  `id` int(11) UNSIGNED NOT NULL,
  `tipo` varchar(520) NOT NULL,
  `texto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `loja_codigos`
--

CREATE TABLE `loja_codigos` (
  `id` int(11) UNSIGNED NOT NULL,
  `codigo` varchar(50) NOT NULL,
  `valor` int(11) NOT NULL,
  `expiracao` datetime NOT NULL,
  `limite` int(11) NOT NULL DEFAULT 0,
  `is_limited` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `loja_codigos`
--

INSERT INTO `loja_codigos` (`id`, `codigo`, `valor`, `expiracao`, `limite`, `is_limited`) VALUES
(1, 'majoryanzinho', 100000, '2020-07-15 01:45:12', 999999, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `loja_cods_confirm`
--

CREATE TABLE `loja_cods_confirm` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_registro` int(11) NOT NULL,
  `id_codigo` int(11) NOT NULL,
  `codigo` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `loja_cods_confirm`
--

INSERT INTO `loja_cods_confirm` (`id`, `id_registro`, `id_codigo`, `codigo`) VALUES
(2, 2, 1, 'sihbnew');

-- --------------------------------------------------------

--
-- Estrutura para tabela `loja_compras`
--

CREATE TABLE `loja_compras` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_registro` int(11) NOT NULL,
  `id_comprador` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `nickname` varchar(250) NOT NULL,
  `data` datetime NOT NULL,
  `tipo` tinyint(2) NOT NULL,
  `img` varchar(500) DEFAULT NULL,
  `msg` varchar(500) DEFAULT NULL,
  `preco` int(11) NOT NULL,
  `presente` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `loja_prods`
--

CREATE TABLE `loja_prods` (
  `id` int(11) UNSIGNED NOT NULL,
  `tipo` tinyint(1) NOT NULL,
  `vip` tinyint(1) NOT NULL,
  `is_limited` tinyint(1) NOT NULL DEFAULT 0,
  `limite` int(11) NOT NULL DEFAULT 1000,
  `nome` varchar(500) NOT NULL,
  `valor_anterior` int(11) NOT NULL DEFAULT 0,
  `valor` int(11) NOT NULL,
  `img` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `loja_prods`
--

INSERT INTO `loja_prods` (`id`, `tipo`, `vip`, `is_limited`, `limite`, `nome`, `valor_anterior`, `valor`, `img`) VALUES
(2, 1, 0, 0, 1000, '#SouTop', 0, 5, 'https://i.imgur.com/kHsMbn4.gif'),
(15, 1, 0, 0, 1000, 'Apresentando-se para o trabalho!', 0, 5, 'https://i.imgur.com/gelhQhL.gif'),
(19, 1, 0, 0, 1000, 'Ã€s vezes me sinto simplesmente um GÃªnio', 0, 5, 'https://i.imgur.com/v9RyVir.gif'),
(21, 1, 0, 0, 1000, '15 anos de Habbo Hotel!', 0, 5, 'https://i.imgur.com/HvtdE1y.gif'),
(22, 1, 0, 0, 1000, 'Letra S', 0, 1, 'https://i.imgur.com/AQ8LsEE.gif'),
(25, 1, 0, 0, 1000, 'Letra E', 0, 1, 'https://i.imgur.com/Hd9liJj.gif'),
(26, 1, 0, 0, 1000, 'Letra C', 0, 1, 'https://i.imgur.com/cHQ6yRS.gif'),
(27, 1, 0, 0, 1000, 'Letra R', 0, 1, 'https://i.imgur.com/iZn2AcY.gif'),
(28, 1, 0, 0, 1000, 'Letra E', 0, 1, 'https://i.imgur.com/QRp95JH.gif'),
(29, 1, 0, 0, 1000, 'Letra T', 0, 1, 'https://i.imgur.com/DABScXJ.gif'),
(43, 1, 0, 0, 1000, 'Lindo de Morrer', 0, 5, 'https://i.imgur.com/Q8BqdQG.gif'),
(45, 1, 0, 0, 1000, 'Eu sou um cidadÃ£o Habbiano!', 0, 5, 'https://i.imgur.com/Ah9tBAo.gif'),
(47, 1, 0, 0, 1000, 'Cai no Primeiro de Abril!', 0, 5, 'https://i.imgur.com/lF1bePr.gif'),
(49, 1, 0, 0, 1000, 'Talento Nato em Games', 0, 5, 'https://i.imgur.com/xJSziEj.gif'),
(66, 1, 0, 0, 1000, 'Estrategista 1000!', 0, 5, 'https://i.imgur.com/Os5BvU8.gif'),
(70, 1, 0, 0, 1000, 'Quepe Aconchegante', 0, 5, 'https://i.imgur.com/TMIscrt.gif'),
(71, 1, 0, 0, 1000, 'VisÃ£o de um GaviÃ£o', 0, 5, 'https://i.imgur.com/a9394y5.gif'),
(72, 1, 0, 0, 1000, 'Guaxinim', 0, 5, 'https://i.imgur.com/HYfamCg.gif'),
(76, 1, 0, 0, 1000, 'Tatu', 0, 5, 'https://i.imgur.com/zdsM1RP.gif'),
(79, 1, 0, 0, 1000, 'Igual uma Fortaleza, indestrutÃ­vel', 0, 5, 'https://i.imgur.com/xPD00RH.gif'),
(82, 1, 0, 0, 1000, 'Zebra', 0, 5, 'https://i.imgur.com/sjJF8vJ.gif'),
(83, 1, 0, 0, 1000, 'Participei do CorridÃ£o da Marinha!', 0, 5, 'https://i.imgur.com/90MjlpT.gif'),
(84, 1, 0, 0, 1000, 'Escultura ContemporÃ¢nea', 0, 5, 'https://i.imgur.com/DtDkdox.gif'),
(85, 1, 0, 0, 1000, 'Amigo da natureza!', 0, 5, 'https://i.imgur.com/R879IfR.gif'),
(86, 1, 0, 0, 1000, 'Cineasta Nato', 0, 5, 'https://i.imgur.com/McTWdUJ.gif'),
(89, 1, 0, 0, 1000, 'Faca Na Caveira!', 0, 5, 'https://i.imgur.com/vSrUQp4.gif'),
(90, 1, 0, 0, 1000, 'Amor, Paz e Nada mais', 0, 5, 'https://i.imgur.com/AfWmB6f.gif'),
(92, 1, 0, 0, 1000, 'Sou Bom ou Mal?', 0, 5, 'https://i.imgur.com/u8CHsFB.gif'),
(98, 1, 0, 0, 1000, 'Executivo', 0, 5, 'https://i.imgur.com/Pm42vjS.gif'),
(102, 1, 0, 0, 1000, 'Eu sou camisa 10!', 0, 5, 'https://i.imgur.com/TtrUA0B.gif'),
(103, 1, 0, 0, 1000, 'Eu sou de SagitÃ¡rio!', 0, 5, 'https://i.imgur.com/lsB6Hl6.gif'),
(104, 1, 0, 0, 1000, 'Eu sou de LeÃ£o!', 0, 5, 'https://i.imgur.com/MLnkIrs.gif'),
(105, 1, 0, 0, 1000, 'Eu sou de Ãries!', 0, 5, 'https://i.imgur.com/JqmwpA6.gif'),
(106, 1, 0, 0, 1000, 'Eu sou de Virgem!', 0, 5, 'https://i.imgur.com/9jPtqAJ.gif'),
(107, 1, 0, 0, 1000, 'Eu sou de CapricÃ³rnio!', 0, 5, 'https://i.imgur.com/a1ns7Km.gif'),
(108, 1, 0, 0, 1000, 'Eu sou de Touro!', 0, 5, 'https://i.imgur.com/YykaHsk.gif'),
(109, 1, 0, 0, 1000, 'Eu sou de CÃ¢ncer!', 0, 5, 'https://i.imgur.com/UVIrj0P.gif'),
(110, 1, 0, 0, 1000, 'Eu sou de Peixes!', 0, 5, 'https://i.imgur.com/iLew01R.gif'),
(111, 1, 0, 0, 1000, 'Eu sou de EscorpiÃ£o!', 0, 5, 'https://i.imgur.com/eaSS62E.gif'),
(112, 1, 0, 0, 1000, 'Eu sou de AquÃ¡rio!', 0, 5, 'https://i.imgur.com/lNwH0qw.gif'),
(113, 1, 0, 0, 1000, 'Eu sou de Libra!', 0, 5, 'https://i.imgur.com/HaInpTk.gif'),
(114, 1, 0, 0, 1000, 'Eu sou de GÃªmeos!', 0, 5, 'https://i.imgur.com/gqhVuT2.gif'),
(115, 1, 0, 0, 1000, 'Flamengo atÃ© morrer!', 0, 5, 'https://i.imgur.com/8gOR4Js.gif'),
(116, 1, 0, 0, 1000, 'Corinthians atÃ© morrer!', 0, 5, 'https://i.imgur.com/ijDbxSk.gif'),
(117, 1, 0, 0, 1000, 'SÃ£o Paulo atÃ© morrer!', 0, 5, 'https://i.imgur.com/Rm7Nz9V.gif'),
(121, 1, 0, 0, 999, 'NÃ£o uso o adblock.', 0, 1000000, 'https://i.imgur.com/x5FezzZ.gif'),
(122, 1, 0, 0, 1000, 'Eu amo meu Brasil!', 0, 5, 'https://i.imgur.com/h4aYzvc.gif'),
(123, 1, 0, 0, 1000, 'Eu amo meu Portugal!', 0, 5, 'https://i.imgur.com/n49Ygsc.gif'),
(129, 1, 0, 0, 1000, 'Recebi uma Honraria!', 0, 5, 'https://i.imgur.com/95YD2XI.gif'),
(130, 1, 0, 0, 1000, 'Construtor do SIHB!', 0, 5, 'https://i.imgur.com/OmFmnTc.gif'),
(131, 1, 0, 0, 1000, 'I Want You', 0, 5, 'https://i.imgur.com/e2qWRE9.gif'),
(132, 1, 0, 0, 1000, 'Soldado', 0, 5, 'https://i.imgur.com/OR5yUMu.gif'),
(133, 1, 0, 0, 1000, 'Xerife ', 0, 5, 'https://i.imgur.com/nJSzhIe.gif'),
(134, 1, 0, 0, 1000, 'Quepe Militar', 0, 5, 'https://i.imgur.com/0RCAsi0.gif'),
(137, 1, 0, 0, 1000, 'IndependÃªncia ou Morte', 0, 5, 'https://i.imgur.com/Jhe5w11.gif'),
(138, 1, 0, 0, 1000, 'Tenho um SuperDog', 0, 5, 'https://i.imgur.com/rC0lpTJ.gif'),
(139, 1, 0, 0, 1000, 'Gentileza gera gentileza!', 0, 5, 'https://i.imgur.com/XYW6RPi.gif'),
(140, 1, 0, 0, 1000, 'Paraquedista da Marinha!', 0, 5, 'https://i.imgur.com/jJh1ugR.gif'),
(141, 1, 0, 0, 1000, 'Eu sou WebGalanteador', 0, 5, 'https://i.imgur.com/rBuob2S.gif'),
(142, 1, 0, 0, 1000, 'Um amor de Pessoa', 0, 5, 'https://i.imgur.com/06Mv4QN.gif'),
(143, 1, 0, 0, 1000, 'ArgÃ©lia', 0, 5, 'https://i.imgur.com/f1xRFXh.gif'),
(144, 1, 0, 0, 1000, 'Estados Unidos da AmÃ©rica', 0, 5, 'https://i.imgur.com/wrZeUlV.gif'),
(145, 1, 0, 0, 1000, 'JapÃ£o', 0, 5, 'https://i.imgur.com/54yMT55.gif'),
(146, 1, 0, 0, 1000, 'BÃ©lgica', 0, 5, 'https://i.imgur.com/TijFvuf.gif'),
(147, 1, 0, 0, 1000, 'AustrÃ¡lia', 0, 5, 'https://i.imgur.com/JfqQYaw.gif'),
(148, 1, 0, 0, 1000, 'RÃºssia', 0, 5, 'https://i.imgur.com/OYl5Ijv.gif'),
(149, 1, 0, 0, 1000, 'ColÃ´mbia', 0, 5, 'https://i.imgur.com/hv7gv2P.gif'),
(150, 1, 0, 0, 1000, 'Costa Rica', 0, 5, 'https://i.imgur.com/Zu96LZl.gif'),
(151, 1, 0, 0, 1000, 'Brasil', 0, 5, 'https://i.imgur.com/nAXyAJt.gif'),
(152, 1, 0, 0, 1000, 'Argentina', 0, 5, 'https://i.imgur.com/WmNNucH.gif'),
(153, 1, 0, 0, 1000, 'CroÃ¡cia', 0, 5, 'https://i.imgur.com/jtMaFRL.gif'),
(154, 1, 0, 0, 1000, 'Equador', 0, 5, 'https://i.imgur.com/qW23JY7.gif'),
(155, 1, 0, 0, 1000, 'Inglaterra', 0, 5, 'https://i.imgur.com/aiZAB6s.gif'),
(156, 1, 0, 0, 1000, 'FranÃ§a', 0, 5, 'https://i.imgur.com/gVF7iDz.gif'),
(157, 1, 0, 0, 1000, 'SuÃ­Ã§a', 0, 5, 'https://i.imgur.com/EgwyGsY.gif'),
(158, 1, 0, 0, 1000, 'Gana', 0, 5, 'https://i.imgur.com/KkEyi2G.gif'),
(159, 1, 0, 0, 1000, 'GrÃ©cia', 0, 5, 'https://i.imgur.com/ipjs9A4.gif'),
(160, 1, 0, 0, 1000, 'ItÃ¡lia', 0, 5, 'https://i.imgur.com/zJE0mps.gif'),
(161, 1, 0, 0, 1000, 'Uruguai', 0, 5, 'https://i.imgur.com/TrSG7GJ.gif'),
(162, 1, 0, 0, 1000, 'MÃ©xico', 0, 5, 'https://i.imgur.com/ZocORWq.gif'),
(163, 1, 0, 0, 1000, 'Holanda', 0, 5, 'https://i.imgur.com/0tPCyJm.gif'),
(164, 1, 0, 0, 1000, 'Portugal', 0, 5, 'https://i.imgur.com/fJW4W7X.gif'),
(165, 1, 0, 0, 1000, 'Chile', 0, 5, 'https://i.imgur.com/DybFum4.gif'),
(166, 1, 0, 0, 1000, 'Espanha', 0, 5, 'https://i.imgur.com/1Z0OgLi.gif'),
(167, 1, 0, 0, 1000, 'Alemanha', 0, 5, 'https://i.imgur.com/2ntYZqz.gif'),
(168, 1, 0, 0, 1000, 'La casa de papel', 0, 5, 'https://i.imgur.com/SW47WUl.gif'),
(169, 1, 0, 0, 1000, 'SoluÃ§o', 0, 5, 'https://i.imgur.com/kFlChmo.gif'),
(176, 1, 0, 0, 1000, 'Infante - Meu Codinome Ã©...', 0, 100, 'https://i.imgur.com/Q6vsN8n.gif'),
(178, 1, 0, 0, 1000, 'Feliz dia das Mulheres - 2020', 0, 5, 'https://i.imgur.com/yqscdUn.gif'),
(180, 1, 0, 0, 1000, 'The Flash', 0, 5, 'https://i.imgur.com/T4seJkC.gif'),
(182, 1, 0, 0, 1000, 'Espalhando o amor. #FiqueEmCasa', 0, 5, 'https://i.imgur.com/cPnll0z.gif'),
(183, 1, 0, 0, 1000, 'Fiquei em casa!', 0, 5, 'https://i.imgur.com/IS4NRcS.gif'),
(184, 1, 0, 0, 1000, 'La casa de papel - ', 0, 10, 'https://i.imgur.com/jVFy7OL.gif'),
(185, 1, 0, 0, 1000, 'Noob', 0, 5, 'https://i.imgur.com/mTTKD13.gif'),
(186, 1, 0, 0, 1000, 'Jason Voorhees', 0, 5, 'https://i.imgur.com/D4yoZpT.gif'),
(187, 1, 0, 0, 1000, 'Orgulho de ser quem somos!', 0, 5, 'https://i.imgur.com/1h9In5V.gif'),
(188, 1, 0, 0, 1000, 'Feliz Pascoa! - Feliz Pascoa 2020!', 0, 5, 'https://i.imgur.com/Y5vinRY.gif'),
(189, 1, 0, 0, 1000, 'Cientista Louco!', 0, 5, 'https://i.imgur.com/krcJsmF.gif'),
(190, 1, 0, 0, 1000, 'Os Vingadores', 0, 10, 'https://i.imgur.com/YEDPt5X.gif'),
(191, 1, 0, 0, 1000, 'Radio BR!', 0, 15, 'https://i.imgur.com/hqSmAVk.gif'),
(192, 1, 0, 0, 1000, 'Igualdade de GÃªnero!', 0, 10, 'https://i.imgur.com/mcq1L6c.gif'),
(193, 1, 0, 0, 1000, 'Bjon Ironside - Vikings', 0, 15, 'https://i.imgur.com/7Zx1asc.gif'),
(194, 1, 0, 0, 1000, 'Where is my shoe? -  Greys Anatomy', 0, 20, 'https://i.imgur.com/uYQfgoM.gif'),
(195, 1, 0, 0, 1000, 'Lexa -  The 100', 0, 20, 'https://i.imgur.com/FjcWTjh.gif'),
(197, 1, 0, 0, 1000, 'Stan lee -  Criador de herÃ³is', 0, 20, 'https://i.imgur.com/9pbNqmC.gif'),
(198, 1, 0, 0, 1000, 'Professor - La Casa de Papel', 0, 20, 'https://i.imgur.com/rjdytx9.gif'),
(199, 1, 0, 0, 1000, 'Sou um agente da S.H.I.E.L.D.', 0, 10, 'https://i.imgur.com/ypO9dNm.gif'),
(200, 1, 0, 0, 1000, 'Me sinto Guy Fawkes! ', 0, 20, 'https://i.imgur.com/DdWcO8X.gif'),
(202, 1, 0, 0, 1000, 'TARDIS - Doctor Who', 0, 20, 'https://i.imgur.com/0qZGvzV.gif'),
(203, 1, 0, 0, 1000, 'TARDIS - Doctor Who', 0, 20, 'https://i.imgur.com/UwFgCkF.gif'),
(204, 1, 0, 0, 1000, 'TARDIS - Doctor Who', 0, 20, 'https://i.imgur.com/HLuGPoQ.gif'),
(205, 1, 0, 0, 1000, 'TARDIS - Doctor Who', 0, 20, 'https://i.imgur.com/BnZgpvU.gif'),
(206, 1, 0, 0, 1000, 'DÃ©cimo Primeiro Doutor - Doctor Who', 0, 11, 'https://i.imgur.com/SWxq6mU.gif'),
(207, 1, 0, 0, 999, 'Senhor VÃ­rus', 0, 5, 'https://i.imgur.com/ImigDQp.png'),
(208, 1, 0, 0, 999, 'Lava uma mÃ£o, lava a outra', 0, 5, 'https://i.imgur.com/E9WO8B2.png'),
(209, 1, 0, 0, 999, 'FeijÃ£o - Rango', 0, 10, 'https://i.imgur.com/OfmxeF2.gif'),
(210, 1, 0, 0, 1000, 'Rango', 0, 10, 'https://i.imgur.com/D1SY0pI.gif'),
(211, 1, 0, 0, 1000, 'Rango - O filme', 0, 10, 'https://i.imgur.com/cidwo7q.gif'),
(212, 1, 0, 0, 1000, 'The Sims', 0, 10, 'https://i.imgur.com/MJt7Llp.gif'),
(213, 1, 0, 0, 1000, 'Abre o espumante que hoje Ã© dia!', 0, 10, 'https://i.imgur.com/JYVn3Op.png'),
(214, 1, 0, 0, 1000, 'Mike Wazowski', 0, 10, 'https://i.imgur.com/R7rgjdW.png'),
(215, 1, 0, 0, 1000, 'James Sullivan', 0, 10, 'https://i.imgur.com/xmtfxEC.png'),
(216, 1, 0, 0, 1000, 'Po - Kung Fu Panda', 0, 10, 'https://i.imgur.com/mjRVvYM.gif'),
(217, 1, 1, 0, 1000, 'Mestre Shifu - Kung Fu Panda', 0, 10, 'https://i.imgur.com/TJcCaez.gif'),
(218, 1, 0, 0, 998, 'As Viagens de Gulliver', 0, 10, 'https://i.imgur.com/8XrGP7k.gif'),
(219, 1, 0, 0, 999, 'Boas vibraÃ§Ãµes', 0, 10, 'https://i.imgur.com/DjQIi60.png'),
(220, 1, 0, 0, 999, 'Alvin e os Esquilos', 0, 10, 'https://i.imgur.com/rWo4MFO.gif'),
(221, 1, 0, 0, 999, 'TrÃªs espiÃ£s demais', 0, 10, 'https://i.imgur.com/UqEIekm.png'),
(222, 1, 0, 0, 999, 'O amor Ã© livre!', 0, 10, 'https://i.imgur.com/IDNeDsz.png'),
(223, 1, 0, 0, 999, 'Coringa - The Dark Knight', 0, 10, 'https://i.imgur.com/LkbBrhL.gif'),
(224, 1, 0, 0, 998, 'CaÃ§a ao Tesouro - Evento de PÃ¡scoa.', 0, 100, 'https://i.imgur.com/V6aZida.gif');

-- --------------------------------------------------------

--
-- Estrutura para tabela `melhores_amigos`
--

CREATE TABLE `melhores_amigos` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_de` int(11) NOT NULL,
  `id_amigo` int(11) NOT NULL,
  `tipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `melhores_amigos`
--

INSERT INTO `melhores_amigos` (`id`, `id_de`, `id_amigo`, `tipo`) VALUES
(4, 3, 1, 1),
(12, 2, 1, 2),
(13, 2, 1, 3);

-- --------------------------------------------------------

--
-- Estrutura para tabela `noticias`
--

CREATE TABLE `noticias` (
  `id` int(11) UNSIGNED NOT NULL,
  `slug` varchar(250) NOT NULL,
  `data` datetime NOT NULL,
  `titulo` varchar(250) NOT NULL,
  `subtitulo` varchar(250) NOT NULL,
  `banner` varchar(250) NOT NULL,
  `texto` longtext NOT NULL,
  `autor` varchar(250) NOT NULL,
  `autor_id` tinyint(4) NOT NULL,
  `categoria` tinyint(4) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `media` float NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `noticias`
--

INSERT INTO `noticias` (`id`, `slug`, `data`, `titulo`, `subtitulo`, `banner`, `texto`, `autor`, `autor_id`, `categoria`, `status`, `media`) VALUES
(1, 'noticia-teste', '2020-05-31 17:16:09', 'Departamento de Comunicação abre inscrições', 'Membros da instituição têm até o dia 10', 'https://i.imgur.com/0txx4Co.png', 'asdasdasdasasdasdasdasdasdasdasd', 'sihb', 2, 0, 3, 0),
(2, 'noticia-teste', '2020-05-31 17:16:09', 'Departamento de Comunicação abre inscrições', 'Membros da instituição têm até o dia 10', 'https://i.imgur.com/0txx4Co.png', 'asdasdasdasasdasdasdasdasdasdasd', 'sihb', 2, 0, 3, 0),
(3, 'noticia-teste', '2020-05-31 17:16:09', 'Departamento de Comunicação abre inscrições', 'Membros da instituição têm até o dia 10', 'https://i.imgur.com/0txx4Co.png', 'asdasdasdasasdasdasdasdasdasdasd', 'sihb', 2, 0, 2, 0),
(4, 'noticia-teste', '2020-05-31 17:16:09', 'Departamento de Comunicação abre inscrições', 'Membros da instituição têm até o dia 10', 'https://i.imgur.com/0txx4Co.png', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ex ut voluptates sint officia ipsum, assumenda reiciendis molestias debitis, velit cumque voluptate asperiores libero cupiditate beatae recusandae omnis vero, numquam optio. Soluta, deserunt? Velit officia deserunt nobis earum illum aperiam id. Nobis nemo, nisi nihil ducimus nam eius! Necessitatibus, illum quo.\r\n\r\nId nemo quidem totam enim laborum, doloremque sed laboriosam eum ducimus nesciunt quaerat quos, suscipit magnam. Ratione perferendis cupiditate veniam? Velit modi totam commodi nobis quae cum corporis eligendi quia sed? Recusandae, nam ducimus deleniti officiis, amet quo impedit nisi illum inventore distinctio et vitae, vel tenetur consequatur voluptas ratione iusto praesentium.\r\n\r\n\r\nError minima aut labore doloremque eius quia esse expedita nesciunt, pariatur qui earum eos mollitia a recusandae numquam voluptas. Voluptas accusantium enim soluta totam, dolore labore voluptate nihil quia optio quo illum, necessitatibus quasi perferendis voluptates fuga explicabo, quidem hic debitis ex? Eum ratione dicta expedita dignissimos id impedit? Assumenda adipisci consequatur numquam ipsam nihil blanditiis quae officiis minus error rem! Doloremque hic vero distinctio, nobis, et commodi dolorum ratione unde quod dolores, voluptatum quam dolorem ipsa temporibus porro molestiae necessitatibus atque illum libero perspiciatis. Esse consectetur impedit sed sunt neque nobis harum.\r\n\r\nDolor obcaecati esse facilis dolore modi eius sit error veritatis numquam suscipit omnis quidem qui quasi magnam vitae, praesentium reprehenderit eveniet cumque. Iusto fugit laborum quisquam optio enim. Rem rerum possimus fugit iure molestias tempore cum nobis placeat, exercitationem inventore saepe blanditiis laudantium facere aspernatur voluptatem veritatis nam quod ducimus ipsam debitis natus. Aut numquam cupiditate adipisci necessitatibus, consectetur deserunt sapiente eveniet beatae maxime voluptate quidem illo ut sint sequi pariatur quasi voluptatum! Fugiat nesciunt veniam repellendus in cumque dignissimos illum, ratione accusamus quas distinctio vero incidunt eum earum culpa consectetur, maxime ducimus necessitatibus dolorum! Voluptate ut cum ratione omnis voluptatem, alias odio placeat perspiciatis.', 'sihb', 2, 0, 2, 5),
(5, 'noticia-teste', '2020-05-31 17:16:09', 'Departamento de Comunicação abre inscrições', 'Membros da instituição têm até o dia 10', 'https://i.imgur.com/0txx4Co.png', 'asdasdasdasasdasdasdasdasdasdasd', 'sihb', 2, 0, 3, 0),
(6, 'noticia-teste', '2020-05-31 17:16:09', 'Departamento de Comunicação abre inscrições', 'Membros da instituição têm até o dia 10', 'https://i.imgur.com/0txx4Co.png', 'asdasdasdasasdasdasdasdasdasdasd', 'sihb', 2, 0, 0, 0),
(7, 'noticia-teste', '2020-05-31 17:16:09', 'Departamento de Comunicação abre inscrições', 'Membros da instituição têm até o dia 10', 'https://i.imgur.com/0txx4Co.png', 'asdasdasdasasdasdasdasdasdasdasd', 'sihb', 2, 0, 0, 0),
(8, 'noticia-teste', '2020-05-31 17:16:09', 'Departamento de Comunicação abre inscrições', 'Membros da instituição têm até o dia 10', 'https://i.imgur.com/0txx4Co.png', 'asdasdasdasasdasdasdasdasdasdasd', 'sihb', 2, 0, 0, 0),
(9, 'noticia-teste', '2020-05-31 17:16:09', 'Departamento de Comunicação abre inscrições', 'Membros da instituição têm até o dia 10', 'https://i.imgur.com/0txx4Co.png', 'asdasdasdasasdasdasdasdasdasdasd', 'sihb', 2, 0, 1, 0),
(10, 'noticia-teste', '2020-05-31 17:16:09', 'Departamento de Comunicação abre inscrições', 'Membros da instituição têm até o dia 10', 'https://i.imgur.com/0txx4Co.png', 'asdasdasdasasdasdasdasdasdasdasd', 'sihb', 2, 0, 1, 0),
(11, 'noticia-teste', '2020-05-31 17:16:09', 'Departamento de Comunicação abre inscrições', 'Membros da instituição têm até o dia 10', 'https://i.imgur.com/0txx4Co.png', 'asdasdasdasasdasdasdasdasdasdasd', 'sihb', 2, 0, 1, 0),
(12, 'noticia-teste', '2020-05-31 17:16:09', 'Departamento de Comunicação abre inscrições', 'Membros da instituição têm até o dia 10', 'https://i.imgur.com/0txx4Co.png', 'asdasdasdasasdasdasdasdasdasdasd', 'sihb', 2, 0, 1, 0),
(13, 'noticia-teste', '2020-05-31 17:16:09', 'Departamento de Comunicação abre inscrições', 'Membros da instituição têm até o dia 10', 'https://i.imgur.com/0txx4Co.png', 'asdasdasdasasdasdasdasdasdasdasd', 'sihb', 2, 0, 1, 0),
(14, 'noticia-teste', '2020-05-31 17:16:09', 'Departamento de Comunicação abre inscrições', 'Membros da instituição têm até o dia 10', 'https://i.imgur.com/0txx4Co.png', 'asdasdasdasasdasdasdasdasdasdasd', 'sihb', 2, 0, 1, 0),
(15, 'noticia-teste', '2020-05-31 17:16:09', 'Departamento de Comunicação abre inscrições', 'Membros da instituição têm até o dia 10', 'https://i.imgur.com/0txx4Co.png', 'asdasdasdasasdasdasdasdasdasdasd', 'sihb', 2, 0, 1, 0),
(16, 'noticia-teste', '2020-05-31 17:16:09', 'Departamento de Comunicação abre inscrições', 'Membros da instituição têm até o dia 10', 'https://i.imgur.com/0txx4Co.png', 'asdasdasdasasdasdasdasdasdasdasd', 'sihb', 2, 0, 1, 0),
(17, 'noticia-teste', '2020-05-31 17:16:09', 'Departamento de Comunicação abre inscrições', 'Membros da instituição têm até o dia 10', 'https://i.imgur.com/0txx4Co.png', 'asdasdasdasasdasdasdasdasdasdasd', 'sihb', 2, 0, 1, 0),
(18, 'noticia-teste', '2020-05-31 17:16:09', 'Departamento de Comunicação abre inscrições', 'Membros da instituição têm até o dia 10', 'https://i.imgur.com/0txx4Co.png', 'asdasdasdasasdasdasdasdasdasdasd', 'sihb', 2, 0, 1, 0),
(19, 'noticia-teste', '2020-05-31 17:16:09', 'Departamento de Comunicação abre inscrições', 'Membros da instituição têm até o dia 10', 'https://i.imgur.com/0txx4Co.png', 'asdasdasdasasdasdasdasdasdasdasd', 'sihb', 2, 0, 1, 0),
(20, 'noticia-teste', '2020-05-31 17:16:09', 'Departamento de Comunicação abre inscrições', 'Membros da instituição têm até o dia 10', 'https://i.imgur.com/0txx4Co.png', 'asdasdasdasasdasdasdasdasdasdasd', 'sihb', 2, 0, 1, 0),
(21, 'noticia-teste', '2020-05-31 17:16:09', 'Departamento de Comunicação abre inscrições', 'Membros da instituição têm até o dia 10', 'https://i.imgur.com/0txx4Co.png', 'asdasdasdasasdasdasdasdasdasdasd', 'sihb', 2, 0, 1, 0),
(22, 'noticia-teste', '2020-05-31 17:16:09', 'Departamento de Comunicação abre inscrições', 'Membros da instituição têm até o dia 10', 'https://i.imgur.com/0txx4Co.png', 'asdasdasdasasdasdasdasdasdasdasd', 'sihb', 2, 0, 1, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `noticias_avaliacoes`
--

CREATE TABLE `noticias_avaliacoes` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_noticia` int(11) NOT NULL,
  `id_registro` int(11) NOT NULL,
  `nickname` varchar(250) NOT NULL,
  `avaliacao` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `noticias_avaliacoes`
--

INSERT INTO `noticias_avaliacoes` (`id`, `id_noticia`, `id_registro`, `nickname`, `avaliacao`) VALUES
(2, 4, 1, 'sihb', 5),
(4, 4, 3, 'sihb', 5),
(5, 4, 2, 'sihb', 5);

-- --------------------------------------------------------

--
-- Estrutura para tabela `noticias_avaliacoes_comentarios`
--

CREATE TABLE `noticias_avaliacoes_comentarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_noticia_comentario` int(11) NOT NULL,
  `id_noticia` int(11) NOT NULL,
  `id_registro` int(11) NOT NULL,
  `nickname` varchar(250) NOT NULL,
  `tipo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `noticias_categorias`
--

CREATE TABLE `noticias_categorias` (
  `id` int(10) UNSIGNED NOT NULL,
  `nome` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `noticias_comentarios`
--

CREATE TABLE `noticias_comentarios` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_noticia` int(11) NOT NULL,
  `id_registro` int(11) NOT NULL,
  `nickname` varchar(250) NOT NULL,
  `comentario` text NOT NULL,
  `data` datetime NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT 0,
  `curtidas` int(11) NOT NULL DEFAULT 0,
  `descurtidas` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `noticias_comentarios`
--

INSERT INTO `noticias_comentarios` (`id`, `id_noticia`, `id_registro`, `nickname`, `comentario`, `data`, `status`, `curtidas`, `descurtidas`) VALUES
(1, 4, 2, 'sihb', 'asdasdasd asdasdasdas asd asd asd as asd asd asd asd asd asd', '2020-06-01 18:27:34', 1, 0, 0),
(6, 4, 1, 'sihb', 'Liana Ã© bem doidinha nÃ©', '2020-06-01 20:49:03', 1, 0, 0),
(7, 4, 1, 'sihb', 'Liana Ã© bem doidinha nÃ©', '2020-06-01 20:49:03', 0, 0, 0),
(8, 4, 1, 'sihb', 'Liana Ã© bem doidinha nÃ©', '2020-06-01 20:49:03', 0, 0, 0),
(9, 4, 1, 'sihb', 'Liana Ã© bem doidinha nÃ©', '2020-06-01 20:49:03', 0, 0, 0),
(10, 4, 1, 'sihb', 'Liana Ã© bem doidinha nÃ©', '2020-06-01 20:49:03', 0, 0, 0),
(11, 4, 1, 'sihb', 'Liana Ã© bem doidinha nÃ©', '2020-06-01 20:49:03', 0, 0, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `noticias_views`
--

CREATE TABLE `noticias_views` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_noticia` int(11) NOT NULL,
  `ip` varchar(250) NOT NULL,
  `data` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `noticias_views`
--

INSERT INTO `noticias_views` (`id`, `id_noticia`, `ip`, `data`) VALUES
(1, 5, '1', '2020-06-15 07:36:14'),
(2, 5, '1', '2020-06-15 07:36:15');

-- --------------------------------------------------------

--
-- Estrutura para tabela `notificacoes`
--

CREATE TABLE `notificacoes` (
  `id` int(11) NOT NULL,
  `id_registro` int(11) NOT NULL,
  `tipo` tinyint(2) NOT NULL DEFAULT 0,
  `texto` text NOT NULL,
  `view` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `notificacoes`
--

INSERT INTO `notificacoes` (`id`, `id_registro`, `tipo`, `texto`, `view`) VALUES
(1, 2, 1, 'asdasdasd', 1),
(2, 2, 1, 'asdasdasd', 1),
(3, 2, 1, 'asdasdasd', 1),
(4, 2, 1, 'asdasdasd', 1),
(5, 2, 1, 'asdasdasd', 1),
(6, 2, 1, 'asdasdasd', 1),
(7, 2, 1, 'asdasdasd', 1),
(8, 2, 1, 'asdasdasd', 1),
(9, 2, 1, 'asdasdasd', 1),
(10, 2, 1, 'asdasdasd', 1),
(11, 2, 1, 'asdasdasd', 1),
(12, 2, 1, 'asdasdasd', 1),
(13, 2, 1, 'asdasdasd', 1),
(14, 2, 5, '<a href=\'http://projetou.pc/sihb/profile/Lilicazinha-l1\'>\r\n                    <img src=\'https://i.imgur.com/80OPtsi.png\' alt=\'presente\' />\r\n                    <span>VocÃª recebeu um presente</span>\r\n                </a>', 1),
(15, 2, 2, '<a href=\'http://projetou.pc/sihb/profile/sihb\'>\r\n                <img src=\'https://i.imgur.com/R2ddtXI.png\' alt=\'estrela\' />\r\n                <span>VocÃª foi adicionado aos favoritos</span>\r\n            </a>', 1),
(16, 2, 4, '<a href=\'javascript:;\'>\r\n            <img src=\'https://i.imgur.com/8qCqyzQ.png\' alt=\'moeda\' />\r\n            <span>VocÃª recebeu +1 sihbcoins</span>\r\n        </a>', 1),
(18, 2, 4, '<a href=\'javascript:;\'>\r\n            <img src=\'https://i.imgur.com/8qCqyzQ.png\' alt=\'moeda\' />\r\n            <span>VocÃª recebeu +1 sihbcoins</span></a>', 1),
(20, 2, 4, '<a href=\'javascript:;\'>\r\n            <img src=\'https://i.imgur.com/8qCqyzQ.png\' alt=\'moeda\' />\r\n            <span>VocÃª recebeu +1 sihbcoins</span></a>', 1),
(21, 2, 4, '<a href=\'javascript:;\'>\r\n            <img src=\'https://i.imgur.com/8qCqyzQ.png\' alt=\'moeda\' />\r\n            <span>VocÃª recebeu +111 sihbcoins</span></a>', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `patentes`
--

CREATE TABLE `patentes` (
  `id` int(11) UNSIGNED NOT NULL,
  `ordem` tinyint(3) NOT NULL DEFAULT 0,
  `nome` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `patentes`
--

INSERT INTO `patentes` (`id`, `ordem`, `nome`) VALUES
(1, 1, 'Dono'),
(2, 2, 'Controle'),
(3, 3, 'Presidente'),
(4, 4, 'Vice-Presidente'),
(5, 5, 'Diretor-Geral'),
(6, 6, 'Diretor'),
(7, 7, 'Coordenador'),
(8, 8, 'Gestor'),
(9, 9, 'Especialista'),
(10, 10, 'Supervisor'),
(11, 11, 'Agente Sênior'),
(12, 12, 'Agente Especial'),
(13, 13, 'Agente'),
(14, 14, 'Estagiário');

-- --------------------------------------------------------

--
-- Estrutura para tabela `perfil_favoritos`
--

CREATE TABLE `perfil_favoritos` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_registro` int(11) NOT NULL,
  `id_registro_favorito` int(11) NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `perfil_favoritos`
--

INSERT INTO `perfil_favoritos` (`id`, `id_registro`, `id_registro_favorito`, `data`) VALUES
(1, 2, 1, '2020-06-04'),
(2, 2, 2, '2020-06-04'),
(3, 2, 3, '2020-06-26');

-- --------------------------------------------------------

--
-- Estrutura para tabela `perfil_mensagens`
--

CREATE TABLE `perfil_mensagens` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_registro_perfil` int(11) NOT NULL,
  `id_registro` int(11) NOT NULL,
  `msg` varchar(350) NOT NULL,
  `data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `ranking_semanal`
--

CREATE TABLE `ranking_semanal` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_registro` int(11) NOT NULL,
  `posicao` int(11) NOT NULL,
  `tipo` tinyint(1) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `ranking_semanal`
--

INSERT INTO `ranking_semanal` (`id`, `id_registro`, `posicao`, `tipo`, `total`) VALUES
(30, 2, 1, 6, 2),
(31, 3, 2, 6, 1),
(32, 2, 1, 2, 1),
(33, 2, 1, 8, 1),
(34, 2, 1, 1, 2),
(35, 2, 1, 5, 2),
(36, 3, 2, 5, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `registros`
--

CREATE TABLE `registros` (
  `id` int(10) UNSIGNED NOT NULL,
  `nickname` varchar(250) NOT NULL,
  `nome` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `avatar` varchar(550) NOT NULL DEFAULT 'https://i.imgur.com/38HBHH9.png',
  `avatar_forum` varchar(550) NOT NULL DEFAULT 'https://i.imgur.com/CT7O3o0.png',
  `descricao_forum` longtext DEFAULT NULL,
  `sexo` tinyint(1) NOT NULL DEFAULT 0,
  `nascimento` date DEFAULT NULL,
  `data_alistamento` datetime NOT NULL,
  `ultima_promocao` datetime NOT NULL,
  `promovido_por` varchar(250) NOT NULL,
  `patente_id` tinyint(2) NOT NULL DEFAULT 13,
  `status_id` tinyint(2) NOT NULL DEFAULT 1,
  `faixa` tinyint(2) NOT NULL DEFAULT 1,
  `confianca` tinyint(3) NOT NULL DEFAULT 40,
  `advs` tinyint(1) NOT NULL DEFAULT 0,
  `vip` tinyint(1) NOT NULL DEFAULT 0,
  `vip_vencimento` datetime NOT NULL,
  `moedas` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `registros`
--

INSERT INTO `registros` (`id`, `nickname`, `nome`, `email`, `avatar`, `avatar_forum`, `descricao_forum`, `sexo`, `nascimento`, `data_alistamento`, `ultima_promocao`, `promovido_por`, `patente_id`, `status_id`, `faixa`, `confianca`, `advs`, `vip`, `vip_vencimento`, `moedas`) VALUES
(2, 'majoryanzinho', '', 'majoryanzinho@majoryanzinho.site', 'https://i.imgur.com/38HBHH9.png', 'http://projetou.pc/sihb/assets/media/pic_forum/foto_5edd56f527a57.jpg', '<p>abc</p>', 0, '2020-05-11', '2020-05-11 00:00:00', '2020-05-11 14:03:15', 'majoryanzinho', 2, 1, 6, 100, 0, 1, '2030-12-31 23:59:59', 20032);

-- --------------------------------------------------------

--
-- Estrutura para tabela `relatorios`
--

CREATE TABLE `relatorios` (
  `id` int(11) UNSIGNED NOT NULL,
  `tipo` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `data` datetime NOT NULL,
  `id_registro` int(11) NOT NULL,
  `id_criador` int(11) NOT NULL,
  `responsavel_id` int(11) NOT NULL,
  `relatorio` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `status`
--

CREATE TABLE `status` (
  `id` int(10) UNSIGNED NOT NULL,
  `ordem` tinyint(2) NOT NULL,
  `nome` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `status`
--

INSERT INTO `status` (`id`, `ordem`, `nome`) VALUES
(1, 1, 'Ativo'),
(2, 2, 'Demitido'),
(3, 3, 'Aposentado'),
(4, 4, 'Conselheiro');

-- --------------------------------------------------------

--
-- Estrutura para tabela `textos`
--

CREATE TABLE `textos` (
  `id` int(11) UNSIGNED NOT NULL,
  `local` varchar(250) NOT NULL,
  `titulo` varchar(250) NOT NULL,
  `tipo` tinyint(1) NOT NULL DEFAULT 0,
  `texto` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `textos`
--

INSERT INTO `textos` (`id`, `local`, `titulo`, `tipo`, `texto`) VALUES
(1, 'sobre/historia', '', 0, '<p>bbbbbbbbbbbbbbbbbbbbbb</p>'),
(2, 'sobre/posicionamento', '', 0, ''),
(3, 'sobre/hierarquia', '', 0, ''),
(4, 'sobre/estatuto', '', 0, ''),
(5, 'sobre/atos-normativos', '', 0, ''),
(6, 'servicos-externos/operacoes', '', 0, ''),
(7, 'servicos-externos/atendimento-de-ocorrencias', '', 0, ''),
(8, 'servicos-extermps/conquistas', '', 0, ''),
(9, 'departamentos/educacao-e-civismo', '', 0, ''),
(10, 'departamentos/juridico', '', 0, ''),
(11, 'departamentos/comunicacao', '', 0, ''),
(12, 'departamentos/logistica-e-rh', '', 0, ''),
(13, 'apostilas/treinamento-de-estagiarios', '', 0, ''),
(14, 'apostilas/treinamento-de-agentes', '', 0, ''),
(15, 'apostilas/treinamento-de-agentes-especiais', '', 0, ''),
(16, 'apostilas/treinamento-de-agentes-seniores', '', 0, ''),
(17, 'apostilas/pele-e-cabelo', '', 0, ''),
(18, 'apostilas/areas-da-sede', '', 0, ''),
(19, 'apostilas/discord', '', 0, ''),
(20, 'apostilas/hb-etiqueta', '', 0, ''),
(21, 'apostilas/blacklist', '', 0, ''),
(22, 'financeiro/cargos-pagos', '', 0, ''),
(23, 'grupos/ajudantes', '', 0, ''),
(24, 'ouvidoria', '', 0, ''),
(25, 'extras/vip', '', 0, ''),
(26, 'apostilas/como-ser-promovido', '', 0, ''),
(27, 'apostilas/como-ser-um-bom-funcionario', '', 0, ''),
(28, 'apostilas/uniformes', '', 0, ''),
(29, 'financeiro/salarios', '', 0, ''),
(30, 'financeiro/sistema-de-indicacao', '', 0, ''),
(31, 'grupos/professores', '', 0, ''),
(32, 'grupos/divulgadores', '', 0, ''),
(33, 'a-pessoa-cria-a-noticia-etc-ai-se-tenta-sair-da-pagina-da-um-erro', 'A pessoa cria a noticia etc ai se tenta sair da pÃ¡gina dÃ¡ um erro', 1, '<p>asdasasd</p>'),
(34, 'cursos-regras', 'a', 0, '');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `acesso`
--
ALTER TABLE `acesso`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `adv`
--
ALTER TABLE `adv`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `bugs`
--
ALTER TABLE `bugs`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `cartao`
--
ALTER TABLE `cartao`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `confianca_voto`
--
ALTER TABLE `confianca_voto`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Índices de tabela `cursos_alunos`
--
ALTER TABLE `cursos_alunos`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Índices de tabela `cursos_area`
--
ALTER TABLE `cursos_area`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `cursos_aulas`
--
ALTER TABLE `cursos_aulas`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Índices de tabela `cursos_historico`
--
ALTER TABLE `cursos_historico`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Índices de tabela `cursos_modulos`
--
ALTER TABLE `cursos_modulos`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Índices de tabela `cursos_videos`
--
ALTER TABLE `cursos_videos`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Índices de tabela `destaques`
--
ALTER TABLE `destaques`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `emblemas`
--
ALTER TABLE `emblemas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `externos`
--
ALTER TABLE `externos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `faixas`
--
ALTER TABLE `faixas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `forum`
--
ALTER TABLE `forum`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `forum_comentarios`
--
ALTER TABLE `forum_comentarios`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `honrarias`
--
ALTER TABLE `honrarias`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `info`
--
ALTER TABLE `info`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `loja_codigos`
--
ALTER TABLE `loja_codigos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `loja_cods_confirm`
--
ALTER TABLE `loja_cods_confirm`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `loja_compras`
--
ALTER TABLE `loja_compras`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `loja_prods`
--
ALTER TABLE `loja_prods`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `melhores_amigos`
--
ALTER TABLE `melhores_amigos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `noticias_avaliacoes`
--
ALTER TABLE `noticias_avaliacoes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `noticias_avaliacoes_comentarios`
--
ALTER TABLE `noticias_avaliacoes_comentarios`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `noticias_categorias`
--
ALTER TABLE `noticias_categorias`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `noticias_comentarios`
--
ALTER TABLE `noticias_comentarios`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `noticias_views`
--
ALTER TABLE `noticias_views`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `notificacoes`
--
ALTER TABLE `notificacoes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `patentes`
--
ALTER TABLE `patentes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `perfil_favoritos`
--
ALTER TABLE `perfil_favoritos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `perfil_mensagens`
--
ALTER TABLE `perfil_mensagens`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `ranking_semanal`
--
ALTER TABLE `ranking_semanal`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `registros`
--
ALTER TABLE `registros`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `relatorios`
--
ALTER TABLE `relatorios`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `textos`
--
ALTER TABLE `textos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `acesso`
--
ALTER TABLE `acesso`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `adv`
--
ALTER TABLE `adv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `bugs`
--
ALTER TABLE `bugs`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `cartao`
--
ALTER TABLE `cartao`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de tabela `confianca_voto`
--
ALTER TABLE `confianca_voto`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `cursos_alunos`
--
ALTER TABLE `cursos_alunos`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `cursos_area`
--
ALTER TABLE `cursos_area`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `cursos_aulas`
--
ALTER TABLE `cursos_aulas`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `cursos_historico`
--
ALTER TABLE `cursos_historico`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `cursos_modulos`
--
ALTER TABLE `cursos_modulos`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `cursos_videos`
--
ALTER TABLE `cursos_videos`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `destaques`
--
ALTER TABLE `destaques`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `emblemas`
--
ALTER TABLE `emblemas`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `externos`
--
ALTER TABLE `externos`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `faixas`
--
ALTER TABLE `faixas`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `forum`
--
ALTER TABLE `forum`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `forum_comentarios`
--
ALTER TABLE `forum_comentarios`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `honrarias`
--
ALTER TABLE `honrarias`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `info`
--
ALTER TABLE `info`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de tabela `loja_codigos`
--
ALTER TABLE `loja_codigos`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `loja_cods_confirm`
--
ALTER TABLE `loja_cods_confirm`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `loja_compras`
--
ALTER TABLE `loja_compras`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT de tabela `loja_prods`
--
ALTER TABLE `loja_prods`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=225;

--
-- AUTO_INCREMENT de tabela `melhores_amigos`
--
ALTER TABLE `melhores_amigos`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `noticias`
--
ALTER TABLE `noticias`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de tabela `noticias_avaliacoes`
--
ALTER TABLE `noticias_avaliacoes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `noticias_avaliacoes_comentarios`
--
ALTER TABLE `noticias_avaliacoes_comentarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `noticias_categorias`
--
ALTER TABLE `noticias_categorias`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `noticias_comentarios`
--
ALTER TABLE `noticias_comentarios`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `noticias_views`
--
ALTER TABLE `noticias_views`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `notificacoes`
--
ALTER TABLE `notificacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `patentes`
--
ALTER TABLE `patentes`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `perfil_favoritos`
--
ALTER TABLE `perfil_favoritos`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `perfil_mensagens`
--
ALTER TABLE `perfil_mensagens`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `ranking_semanal`
--
ALTER TABLE `ranking_semanal`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de tabela `registros`
--
ALTER TABLE `registros`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `relatorios`
--
ALTER TABLE `relatorios`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `status`
--
ALTER TABLE `status`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `textos`
--
ALTER TABLE `textos`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
