<?php
// Adicionar campos ao checkout
add_filter('woocommerce_checkout_fields', function($fields) {
    $extra_fields = [
        'meta_id_erp' => __('ID ERP', 'woocommerce'),
        'meta_encomenda_id_erp' => __('ID ERP da Encomenda', 'woocommerce'),
        'meta_id_doc' => __('ID Documento', 'woocommerce'),
        'meta_encomenda_id_doc' => __('ID Documento da Encomenda', 'woocommerce')
    ];
    foreach ($extra_fields as $key => $label) {
        $fields['billing'][$key] = [
            'label' => $label,
            'type' => 'text',
            'required' => false
        ];
    }
    return $fields;
});

add_action('woocommerce_checkout_update_order_meta', function($order_id) {
    foreach (['meta_id_erp', 'meta_encomenda_id_erp', 'meta_id_doc', 'meta_encomenda_id_doc'] as $field) {
        if (!empty($_POST[$field])) {
            update_post_meta($order_id, $field, sanitize_text_field($_POST[$field]));
        }
    }
});
