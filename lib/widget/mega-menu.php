<?php

namespace Elementor;

class CustomMegaMenu extends Widget_Base
{
    protected $nav_menu_index = 1;

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);


    }


    protected function get_nav_menu_index()
    {
        return $this->nav_menu_index++;
    }


    private function get_available_menus()
    {
        $menus = wp_get_nav_menus();

        $options = [];

        foreach ($menus as $menu) {
            $options[$menu->slug] = $menu->name;
        }

        return $options;
    }

    public function get_style_depends()
    {
        return ['ber-css-mego-menu', ];
    }

    public function get_script_depends()
    {
        return ['jquery', 'swiper', 'ber-js-mego-menu'];
    }

    function append_mega_menu($item_output, $item)
    {

        if (get_field('radiators_mega_menu', $item) && strpos($item_output, 'o-header__megamenu-holder') === false) {
            $mega_menu = '<div class="o-header__megamenu-holder" style="display:none;">';
            $mega_menu .= $this->radiators_mega_menu();
            $mega_menu .= '</div>';
            return $item_output . $mega_menu;
        }
        if (get_field('electric_towel_rails', $item) && strpos($item_output, 'o-header__megamenu-holder') === false) {
            $mega_menu = '<div class="o-header__megamenu-holder">';
            $mega_menu .= $this->towels_mega_menu();
            $mega_menu .= '</div>';
            return $item_output . $mega_menu;
        }
        return $item_output;
    }

    function towels_mega_menu()
    {

    }

    function my_wp_nav_menu_objects($items, $args)
    {
        // loop
        foreach ($items as &$item) {
            // vars
            $radiators_menu_item = get_field('radiators_mega_menu', $item);
            $towels_menu_item = get_field('electric_towel_rails', $item);

            // append icon
            if ($radiators_menu_item && array_search('JS--radiators-mega-menu JS--mega-menu-item c-mega-menu-item', $item->classes) === false) {
                //add class
                array_push($item->classes, 'JS--radiators-mega-menu JS--mega-menu-item c-mega-menu-item');
            }

            if ($towels_menu_item && array_search('JS--towels-mega-menu JS--mega-menu-item c-mega-menu-item', $item->classes) === false) {
                //add class
                array_push($item->classes, 'JS--towels-mega-menu JS--mega-menu-item c-mega-menu-item');
            }
        }
        // return
        return $items;
    }


    public function get_name()
    {
        return "custom-mega-menu";
    }

    public function get_title()
    {
        return "MegaMenu";
    }

    public function get_icon()
    {
        return 'eicon-nav-menu';
    }

    public function get_keywords()
    {
        return ['menu', 'nav', 'button'];
    }

    public function get_categories()
    {
        return ['hello-elementor-theme'];
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            'capital_section',
            [
                'label' => __('Layout', 'bestelectric'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $menus = $this->get_available_menus();

        if (!empty($menus)) {
            $this->add_control(
                'menu',
                [
                    'label' => esc_html__('Menu', 'bestelectric'),
                    'type' => Controls_Manager::SELECT,
                    'options' => $menus,
                    'default' => array_keys($menus)[0],
                    'save_default' => true,
                    'separator' => 'after',
                    'description' => sprintf(
                        esc_html__('Go to the %1$sMenus screen%2$s to manage your menus.', 'bestelectric'),
                        sprintf('<a href="%s" target="_blank">', admin_url('nav-menus.php')),
                        '</a>'
                    ),
                ]
            );
        } else {
            $this->add_control(
                'menu',
                [
                    'type' => Controls_Manager::RAW_HTML,
                    'raw' => '<strong>' . esc_html__('There are no menus in your site.', 'bestelectric') . '</strong><br>' .
                        sprintf(
                        /* translators: 1: Link open tag, 2: Link closing tag. */
                            esc_html__('Go to the %1$sMenus screen%2$s to create one.', 'bestelectric'),
                            sprintf('<a href="%s" target="_blank">', admin_url('nav-menus.php?action=edit&menu=0')),
                            '</a>'
                        ),
                    'separator' => 'after',
                    'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
                ]
            );
        }


        $this->end_controls_section();
        $this->start_controls_section(
            'radiators_section',
            [
                'label' => __('Radiators Mega Menu ', 'bestelectric'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'radiators-top-link-title',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label' => esc_html__('Top Link', 'bestelectric'),
                'default' => 'All Electric Radiators'
            ]
        );
        $this->add_control(
            'radiators-top-link',
            [
                'label' => esc_html__('Top Link', 'bestelectric'),
                'type' => \Elementor\Controls_Manager::URL,
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                    'custom_attributes' => '',
                ],
                'dynamic' => [
                    'active' => true,
                ],
                'label_block' => true,
            ]
        );


        $this->add_control(
            'radiators-bottom-link-title',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label' => esc_html__('Bottom Link', 'bestelectric'),
                'default' => 'Accessories'
            ]
        );
        $this->add_control(
            'radiators-bottom-link',
            [
                'label' => esc_html__('Bottom Link', 'bestelectric'),
                'type' => \Elementor\Controls_Manager::URL,
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                    'custom_attributes' => '',
                ],
                'dynamic' => [
                    'active' => true,
                ],
                'label_block' => true,
            ]
        );


        if (!empty($menus)) {
            $this->add_control(
                'bestelectric-rad-type-title',
                [
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'label' => esc_html__('Title Menu', 'bestelectric'),
                    'default' => 'Type'
                ]
            );
            $this->add_control(
                'bestelectric-rad-type-icon',
                [
                    'label' => esc_html__('Icon', 'bestelectric'),
                    'type' => \Elementor\Controls_Manager::ICONS,

                ]
            );

            $this->add_control(
                'bestelectric-rad-type',
                [
                    'label' => esc_html__('Radiators Type ', 'bestelectric'),
                    'type' => Controls_Manager::SELECT,
                    'options' => $menus,
                    'default' => array_keys($menus)[0],
                    'save_default' => true,
                    'separator' => 'after',

                ]
            );
        }

        if (!empty($menus)) {
            $this->add_control(
                'bestelectric-rad-room-title',
                [
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'label' => esc_html__('Title Menu', 'bestelectric'),
                    'default' => 'Room'
                ]
            );
            $this->add_control(
                'bestelectric-rad-room-icon',
                [
                    'label' => esc_html__('Icon', 'bestelectric'),
                    'type' => \Elementor\Controls_Manager::ICONS,

                ]
            );
            $this->add_control(

                'bestelectric-rad-room',
                [
                    'label' => esc_html__('Radiators Room', 'bestelectric'),
                    'type' => Controls_Manager::SELECT,
                    'options' => $menus,
                    'default' => array_keys($menus)[0],
                    'save_default' => true,
                    'separator' => 'after',

                ]
            );
        }
        if (!empty($menus)) {
            $this->add_control(
                'bestelectric-rad-wattage-title',
                [
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'label' => esc_html__('Title Menu', 'bestelectric'),
                    'default' => 'Wattage'
                ]
            );
            $this->add_control(
                'bestelectric-rad-wattage-icon',
                [
                    'label' => esc_html__('Icon', 'bestelectric'),
                    'type' => \Elementor\Controls_Manager::ICONS,

                ]
            );
            $this->add_control(
                'bestelectric-rad-wattage',
                [
                    'label' => esc_html__('Radiators Wattage', 'bestelectric'),
                    'type' => Controls_Manager::SELECT,
                    'options' => $menus,
                    'default' => array_keys($menus)[0],
                    'save_default' => true,
                    'separator' => 'after',

                ]
            );
        }
        if (!empty($menus)) {
            $this->add_control(
                'bestelectric-rad-color-title',
                [
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'label' => esc_html__('Title Menu', 'bestelectric'),
                    'default' => 'Color'
                ]
            );
            $this->add_control(
                'bestelectric-rad-color-icon',
                [
                    'label' => esc_html__('Icon', 'bestelectric'),
                    'type' => \Elementor\Controls_Manager::ICONS,

                ]
            );
            $this->add_control(
                'bestelectric-rad-color',
                [
                    'label' => esc_html__('Radiators Color', 'bestelectric'),
                    'type' => Controls_Manager::SELECT,
                    'options' => $menus,
                    'default' => array_keys($menus)[0],
                    'save_default' => true,
                    'separator' => 'after',

                ]
            );
        }
        if (!empty($menus)) {
            $this->add_control(
                'bestelectric-right-menu-title',
                [
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'label' => esc_html__('Title Menu', 'bestelectric'),
                    'default' => 'Help & Advice'
                ]
            );

            $this->add_control(
                'bestelectric-right-menu',
                [
                    'label' => esc_html__('Right Menu', 'bestelectric'),
                    'type' => Controls_Manager::SELECT,
                    'options' => $menus,
                    'default' => array_keys($menus)[0],
                    'save_default' => true,
                    'separator' => 'after',

                ]
            );
        }

        $this->end_controls_section();


    }

    function help_advice_menu()
    {
        $settings = $this->get_settings_for_display();
        if ($settings['bestelectric-right-menu']) {
            ?>

            <div class="c-mega-sub-menu">
                <?php if ($settings['bestelectric-right-menu-title']) : ?>
                    <div class="c-mega-sub-menu__header c-mega-sub-menu__header--help">
                    <span class="c-mega-sub-menu__title c-mega-sub-menu__title--help">
                           <?php echo $settings['bestelectric-right-menu-title'] ?: __('Help & Advice', 'bestelectric'); ?>
                    </span>
                    </div>
                <?php endif; ?>
                <div class="c-mega-sub-menu__body">
                    <?php wp_nav_menu(array(
                        'menu' => $settings['bestelectric-right-menu'],
                        'menu_class' => 'c-mega-sub-menu__list',
                        'container' => 'nav'
                    )); ?>
                </div>
            </div>
            <?php
        }
    }

    function radiators_mega_menu()
    {
        ob_start();
        $settings = $this->get_settings_for_display();
        $products = get_field('rad_range_menu', 'option');
        $index = 1;
        ?>
        <div class="o-header__ranges-slider">
            <?php if ($products): ?>
                <div class="c-range-menu">
                    <div class="c-range-menu-over JS--menu-ranges-slider swiper-custom">
                        <div class="c-range-menu__list swiper-wrapper">
                            <?php foreach ($products as $post): // variable must be called $post (IMPORTANT) ?>
                                <?php
                                $price = get_post_meta($post->ID, '_price', true);
                                $label = get_field('label', $post->ID);
                                $label_color = get_field('product_label_color', $post->ID);
                                ?>
                                <div class="c-range-menu__item carousel__slide swiper-slide"
                                     id="<?php echo "carousel__slide" . $index++ ?>">

                                    <a href="<?php echo get_permalink($post->ID); ?>" class="c-range-menu__product">
                                        <div class="c-range-menu__product-image">
                                            <?php echo wp_get_attachment_image(get_post_thumbnail_id($post->ID)); ?>
                                        </div>
                                        <div class="c-range-menu__product-details">
                                            <?php if ($label) : ?>
                                                <span class="c-range-menu__product-label <?php echo ($label_color == 'blue') ? 'c-range-menu__product-label--blue' : null; ?>"><?php echo $label; ?></span>
                                            <?php else : ?>
                                                <span class="c-range-menu__label-empty"></span>
                                            <?php endif; ?>
                                            <span class="c-range-menu__product-title"><?php echo str_replace('Wifi', '<sup>wifi</sup>', get_the_title($post->ID)); ?></span>
                                            <div class="c-range-menu__product-price">
                                                from <?php echo wc_price($price, $post->ID); ?></div>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
                <?php wp_reset_query(); ?>
            <?php endif; ?>
        </div>
        <div class="c-megamenu-radiators">
            <div class="c-megamenu-radiators__container">
                <div class="c-megamenu-radiators__grid">

                    <div class="c-megamenu-radiators__column c-megamenu-radiators__column--wide">
                        <?php if (isset($settings['radiators-top-link']) && isset($settings['radiators-top-link']['url'])) { ?>
                            <a href="<?php echo $settings['radiators-top-link']['url'] ?>"
                               class="c-megamenu-radiators__link">
                                <?php echo $settings['radiators-top-link-title'] ?>
                            </a>
                        <?php }; ?>
                        <div class="c-sub-menus__grid">
                            <?php if ($settings['bestelectric-rad-type']) { ?>
                                <div class="c-sub-menus__column">
                                    <div class="c-mega-sub-menu">
                                        <div class="c-mega-sub-menu__header">
                                            <div class="c-mega-sub-menu__icon c-mega-sub-menu__icon--type">
                                                <?php if ($settings['bestelectric-rad-type-icon']) {
                                                    \Elementor\Icons_Manager::render_icon($settings['bestelectric-rad-type-icon'], ['aria-hidden' => 'true']);
                                                } ?>
                                                <?php ?>
                                            </div>
                                            <span class="c-mega-sub-menu__title">
                                            <?php echo $settings['bestelectric-rad-type-title'] ?: __('Type', 'bestelectric'); ?>
                                         </span>
                                        </div>
                                        <div class="c-mega-sub-menu__body">
                                            <?php wp_nav_menu(array(
                                                'menu' => $settings['bestelectric-rad-type'],
                                                'menu_class' => 'c-mega-sub-menu__list',
                                                'container' => 'nav'
                                            )); ?>
                                        </div>
                                    </div>
                                </div>
                            <?php }; ?>
                            <?php if ($settings['bestelectric-rad-type']) { ?>
                                <div class="c-sub-menus__column">
                                    <div class="c-mega-sub-menu">
                                        <div class="c-mega-sub-menu__header">
                                            <div class="c-mega-sub-menu__icon c-mega-sub-menu__icon--room">
                                                <?php if ($settings['bestelectric-rad-room-icon']) {
                                                    \Elementor\Icons_Manager::render_icon($settings['bestelectric-rad-room-icon'], ['aria-hidden' => 'true']);
                                                } ?>
                                            </div>
                                            <span class="c-mega-sub-menu__title">
                                                <?php echo $settings['bestelectric-rad-room-title'] ?: __('Room', 'bestelectric'); ?>
                                                </span>
                                        </div>
                                        <div class="c-mega-sub-menu__body">
                                            <?php wp_nav_menu(array(
                                                'menu' => $settings['bestelectric-rad-room'],
                                                'menu_class' => 'c-mega-sub-menu__list',
                                                'container' => 'nav'
                                            )); ?>
                                        </div>

                                    </div>
                                </div>
                            <?php }; ?>
                            <div class="c-sub-menus__column">
                                <div class="c-mega-sub-menu">
                                    <div class="c-mega-sub-menu__header">
                                        <div class="c-mega-sub-menu__icon">
                                            <?php if ($settings['bestelectric-rad-wattage-icon']) {
                                                \Elementor\Icons_Manager::render_icon($settings['bestelectric-rad-wattage-icon'], ['aria-hidden' => 'true']);
                                            } ?>

                                        </div>
                                        <span class="c-mega-sub-menu__title">
                                              <?php echo $settings['bestelectric-rad-wattage-title'] ?: __('Room', 'bestelectric'); ?>
                                        </span>
                                    </div>
                                    <div class="c-mega-sub-menu__body">
                                        <?php wp_nav_menu(array(
                                            'menu' => $settings['bestelectric-rad-wattage'],
                                            'menu_class' => 'c-mega-sub-menu__list c-mega-sub-menu__list--wrap',
                                            'container' => 'nav'
                                        )); ?>
                                    </div>

                                </div>
                                <div class="c-mega-sub-menu">
                                    <div class="c-mega-sub-menu__header">
                                        <div class="c-mega-sub-menu__icon">
                                            <?php if ($settings['bestelectric-rad-color-icon']) {
                                                \Elementor\Icons_Manager::render_icon($settings['bestelectric-rad-color-icon'], ['aria-hidden' => 'true']);
                                            } ?>
                                        </div>
                                        <span class="c-mega-sub-menu__title">
                                            <?php echo $settings['bestelectric-rad-color-title'] ?: __('Room', 'bestelectric'); ?>
                                        </span>
                                    </div>
                                    <div class="c-mega-sub-menu__body">
                                        <?php wp_nav_menu(array(
                                            'menu' => $settings['bestelectric-rad-color'],
                                            'menu_class' => 'c-mega-sub-menu__list',
                                            'container' => 'nav'
                                        )); ?>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <?php if (isset($settings['radiators-bottom-link']) && isset($settings['radiators-bottom-link']['url'])) { ?>
                            <div class="c-sub-menus__below">
                                <a class="c-megamenu-radiators__link"
                                   href="<?php echo $settings['radiators-bottom-link']['url'] ?>">
                                    <?php echo $settings['radiators-bottom-link-title'] ?>
                                </a>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="c-megamenu-radiators__column c-megamenu-radiators__column--gray">
                        <?php $this->help_advice_menu(); ?>
                    </div>

                </div>
            </div>
        </div>

        <?php
        return ob_get_clean();
    }


    protected function render()
    {

        $settings = $this->get_settings_for_display();
        add_filter('wp_nav_menu_objects', [$this, 'my_wp_nav_menu_objects'], 10, 2);
        add_filter('walker_nav_menu_start_el', [$this, 'append_mega_menu'], 15, 2);

        ?>
        <style>
            .elementor-element-<?php echo $this->get_id()?>, .elementor-element-<?php echo $this->get_id()?> .elementor-widget-wrap {
                position: static;
            }
        </style>

        <div class="o-header__nav" >
            <div class="o-header__col-menu">
                <div class="c-header-nav">
                    <?php wp_nav_menu(array(
                        'menu' => $settings['menu'],
                        'container_class' => 'c-header-nav__primary',
                        'container' => 'nav'
                    )); ?>
                </div>
            </div>
        </div>

        <?php
    }

}

global $widgets;
$widgets->register(new \Elementor\CustomMegaMenu());


