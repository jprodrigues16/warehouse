<?php
/*
Plugin Name: Woo Armazém para Classe de Envio
Description: Associa meta_armazem_nome de produtos a classes de envio do WooCommerce e adiciona campos personalizados a produtos e encomendas.
Version: 1.1
Author: João Rodrigues
*/

if (!defined('ABSPATH')) exit;

require_once plugin_dir_path(__FILE__) . 'includes/class-shipping-mapper.php';
require_once plugin_dir_path(__FILE__) . 'includes/class-produto-campos.php';
require_once plugin_dir_path(__FILE__) . 'includes/class-encomenda-campos.php';
