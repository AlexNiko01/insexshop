<?php
// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	die();
}

class AMPHTML_No_Conflict {

	public function __construct() {
		$this->no_conflict();
	}

	public function no_conflict() {
		if ( AMPHTML()->is_amp() ) {
			remove_filter( 'template_redirect', 'redirect_canonical' );
			add_action( 'wp', array( $this, 'rocket_disable_options_on_amp' ) );
			add_action( 'wp', array( $this, 'disable_aisop_ga' ) );
			add_filter( 'bj_lazy_load_run_filter', '__return_false' );
			$this->WPML();
			$this->hyper_cache_compatibility();
			$this->jetpack_compatibility();
			add_filter( 'amphtml_illegal_tags', array( $this, 'sanitize_goodlayer_content' ) );
			if ( AMPHTML::instance()->is_yoast_seo() ) {
				add_action( 'wp', array ( $this, 'fix_yoast_seo_title' ) );
				add_action( 'wp', array ( $this, 'fix_yoast_seo_desc' ) );
			}
			if ( AMPHTML::instance()->is_aiosp() ) {
				add_action( 'wp', array ( $this, 'fix_aiosp_title' ), 999 );
				add_action( 'wp', array ( $this, 'fix_aiosp_desc' ), 999 );
			}
			$this->disable_w3_total_cache();
		}
	}

	/**
	 * Remove Minification, DNS Prefetch, LazyLoad, Defer JS when on an AMP version of a post
	 */
	function rocket_disable_options_on_amp() {
		if ( function_exists( 'wp_resource_hints' ) ) {
			remove_filter( 'wp_resource_hints', 'rocket_dns_prefetch', 10 );
		} else {
			remove_filter( 'rocket_buffer', '__rocket_dns_prefetch_buffer', 12 );
		}
		remove_filter( 'rocket_buffer', 'rocket_exclude_deferred_js', 11 );
		remove_filter( 'rocket_buffer', 'rocket_dns_prefetch', 12 );
		remove_filter( 'rocket_buffer', 'rocket_minify_process', 13 );
		add_filter( 'do_rocket_lazyload', '__return_false' );
	}

	/**
	 * all-in-one-seo-pack
	 */
	public function disable_aisop_ga() {
		if ( AMPHTML()->is_aiosp() ) {
			global $aiosp;
			remove_action( 'aioseop_modules_wp_head', array( $aiosp, 'aiosp_google_analytics' ) );
			remove_action( 'wp_head', array( $aiosp, 'aiosp_google_analytics' ) );
			add_filter( 'aiosp_google_analytics', '__return_false' );
		}
	}

	/**
	 * WPML
	 */
	public function WPML() {
		if ( class_exists( 'SitePress' ) ) {
			define( 'ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS', true );
		}
	}

	/*
	 * Hyper Cache
	 */
	public function hyper_cache_compatibility() {
		global $cache_stop;
		if ( AMPHTML()->is_amp() !== false ) {
			$cache_stop = true;
		}
	}

	/*
	 * Jetpack
	 */
	public function jetpack_compatibility() {
			//remove sharing buttons
			add_filter( 'sharing_show', '__return_false' );
			//remove related posts
			add_filter( 'wp', array ( $this, 'jetpackme_remove_rp' ), 20 );
			//remove like buttons
			add_action( 'wp', array ( $this, 'jetpackme_remove_likes' ) );
	}

	public function jetpackme_remove_rp() {
		if ( class_exists( 'Jetpack_RelatedPosts' ) ) {
			$jprp     = Jetpack_RelatedPosts::init();
			$callback = array ( $jprp, 'filter_add_target_to_dom' );
			remove_filter( 'the_content', $callback, 40 );
		}
	}

	public function jetpackme_remove_likes() {
		remove_filter( 'the_content', 'sharing_display', 19 );
		remove_filter( 'the_excerpt', 'sharing_display', 19 );
		if ( class_exists( 'Jetpack_Likes' ) ) {
			remove_filter( 'the_content', array( Jetpack_Likes::init(), 'post_likes' ), 30, 1 );
		}
	}

	public function sanitize_goodlayer_content( $tags ) {
		$tags[] = 'pre[class=gdlr_rp]';
		return $tags;
	}

