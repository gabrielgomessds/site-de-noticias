<?php
ob_start();

require __DIR__ . "/vendor/autoload.php";
/**
 * HOME
 */

use CoffeeCode\Router\Router;
use Source\Core\Session;

$session = new Session();
$route = new Router(url(), "@");

/* =============== WEB ===================== */

/* HOME 01 */
$route->namespace("Source\Controllers\Web");
$route->group(null);
$route->get("/", "Web@home");

/* MESSAGE */
$route->get("/mensagem/{msg}", "Web@message");

/* HOME 02 */
$route->group("/home");
$route->get("/", "Web@home");

/* NEWS */
$route->group('/noticia');
$route->get("/{uri}", "Web@news");

/* LAST NEWS */
$route->group('/ultimas_noticias');
$route->get("/", "Web@lastNews");
$route->post("/", "Web@lastNews");

$route->get("/{searchNotFound}", "Web@lastNews");
$route->post("/{searchNotFound}", "Web@lastNews");
$route->get("/{search}/{page}", "Web@lastNews");

/* CATEGORIES */
$route->group('/categorias');
$route->get("/", "Web@categories");

/* CATEGORY NEWS */
$route->group('/categoria');
$route->get("/{nameCategory}", "Web@categoryNews");
$route->post("/{nameCategory}", "Web@categoryNews");

$route->get("/{nameCategory}/{searchNotFound}", "Web@categoryNews");
$route->post("/{nameCategory}/{searchNotFound}", "Web@categoryNews");
$route->get("/{nameCategory}/{search}/{page}", "Web@categoryNews");

/* CONTACT */
$route->group('/contato');
$route->get("/", "Web@contact");
$route->post("/enviar", "Web@contact");

/* INSCRIPTIONS */
$route->group('/inscricao');
$route->post("/inscrever_se", "Web@inscriptions");

/* ABOUT */
$route->group('/sobre');
$route->get("/", "Web@about");



/* ============ ADMIN ======================= */
$route->namespace("Source\Controllers\Admin");
$route->group("/admin");

/* Admins */
$route->get("/login","Login@home");
$route->post("/login","Login@home");

$route->get("/dash","Dash@home");
$route->get("/", "Login:root");
$route->get("/","Dash@home");

$route->post("/admins","Admin@list");
$route->get("/admins","Admin@list");

$route->get("/admins/{search}/{page}", "Admin@list");
$route->get("/adicionar-admin","Admin@actions");
$route->post("/adicionar-admin","Admin@actions");
$route->get("/atualizar-admin/{idAdmin}","Admin@actions");
$route->post("/atualizar-admin/{idAdmin}","Admin@actions");
$route->post("/deletar-admin","Admin@actions");
$route->get("/configuracoes","Admin@settings");

$route->get("/sair", "Dash@logoff");

/* News */
$route->get("/noticias","News@list");
$route->post("/noticias","News@list");
$route->get("/noticias/{search}/{page}", "News@list");
$route->get("/adicionar-noticia","News@actions");
$route->post("/adicionar-noticia","News@actions");

$route->get("/atualizar-noticia/{idNews}","News@actions");
$route->post("/atualizar-noticia/{idNews}","News@actions");

$route->post("/deletar-noticia","News@actions");

$route->get("/revisar-noticia/{idNews}","News@review");
$route->get('/publicar-noticia/{idNews}',"News@publicNews");
$route->get('/privar-noticia/{idNews}',"News@privateNews");
$route->get("/info-noticia/{idNews}","News@info");

/* Categories */
$route->get("/categorias","Categories@list");
$route->post("/categorias","Categories@list");

$route->get("/categorias/{search}/{page}", "Categories@list");
$route->get("/adicionar-categoria","Categories@actions");
$route->post("/adicionar-categoria","Categories@actions");
$route->get("/atualizar-categoria/{idCategorie}","Categories@actions");
$route->post("/atualizar-categoria/{idCategorie}","Categories@actions");
$route->post("/deletar-categoria","Categories@actions");

/* Inscriptions */
$route->get("/inscricoes","Inscriptions@list");
$route->post("/inscricoes","Inscriptions@list");
$route->get("/inscricoes/{search}/{page}", "Inscriptions@list");

$route->get("/ativar-inscricao/{idInsc}","Inscriptions@activeInscription");
$route->get("/desativar-inscricao/{idInsc}","Inscriptions@disableInscription");
$route->post("/deletar-inscricao","Inscriptions@actions");

/* ADS */
$route->get("/propagandas","Ads@list");
$route->post("/propagandas","Ads@list");

$route->get("/propagandas/{search}/{page}", "Ads@list");
$route->get("/adicionar-propaganda","Ads@actions");
$route->post("/adicionar-propaganda","Ads@actions");

$route->get("/atualizar-propaganda/{idAds}","Ads@actions");
$route->post("/atualizar-propaganda/{idAds}","Ads@actions");
$route->post("/deletar-propaganda","Ads@actions");

$route->get('/publicar-propaganda/{idAds}',"Ads@publicAds");
$route->get('/privar-propaganda/{idAds}',"Ads@privateAds");

/* CONTACT */
$route->get("/contatos","Contact@list");
$route->post("/contatos","Contact@list");
$route->get("/contatos/{search}/{page}", "Contact@list");

$route->get("/contactAllData/{idContact}", "Contact@templateDataView");

$route->post("/status-contato", "Contact@SettingContact");
$route->post("/deletar-contato", "Contact@SettingContact");

/* CONF */
$route->get("/contatos","Contact@list");



/* ============= ERROR ======================= */

/**
 * ERROR ROUTES
 */
$route->namespace("Source\Controllers\Error");
$route->group("/ops");
$route->get("/{errcode}", "Error@errors");
/**
 * ROUTE
 */
$route->dispatch();

/**
 * ERROR REDIRECT
 */
if ($route->error()) {
    $route->redirect("/ops/{$route->error()}");
}

ob_end_flush();
