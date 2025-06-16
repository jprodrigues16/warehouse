<?php
class Woo_Armazem_Shipping_Mapper {
    private $option_name = 'woo_armazem_shipping_map';

    public function __construct() {
        add_action('admin_menu', [$this, 'add_admin_menu']);
        add_action('admin_init', [$this, 'register_settings']);
        add_action('woocommerce_init', [$this, 'schedule_cron']);
        add_action('woo_armazem_cron_event', [$this, 'apply_shipping_classes']);
    }

    public function add_admin_menu() {
        add_submenu_page('woocommerce', 'Armazém x Envio', 'Armazém x Envio', 'manage_woocommerce', 'woo-armazem-envio', [$this, 'admin_page']);
    }

    public function register_settings() {
        register_setting('woo_armazem_group', $this->option_name);
    }

    public function admin_page() {
        $shipping_classes = WC()->shipping()->get_shipping_classes();
        $armazens = $this->get_distinct_armazens();
        $map = get_option($this->option_name, []);

        echo '<div class="wrap"><h1>Mapeamento Armazém para Classe de Envio</h1>';
        echo '<form method="post" action="options.php">';
        settings_fields('woo_armazem_group');
        echo '<table class="form-table">';

        foreach ($armazens as $armazem) {
            echo '<tr><th scope="row">' . esc_html($armazem) . '</th><td><select name="' . $this->option_name . '[' . esc_attr($armazem) . ']">';
            echo '<option value="">- Padrão -</option>';
            foreach ($shipping_classes as $class) {
                $selected = (isset($map[$armazem]) && $map[$armazem] == $class->term_id) ? 'selected' : '';
                echo '<option value="' . esc_attr($class->term_id) . '" ' . $selected . '>' . esc_html($class->name) . '</option>';
            }
            echo '</select></td></tr>';
        }

        echo '</table><p><input type="submit" class="button-primary" value="Guardar Mapeamento"></p>';
        echo '</form>';
        echo '<form method="post"><input type="submit" name="run_now" class="button" value="Executar Agora"></form>';
        echo '</div>';

        if (isset($_POST['run_now'])) {
            $this->apply_shipping_classes();
            echo '<div class="notice notice-success"><p>Associações aplicadas com sucesso!</p></div>';
        }
    }

    private function get_distinct_armazens() {
        global $wpdb;
        $results = $wpdb->get_col(\"SELECT DISTINCT meta_value FROM {$wpdb->postmeta} WHERE meta_key = 'meta_armazem_nome'\");
        return array_filter($results);
    }

    public function apply_shipping_classes() {
        $map = get_option($this->option_name, []);
        $args = [
            'post_type' => 'product',
            'posts_per_page' => -1,
            'meta_query' => [
                [
                    'key' => 'meta_armazem_nome',
                    'compare' => 'EXISTS'
                ]
            ]
        ];
        $products = get_posts($args);

        foreach ($products as $product_post) {
            $product = wc_get_product($product_post->ID);
            $armazem = get_post_meta($product->get_id(), 'meta_armazem_nome', true);
            if (isset($map[$armazem])) {
                wp_set_object_terms($product->get_id(), (int)$map[$armazem], 'product_shipping_class');
            }
        }
    }

    public function schedule_cron() {
        if (!wp_next_scheduled('woo_armazem_cron_event')) {
            wp_schedule_event(time(), 'daily', 'woo_armazem_cron_event');
        }
    }
}

new Woo_Armazem_Shipping_Mapper();
