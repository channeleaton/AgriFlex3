<?php

/**
 * Add Search field
 * @package AgriFlex3
 * @since 1.0
 */

class AgriFlex_Search
{

    public function __construct() {

        //* Add search to header main navigation
        $this->add_search_to_menu();

    }

    /**
     * Add search field to main navigation
     * @since 1.0
     * @return void
     */
    private function add_search_to_menu()
    {

        add_filter( 'genesis_do_nav', array( $this, 'custom_nav_walker_search' ), 11, 3 );

    }

    public function custom_nav_walker_search( $nav_output, $nav, $args ) {

        $args['menu_class'] = $args['menu_class'] . ' left';
        $args['walker'] = new AgriFlex_CustomNavigationWalker;

        $search_form = '
        <form action="#" method="post" class="inline-form search-form">
            <fieldset>
                <legend class="is-vishidden">Search</legend>
                <label for="search-field" class="is-vishidden">Search</label>
                <input type="search" placeholder="Search" id="search-field" class="search-field">
                <button class="search-submit">
                    <span class="icon-search" aria-hidden="true"></span>
                    <span class="is-vishidden">Search</span>
                </button>
            </fieldset>
        </form>';

        $title = '<ul class="title-area"><li class="name"></li><li class="toggle-topbar menu-icon"><a><span></span></a></ul>';

        $nav = $title . '<section class="top-bar-section">' . wp_nav_menu( $args ) . $search_form  . '</section>';

        $nav_markup_open = genesis_markup( array(
            'html5' => '<div class="top-bar-wrapper contain-to-grid"><nav class="nav-primary top-bar" data-topbar data-options="is_hover: false">',
            'xhtml' => '<div id="nav">',
            'context' => 'nav-primary',
            'echo' => false,
        ) );

        $nav_markup_open .= genesis_structural_wrap( 'menu-primary', 'open', 0 );

        $nav_markup_close = genesis_structural_wrap( 'menu-primary', 'close', 0 );
        $nav_markup_close .= genesis_html5() ? '</nav>' : '';
        $nav_markup_close .= do_action('agriflex_after_nav');
        $nav_markup_close .= '</div>';

        $nav_output = $nav_markup_open . $nav . $nav_markup_close;

        return $nav_output;

    }

}
