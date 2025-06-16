<?php
// Adicionar campos personalizados a produtos
add_action('woocommerce_product_options_general_product_data', function() {
    woocommerce_wp_text_input([
        'id' => 'meta_empresa_nome',
        'label' => __('Nome da Empresa', 'woocommerce'),
        'desc_tip' => true,
        'description' => __('Nome da empresa relacionada ao produto.', 'woocommerce')
    ]);
    woocommerce_wp_text_input([
        'id' => 'meta_empresa_id',
        'label' => __('ID da Empresa', 'woocommerce'),
        'desc_tip' => true,
        'description' => __('ID da empresa relacionada ao produto.', 'woocommerce')
    ]);
    woocommerce_wp_text_input([
        'id' => 'meta_armazem_nome',
        'label' => __('Nome do Armazém', 'woocommerce'),
        'desc_tip' => true,
        'description' => __('Nome do armazém relacionado ao produto.', 'woocommerce')
    ]);
    woocommerce_wp_text_input([
        'id' => 'meta_armazem_id',
        'label' => __('ID do Armazém', 'woocommerce'),
        'desc_tip' => true,
        'description' => __('ID do armazém relacionado ao produto.', 'woocommerce')
    ]);
});

add_action('woocommerce_process_product_meta', function($post_id) {
    foreach (['meta_empresa_nome', 'meta_empresa_id', 'meta_armazem_nome', 'meta_armazem_id'] as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
        }
    }
});