	public function fix_yoast_seo_title() {
        global $wp_query;

        if ( ($wp_query->is_posts_page != false ) || ( is_home() && ( $wp_query->is_posts_page == false ) ) ) {
	        add_filter( 'amphtml_template_load_after', array ( $this, 'get_yoast_seo_title' ) );
        }
    }

	public function fix_yoast_seo_desc() {
		global $wp_query;

		if (  is_home()  && ( $wp_query->is_posts_page == false ) ) {
			add_filter( 'wpseo_metadesc', array ( $this, 'wpseo_metadesc_filter_fix' ) );
		}

	}

	public function get_yoast_seo_title( $template ) {
		global $wp_query;
		if ( is_home() ) {
			$post_id = get_option( 'page_on_front' );
		}
		if ( $wp_query->is_posts_page ) {
			$post_id = get_option( 'page_for_posts' );
		}
		$fixed_title = WPSEO_Meta::get_value( 'title', $post_id );
		if ( $fixed_title !== '' ) {
			$template->doc_title = $fixed_title;

			return $template;
		}

		$post    = get_post( $post_id );
		$options = WPSEO_Options::get_option( 'wpseo_titles' );
		if ( is_object( $post ) && ( isset( $options[ 'title-' . $post->post_type ] ) && $options[ 'title-' . $post->post_type ] !== '' ) ) {
			$title_template = $options[ 'title-' . $post->post_type ];
			$title_template = str_replace( ' %%page%% ', ' ', $title_template );

			$template->doc_title = wpseo_replace_vars( $title_template, $post );

			return $template;
		}

		$template->doc_title = wpseo_replace_vars( '%%title%%', $post );

		return $template;
	}

	public function wpseo_metadesc_filter_fix( $metadesc, $post ) {
		$current_post_id = get_option( 'page_on_front' );
		$wpseo_metadesc  = WPSEO_Meta::get_value( 'metadesc', $current_post_id );

		return $wpseo_metadesc;
	}

	public function fix_aiosp_title() {
		global $wp_query;

		if ( ( $wp_query->is_posts_page != false ) || ( is_home() && ( $wp_query->is_posts_page == false ) ) ) {
			add_filter( 'amphtml_template_load_after', array ( $this, 'aiosp_fix_title' ) );
		}
	}

	public function aiosp_fix_title( $template ) {
		global $aioseop_options, $wp_query;

		$title_format = $aioseop_options['aiosp_page_title_format'];
		if ( is_home() ) {
			$page_id = get_option( 'page_on_front' );
		}
		if ( $wp_query->is_posts_page ) {
			$page_id = get_option( 'page_for_posts' );
		}
		if ( ! empty( $aioseop_options['aiosp_use_static_home_info'] ) ) {
			$title = get_post_meta( $page_id, '_aioseop_title', true );

			if ( empty( $title ) ) {
				$title = get_the_title( $page_id );
			}

			if ( $wp_query->is_posts_page ) {
				$title_format = str_replace( '%page_title%', $title, $title_format );
				$title        = str_replace( '%blog_title%', get_bloginfo( 'name' ), $title_format );
			}
			$template->doc_title = $title;

			return $template;
		}

		$template->doc_title = $aioseop_options['aiosp_home_title'];

		return $template;
	}

	public function fix_aiosp_desc() {
		global $wp_query;
		if ( is_home() && ( $wp_query->is_posts_page == false ) ) {
			add_filter( 'aioseop_description', array ( $this, 'aiosp_fix_descriptions' ) );
		}
	}

	public function aiosp_fix_descriptions() {
		global $aioseop_options;
		if ( ! empty( $aioseop_options['aiosp_use_static_home_info'] ) ) {
			$current_post_id = get_option( 'page_on_front' );

			return get_post_meta( $current_post_id, '_aioseop_description', true );
		}

		return $aioseop_options['aiosp_home_description'];

	}

	public function disable_w3_total_cache() {
		if ( is_plugin_active( 'w3-total-cache/w3-total-cache.php' ) ) {
			//Disables page caching for a given page.
			define('DONOTCACHEPAGE', true);

			//Disables database caching for given page.
			define('DONOTCACHEDB', true);

			//Disables minify for a given page.
			define('DONOTMINIFY', true);

			//Disables content delivery network for a given page.
	        define('DONOTCDN', true);

			//Disables object cache for a given page.
			define('DONOTCACHEOBJECT', true);
		}
	}

}