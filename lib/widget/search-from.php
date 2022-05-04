<?php

namespace Elementor;

class CustomSearchForm extends Widget_Base
{

    public function get_style_depends()
    {
        return ['ber-css-search-form'];
    }
//
    public function get_script_depends()
    {
        return ['jquery', 'ber-js-search-form'];
    }

    public function get_name()
    {
        return "custom-search-form";
    }

    public function get_title()
    {
        return "Search Form";
    }

    public function get_icon()
    {
        return 'eicon-site-search';
    }

    public function get_keywords()
    {
        return ['menu', 'nav', 'button', 'search'];
    }

    public function get_categories()
    {
        return ['hello-elementor-theme'];
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            'capital_content_section',
            [
                'label' => __('Layout', 'bestelectric'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'control-name',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label' => esc_html__( 'Placeholder', 'bestelectric' ),
                'default'=>'Search'
            ]
        );

        $this->end_controls_section();


    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        ?>

        <div class="o-header__col-search" >
            <div class="JS--mobile-search-form">
                <div class="c-search-form">
                    <form class="search" method="get" action="<?php echo home_url(); ?>" role="search">
                        <input class="c-search-form__input" type="search" name="s" value="<?php the_search_query(); ?>"
                               placeholder="<?php _e($settings['control-name'], 'hello-elementor-child'); ?>">
                        <button class="c-search-form__submit" type="submit" role="button" style="background-color: transparent!important;">
                            <?php echo get_search_icon(); ?>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <?php
    }
}

global $widgets;

$widgets->register(new \Elementor\CustomSearchForm());

